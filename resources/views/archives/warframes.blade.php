<?php
$foreach_count = 0; //Set counter for loop below
$type = Request::segment(1); //Get ?type from URL for API
$type = ucfirst($type); //Capitalise first letter

$components_array = (array) $warframe_array; //ensures that the data is in array format
$components_array = json_decode(json_encode($components_array),true); //decode the array to json, and removes all object referances using the true variable
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warframes</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="navbar-style.css">
    <link rel="stylesheet" href="global.css">
</head>
<body>
    <x-navbar-auth/> <!-- add navbar -->
    <br><br><br>
    <div class="auth-weapon-container">
        <?php
        //Loop through each warframe
        foreach ($warframe_array as $obj){
            $warframe = $obj->name; //Get warframe name from array
            ?>
            <!-- Display warframes and add form for adding warframe to favorites -->
            <div>
                <!-- Display warframes -->
                <h1>{{$warframe}}</h1>
                <img src="https://cdn.warframestat.us/img/{{$obj->imageName}}">
                <button><a href="/warframes/{{$warframe}}?type=Warframes">Read more</a></button>
                <!-- Create form to store favorites when picking one -->
                <form method="POST" action=" {{ route('favorites.store') }}">
                    @csrf
                    <input type="hidden" name="favorited_item" value="{{$warframe}}"></input>
                    <input type="hidden" name="type" value="{{$type}}"></input>
                    <input type="hidden" name="mastery_requirement" value="0"></input> <!-- All Warframes have 0 MR requirement -->
                    <?php
                    //Check to see if array entry contains "components" as Excalibur Prime is an exception where it is not obtained normally (no components) e.g warframe is bought
                    if(array_key_exists("components", $components_array[$foreach_count])){
                        ?>
                        <input type="hidden" name="component_count" value='{{count($components_array[$foreach_count]["components"])-1}}'></input>
                        <?php
                        //Create a for loop to run for each component the warframe requires, we do -1 as count() starts from 1 while $i starts from 0
                        for($i=0; $i <= count($components_array[$foreach_count]["components"])-1; $i++ ){

                            /*  BREAKDOWN OF $components_array[$foreach_count]["components"][$i]["attributename"] - This is complicated due to the Warframe API:
                                //$components_array --> the decoded array with no object references
                                //[$foreach_count] --> used to reference the place in the array we are in the foreach loop
                                //["components"] --> used to reference "components", where the data we need is
                                //[$i] --> using the for loop count $i we run this for each entry in "components" as some items have less than 5
                                //"attributename" --> simple reference the attribute
                            END OF BREAKDOWN */

                            $component_name = $components_array[$foreach_count]["components"][$i]["name"];
                            $component_image_name = $components_array[$foreach_count]["components"][$i]["imageName"];
                            $component_amount = $components_array[$foreach_count]["components"][$i]["itemCount"];
                            ?>
                            <!-- //Create input for each component to send to database table as some Warframes have different numbers of components --> 
                            <input type="hidden" name="component_name_{{$i}}" value="{{$component_name}}"></input>
                            <input type="hidden" name="component_image_name_{{$i}}" value="{{$component_image_name}}"></input>
                            <input type="hidden" name="component_amount_{{$i}}" value="{{$component_amount}}"></input>
                            <?php
                        }
                    }else{
                        echo "there are no components for x"; //Some warframes don't have components (e.g. bought in store)
                    }
                    ?>
                    <input type="submit" value="Favorite"></input>
                </form>
            </div>
            <?php
            $foreach_count++; //Increase count every time foreach loop runs
        }
        ?>
    </div>
</body>
</html>