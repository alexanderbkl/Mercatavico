<table id="productTable" class="table table-hover">
    <thead>
    <tr>
        <th>Producto</th>
        <th>Cantidad</th>
        <th class="text-center">Pricio unitario</th>
        <th class="text-center">Sub total</th>
        <th>Eliminar</th>
    </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<!-- Rest of the HTML code remains same -->

<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script>
    let products = JSON.parse(sessionStorage.getItem('products')) || [];
    let cart = JSON.parse(localStorage.getItem('cart')) || {};

    products.forEach(product => {
        let quantity = cart[product.id] || 0;
        let subTotal = product.price * quantity;

        let row = `
            <tr>
                <td class="col-sm-8 col-md-6">
                    <div class="media">
                        <div class="thumbnail pull-left" style="margin-right: 25px">
                            <img src="/Mercatavico/public/storage/productsImages/${product.foto}" style="width: 72px; height: 72px;object-fit: cover">
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">${product.title}</h4>
                            <h5 class="media-heading"> Vendido por <span>${product.user_id}</span></h5>
                            <span>Estado: </span><span class="text-success"><strong>${product.state}</strong></span>
                        </div>
                    </div>
                </td>
                <td class="col-sm-1 col-md-1" style="text-align: center">
                    ${quantity} unidades
                </td>
                <td class="col-sm-1 col-md-1 text-center"><strong>${product.price}€</strong></td>
                <td class="col-sm-1 col-md-1 text-center"><strong>${subTotal}€</strong></td>
                <td class="col-sm-1 col-md-1">
                    <button type="button"  class="btn btn-danger deleteCartItem"  data-id="${product.id}"  data-toggle="modal" data-target="#confirmDeleteCartModal">
                        <span class="glyphicon glyphicon-remove"></span> Eliminar
                    </button>
                </td>
            </tr>
        `;

        $('#productTable tbody').append(row);
    });

    $('.deleteCartItem').click(function() {
        let productId = $(this).data('id');

        // Remove the product from the cart
        delete cart[productId];

        // Update the cart in localStorage
        localStorage.setItem('cart', JSON.stringify(cart));

        // Reload the page to reflect the changes
        location.reload();
    });
</script>
