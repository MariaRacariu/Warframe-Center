<a href="/">Home page</a>
@auth
<div>
    <span>Welcome {{auth()->user()->name}}</span>
</div>
<a href="/dashboard">Dashboard</a>
<form method="POST" action="/logout">
    @csrf
    <button type="submit" style="color:red;">Log out</button>
</form>
@else
<button><a href="/login">Log in</a></button>
@endauth