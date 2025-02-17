<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Notifications\OfferAccepted;
use App\Notifications\OfferRejected;
use Illuminate\Http\Request;

class RealtorListingAcceptController extends Controller
{
    //
    public function __invoke(Offer $offer,Request $request){
        $offer->update(['accepted_at'=>now()]); //accepting the current offer
        $offer->listing->sold_at =  now();
        $offer->listing->save();
        $offer->user->notify(new OfferAccepted($offer));
        $offer->listing->offers()->except($offer)->update(['rejected_at'=>now()]); // rejecting all other offers thanks to relationships
        $otherOffers = $offer->listing->offers()->except($offer)->get();

        foreach ($otherOffers as $otherOffer) {
            // sending a notification to all other bidders that their bid was rejected
            $otherOffer->user->notify(new OfferRejected($offer));
            }

        return redirect()->back()->with('success'," Offer # $offer->id accepted and other offers rejected");
    }
}
