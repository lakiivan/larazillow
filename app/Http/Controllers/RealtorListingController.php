<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RealtorListingController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Listing::class, 'listing');
    }

    public function index(Request $request)
    {
        //dd(Auth::user()->listings);
        //dd($request->all());

        $filters = [
            'deleted' => $request->boolean('deleted'),
            ... $request->only(['by', 'order'])
        ];
        return inertia(
            'Realtor/RealtorIndex',
            [
                'filters' => $filters,
                'listings' => Auth::user()
                    ->listings()
                    ->filter($filters)
                    ->withCount('images')
                    ->withCount('offers')
                    ->paginate(5)
                    ->withQueryString()
            ]
        );
    }

        /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        // ispod je jedan nacin za proveru svake metode ponaosob, drugi nacin je kreiranje constructora u kome se provere sve metode
        // samo tada sve metode u ListingPoliciy moraju biti definisane
        // $this->authorize('create', Listing::class);
        
        return inertia (
        'Realtor/RealtorCreateListing'
    );
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $request->user()->listings()->create(
            $request->validate([
                'beds' => 'required|integer|min:0|max:20',
                'baths' => 'required|integer|min:0|max:20',
                'area' => 'required|integer|min:15|max:1500',
                'city' => 'required',
                'code' => 'required',
                'street' => 'required',
                'street_nr' => 'required|integer|min:1|max:1000',
                'price' => 'required|integer|min:1|max:200000000',
            ])
        );

        return redirect()->route('realtor.listing.index')
        ->with('success', 'Listing was created!');
    }

    /**
     * Display the specified resource.
     */
    // public function show(Listing $listing)
    // {
    //     //$this->authorize('view', $listing);

    //     return inertia(
    //         'Listing/ShowListing',
    //         [
    //             'listing' => $listing
    //         ]
    //     );
    // }

    public function show(Listing $listing)
    {
        return inertia(
            'Realtor/RealtorShow',
            ['listing' => $listing->load('offers', 'offers.bidder')]
        );
    }

        /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        return inertia(
            'Realtor/RealtorEditListing',
            [
                'listing' => $listing
            ]
        );
    }

        /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {
        // dd($request->all());
        $listing->update(
            $request->validate([
                'beds' => 'required|integer|min:0|max:20',
                'baths' => 'required|integer|min:0|max:20',
                'area' => 'required|integer|min:15|max:1500',
                'city' => 'required',
                'code' => 'required',
                'street' => 'required',
                'street_nr' => 'required|integer|min:1|max:1000',
                'price' => 'required|integer|min:1|max:200000000',
            ])
        );

        return redirect()->route('realtor.listing.index')
        ->with('success', 'Listing was updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        $listing->delete();

        return redirect()->back()
        ->with('success', 'Listing was deleted!');
    
    }

    public function restore(Listing $listing)
    {
        $listing->restore();

        return redirect()->back()->with('success', 'Listing was restored!');
    }
}
