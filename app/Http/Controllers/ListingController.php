<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Contracts\Database\Eloquent\Builder;
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
                'listings' => Listing::mostRecent()
                ->notSold() 
                ->filter($filters)
                ->paginate(10)->withQueryString() //withQueryString is used to keep the query parameters applied across all pages
            ]
        );
    }

  
    public function show(Listing $listing,Request $request)
    {
        
        $listing->load(['images']); //eager load relation as an attibute images
        return inertia(
            'Listing/Show',
            [
                'listing' => $listing,
                'isOwner'=>$request->user() ? $listing->user->id==$request->user()->id : null,
                'offerMadeByMe'=>$request->user() ? $listing->offers()->byMe()->first() : null,
            ]
        );
    }
    
} 
