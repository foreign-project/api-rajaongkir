<?php

namespace App\Http\Controllers;

use App\City;
use App\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class getApi extends Controller
{
    public function index(Request $request) {
        // dd($request->all());

        // $response = Http::withHeaders([
        //     'key' => 'b891c30147a00276f0e7c65836414217'
        // ])->get('https://api.rajaongkir.com/starter/province');
        
        // return $response['rajaongkir']['results'];

        // $response = Http::withHeaders([
        //     'key' => 'b891c30147a00276f0e7c65836414217'
        // ])->get('https://api.rajaongkir.com/starter/city');
        // return $response['rajaongkir']['results'];

        if($request->origin && $request->destination && $request->weight && $request->courier){
            $origin = $request->origin;
            $destination = $request->destination;
            $weight = $request->weight;
            $courier = $request->courier; 
            
            $response = Http::asForm()->withHeaders([
                'key' => 'b891c30147a00276f0e7c65836414217'
            ])->post('https://api.rajaongkir.com/starter/cost', [
                'origin' => $origin,
                'destination' => $destination,
                'weight' => $weight,
                'courier' => $courier
    
            ]);
            
            $cekongkir = $response['rajaongkir']['results'][0]['costs'];
        } else{
            $origin = '';
            $destination = '';
            $weight = '';
            $courier = '';   
            $cekongkir = null;
        }
        
        $provinsi = Province::all();  
        return view('ongkir', compact('provinsi','cekongkir'));
    }

    public function ajax($id) {
        $cities = City::where('province_id','=', $id)->pluck('city_name','id');

        return json_encode($cities);
    }
}
