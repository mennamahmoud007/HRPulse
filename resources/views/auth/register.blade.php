<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
    </head>

    <body>
        <h1>Register</h1>

        @if ($errors->any())
            @foreach ($errors->all() as $error )
                <p>{{ $error }}</p>
            
            @endforeach
        
        @endif


        <form method="post" action="{{ route('register') }}">
            @csrf
            <label>name</label>
            <input type="name" name="name">
            <label>email</label>
            <input type="email" name="email">
            <label>password</label>
            <input type="password" name="password">
            <label>confirm password</label>
            <input type="password" name="confirm_password">
            <button type="submit">Register</button>

        </form>
        <a href="{{ route('login') }}">Already have an account? Login</a>
    </body>
</html>