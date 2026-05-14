<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\View\View;

class PublicDestinationController extends Controller
{
    public function index(): View
    {
        return view('destinations.index', [
            'destinations' => Destination::query()
                ->where('is_published', true)
                ->latest()
                ->get(),
        ]);
    }

    public function show(Destination $destination): View
    {
        abort_unless($destination->is_published, 404);

        return view('destinations.show', [
            'destination' => $destination->load('travelPackages'),
            'relatedDestinations' => Destination::query()
                ->where('is_published', true)
                ->whereKeyNot($destination->id)
                ->latest()
                ->limit(3)
                ->get(),
        ]);
    }
}
