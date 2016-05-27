<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Call Me</title>
        {{ HTML::style('assets/css/common.css'); }}
    </head>
    <body>
        <div class="welcome">
            <a href="{{ URL::route('indexPage') }}">
                Change Country
            </a>
            <h1>
                @if ($errorMessage)
                {{ $errorMessage }}
                @elseif ($phoneNumber)
                Call Me
                {{ $phoneNumber }}
                @endif
            </h1>
        </div>
    </body>
</html>
