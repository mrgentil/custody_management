<?php

namespace App\Livewire;

use App\Models\CategorieUser;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserForm extends Component
{
    use WithFileUploads; // Utilisez le trait WithFileUploads

    public $name;
    public $phone;
    public $address;
    public $email;
    public $role_id;
    public $category_id;
    public $gender;
    public $avatar;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'role_id' => 'required|exists:roles,id',
        'category_id' => 'required|exists:categorie_users,id',
        'gender' => 'required|in:M,F',
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'password' => 'required|string|min:8|confirmed',
    ];

    public function store()
    {
        $this->validate();

        // Téléchargez l'avatar s'il est fourni
        $avatarPath = null;
        if ($this->avatar) {
            $avatarPath = $this->avatar->store('public/avatars');
            $avatarPath = str_replace('public/', '', $avatarPath);
        }

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'password' => Hash::make($this->password),
            'gender' => $this->gender,
            'role_id' => $this->role_id,
            'category_id' => $this->category_id,
            'avatar' => $avatarPath,
            'is_active' => true, // Vous pouvez modifier cela selon vos besoins
            'first_login' => true, // Vous pouvez modifier cela selon vos besoins
        ]);

        // Réinitialisez les propriétés du formulaire après l'ajout de l'utilisateur
        $this->reset();

        // Envoyez un message de succès
        session()->flash('success', 'Utilisateur créé avec succès.');
    }


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        $roles = Role::all();
        $categories = CategorieUser::all();

        return view('livewire.user-form', compact('roles', 'categories'));
    }
}
