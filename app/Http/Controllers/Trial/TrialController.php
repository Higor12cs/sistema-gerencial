<?php

namespace App\Http\Controllers\Trial;

use App\Http\Controllers\Controller;
use App\Models\Trial;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TrialController extends Controller
{
    public function index(): View
    {
        $teste = Trial::all();
        $trials = [];
        return view('app.trials.index', compact('trials'));
    }
}
