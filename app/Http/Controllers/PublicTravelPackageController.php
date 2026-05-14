<?php

namespace App\Http\Controllers;

use App\Models\TravelPackage;
use Illuminate\View\View;

class PublicTravelPackageController extends Controller
{
    public function index(): View
    {
        return view('packages.index', [
            'packages' => TravelPackage::query()
                ->where('is_published', true)
                ->with('destination')
                ->latest()
                ->get(),
        ]);
    }

    public function show(TravelPackage $package): View
    {
        abort_unless($package->is_published, 404);

        return view('packages.show', [
            'package' => $package->load('destination'),
            'relatedPackages' => TravelPackage::query()
                ->where('is_published', true)
                ->whereKeyNot($package->id)
                ->with('destination')
                ->latest()
                ->limit(3)
                ->get(),
        ]);
    }
}
