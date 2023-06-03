@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12" style="text-align: center">
                <h1>Carrito de compra</h1>
            </div>
            <div class="col-sm-12 col-md-12" id="table_cart">
                @include('cart._partial_cart', [$cartItems, $cartItems])
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>

    <script>
        $(document).ready(function() {
            var cart = JSON.parse(localStorage.getItem('cart')) || {};
            if (Object.keys(cart).length) {
                $.ajax({
                    url: '{{ route('get.products') }}',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        product_ids: Object.keys(cart)
                    },
                    success: function(response) {
                        sessionStorage.setItem('products', JSON.stringify(response));
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }
        });
    </script>
@endsection
