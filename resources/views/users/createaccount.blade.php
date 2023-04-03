<!-- Navigation -->
<a href="/">Home page</a>

<!-- Register form -->
<div>
    <h1>Register</h1>
    <p>Create an account to be able to plan</p>
</div>
<form method="POST" action="/users">
    @csrf
    <div>
        <label for="name">Name or Username</label>
        <input type="text" name="name" value="{{old('name')}}">
    </div>
    @error('name')
    <p style="color:red;">{{$message}}</p>
    @enderror
    <div>
        <label for="mastery_rank">Mastery Rank:</label>
        <input type="number" name="mastery_rank">
    </div>
    @error('mastery_rank')
    <p style="color:red;">{{$message}}</p>
    @enderror
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
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation">
    </div>
    @error('password_confirmation')
    <p style="color:red;">{{$message}}</p>
    @enderror
    <div>
        <button type="submit">Create account</button>
    </div>
</form>

<div>
    <p>Already have an account? <a href="/login">Login</a></p>
</div>