<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorites;
use App\Models\Components;
use Illuminate\Support\Facades\Auth;

class WeaponsController extends Controller {

    //-----------------------------------------------PAGES FROM DASHBOARD (types)---------------------------------------------
    //Call to main primary page
    public function primary_call(Request $request){
        $type = $request->type; //Get weapon type (Primary, Secondary, Melee) from url param ?type=
        $weapons_array = new Controller(); //Create object using Controller class in Controller.php for API reference

        //Direct to page with API data:
        return view('archives.primary-weapons', ["weapons_array" => $weapons_array->api_call($type) ]);
    }

    //Call to main secondary page
    public function secondary_call(Request $request){
        $type = $request->type; //Get weapon type (Primary, Secondary, Melee) from url param ?type=
        $weapons_array = new Controller(); //Create object using Controller class in Controller.php for API reference

        //Direct to page with API data:
        return view('archives.secondary-weapons', ["weapons_array" => $weapons_array->api_call($type) ]);
    }

    //Call to main melee page
    public function melee_call(Request $request){
        $type = $request->type; //Get weapon type (Primary, Secondary, Melee) from url param ?type=
        $weapons_array = new Controller(); //Create object using Controller class in Controller.php for API reference

        //Direct to page with API data:
        return view('archives.melee-weapons', ["weapons_array" => $weapons_array->api_call($type) ]);
    }
    
    //Call to single warframe
    public function warframe_call(Request $request){
        $type = $request->type; //Get url param ?type=
        $warframe_array = new Controller(); //Create object using Controller class in Controller.php for API reference
        
        //Direct to page with API data
        return view('archives.warframes', ["warframe_array" => $warframe_array->api_call($type) ]);
    }


    //-----------------------------------------------------INDIVIDUAL PAGES----------------------------------------------
    //Call to single weapon regardless of type
    public function weapon_call(Request $request){
        $type = $request->type; //Get weapon type (Primary, Secondary, Melee) from url param ?type=
        $weapons_array = new Controller(); //Create object using Controller class in Controller.php for API reference
        
        //Direct to page with API data
        return view('archives.weapon', ["weapons_array" => $weapons_array->api_call($type) ]);
    }

    public function warframe_call_single(Request $request){
        $type = $request->type; //Get url param ?type=
        $warframe_array = new Controller(); //Create object using Controller class in Controller.php for API reference
        
        //Direct to page with API data
        return view('archives.warframe', ["warframe_array" => $warframe_array->api_call($type) ]);
    }


    //-----------------------------------------------------DASHBOARD----------------------------------------------


    //Display favorites on dashboard (Warframes)
    public function dashboard(Request $request){
        //Check if user is logged in
        if (Auth::check()) {

            $user = Auth::user(); //Get the users data

            $favorites = Favorites::where('user_id', $user->id)->get();

            $components = array();
            $count =0;
            foreach($favorites as $entry){

                $components_call = Components::where('favorites_id', $entry->favorites_id)->get();
                $components[$count] = $components_call;
                $count++;
            }
            

            return view('dashboard', [
                "favorites" => $favorites,
                "components" => $components
            ]);
        }
        return view('users.login');
    }
}