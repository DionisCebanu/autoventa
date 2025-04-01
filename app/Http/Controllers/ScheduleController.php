<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Support\Facades\Storage;

class ScheduleController extends Controller
{
    public function create() {
        return view('administration.schedule.create');
    }
}


?>