<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Choose your country</title>
        {{ HTML::style('assets/css/common.css'); }}
    </head>
    <body>
        <div class="welcome">
            <a href="{{ URL::route('callPage', ['country' => 'us']) }}" title="United States">
                US
            </a>
            <a href="{{ URL::route('callPage', ['country' => 'dk']) }}" title="Denmark">
                DK
            </a>
            <a href="{{ URL::route('callPage', ['country' => 'cy']) }}" title="Cyprus">
                CY
            </a>
            <h1>
                Choose your country
            </h1>
        </div>
    </body>
</html>
