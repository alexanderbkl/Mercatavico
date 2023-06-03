<!DOCTYPE html>
<html lang="es">
@include('layouts.head')

<body id="app">

    @include('layouts.header')
    @include('layouts.flash-message')
    @yield("content")

    @include('layouts.scripts')

    @yield('javascript')
    @vite('resources/js/app.js')
    @include('layouts.footer')

</body>

</html>
