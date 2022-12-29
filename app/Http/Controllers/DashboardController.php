<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Matkul;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $dosens = Dosen::count();
        $matkuls = Matkul::count();

        return view('dashboard', compact('dosens','matkuls'));
    }
}
