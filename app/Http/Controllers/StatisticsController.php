<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SoldCar;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function sold()
    {
        $soldCars = SoldCar::with('car')->get();

        // Exemple de données groupées pour diagramme
        $salesByMonth = SoldCar::selectRaw('MONTH(sold_date) as month, COUNT(*) as count')
            ->groupBy(DB::raw('MONTH(sold_date)'))
            ->pluck('count', 'month');

        return view('statistics.sold', compact('soldCars', 'salesByMonth'));
    }
}
