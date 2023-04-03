
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="{{asset('single-item-page-style.css')}}">
    <link rel="stylesheet" href="{{ asset('global.css')}}">
    <link rel="stylesheet" href="{{ asset('navbar-style.css')}}">
</head>

<?php
$weapon_name = Request::segment(2); //This takes 2nd part of URL which will be the gun name in all cases
$i = 0; //Set counter for loop below

// Here we look for the position of the current page's object $i so we can reference it in html
foreach ($weapons_array as $object) {
    // Check if the object's name matches $weapon_name defined above
    if ($object->name === $weapon_name) {
        $position = $weapons_array[$i]; // Object found, get position in $weapons_array for html
        break; // Stop looping
    }
    $i++; //Increase $i as we search array
}
?>

<body>
    <x-navbar-auth/> <!-- add navbar -->
    <div class="single-item-container">
        <div class="intro-section"> 
            <h1>{{ $weapons_array[$i]->name }}</h1>

            <img src="https://cdn.warframestat.us/img/{{$weapons_array[$i]->imageName}}" alt="">
        </div>
        <div class="item-information">
            <p>Description: {{ $weapons_array[$i]->description }}</p>

            <p>Damage: {{ $weapons_array[$i]->totalDamage }}</p>

            <p>Build Price: {{ $weapons_array[$i]->buildPrice }} Credits</p>

            <p>Type: {{ $weapons_array[$i]->type }}</p>

            <p>Attack Rate: {{ $weapons_array[$i]->fireRate }}</p>

            <p>Mastery Requirement: {{ $weapons_array[$i]->masteryReq }}</p>
        </div>



        <!-- weapon attacks -->
        <div class="item-abilities">
            <?php
            foreach($weapons_array[$i]->attacks as $attack){
                ?>
                <div class="abilities-container">
                    <h3>{{ $attack->name }}</h3>
                    <p>Crit Chance: {{ $attack->crit_chance }}</p>
                    <p>Crit Multiplier: {{ $attack->crit_mult }}</p>
                    <p>Status Chance: {{ $attack->status_chance }}</p>
                </div>
                <?php
            }
            ?>
        </div>


        <!-- weapon component drops -->
        <table class="drops-table">
            <tr>
                <th>Name</th>
                <th>Location</th>
                <th>Chance</th>
            </tr>
            <?php
            foreach($weapons_array[$i]->components as $component){
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