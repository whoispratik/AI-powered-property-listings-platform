<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class RealtorListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $filters = [
            'deleted' => $request->boolean('deleted'),
            ...$request->only(['by','order'])
        ];
        return inertia(
            'Realtor/Index',
            [
                'filters'=>$filters,
                'listings' => $filters['deleted']?  $request->user()->listings()->filter($filters)->paginate(5)->withQueryString():$request->user()->listings()->filter([ ...$request->only(['by','order'])])->paginate(5)->withQueryString()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return inertia('Realtor/CreateR');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->user()->listings()->create($request->validate([
            'beds'=>'required|integer|min:1|max:30|',
            'baths'=>'required|integer|min:1|max:30|',
            'area'=>'required|integer|min:1|max:10000|',
            'price'=>'required|integer|min:1|max:300000000|',
            'city'=>'required','code'=>'required','street'=>'required','street_nr'=>'required|integer|min:1|max:1000|'
        ]));
        return redirect()->route('realtor.listing.index')->with('success', 'Listing created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
         $response=Gate::inspect('update', $listing);
         if($response->allowed()){  
        return inertia(
            'Realtor/Edit',
            [
                'listing' => $listing
            ]
        );}
        else{
            return redirect()->back()->with('error', $response->message());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {
        $response=Gate::inspect('update', $listing);
        if($response->allowed()){
        $listing->update($request->validate(['beds'=>'required|integer|min:1|max:30|'
        ,'baths'=>'required|integer|min:1|max:30|',
        'area'=>'required|integer|min:1|max:10000|','price'=>'required|integer|min:1|max:1000000000|','city'=>'required','code'=>'required','street'=>'required','street_nr'=>'required|integer|min:1|max:1000|'
    ]));
        return redirect()->route('realtor.listing.index')->with('success', 'Listing updated successfully');
}
else{
    return redirect()->back()->with('error', $response->message());
}
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        $response=Gate::inspect('delete', $listing);
        if($response->allowed()){
        $listing->delete();
        return redirect()->back()->with('success', 'Listing deleted successfully');
    }
    else{
        return redirect()->back()->with('error', $response->message());
    }
    }
    public function restore(Listing $listing){
        $listing->restore();
       return redirect()->back()->with('success', 'Listing restored successfully');
    }
}
