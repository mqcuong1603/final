<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transaction</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</head>

<body onload="setElementHeightToScreenHeight()">
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <a href=" {{ route('sales.sales_dashboard') }}"
                        class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span style="margin-left:44px" class="fs-5 d-none d-sm-inline">Point of Sale</span>
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                        id="menu">
                        <li class="nav-item">
                            <a href="{{ route('sales.sales_dashboard') }}" class="mt-3 nav-link align-middle px-0">
                                <i class="fs-4 bi-house"></i>
                                <h6><span class="ms-1 d-none d-sm-inline">Customer
                                        Management</span></h6>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('sales.sales_transaction') }}" class="mt-3 nav-link px-0 align-middle">
                                <i class="fs-4 bi-people"></i>
                                <h5><span class="ms-1 d-none d-sm-inline badge bg-info">Transaction</span></h5>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('sales.report') }}" class="mt-3 nav-link px-0 align-middle">
                                <i class="fs-4 bi-people"></i>
                                <h6><span class="ms-1 d-none d-sm-inline">Report &
                                        Analytics</span></h6>
                            </a>
                        </li>
                    </ul>
                    <hr>
                    <div class="dropdown pb-4">
                        <a href="#"
                            class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                            id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://t4.ftcdn.net/jpg/04/75/00/99/360_F_475009987_zwsk4c77x3cTpcI3W1C1LU4pOSyPKaqi.jpg"
                                alt="hugenerd" width="30" height="30" class="rounded-circle">
                            <span class="d-none d-sm-inline mx-1">{{ Auth::guard('salesman')->user()->username }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="{{ route('sales.salesInfo', Auth::guard('salesman')->user()->email) }}">Profile</a></li>                            <li><a class="dropdown-item" href="{{ route('admin.logout') }}">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class=" py-3 col-auto col-md-9 col-xl-10 px-sm-10 container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <div>
                            <nav class="navbar navbar-expand-sm navbar-dark bg-dark ">
                                <div class="container-fluid">
                                    <a class="navbar-brand" href="#">Product List</a>
                                    <div class="collapse navbar-collapse" id="mynavbar">
                                        <ul class="navbar-nav me-auto">
                                            <li class="nav-item">
                                            </li>
                                        </ul>
                                        <form class="d-flex" action="#" method="GET">
                                            <input class="form-control me-2" type="text" placeholder="Search"
                                                name="search" id="search">
                                        </form>
                                    </div>
                                </div>
                            </nav>
                        </div>
                        <div id="HTML_element" style="overflow-inline: auto; overflow-y:auto">
                            <table class="table table-hover table-striped ">
                                <thead>
                                    <tr>
                                        <th class="text-center">Barcode</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Action</th>
                                        <th>

                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td class="text-center">{{ $product->barcode }}</td>
                                            <td class="text-center">{{ $product->product_name }}</td>
                                            <td class="text-center">${{ number_format($product->retail_price, 2) }}</td>
                                            <td class="text-center">
                                                <button class="btn btn-success addButton">Add</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="border border-4 col-12 col-sm-12 col-md-6 col-lg-6 position-relative">
                        <div>
                            <h1>Transaction List</h1>
                        </div>
                        <div style="overflow-y: auto; height:690px">
                            <table id="transactionList" class="table table-hover table-striped ">
                                <thead>
                                    <tr>
                                        <th class="text-center">Barcode</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center"><label for="number">Quantity</label></th>
                                        <th class="text-center">Total price</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>

                        <div style="width:50%" class="position-absolute bottom-0 start-0 display-6 mb-3">
                            <label for="total">Total</label>
                            <input type="text" class="form-control" id="total" value="$0.00" readonly>
                        </div>
                        <div class="position-absolute bottom-0 end-0 d-grid gap-2 mx-3 mb-3">
                            <button data-bs-toggle="modal" href="#" data-bs-target="#addModal"
                                class="btn btn-success btn-lg">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<div class="modal fade " id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Check customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('sales.checkCustomer') }}" method="POST">
                    @method('POST')
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" value="">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="tel" class="form-control" name="phone" value="">
                    </div>
                    <div id="transactionData">
                        <!-- Hidden input fields for the transaction list data will be added here -->
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Check</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        function setElementHeightToScreenHeight() {
            const element = document.getElementById("HTML_element");
            element.style.height = window.innerHeight - 90 + "px";
        }
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.addButton').click(function() {
                var row = $(this).closest('tr');
                var barcode = row.find('td:eq(0)').text();
                var product = row.find('td:eq(1)').text();
                var priceText = row.find('td:eq(2)').text().replace('$', '');
                var price = parseFloat(priceText.replace(',', ''));

                // Check if a row with the same barcode already exists in the transaction list
                var existingRow = $('#transactionList tr').filter(function() {
                    return $(this).find('td:eq(0)').text() === barcode;
                });

                if (existingRow.length > 0) {
                    // If the product already exists in the transaction list, increment its quantity
                    var quantityInput = existingRow.find('.quantity');
                    var quantity = parseInt(quantityInput.val()) + 1;
                    quantityInput.val(quantity).change();
                } else {
                    // If the product doesn't exist in the transaction list, add a new row
                    var newRow = $('<tr><td class="text-center">' + barcode +
                        '</td><td class="text-center">' + product + '</td><td class="product-price">' +
                        price +
                        '</td><td class="text-center"><input type="number" value="1" min="1" class="quantity" style="width: 50%;"></td><td class="text-center total-price">' +
                        price +
                        '</td><td class="text-center"><button class="btn btn-danger deleteButton">Delete</button></td></tr>'
                    );
                    $('#transactionList').append(newRow);

                    // Also add the product data to hidden input fields within the form
                    $('#transactionData').append('<input type="hidden" name="products[]" value="' +
                        barcode +
                        '">');
                    var quantityInput = $('<input type="hidden" name="quantity[]" value="1">');
                    $('#transactionData').append(quantityInput);

                    updateTotal();

                    // Add event listener for quantity change
                    newRow.find('.quantity').change(function() {
                        var quantity = $(this).val();
                        var price = newRow.find('.product-price').text();
                        var totalPrice = quantity * price;
                        newRow.find('.total-price').text(totalPrice);
                        updateTotal();
                        quantityInput.val(quantity);
                    });
                }
            });

            $('#transactionList').on('input', '.quantity', function() {
                // Get the current quantity and convert it to a number
                var quantity = parseInt($(this).val());

                // Get the price and convert it to a number
                var price = parseFloat($(this).closest('tr').find('.product-price').text());

                // Calculate the new total price
                var totalPrice = quantity * price;

                // Update the total price cell
                $(this).closest('tr').find('.total-price').text(totalPrice.toFixed(2));

                // Update the quantity in the hidden input field
                $(this).closest('tr').find('input[name="quantities[]"]').val(quantity);

                updateTotal();
            });

            //delete
            $('#transactionList').on('click', '.deleteButton', function() {
                $(this).closest('tr').remove();

                updateTotal();
            });

            function updateTotal() {
                var total = 0;

                // Loop through all total prices and add them to the total
                $('#transactionList .total-price').each(function() {
                    total += parseFloat($(this).text().replace('$', ''));
                });

                // Update the total input field with the new total and increase the font size
                $('#total').val('$' + total.toFixed(2)).css('font-size', '20px');
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('table tbody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>

</html>
