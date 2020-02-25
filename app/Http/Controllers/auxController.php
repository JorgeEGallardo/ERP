<?php

namespace App\Http\Controllers;

use App\empresas;
use Illuminate\Http\Request;
use Session;

class auxController extends Controller
{
    public function getStates($id)
    {
        $states = \DB::select('select * from states where country_id = ?', [$id]);
        return view('auxi.states')->with(compact('states'));
    }
    public function getCities($id)
    {
        $cities = \DB::select('select * from cities where state_id = ?', [$id]);
        return view('auxi.cities')->with(compact('cities'));
    }
    public function getCountries()
    {
        $countries = \DB::select('select * from countries');
        return view('auxi.countries')->with(compact('countries'));
    }
    public static function empresaSesion($id)
    {
        $empresa = empresas::find($id);
        Session::put('empresa', $id);
        \session::put('empresaN', $empresa->Nombre);
        return back();
    }
}
