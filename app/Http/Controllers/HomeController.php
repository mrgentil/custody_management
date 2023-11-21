<?php

namespace App\Http\Controllers;

use App\Charts\SampleChart;
use App\Models\Customer;
use App\Models\Guard;
use App\Models\User;
use App\Models\Weapon;
use ConsoleTVs\Charts\Facades\Charts;

use Illuminate\Http\Request;
use function formatNumber;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalArmes = Weapon::count();
        $totalUsers = User::count();
        $totalGuards = Guard::count();
        $totalGustomers = Customer::count();

        $formattedTotalArmes = formatNumber($totalArmes);
        $formattedTotalUsers = formatNumber($totalUsers);
        $formattedTotalGuards = formatNumber($totalGuards);
        $formattedTotalCustomers = formatNumber($totalGustomers);

        $latestCustomers = Customer::latest()->paginate(5);

        $chart = new SampleChart;
        // Configurer les données du graphique
        $chart->labels(['Armes', 'Utilisateurs', 'Gardes', 'Clients']);
        $chart->dataset('Nombre total', 'bar', [$totalArmes, $totalUsers, $totalGuards, $totalGustomers]);

        return view('home', compact('formattedTotalArmes',
            'formattedTotalUsers', 'formattedTotalGuards',
            'formattedTotalCustomers','totalGuards','totalUsers','totalArmes','totalGustomers','latestCustomers','chart'));
    }
}
