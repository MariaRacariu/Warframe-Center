<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="accounts.css">
</head>
<body>
    <!-- Navigation -->

    <div class="create-container">
        <a href="/" class="homepage">Homepage</a>
        <!-- Register form -->
        <div class="login-title">
            <h1>Register</h1>
            <p>Create an account to be able to plan</p>
        </div>
        <form method="POST" action="/users" class="form-inputs">
            @csrf
            <div class="form-inputs">
                <label for="name">Name or Username:</label>
                <input type="text" name="name" value="{{old('name')}}">
            </div>
            @error('name')
            <p class="error">{{$message}}</p>
            @enderror

            <div class="form-inputs">
                <label for="mastery_rank">Mastery Rank:</label>
                <input type="number" name="mastery_rank">
            </div>
            @error('mastery_rank')
            <p class="error">{{$message}}</p>
            @enderror

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

            <div class="form-inputs">
                <label for="password_confirmation">Confirm Password:</label>
                <input type="password" name="password_confirmation">
            </div>
            @error('password_confirmation')
            <p class="error">{{$message}}</p>
            @enderror

            <div class="submit-button">
                <button type="submit" class="primary-button"><a>Create account</a></button>
            </div>
        </form>

        <div>
            <p>Already have an account? <a href="/login">Login</a></p>
        </div>
    </div>
</body>
</html>