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
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        .full-height {
            height: 100%;
        }
    </style>
</head>

<body class="justify-content-center align-items-center full-height">
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="d-flex flex-column">
                <div>
                    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
                        <div class="container-fluid">
                            <div class="d-flex align-items-center">
                                <a class="navbar-brand">{{$customer->fullName}}'s orders</a>
                                <a href="{{ route('sales.sales_dashboard') }}">
                                    <button class="btn btn-success ms-2">Return</button>
                                </a>
                            </div>
                            <div style="margin-left: 15% ; font-size:20px" class=" navbar-text badge rounded-pill bg-secondary">
                                Total Orders: {{ $customer->orders->count() }}
                            </div>
                            <form action="{{ route('sales.searchOrder', $customer->id) }}" method="GET">
                                <div class="d-flex align-items-center">
                                    <span class="text-white me-2">From</span>
                                    <input type="date" class="form-control me-2" id="fromDate" name="fromDate">
                                    <span class="text-white me-2">To</span>
                                    <input type="date" class="form-control me-2" id="toDate" name="toDate">
                                    <button class="btn btn-primary" type="submit">Go</button>
                                </div>
                            </form>
                        </div>
                    </nav>
                    <div id="HTML_element" style="overflow-y: auto">
                        <table class="table table-hover table-striped position-relative">
                            <thead>
                                <tr>
                                    <th class="text-center">Order Id</th>
                                    <th class="text-center">Order Date</th>
                                    <th class="text-center">Total price</th>
                                    <th class="text-center">Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customer->orders as $order)
                                    <tr>
                                        <td class="text-center">{{ $order->id }}</td>
                                        <td class="text-center">{{ date('H:i d F Y', strtotime($order->order_date)) }}</td>
                                        <td class="text-center">${{ $order->total_price }}</td>
                                        <td class="text-center">
                                            <button class="btn btn-primary view-order-button" data-bs-toggle="modal"
                                                data-bs-target="#orderModal" data-order-id="{{ $order->id }}">
                                                View
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div></div>
                    </div>
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
                    url: '{{ route('sales.orderDetails', ['id' => '__ID__']) }}'.replace('__ID__', orderId),
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#customerName').text(response.customerName);

                        var productList = $('#productList');
                        productList.empty();

                        response.products.forEach(function(product) {
                            var listItem = $('<li>').text(product.name + ' x' + product.quantity);
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

