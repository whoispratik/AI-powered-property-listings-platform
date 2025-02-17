<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Notifications\OfferMade;
use Gate;
use Illuminate\Http\Request;

class ListingOfferController extends Controller
{
    public function store(Listing $listing, Request $request)
    {
        $response = Gate::inspect('forSold',$listing);
        if($response->allowed()){
            // Validate the request data.
            $data = $request->validate([
                'amount' => 'required|integer|min:1',
            ]);
            $data['user_id']=$request->user()->id;
            $offer=$listing->offers()->create($data);
            $listing->user->notify(new OfferMade($offer));
            return redirect()->back()->with('success','Offer successfully made');
        }
        else{
            return redirect()->back()->with('error',$response->message());
        }
    }
    
}
