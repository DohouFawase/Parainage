<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('components.scripts.header')
    <title>@yield('title') | Upflow</title>
</head>
<body class="dashboard">
    <div id="main-wrapper">
            @include('components.preloader')
       <div class="content-body">
        @yield('content')
       </div>

    

    </div>
    @include('components.scripts.script')
</body>
</html>