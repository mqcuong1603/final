<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <title>Report & Analytics</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <a href=" {{ route('sales.report') }}"
                        class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span style="margin-left:44px" class="fs-5 d-none d-sm-inline">Point of Sale</span>
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                        id="menu">
                        <li class="nav-item">
                            <a href="{{ route('admin.admin_dashboard') }}" class="mt-3 nav-link align-middle px-0">
                                <i class="fs-4 bi-house"></i>
                                <h6><span class="ms-1 d-none d-sm-inline">Account
                                        Management</span></h6>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('products.index') }}" class="mt-3 nav-link px-0 align-middle">
                                <i class="fs-4 bi-people"></i>
                                <h6><span class="ms-1 d-none d-sm-inline">Product Catalog</span></h6>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.admin_report') }}" class="mt-3 nav-link px-0 align-middle">
                                <i class="fs-4 bi-people"></i>
                                <h5><span class="ms-1 d-none d-sm-inline badge bg-info">Report &
                                        Analytics</span></h5>
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
                            <span class="d-none d-sm-inline mx-1">admin</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow"
                            aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item"
                                    href="{{ route('admin.changePassword', Auth::guard('admin')->user()->email) }}">Change
                                    password</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('admin.logout') }}">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class=" col-auto col-md-9 col-xl-10 px-sm-10 d-flex flex-column">
                <div>
                    <nav class="navbar navbar-expand-sm navbar-dark bg-dark mt-3">
                        <div class="container-fluid">
                            <a class="navbar-brand" href="{{ route('admin.admin_report') }}">Report & Analytics</a>
                            <div class="collapse navbar-collapse" id="mynavbar">
                                <input style="width:20%" name="search" id="search" class="form-control me-2 mx-5" type="text"
                                    placeholder="Search" value="" autofocus>
                                <div style="margin-left: 9% ; font-size:20px" class=" navbar-text badge rounded-pill bg-secondary">
                                    Total Orders: {{ $orders->count() }}
                                </div>
                                <div style="margin-left:10px; font-size:20px" class=" navbar-text badge rounded-pill bg-secondary">
                                    Total Profits: xxx
                                </div>
                                <form style="margin-left: auto" action="#" method="GET">
                                    <div class="d-flex align-items-center">
                                        <span class="text-white me-2">From</span>
                                        <input type="date" class="form-control me-2" id="fromDate" name="fromDate">
                                        <span class="text-white me-2">To</span>
                                        <input type="date" class="form-control me-2" id="toDate" name="toDate">
                                        <button class="btn btn-primary" type="submit">Go</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </nav>
                    <div id="HTML_element" style="overflow-y: auto">
                        <table class="table table-hover table-striped position-relative">
                            <thead>
                                <tr>
                                    <th class="text-center">Order Id</th>
                                    <th class="text-center">Customer Id</th>
                                    <th class="text-center">Order Date</th>
                                    <th class="text-center">Total price</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td class="text-center">{{ $order->id }}</td>
                                        <td class="text-center">{{ $order->customer_id }}</td>
                                        <td class="text-center">{{ date('H:i d F Y', strtotime($order->order_date)) }}
                                        </td>
                                        <td class="text-center">{{ "$" . $order->total_price }}</td>
                                        <td class="text-center">
                                            <button class="btn btn-primary view-order-button" data-bs-toggle="modal"
                                                data-bs-target="#orderModal" data-order-id="{{ $order->id }}">
                                                View more detail
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="orderModalLabel">Order Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Customer Name:</strong> <span id="customerName"></span></p>
                            <p><strong>Products:</strong></p>
                            <ul id="productList"></ul>
                            <p><strong>Total Price:</strong> <span id="totalPrice"></span></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    window.addEventListener('resize', setElementHeightToScreenHeight);
                    setElementHeightToScreenHeight();
                });

                function setElementHeightToScreenHeight() {
                    const element = document.getElementById("HTML_element");
                    if (element) {
                        element.style.height = window.innerHeight - 145 + "px";
                    }
                }
                window.onload = function() {
                    const input = document.getElementById('search');
                    input.focus();
                    input.setSelectionRange(input.value.length, input.value.length);
                };
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
            <script>
                $(document).ready(function() {
                    $('.view-order-button').click(function(event) {
                        event.preventDefault();

                        var orderId = $(this).data('order-id');

                        $.ajax({
                            url: '{{ route('sales.orderDetails', ['id' => '__ID__']) }}'.replace('__ID__',
                                orderId),
                            method: 'GET',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                $('#customerName').text(response.customerName);

                                var productList = $('#productList');
                                productList.empty();

                                response.products.forEach(function(product) {
                                    var listItem = $('<li>').text(product.name + ' x' + product
                                        .quantity);
                                    productList.append(listItem);
                                });

                                $('#totalPrice').text("$" + response.totalPrice);
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                console.error(textStatus, errorThrown);
                            }
                        });
                    });
                });
            </script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var today = new Date();
                    var dd = String(today.getDate()).padStart(2, '0');
                    var mm = String(today.getMonth() + 1).padStart(2, '0');
                    var yyyy = today.getFullYear();
        
                    today = yyyy + '-' + mm + '-' + dd;
        
                    var fromDate = document.getElementById('fromDate');
                    var toDate = document.getElementById('toDate');
        
                    fromDate.setAttribute('max', today);
                    toDate.setAttribute('max', today);
                });
            </script>

</body>

</html>