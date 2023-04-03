@auth
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="navbar-style.css">
</head>
<body>
    <x-navbar-auth/> <!-- add navbar -->
    <h1 style="padding-top:10px;"><span>{{auth()->user()->name}}'s Mastery Rank: {{auth()->user()->mastery_rank}}</span></h1>
    <br>
    <div>
        <div class="dashboard-container">
            <?php  
            $foreach_count = 0;

            foreach ($favorites as $obj){

                $components_count = count($components[$foreach_count]);
                $running_count = 0;
                $acquired_status = "";
                for($i=0; $i < $components_count; $i++){
                    if($components[$foreach_count][$i]->acquired == 1){
                        $running_count++;
                    }
                }
                if ($running_count == $components_count){
                    $acquired_status = "item-acquired";
                }
                ?>
                <div class="item-container {{ $acquired_status }}">
                    <?php
                    $favorite_name = $obj->name; //Get item name from array
                    $favorite_filename = str_replace(' ', '-', strtolower($favorite_name)); //format name for filename 
                    $favorite_type = strtolower($obj->type); //used for url navigation on single item

                    $mastery_rank_class = "";
                    if($obj->mastery_rank > auth()->user()->mastery_rank){
                        $mastery_rank_class = "danger";
                    }
                    ?>
                    <!-- Delete will delete it from the database favorites and also components -->
                    <div class="buttons_container">
                        <form method="POST" action="{{ route('favorites.destroy') }}">
                            @csrf
                            <input type="hidden" name="favorites_id" value="{{$obj->favorites_id}}">
                            <input type="submit" value="Delete" class="favorite_button"></input>
                        </form>
                    </div>
                    <h3 class="item_title"><a href="/{{$favorite_type}}/{{$favorite_name}}?type={{$obj->type}}">{{$favorite_name}}</a></h3>
                    <!-- mastery rank requirement -->
                    <div class="mastery-rank-container"><p class="{{$mastery_rank_class}}">Mastery Rank: {{$obj->mastery_rank}}</p></div>
                    <!-- Show image of Item -->
                    <img src="https://cdn.warframestat.us/img/{{$favorite_filename}}.png" alt=""> 
                    <!-- For each component get name, amount and image -->
                    <?php
                    for($i=0; $i < count($components[$foreach_count]); $i++){
                        //add class to components user has clicked on (acquired)
                        $acquired_class = "";
                        if($components[$foreach_count][$i]->acquired == 1){
                            $acquired_class = "acquired";
                        }
                        ?>
                        <form method="POST" class="form-container" action="{{ route('component.component_acquired') }}">
                            @csrf
                            <input type="hidden" name="acquired_status" value="{{$components[$foreach_count][$i]->acquired}}"></input>
                            <input type="hidden" name="component_id" value="{{$components[$foreach_count][$i]->id}}"></input>
                            <button type="submit" style="border: 1px black solid;" class="components-container {{ $acquired_class }}">
                                <p>{{ $components[$foreach_count][$i]->name }}</p>
                                <p>Amount: {{$components[$foreach_count][$i]->amount}} </p>
                                <img src="https://cdn.warframestat.us/img/{{$components[$foreach_count][$i]->filename}}" alt="" class="components-image"> 
                            </button>
                        </form>
                        <?php
                    }
                    ?>
                </div>
                <?php
                $foreach_count++;
            }
            ?>
        </div>
    </div>
</body>
</html>
@endauth