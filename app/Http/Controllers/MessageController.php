<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    public function index()
    {
        // Récupérer toutes les conversations de l'utilisateur authentifié
        $conversations = \DB::table('messages')
            ->select('sender_id', 'receiver_id', \DB::raw('MAX(id) as max_id'), \DB::raw('COUNT(*) as message_count'))
            ->where('sender_id', Auth::id())
            ->orWhere('receiver_id', Auth::id())
            ->groupBy('sender_id', 'receiver_id')
            ->get();

        foreach ($conversations as $conversation) {
            $conversation->otherUser = User::find($conversation->sender_id === Auth::id() ? $conversation->receiver_id : $conversation->sender_id);

            // Calculer le nombre de messages non lus
            $conversation->unread_count = Message::where('sender_id', $conversation->otherUser->id)
                ->where('receiver_id', Auth::id())
                ->whereNull('read_at') // Assurez-vous que la colonne "read_at" est bien définie dans votre table
                ->count();
        }


        $allUsers = User::all();
        return view('messages.index', compact('allUsers','conversations'));
    }

    public function show($userId)
    {
        // Récupérer les messages entre l'utilisateur authentifié et l'utilisateur $userId
        $messages = Message::where(function ($query) use ($userId) {
            $query->where('sender_id', Auth::id())
                ->where('receiver_id', $userId);
        })
            ->orWhere(function ($query) use ($userId) {
                $query->where('sender_id', $userId)
                    ->where('receiver_id', Auth::id());
            })
            ->orderBy('created_at', 'asc')
            ->get();
        // Récupérer les informations de l'utilisateur avec qui la conversation a lieu
        $otherUser = User::findOrFail($userId);

        return view('messages.show', compact('messages', 'otherUser'));
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'recipient_id' => 'required|exists:users,id',
            'content' => 'required|string',
        ]);

        // Créer un nouveau message
        $message = new Message([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->input('recipient_id'),
            'content' => $request->input('content'),
        ]);

        $message->save();

        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Message envoyé avec succès!');
    }
}
