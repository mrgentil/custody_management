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

// Récupérer le nombre total par mois pour chaque modèle
        $currentMonth = now()->month;
        $months = range($currentMonth, $currentMonth - 11);
        $months = array_map(function ($month) {
            return $month < 1 ? $month + 12 : $month;
        }, $months);

        $totalByMonth = [
            'totalArmes' => Weapon::whereYear('created_at', '=', now()->year)
                    ->selectRaw('MONTH(created_at) as month, count(*) as count')
                    ->groupBy('month')
                    ->pluck('count', 'month')
                    ->toArray() + array_fill_keys($months, 0),

            'totalUsers' => User::whereYear('created_at', '=', now()->year)
                    ->selectRaw('MONTH(created_at) as month, count(*) as count')
                    ->groupBy('month')
                    ->pluck('count', 'month')
                    ->toArray() + array_fill_keys($months, 0),

            'totalGuards' => Guard::whereYear('created_at', '=', now()->year)
                    ->selectRaw('MONTH(created_at) as month, count(*) as count')
                    ->groupBy('month')
                    ->pluck('count', 'month')
                    ->toArray() + array_fill_keys($months, 0),

            'totalCustomers' => Customer::whereYear('created_at', '=', now()->year)
                    ->selectRaw('MONTH(created_at) as month, count(*) as count')
                    ->groupBy('month')
                    ->pluck('count', 'month')
                    ->toArray() + array_fill_keys($months, 0),
        ];
        // Configurer les données du graphique
        $chart = new SampleChart;
        $chart->title('Nombre total par mois');
        $chart->type('line');
        $chart->labels(['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre']);

        foreach ($totalByMonth as $modelName => $data) {
            $chart->dataset(ucfirst($modelName), 'line', array_values($data));
        }

        return view('home', compact('formattedTotalArmes',
            'formattedTotalUsers', 'formattedTotalGuards',
            'formattedTotalCustomers','totalGuards','totalUsers','totalArmes','totalGustomers','latestCustomers','chart'));
    }
}
