<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingOfferController extends Controller
{
    public function store(Listing $listing, Request $request)
    {
        // Validate the request data.
        $data = $request->validate([
            'amount' => 'required|integer|min:1',
        ]);
        $data['user_id']=$request->user()->id;
        $listing->offers()->create($data);
        return redirect()->back()->with('success','Offer successfully made');
    }
    
}
