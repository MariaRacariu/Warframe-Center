<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorites;
use App\Models\Components;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\WeaponsController;

class FavoritesController extends Controller {

    //Function to send data from /warframes page to 2 database tables, Favorites and Components
    public function store(Request $request){
        
        //--------------Start of Favorites entry---------------------
        $user = Auth::user(); //Get the users data
        
        //Insert into Favorites table, the key id is added automatically by laravel, we do insertGetId instead of create so we can use $favorites below (returns id)
        $favorites = Favorites::insertGetId([
            'user_id' => $user->id, 
            'name' => $request->favorited_item, 
            'type' => $request->type, 
            'mastery_rank' => $request->mastery_requirement,
        ]);


        //--------------Start of Components entry---------------------

        //get count for for loop
        $components_count = $request->component_count;

        //loop through each component input in html
        for($i=0; $i <= $components_count; $i++ ){ 
            //create new model for save()
            $components = new Components;

            //set favorites id in components table to last entered id in favorites table done above
            $components->favorites_id = $favorites;


            $component_html_name = "component_name_" . $i; //sets component name from html
            $component_html_amount = "component_amount_" . $i; //sets component amount from html
            $component_html_filename = "component_image_name_" . $i; //sets component image name from html


            $components->name = $request->{$component_html_name}; //get name value from html
            $components->amount = $request->{$component_html_amount}; //get amount value from html 
            $components->filename = $request->{$component_html_filename}; //get filename value from html
            

            //echo '<h3> <pre>'. var_dump($components) . '<pre> </h3>'; - debugging
    
            //send db query
            $components->save();
        }
        
        return redirect()->action([WeaponsController::class, 'dashboard']);
    }

    //Delete favorite function
    public function destroy(Request $request){
        
        Favorites::where('favorites_id', $request->favorites_id)->delete();
        
        //get data for components removal
        $user = Auth::user(); //Get the users data
        $favorites = Favorites::where('user_id', $user->id)->get();
        foreach($favorites as $entry){
            //remove components
            Components::where('favorites_id', $request->favorites_id)->delete();
        }
        return redirect()->action([WeaponsController::class, 'dashboard']);
    }



        //Delete component function
        public function component_acquired(Request $request){

            if($request->acquired_status == true){
                Components::where('id', $request->component_id)->update(['acquired' => false]);
            }else{
                Components::where('id', $request->component_id)->update(['acquired' => true]);
            }
            
            return redirect()->action([WeaponsController::class, 'dashboard']);
        }
}
