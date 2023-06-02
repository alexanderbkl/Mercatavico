<!DOCTYPE html>
<html lang="es">
@include('layouts.head')

<body>

    @include('layouts.header')
    @include('layouts.flash-message')
    @yield("content")

    @include('layouts.scripts')

    @yield('javascript')
    @yield('vue-content')

    @include('layouts.footer')

</body>

</html>