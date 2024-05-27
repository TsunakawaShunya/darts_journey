<?php

namespace App\Http\Controllers;

use App\Models\Spot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_spots(Request $request)
    {
        $spots = $request->input('spot');
    
        foreach ($spots as $spot) {
            if (isset($spot['selected'])) {
                $newSpot = new Spot();
                $newSpot->spot_category_id = $spot['spot_category_id'];
                $newSpot->name = $spot['name'];
                $newSpot->latitude = $spot['latitude'];
                $newSpot->longitude = $spot['longitude'];
                $newSpot->save();
            }
        }
    
        return redirect('users/' . Auth::id() . '/trip/list');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Spot  $spot
     * @return \Illuminate\Http\Response
     */
    public function show(Spot $spot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Spot  $spot
     * @return \Illuminate\Http\Response
     */
    public function edit(Spot $spot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Spot  $spot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Spot $spot)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Spot  $spot
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spot $spot)
    {
        //
    }
}
