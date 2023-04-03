<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="accounts.css">
</head>
<body>
    <div class="login-container">
        <!-- Navigation -->
        <a href="/" class="homepage">Homepage</a>
        <!-- Register form -->
        <div class="login-title">
            <h1>Log in</h1>
            <p>Log in to be able to plan</p>
        </div>
        <form method="POST" action="/users/loginuser" class="form-inputs">
            @csrf
            <div class="form-inputs">
                <label for="email">Email:</label>
                <input type="email" name="email" value="{{old('email')}}">
            </div>
            @error('email')
            <p class="error">{{$message}}</p>
            @enderror
            
            <div class="form-inputs">
                <label for="password">Password:</label>
                <input type="password" name="password">
            </div>
            @error('password')
            <p class="error">{{$message}}</p>
            @enderror

            <div class="submit-button">
                <button type="submit" class="primary-button"><a>Login</a></button>
            </div>
        </form>

        <div>
            <p>Don't have an account? <a href="/createaccount">Create an account now!</a></p>
        </div>
    </div>
</body>
</html>