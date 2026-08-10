<!DOCTYPE html>
<html>
    <head>
        <title>login</title>
    </head>
    <body>
        @if ($errors->any())
            @foreach ($errors->all() as $error )
                <p>{{ $error }}</p>
            
            @endforeach
        
        @endif

        @if (session('success'))
            <p>{{ session('success') }}</p>
        
        @endif


        <form method="post" action="{{ route('login') }}">
            @csrf
            <label>email</label>
            <input type="email" name="email">
            <label></label>password</label>
            <input type="password" name="password">
            <button type="submit">login</button>

        </form>
        <a href="{{ route('register')}}">Create Account</a>
    </body>
</html>