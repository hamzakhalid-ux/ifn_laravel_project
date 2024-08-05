<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Welcome</title>

    <!---Style Sheet-->

    <link rel="stylesheet" href="{{asset('css/indexcss/screens.css')}}" type="text/css" media="all">
</head>
<body>

    <header>
      <div class="logo">
        <img src="{{asset('img/ifn-logo.png')}}">
      </div>

    </header>

    <main>

        <div class="login-page">
            @php
            $errors = session()->get('errors');
            $message = !empty(session()->get('message')) ? session()->get('message') : '';
            $message_class = !empty(session()->get('errors')) ? 'label-danger' : 'label-success';
            @endphp
            <div class="{{$message_class}} text-center">{{!empty(session()->get('message')) ? session()->get('message') : ''}}</div>
            @if(!empty($errors))
            <ul class="">
                @foreach($errors as $error)
                <li class="text-danger">{{$error}}</li>
                @endforeach
            </ul>
            @endif
            <h2>Welcome to IFN Investor</h2>
            <p>Please sign in to your account and commence Funding Reports.</p>
            <div class="form">

                <form class="form-horizontal" method="POST" action="{{url('/login') }}">
                    @csrf
                <input type="email" name="email" id="email" placeholder="Email"/>
                <input type="password" name="password" placeholder="password"/>
                <button type="submit">Log in</button>

                <p class="message">New on our platform? <a href="{{ route('signup') }}">Set up your account with us today!</a></p>
              </form>
            </div>
          </div>

    </main>
    <footer>

    </footer>
</body>
</html>
