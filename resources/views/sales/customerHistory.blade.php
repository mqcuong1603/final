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
                    <a href="{{ route('sales.report') }}"
                        class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span style="margin-left:44px" class="fs-5 d-none d-sm-inline">Point of Sale</span>
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                        id="menu">
                        <li class="nav-item">
                            <a href="{{ route('sales.sales_dashboard') }}" class="nav-link align-middle px-0">
                                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Customer
                                    Management</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('sales.sales_transaction') }}" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Transaction</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline text-info">Report &
                                    Analytics</span>
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
                            <li><a class="dropdown-item" href="{{ route('sales.logout') }}">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col col-md-9 col-xl-10 px-sm-10 d-flex flex-column">
                <div>
                    <nav class="navbar navbar-expand-sm navbar-dark bg-dark mt-3">
                        <div class="container-fluid">
                            <div class="d-flex align-items-center">
                                <a class="navbar-brand" href="{{ route('sales.sales_dashboard') }}">{{$customer->fullName}}'s orders</a>
                                <a href="{{ route('sales.sales_dashboard') }}">
                                    <button class="btn btn-success ms-2" type="button">Return</button>
                                 </a>
                            </div>
                            <div class="d-flex ms-auto">
                                <span style="margin-top: 6px " class="text-white me-2">From</span>
                                <input type="date" class="form-control me-2" id="fromDate">
                                <span style="margin-top: 6px " class="text-white me-2">To</span>
                                <input type="date" class="form-control me-2" id="toDate">
                                <button class="btn btn-primary" type="button">Go</button>
                            </div>
                        </div>
                    </nav>
                    <div id="HTML_element" style="overflow-y: auto">
                        <table class="table table-hover table-striped position-relative">
                            <thead>
                                <tr>
                                    <th class="text-center">Order Id</th>
                                    <th class="text-center">Order Date</th>
                                    <th class="text-center">Total price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customer->orders as $order)
                                    <tr>
                                        <td class="text-center">{{ $order->id }}</td>
                                        <td class="text-center">{{ date('H:i d F Y', strtotime($order->order_date)) }}</td>
                                        <td class="text-center">${{ $order->total_price }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div></div>
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
                document.addEventListener('DOMContentLoaded', function() 
                {
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


