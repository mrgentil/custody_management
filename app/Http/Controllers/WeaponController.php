<?php

namespace App\Http\Controllers;

use App\Models\Guard;
use App\Models\Weapon;
use Illuminate\Http\Request;

class WeaponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $armes = Weapon::paginate(10);
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
            'guard_id' => 'nullable|exists:guards,id',
        ]);

        $armedState = $request->input('state', 'Non possession');

        Weapon::create([
            'name' => $validatedData['name'],
            'type' => $validatedData['type'],
            'serie_number' => $validatedData['serie_number'],
            'acquisition_date' => $validatedData['acquisition_date'],
            'state' => $armedState,
            'guard_id' => $validatedData['guard_id'],
        ]);

        return redirect()->route('weapons.index')->with('success', 'Arme enregistrée avec succès.');
    }

    public function edit(Weapon $weapon)
    {
        $gardes = Guard::all();
        return view('armes.edit', compact('weapon', 'gardes'));
    }

    public function update(Request $request, Weapon $arme)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'serie_number' => 'required|string|max:255',
            'acquisition_date' => 'required|date',
            'guard_id' => 'nullable|exists:guards,id',
        ]);

        $armedState = $request->input('state', 'Non possession');

        $arme->update([
            'name' => $validatedData['name'],
            'type' => $validatedData['type'],
            'serie_number' => $validatedData['serie_number'],
            'acquisition_date' => $validatedData['acquisition_date'],
            'state' => $armedState,
            'guard_id' => $validatedData['guard_id'],
        ]);
        return redirect()->route('armes.index')->with('success', 'Arme mise à jour avec succès.');
    }

    public function disarm(Weapon $weapon)
    {
        // Désarmer la garde en supprimant la relation entre l'arme et le garde (en mettant guard_id à null)
        $weapon->update(['guard_id' => null]);

        return redirect()->route('weapons.index')->with('success', 'L\'arme a été désarmée avec succès.');
    }

    public function arm(Weapon $weapon)
    {
        // Armement de la garde en établissant la relation entre l'arme et le garde (en définissant guard_id)
        // Vous devez choisir une garde pour armer l'arme, par exemple, la première garde de la liste.
        $guard = Guard::first();
        $weapon->update(['guard_id' => $guard->id]);

        return redirect()->route('weapons.index')->with('success', 'L\'arme a été armée avec succès.');
    }


}
