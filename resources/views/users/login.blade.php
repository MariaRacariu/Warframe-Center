<!-- Navigation -->
<a href="/">Home page</a>

<!-- Register form -->
<div>
    <h1>Log in</h1>
    <p>Log in to be able to plan</p>
</div>
<form method="POST" action="/users/loginuser">
    @csrf
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" value="{{old('email')}}">
    </div>
    @error('email')
    <p style="color:red;">{{$message}}</p>
    @enderror
    <div>
        <label for="password">Password</label>
        <input type="password" name="password">
    </div>

    @error('password')
    <p style="color:red;">{{$message}}</p>
    @enderror

    <div>
        <button type="submit">Login</button>
    </div>
</form>

<div>
    <p>Don't have an account? <a href="/createaccount">Create an account now!</a></p>
</div>