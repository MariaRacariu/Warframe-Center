
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="{{asset('single-item-page-style.css')}}">
    <link rel="stylesheet" href="{{ asset('global.css')}}">
    <link rel="stylesheet" href="{{asset('navbar-style.css')}}">
</head>

<?php
$warframe_name = Request::segment(2); //This takes 2nd part of URL which will be the gun name in all cases
$i = 0; //Set counter for loop below

// Here we look for the position of the current page's object $i so we can reference it in html
foreach ($warframe_array as $object) {
    // Check if the object's name matches $weapon_name defined above
    if ($object->name === $warframe_name) {
        $position = $warframe_array[$i]; // Object found, get position in $warframe_array for html
        break; // Stop looping
    }
    $i++; //Increase $i as we search array
}
?>

<body>
    <x-navbar-auth/> <!-- add navbar -->
    <div class="single-item-container">
        <div class="intro-section"> 
            <h1>{{ $warframe_array[$i]->name }}</h1>

            <img src="https://cdn.warframestat.us/img/{{$warframe_array[$i]->imageName}}" alt="">
        </div>
        <div class="item-information">
            <p>{{ $warframe_array[$i]->description }}</p>

            <p>Health: {{ $warframe_array[$i]->health }}</p>
            <p>Armor: {{ $warframe_array[$i]->armor }}</p>
            <p>Shield: {{ $warframe_array[$i]->shield }}</p>
            <p>Mastery Requirement: {{ $warframe_array[$i]->masteryReq }}</p>
        </div>




        <!-- warframe abilities -->
        <div class="item-abilities">
            <?php
            foreach($warframe_array[$i]->abilities as $ability){
                ?>
                <div class="abilities-container">
                    <h3>{{ $ability->name }}</h3>
                    <p>{{ $ability->description }}</p>
                </div>
                <?php
            }
            ?>
        </div>


        <!-- warframe component drops -->
        <table class="drops-table">
            <tr>
                <th>Name</th>
                <th>Location</th>
                <th>Chance</th>
            </tr>
            <?php
            foreach($warframe_array[$i]->components as $component){
                foreach($component->drops as $component_drops){
                    $component_chance = $component_drops->chance * 100;
                    ?>
                    <tr>
                        <td>
                        {{ $component->name }}
                        </td>
                        <td>
                        {{ $component_drops->location }}
                        </td>
                        <td>
                        {{ $component_chance }}%
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
    </div>
</body>
</html>