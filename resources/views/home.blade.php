@extends('layouts.main')
@section('content')
    <style>
        p {
            margin: unset;
        }
    </style>
    <section class="video">
        <video loop="true" autoplay="autoplay" muted>
            <source src="{{ asset('sources/data/mercatavico.mp4') }}" type="video/mp4">
        </video>
    </section>

    <section class="titlemargin" id="slogan">
        <h1>Mercatavico</h1>
        <h2>Conoce el pasado</h2>
    </section>

    <br><br><br><br>

    <h1 class="title">Nuestros productos</h1>
    <br>
    <div class="container">
        <div class="row">
            @foreach ($productos as $producto)
                <div class="col-12 col-md-4" style="margin-top: 40px">
                    <div class="card" style="width: 18rem;">
                        <div class="card-head">
                            <img style="width:100%;height: 200px;object-fit: cover"
                                src="{{ asset('storage/productsImages/' . $producto->foto) }}">
                        </div>
                        <div class="card-body" style="text-align: start">
                            <h3>{{ $producto->title }}</h3>
                            <p>{{ \Illuminate\Support\Str::limit($producto->description, 100) }}</p>
                            <p>{{ $producto->price }}€</p>
                        </div>
                        <div class="card-footer" style="text-align: center">
                            <!--añadir al carrito button-->
                            <a class="btn btn-info m-2" href="{{ route('product.show', $producto->id) }}">Ver producto</a>
                            @auth
                                @if ($producto->user->id == \Illuminate\Support\Facades\Auth::id())
                                    <button type="button" data-product_id="{{ $producto->id }}"
                                        class="btn btn-primary addCartBtn"><i class="fa fa-plus"></i> Añadir al carrito</button>
                                @endif
                            @endauth

                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div id="carrousel-content">
        <div id="carrousel-box">
            <div class="carrousel-element">
                <a href="productos.html"><img class="images" src="{{ asset('sources/data/varios.png') }}"
                        alt="varios"></a>
            </div>
            <div class="carrousel-element">
                <a href="productos.html"><img class="images" src="{{ asset('sources/data/deco.png') }}"
                        alt="decoración"></a>
            </div>
            <div class="carrousel-element">
                <a href="productos.html"><img class="images" src="{{ asset('sources/data/mueble.png') }}"
                        alt="muebles"></a>
            </div>
        </div>
    </div>


    <!--//BLOQUE COOKIES-->
    <div class="cookiesms" id="cookie1">
        Esta web utiliza cookies, puedes ver nuestra <a class="polit" href="{{ route('cookies') }}">política de
            cookies</a>
        .Si continúas navegando estás aceptándola
        <button id="acept" onclick="controlcookies()">Aceptar</button>
        <div class="cookies2" onmouseover="document.getElementById('cookie1').style.bottom = '0px';">Política de cookies +
        </div>
    </div>
@endsection
@section('javascript')
    <script>
        $(document).ready(function() {
            $('.addCartBtn').click(function(e) {
                e.preventDefault();

                var productId = $(this).data('product_id');

                addToCart(productId);
                displayNotification('Producto añadido al carrito correctamente.');
            });

            function addToCart(productId) {
                // Check if localStorage already contains a "cart" item
                if (localStorage.getItem('cart')) {
                    // If it exists, retrieve the current cart data and parse it
                    var cart = JSON.parse(localStorage.getItem('cart'));
                } else {
                    // If it doesn't exist, initialize an empty cart object
                    var cart = {};
                }

                // Check if the product is already in the cart
                if (cart.hasOwnProperty(productId)) {
                    // If it exists, increment the quantity by 1
                    cart[productId]++;
                } else {
                    // If it doesn't exist, set the quantity to 1
                    cart[productId] = 1;
                }

                // Store the updated cart object in localStorage
                localStorage.setItem('cart', JSON.stringify(cart));
            }

            function displayNotification(message) {
                // Display an alert box to the user with the provided message
                // In a real application, you should replace this with a nicer notification method
                toastr.success(message);
            }
        });

        function controlcookies() {
            // si variable no existe se crea (al clicar en Aceptar)
            localStorage.controlcookie = (localStorage.controlcookie || 0);

            localStorage.controlcookie++; // incrementamos cuenta de la cookie
            cookie1.style.display = 'none'; // Esconde la política de cookies
        }

        if (localStorage.controlcookie > 0) {
            const cookie1 = document.getElementById('cookie1');
            if (cookie1) {
                cookie1.style.bottom = "-50px";
            }
        }
    </script>
@endsection
