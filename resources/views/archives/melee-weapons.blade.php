<?php
$foreach_count = 0; //Set counter for loop below
$type = Request::segment(1); //Get ?type from URL for API
$type = ucfirst($type); //Capitalise first letter

$components_array = (array) $weapons_array; //ensures that the data is in array format
$components_array = json_decode(json_encode($components_array),true); //decode the array to json, and removes all object referances using the true variable
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Melee Weapons</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="navbar-style.css">
    <link rel="stylesheet" href="global.css">
</head>
<body>
    <x-navbar-auth/> <!-- add navbar -->
    <br><br><br>
    <div class="auth-weapon-container">
        <?php
        //Loop through each weapon
        foreach ($weapons_array as $obj){
            $weapon = $obj->name; //Get weapon name from array
            //This if statement is because the final result of $components_array[$foreach_count+1]["name"] (used in if statement below) will return an error, this ensures it never tries to run that - I think I could improve this code to make the name not hardcoded
            if($components_array[$foreach_count]["name"] != "Zenistar"){
                //Some results of the API send duplicate weapons as they can be crafted AND bought ingame, this means they would appear twice so this if statement checks the next weapon name and if they match skips the current foreach loop
                if ($components_array[$foreach_count]["name"] === $components_array[$foreach_count+1]["name"]) {
                    $foreach_count++; //Increase count every time foreach loop runs
                    continue;
                }else{
                    ?>
                    <!-- Display weapons and add form for adding weapons to favorites -->
                    <div>
                        <!-- Display weapons -->
                        <h1>{{$weapon}}</h1>
                        <img src="https://cdn.warframestat.us/img/{{$obj->imageName}}">
                        <button><a href="/melee/{{$weapon}}?type=Melee">Read more</a></button>
                        <!-- Create form to store favorites when picking one -->
                        <form method="POST" action=" {{ route('favorites.store') }}">
                            @csrf
                            <input type="hidden" name="favorited_item" value="{{$weapon}}"></input>
                            <input type="hidden" name="type" value="{{$type}}"></input>
                            <input type="hidden" name="mastery_requirement" value="{{$obj->masteryReq}}"></input>
                            <?php
                            //Check to see if array entry contains "components" as there are some exceptions where it is not obtained normally (no components) e.g weapon is bought
                            if(array_key_exists("components", $components_array[$foreach_count])){
                                ?>
                                <!-- create the count of all components in hidden input to send to backend for database entry -->
                                <input type="hidden" name="component_count" value='{{count($components_array[$foreach_count]["components"])-1}}'></input>
                                <?php
                                //Create a for loop to run for each component the weapon requires, we do -1 as count() starts from 1 while $i starts from 0
                                for($i=0; $i <= count($components_array[$foreach_count]["components"])-1; $i++ ){

                                    /*  BREAKDOWN OF $components_array[$foreach_count]["components"][$i]["attributename"] - This is complicated due to the Warframe API:
                                        //$components_array --> the decoded array with no object references
                                        //[$foreach_count] --> used to reference the place in the array we are in the foreach loop
                                        //["components"] --> used to reference "components", where the data we need is
                                        //[$i] --> using the for loop count $i we run this for each entry in "components" as some items have less than 5
                                        //"attributename" --> simple reference the attribute
                                    END OF BREAKDOWN */

                                    //Assign Components variables for form inputs
                                    $component_name = $components_array[$foreach_count]["components"][$i]["name"];
                                    $component_image_name = $components_array[$foreach_count]["components"][$i]["imageName"];
                                    $component_amount = $components_array[$foreach_count]["components"][$i]["itemCount"];
                                    // echo $component_name . " " . $component_image_name . " " . $component_amount . "<br><br>"; DEBUG COMMAND
                                    ?>
                                    <!-- //Create input for each component to send to database table as some Warframes have different numbers of components --> 
                                    <input type="hidden" name="component_name_{{$i}}" value="{{$component_name}}"></input>
                                    <input type="hidden" name="component_image_name_{{$i}}" value="{{$component_image_name}}"></input>
                                    <input type="hidden" name="component_amount_{{$i}}" value="{{$component_amount}}"></input>
                                    <?php
                                }
                            }else{
                                echo "there are no components for x"; //Create exception for weapons which don't require components
                            }
                            ?>
                            <input type="submit" value="Favorite"></input>
                        </form>
                    </div>
                    <?php
                    $foreach_count++; //Increase count every time foreach loop runs
                }
            }
        }
        ?>
    </div>
</body>
</html>
