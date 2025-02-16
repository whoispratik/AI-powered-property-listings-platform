<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class RealtorListingAcceptController extends Controller
{
    //
    public function __invoke(Offer $offer){
        $offer->update(['accepted_at'=>now()]); //accepting the current offer
        $offer->listing->sold_at =  now();
        $offer->listing->save();
        $offer->listing->offers()->except($offer)->update(['rejected_at'=>now()]); // rejecting all other offers thanks to relationships
        return redirect()->back()->with('success'," Offer # $offer->id accepted and other offers rejected");
    }
}
