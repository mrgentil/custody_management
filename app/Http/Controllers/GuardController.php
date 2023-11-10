<?php

namespace App\Http\Controllers;

use App\Models\Guard;
use App\Models\Role;
use App\Models\User;
use App\Models\Weapon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class GuardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $guards = Guard::paginate(10);
        return view('guards.index',compact('guards'));
    }

    public function create()
    {
        // Récupérer les rôles pour le formulaire d'édition
        $roles = Role::all();
        return view('guards.create', compact('roles'));
    }

    public function store(Request $request)
    {
        // Validez les données du formulaire
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'function' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'service' => 'required|string|max:255',
            'unite' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image optionnelle, formats autorisés et taille maximale de 2 Mo
            'birth_date' => 'required|date',
            'adresse' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'hire_date' => 'required|date',
        ]);

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->storeAs('public/gardes', $request->file('avatar')->getClientOriginalName());
            $avatarPath = str_replace('public/', '', $avatarPath);
        } else {
            $avatarPath = null;
        }

        // Récupérez l'ID du rôle "garde"
        $roleGardeId = Role::where('name', 'Garde')->first()->id;
        // Récupérez l'ID du user
        $user = auth()->user()->id;

        // Créez un nouvel enregistrement de garde
        Guard::create([
            'name' => $validatedData['name'],
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'function' => $validatedData['function'],
            'degree' => $validatedData['degree'],
            'service' => $validatedData['service'],
            'unite' => $validatedData['unite'],
            'role_id' => $roleGardeId,// Utilisez l'ID du rôle "garde"
            'user_id' => $user,
            'avatar' => $avatarPath,
            'birth_date' => $validatedData['birth_date'],
            'adresse' => $validatedData['adresse'],
            'phone' => $validatedData['phone'],
            'hire_date' => $validatedData['hire_date'],
        ]);
        // Redirigez l'utilisateur vers la liste des gardes ou une autre page appropriée
        return redirect()->route('guards.index')->with('success', 'Le garde a été créé avec succès.');
    }

    public function edit(Guard $guard)
    {
        // Récupérer les rôles pour le formulaire d'édition
        $roles = Role::all();
        return view('guards.edit', compact('guard', 'roles'));
    }

    public function update(Request $request, Guard $guard)
    {
        // Validez les données du formulaire
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'function' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'service' => 'required|string|max:255',
            'unite' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image optionnelle, formats autorisés et taille maximale de 2 Mo
            'birth_date' => 'required|date',
            'adresse' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'hire_date' => 'required|date',
        ]);
        $roleGardeId = Role::where('name', 'Garde')->first()->id;

        // Mettre à jour les champs de l'utilisateur
        $guard->name = $validatedData['name'];
        $guard->first_name = $validatedData['first_name'];
        $guard->last_name = $validatedData['last_name'];
        $guard->function = $validatedData['function'];
        $guard->degree = $validatedData['degree'];
        $guard->service = $validatedData['service'];
        $guard->unite = $validatedData['unite'];
        $guard->birth_date = $validatedData['birth_date'];
        $guard->hire_date = $validatedData['hire_date'];
        $guard->phone = $validatedData['phone'];
        $guard->adresse = $validatedData['adresse'];
        $guard->role_id = $roleGardeId;
        // Mettre à jour l'avatar s'il est fourni
        if ($request->hasFile('avatar')) {
            // Supprimer l'ancien avatar s'il existe
            if ($guard->avatar) {
                Storage::delete('public/' . $guard->avatar);
            }
            // Enregistrer le nouvel avatar
            $avatarPath = $request->file('avatar')->storeAs('public/gardes', $request->file('avatar')->getClientOriginalName());
            $guard->avatar = str_replace('public/', '', $avatarPath);
        }
        $guard->save();
        // Redirigez l'utilisateur vers la liste des gardes ou une autre page appropriée
        return redirect()->route('guards.index')->with('success', 'Le garde a été mis à jour avec succès.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $guards = Guard::where('name', 'like', '%' . $query . '%')
            ->orWhere('last_name', 'like', '%' . $query . '%')
            ->paginate(10);

        return view('guards.index', compact('guards'));
    }
}
