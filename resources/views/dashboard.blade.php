@auth
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <a href="/">Home page</a>
    <h1>DASHBOARD</h1>

    <!-- Navigation -->
    <div>
        <span>Welcome {{auth()->user()->name}}</span>
    </div>
    <div>
        <div>
            <!-- NAVIGATION -->
            <nav>
                <a href="/warframes">Warframes</a>
                <a href="/primary">Primary Weapons</a>
                <a href="/secondary">Secondary Weapons</a>
                <a href="/melee">Melee Weapons</a>
            </nav>
            <form method="POST" action="/logout">
                @csrf
                <button type="submit" style="color:red;">Log out</button>
            </form>
        </div>
        <div>
            <!-- FRONT PAGE -->
            <div>
                <!-- foreach loop to show warframes -->
            </div>
        </div>
    </div>
</body>

</html>
@endauth