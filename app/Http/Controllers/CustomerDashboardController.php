<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerDashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $user = $request->user();

        return view('customer.dashboard', [
            'documents' => $user->documents()
                ->where('is_visible_to_customer', true)
                ->latest()
                ->get(),
            'itineraries' => $user->itineraries()
                ->with('travelPackage.destination')
                ->latest()
                ->get(),
        ]);
    }
}
