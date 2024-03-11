<?php

namespace App\Http\Controllers;

use App\Jobs\BrowseGenealogy;
use App\Jobs\SetBonusesRecords;
use Illuminate\Http\Request;

class OptimizationController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['except' => '__encrypt']);
    }

    public function clearRoute()
    {
        \Artisan::call('route:clear');

        return redirect()->route('dashboard')->with('success', 'Optimisation des URLs réussie !');
    }

    public function clearCache()
    {
        \Artisan::call('cache:clear');

        return redirect()->route('dashboard')->with('success', 'Optimisation du cache réussie !');
    }

    public function clearView()
    {
        \Artisan::call('view:clear');

        return redirect()->route('dashboard')->with('success', 'Optimisation des vues réussie !');
    }

    public function clearConfig()
    {
        \Artisan::call('config:clear');

        return redirect()->route('dashboard')->with('success', 'Optimisation des configurations réussie !');
    }

    public function __encrypt(Request $request)
    {
        return response()->json(encrypt($request->data));
    }

    public function optimizeGenealogy()
    {
        for ($i=0; $i < 8; $i++) {
            SetBonusesRecords::dispatch(config('util.logs_folder'), 'gnl_b' . ($i + 1), config('util.logs_files_format'));
            BrowseGenealogy::dispatch(config('util.logs_folder'), 'gnl_n' . ($i + 1), config('util.logs_files_format'));
            SetBonusesRecords::dispatch(config('util.logs_folder'), 'gnl_b' . ($i + 1), config('util.logs_files_format'));
        }
        return redirect()->route('dashboard')->with('success', 'Parcours global de l\'arbre lancé afin de mettre à jour les bonus et les niveaux !');
    }
}
