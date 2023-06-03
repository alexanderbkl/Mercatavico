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
    //if products fetched from buy.blade.php ajax in a const called products are not empty, which are saved in a session storage called products, log them
    let products = JSON.parse(sessionStorage.getItem('products'))
    if(products){
        console.log(products)
    }

    // Create an object to hold products count
    let productCount = {};

    products.forEach(item => {
        if(!productCount[item.id]) {
            productCount[item.id] = { count: 0, product: item };
        }
        productCount[item.id].count++;
    });

    console.log(products[0].title)

    // Loop over the products count
    for(let productId in productCount){
        let productItem = productCount[productId].product;
        let quantity = productCount[productId].count;

        // Calculate subtotal
        let subTotal = productItem.price * quantity;

        // Create new row for each product
        let row = `
            <tr>
                <td class="col-sm-8 col-md-6">
                    <div class="media">
                        <div class="thumbnail pull-left" style="margin-right: 25px">
                            <img src="/Mercatavico/public/storage/productsImages/${productItem.foto}" style="width: 72px; height: 72px;object-fit: cover">
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">${productItem.title}</h4>
                            <h5 class="media-heading"> Vendido por <span>${productItem.user_id}</span></h5>
                            <span>Estado: </span><span class="text-success"><strong>${productItem.state}</strong></span>
                        </div>
                    </div></td>
                <td class="col-sm-1 col-md-1" style="text-align: center">
                    ${quantity} unidades
                </td>
                <td class="col-sm-1 col-md-1 text-center"><strong>${productItem.price}€</strong></td>
                <td class="col-sm-1 col-md-1 text-center"><strong>${subTotal}€</strong></td>
                <td class="col-sm-1 col-md-1">
                    <button type="button"  class="btn btn-danger deleteCartItem"  data-id="${productId}"  data-toggle="modal" data-target="#confirmDeleteCartModal">
                        <span class="glyphicon glyphicon-remove"></span> Eliminar
                    </button>
                </td>
            </tr>
        `;

        // Append the row to the table
        $('#productTable tbody').append(row);
    }

    // Rest of the JavaScript code remains same
</script>
