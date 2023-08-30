<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::paginate(10);
        return view('users.index',compact('users'));
    }

//    public function suspend(User $user)
//    {
//        $user->update([
//            'is_active' => false, // Mettre à 0 pour suspendre l'utilisateur
//        ]);
//
//        return redirect()->back()->with('success', 'Utilisateur suspendu avec succès.');
//    }

    public function suspend(User $user)
    {
        $user->is_active = 0; // Suspendre l'utilisateur
        $user->save();

        return redirect()->back()->with('success', 'Utilisateur suspendu avec succès.');
    }

    public function activate(User $user)
    {
        $user->is_active = 1; // Activer l'utilisateur
        $user->save();

        return redirect()->back()->with('success', 'Utilisateur activé avec succès.');
    }



}
