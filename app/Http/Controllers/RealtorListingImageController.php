<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class RealtorListingImageController extends Controller
{
    //
    public function create(Listing $listing){
        $listing->load(['images']);
        return inertia('Realtor/ListingImage/Create',[
            'listing'=>$listing
        ]);
    }
    public function store(Request $request,Listing $listing){
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('images', 'public');
                $listing->images()->create(['filename' => $path]);
        }
        return redirect()->back()->with('success', 'Images uploaded!');
        
    }
    else{
        return redirect()->back()->with('error', 'No images selected!');
    }
    }
}
