<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Listing::class);
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only([
                    'priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo'
        ]);

        return inertia(
            'Listing/IndexListing',
            [
                'filters' => $filters,
                'listings' => Listing::mostRecent()
                ->filter($filters)
                ->withoutSold()
                ->paginate(10)
                ->withQueryString()
            ]
        );
    }

    public function show(Listing $listing)
    {
        //$this->authorize('view', $listing);
        $listing->load(['images']);
        $offer = !Auth::user() ?
        null : $listing->offers()->byMe()->first();
        return inertia(
            'Listing/ShowListing',
            [
                'listing' => $listing,
                'offerMade' => $offer
            ]
        );
    }
    
}
