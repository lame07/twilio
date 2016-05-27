<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Laravel PHP Framework</title>
        {{ HTML::style('assets/css/common.css'); }}
    </head>
    <body>
        <div class="welcome">
            <a href="?country=us" title="United States">
                US
            </a>
            <a href="?country=dk" title="Denmark">
                DK
            </a>
            <a href="?country=cy" title="Cyprus">
                CY
            </a>
            <h1>
                @if ($errorMessage)
                {{ $errorMessage }}
                @elseif ($phoneNumber)
                Call Me
                {{ $phoneNumber }}
                @else
                Choose your country
                @endif
            </h1>
        </div>
    </body>
</html>
