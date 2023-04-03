
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
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
    <br><br><br>
    <h1>{{ $warframe_array[$i]->name }}</h1>

    <img src="https://cdn.warframestat.us/img/{{$warframe_array[$i]->imageName}}" alt="">
    
    <p>{{ $warframe_array[$i]->description }}</p>

</body>
</html>