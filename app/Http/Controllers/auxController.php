<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class auxController extends Controller
{
    public function getStates($id){
        $states = \DB::select('select * from states where country_id = ?', [$id]);
        return view('auxi.states')->with(compact('states'));
    }
    public function getCities($id){
        $cities = \DB::select('select * from cities where state_id = ?', [$id]);
        return view('auxi.cities')->with(compact('cities'));
    }
}
