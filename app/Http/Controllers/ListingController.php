<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return inertia(
            'Listing/Index',
            [
                'listings' => Listing::all()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return inertia('Listing/CreateR');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        Listing::create($request->validate(['beds'=>'required|integer|min:1|max:30|'
        ,'baths'=>'required|integer|min:1|max:30|',
        'area'=>'required|integer|min:1|max:10000|','price'=>'required|integer|min:1|max:300000000|','city'=>'required','code'=>'required','street'=>'required','street_nr'=>'required|integer|min:1|max:1000|'
    ]));
        return redirect()->route('listing.index')->with('success', 'Listing created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        return inertia(
            'Listing/Show',
            [
                'listing' => $listing
            ]
        );
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
             
        return inertia(
            'Listing/Edit',
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
        $listing->update($request->validate(['beds'=>'required|integer|min:1|max:30|'
        ,'baths'=>'required|integer|min:1|max:30|',
        'area'=>'required|integer|min:1|max:10000|','price'=>'required|integer|min:1|max:1000000|','city'=>'required','code'=>'required','street'=>'required','street_nr'=>'required|integer|min:1|max:1000|'
    ]));
        return redirect()->route('listing.index')->with('success', 'Listing updated successfully');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        $listing->delete();
        return redirect()->back()->with('success', 'Listing deleted successfully');
    }
}
