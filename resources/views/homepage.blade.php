<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warframe Center</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
</body>
</html>
    <div>

        <h1 class="frontpage-title"><a href="/">Warframe Center</a></h1>

        @auth
        <div class="auth-navigation">
            <div class="auth-inline-item">
                <p class="auth-nav-text"><a href="/dashboard">Dashboard</a></p>
            </div>
            <div class="auth-inline-item">
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="danger-button">Log out</button>
                </form>
            </div>
        </div>
        @else

        <button class="primary-button login-button"><a href="/login">Log in</a></button>
        @endauth
    </div>

<div class="container">
    <div class="hero-text">
        <h1 class="hero-image-text">Create your <br> own Warframe <br>journey.</h1>
        <button class="primary-button hero-image-button"><a href="/createaccount">Sign Up</a></button>
    </div>
</div>

