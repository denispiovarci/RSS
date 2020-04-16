<!doctype html>
<html lang="sk">

<head>
    @include('layouts.head')
</head>

<body>
@include('layouts.nav')


<main>
    @yield('content')
</main>


<!-- Bootstrap core JavaScript -->
@include('layouts.footer-scripts')
</body>
</html>
