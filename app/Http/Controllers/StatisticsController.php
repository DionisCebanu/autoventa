<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SoldCar;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatisticsController extends Controller
{
    public function sold()
    {
        $soldCars = SoldCar::with('car')->get();

        // Récupérer nombre de ventes ET total des prix groupés par mois
        $salesStats = SoldCar::selectRaw('MONTH(sold_date) as month, COUNT(*) as car_count, SUM(sold_price) as total_price')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $months = [];
        $carCounts = [];
        $totalPrices = [];

        foreach ($salesStats as $stat) {
            $months[] = Carbon::create()->month($stat->month)->format('F');
            $carCounts[] = $stat->car_count;
            $totalPrices[] = $stat->total_price;
        }

        return view('statistics.sold', compact('soldCars', 'months', 'carCounts', 'totalPrices'));
    }

}
