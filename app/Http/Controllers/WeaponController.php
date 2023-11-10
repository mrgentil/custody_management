<?php

namespace App\Http\Controllers;

use App\Models\Guard;
use App\Models\Weapon;
use Illuminate\Http\Request;

class WeaponController extends Controller
{
    public function index()
    {
        $armes = Weapon::all();
        return view('armes.index', compact('armes'));
    }

    public function create()
    {
        $gardes = Guard::all();
        return view('armes.create', compact('gardes'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'serie_number' => 'required|string|max:255',
            'acquisition_date' => 'required|date',
            'state' => 'required|in:En possession,Non possession',
            'guard_id' => 'nullable|exists:guards,id',
        ]);

        $arme = Weapon::create($validatedData);

        // Création de l'utilisateur
        $arme = new Weapon([
            'name' => $validatedData['name'],
            'type' => $validatedData['type'],
            'serie_number' => $validatedData['serie_number'],
            'acquisition_date' => $validatedData['acquisition_date'],
            'state' => $validatedData['state'],
            'guard_id' => $validatedData['guard_id'],
        ]);

        return redirect()->route('armes.index')->with('success', 'Arme enregistrée avec succès.');
    }

    public function edit(Arme $arme)
    {
        $gardes = Guard::all();
        return view('armes.edit', compact('arme', 'gardes'));
    }

    public function update(Request $request, Weapon $arme)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'serie_number' => 'required|string|max:255',
            'acquisition_date' => 'required|date',
            'state' => 'required|in:En possession,Non possession',
            'guard_id' => 'nullable|exists:guards,id',
        ]);

        $arme->update($validatedData);
        return redirect()->route('armes.index')->with('success', 'Arme mise à jour avec succès.');
    }
}
