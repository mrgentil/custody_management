<?php

namespace App\Http\Controllers;

use App\Models\CategorieUser;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;


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

    public function create()
    {
        // Récupérer les rôles pour le formulaire d'édition
        $roles = Role::all();
        return view('users.create',compact('roles'));
    }

    public function suspend(User $user)
    {
        $user->is_active = false;
        $user->save();

        // Invalidate the user's session
        if (Auth::check() && Auth::user()->id === $user->id) {
            session()->invalidate();
            session()->regenerateToken();
            return redirect()->route('login')->with('success', 'Votre compte a été suspendu.');
        }

        return redirect()->back()->with('success', 'Utilisateur suspendu avec succès.');
    }

    public function activate(User $user)
    {
        $user->is_active = 1; // Activer l'utilisateur
        $user->save();

        return redirect()->back()->with('success', 'Utilisateur activé avec succès.');
    }

    public function store(Request $request)
    {
        // Valider les données
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed', // Assurez-vous d'avoir un champ de confirmation de mot de passe
            'gender' => 'required|in:M,F', // Valider que le genre est "M" ou "F"
            'role_id' => 'required|exists:roles,id', // Assurez-vous que role_id existe dans la table des rôles
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image optionnelle, formats autorisés et taille maximale de 2 Mo
        ]);
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->storeAs('public/avatars', $request->file('avatar')->getClientOriginalName());
            $avatarPath = str_replace('public/', '', $avatarPath);
        } else {
            $avatarPath = null;
        }

        // Création de l'utilisateur
        $user = new User([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'address' => $validatedData['address'],
            'password' => Hash::make($validatedData['password']),
            'gender' => $validatedData['gender'],
            'role_id' => $validatedData['role_id'],
            'avatar' => $avatarPath,
            'is_active' => true, // Vous pouvez modifier cela selon vos besoins
            'first_login' => true, // Vous pouvez modifier cela selon vos besoins
        ]);

        $user->save();

        // Rediriger vers la page d'accueil ou une autre page appropriée après la création
        return redirect()->back()->with('success', 'Utilisateur créé avec succès.');

    }

    public function edit(User $user)
    {
        // Récupérer les rôles pour le formulaire d'édition
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'gender' => 'required|in:M,F',
            'role_id' => 'required|exists:roles,id',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        // Mettre à jour les champs de l'utilisateur
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->phone = $validatedData['phone'];
        $user->gender = $validatedData['gender'];
        $user->address = $validatedData['address'];
        $user->role_id = $validatedData['role_id'];

        // Mettre à jour le mot de passe s'il est fourni
        if ($validatedData['password']) {
            $user->password = Hash::make($validatedData['password']);
        }

        // Mettre à jour l'avatar s'il est fourni
        if ($request->hasFile('avatar')) {
            // Supprimer l'ancien avatar s'il existe
            if ($user->avatar) {
                Storage::delete('public/' . $user->avatar);
            }
            // Enregistrer le nouvel avatar
            $avatarPath = $request->file('avatar')->storeAs('public/avatars', $request->file('avatar')->getClientOriginalName());
            $user->avatar = str_replace('public/', '', $avatarPath);
        }

        $user->save();
        // Rediriger vers la page d'accueil ou une autre page appropriée après la mise à jour
        return redirect()->back()->with('success', 'Utilisateur mis à jour avec succès.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $users = User::where('name', 'like', '%' . $query . '%')
            ->orWhere('email', 'like', '%' . $query . '%')
            ->paginate(10);

        return view('users.index', compact('users'));
    }
    public function show()
    {
        // Récupérez l'ID de vue Google Analytics que vous avez configuré dans .env
        $viewId = config('analytics.view_id');

        // Récupérez les statistiques Google Analytics
        $analyticsData = Analytics::performQuery(
            Period::days(7),
            'ga:pageviews',
            [
                'dimensions' => 'ga:pagePath',
            ]
        );

        return view('users.show', compact('analyticsData'));
    }

}
