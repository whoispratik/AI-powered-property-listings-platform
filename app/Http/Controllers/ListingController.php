<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index(Request $request)
    {
        
        $filters=$request->only([ 'priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo']);
        return inertia(
            'Listing/Index',
            [
                'filters'=>$filters,
                'listings' => Listing::orderByDesc('created_at') //conditionally adding constraints to the query
                ->when(isset($filters['priceFrom']),fn ($query)=>$query->where('price','>=',$filters['priceFrom']))
                ->when(isset($filters['priceTo']),fn ($query)=>$query->where('price','<=',$filters['priceTo']))
                ->when(isset($filters['beds']),fn ($query)=>$query->where('beds',(int)$filters['beds'] < 6 ? '=' : '>=',$filters['beds']))
                ->when(isset($filters['baths']),fn ($query)=>$query->where('baths',(int)$filters['baths'] < 6 ? '=' : '>=',$filters['baths']))
                ->when(isset($filters['areaFrom']),fn ($query)=>$query->where('area','>=',$filters['areaFrom']))
                ->when(isset($filters['areaTo']),fn ($query)=>$query->where('area','<=',$filters['areaTo']))
                ->paginate(10)->withQueryString()
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
        $request->user()->listings()->create($request->validate([
            'beds'=>'required|integer|min:1|max:30|',
            'baths'=>'required|integer|min:1|max:30|',
            'area'=>'required|integer|min:1|max:10000|',
            'price'=>'required|integer|min:1|max:300000000|',
            'city'=>'required','code'=>'required','street'=>'required','street_nr'=>'required|integer|min:1|max:1000|'
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
         $response=Gate::inspect('update', $listing);
         if($response->allowed()){  
        return inertia(
            'Listing/Edit',
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
        'area'=>'required|integer|min:1|max:10000|','price'=>'required|integer|min:1|max:1000000|','city'=>'required','code'=>'required','street'=>'required','street_nr'=>'required|integer|min:1|max:1000|'
    ]));
        return redirect()->route('listing.index')->with('success', 'Listing updated successfully');
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
}
