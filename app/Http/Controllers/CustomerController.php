<?php

namespace App\Http\Controllers;

use App\Exports\CustomersExport;
use App\Models\CategorieUser;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $customers = Customer::paginate(10);
        return view('customers.index',compact('customers'));
    }

    public function create()
    {

        $categories = CategorieUser::all();
        return view('customers.create',compact('categories'));
    }


    public function store(Request $request)
    {
        // Valider les données
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'function' => 'required|string|max:255',
            'gender' => 'required|in:M,F', // Valider que le genre est "M" ou "F"
            'created_by' => auth()->id(), // Utilisez l'ID de l'utilisateur actuellement connecté
            'category_id' => 'required|exists:categorie_users,id', // Assurez-vous que category_id existe dans la table des categorie_users
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image optionnelle, formats autorisés et taille maximale de 2 Mo
        ]);
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->storeAs('public/customers', $request->file('avatar')->getClientOriginalName());
            $avatarPath = str_replace('public/', '', $avatarPath);
        } else {
            $avatarPath = null;
        }
        // Création de l'utilisateur
        $customer = new Customer([
            'name' => $validatedData['name'],
            'first_name' => $validatedData['first_name'],
            'function' => $validatedData['function'],
            'phone' => $validatedData['phone'],
            'adresse' => $validatedData['adresse'],
            'gender' => $validatedData['gender'],
            'last_name' => $validatedData['last_name'],
            'category_id' => $validatedData['category_id'],
            'avatar' => $avatarPath,
        ]);

        $customer->save();

        // Rediriger vers la page d'accueil ou une autre page appropriée après la création
        return redirect()->back()->with('success', 'Client créé avec succès.');

    }

    public function edit(Customer $customer)
    {
        $categories = CategorieUser::all();
        return view('customers.edit', compact('customer', 'categories'));
    }

    public function update(Request $request, Customer $customer)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'function' => 'required|string|max:255',
            'gender' => 'required|in:M,F', // Valider que le genre est "M" ou "F"
            'created_by' => auth()->id(), // Utilisez l'ID de l'utilisateur actuellement connecté
            'category_id' => 'required|exists:categorie_users,id', // Assurez-vous que category_id existe dans la table des categorie_users
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image optionnelle, formats autorisés et taille maximale de 2 Mo
        ]);


        // Mettre à jour les champs de l'utilisateur
        $customer->name = $validatedData['name'];
        $customer->first_name = $validatedData['first_name'];
        $customer->function = $validatedData['function'];
        $customer->phone = $validatedData['phone'];
        $customer->last_name = $validatedData['last_name'];
        $customer->gender = $validatedData['gender'];
        $customer->adresse = $validatedData['adresse'];
        $customer->category_id = $validatedData['category_id'];

        // Mettre à jour l'avatar s'il est fourni
        if ($request->hasFile('avatar')) {
            // Supprimer l'ancien avatar s'il existe
            if ($customer->avatar) {
                Storage::delete('public/' . $customer->avatar);
            }
            // Enregistrer le nouvel avatar
            $avatarPath = $request->file('avatar')->storeAs('public/customers', $request->file('avatar')->getClientOriginalName());
            $customer->avatar = str_replace('public/', '', $avatarPath);
        }

        $customer->save();
        // Rediriger vers la page d'accueil ou une autre page appropriée après la mise à jour
        return redirect()->back()->with('success', 'Client mis à jour avec succès.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $customers = Customer::where('name', 'like', '%' . $query . '%')
            ->paginate(10);

        return view('customers.index', compact('customers'));
    }

    public function exportCustomers()
    {
        $query = Customer::query(); // Utilisez query() au lieu de latest()
        return Excel::download(new CustomersExport($query), 'customers.xlsx');
    }

}
