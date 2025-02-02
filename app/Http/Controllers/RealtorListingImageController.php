<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\ListingImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            $request->validate([
                'images' => 'required|array',
                'images.*' => 'image'
            ]);
            foreach ($request->file('images') as $file) {
                $path = $file->store('images', 'public'); // stores the file in storage/app/public/images
                $listing->images()->create(['filename' => $path]);
        }
        return redirect()->back()->with('success', 'Images uploaded!');
        
    }
    else{
        return redirect()->back()->with('error', 'No images selected!');
    }
    }
    public function destroy(Listing $listing,ListingImage $image){
        Storage::disk('public')->delete($image->filename);
        $image->delete();
        return redirect()->back()->with('success', 'Image deleted!');
    }
}
