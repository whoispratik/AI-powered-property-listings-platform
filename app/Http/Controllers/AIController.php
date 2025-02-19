<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AIController extends Controller
{
    //
    public function index(Request $request){
        return inertia('AI/Index');
    }
    public function propertyValuation(){
        return inertia('AI/PropertyValuation');
    }
    public function metrics(){
        return inertia('AI/CityMetrics');
    }
}
