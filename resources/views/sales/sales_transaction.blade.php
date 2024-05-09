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
                    <a href="#"
                        class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-5 d-none d-sm-inline">Point of Sale</span>
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                        id="menu">
                        <li>
                            <a href="#" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Customers
                                    Management</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-people"></i> <span
                                    class="ms-1 d-none d-sm-inline text-info">Transaction</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Report &
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
                            <span class="d-none d-sm-inline mx-1">Name of Saleperson</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="{{ route('admin.logout') }}">Logout</a></li>
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
                                    <a class="navbar-brand" href="#">Transaction</a>
                                    <div class="collapse navbar-collapse" id="mynavbar">
                                        <ul class="navbar-nav me-auto">
                                            <li class="nav-item">
                                            </li>
                                        </ul>
                                        <form class="d-flex" action="#" method="GET">
                                            <input class="form-control me-2" type="text" placeholder="Search"
                                                name="search" id="search">
                                            <button class="btn btn-primary" type="submit">Search</button>
                                        </form>
                                    </div>
                                </div>
                            </nav>
                        </div>
                        <div id="HTML_element" style="overflow-inline: auto; overflow-y:auto">
                            <table class="table table-hover table-striped ">
                                <thead>
                                    <tr>
                                        <th>Barcode</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                        <th>

                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->barcode }}</td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>${{ number_format($product->retail_price, 2) }}</td>
                                        <td>
                                            <a href="{{ route('#') }}">
                                                <button class="btn btn-primary">Add</button></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>123456789</td>
                                        <td>iPhone</td>
                                        <td>700</td>
                                        <td><button class="btn btn-primary">Add</button></td>
                                    </tr>
                                    <tr>
                                        <td>123456789</td>
                                        <td>iPhone</td>
                                        <td>700</td>
                                        <td><button class="btn btn-primary">Add</button></td>
                                    </tr>
                                    <tr>
                                        <td>123456789</td>
                                        <td>iPhone</td>
                                        <td>700</td>
                                        <td><button class="btn btn-primary">Add</button></td>
                                    </tr>
                                    <tr>
                                        <td>123456789</td>
                                        <td>iPhone</td>
                                        <td>700</td>
                                        <td><button class="btn btn-primary">Add</button></td>
                                    </tr>
                                    <tr>
                                        <td>123456789</td>
                                        <td>iPhone</td>
                                        <td>700</td>
                                        <td><button class="btn btn-primary">Add</button></td>
                                    </tr>
                                    <tr>
                                        <td>123456789</td>
                                        <td>iPhone</td>
                                        <td>700</td>
                                        <td><button class="btn btn-primary">Add</button></td>
                                    </tr>
                                    <tr>
                                        <td>123456789</td>
                                        <td>iPhone</td>
                                        <td>700</td>
                                        <td><button class="btn btn-primary">Add</button></td>
                                    </tr>
                                    <tr>
                                        <td>123456789</td>
                                        <td>iPhone</td>
                                        <td>700</td>
                                        <td><button class="btn btn-primary">Add</button></td>
                                    </tr>
                                    <tr>
                                        <td>123456789</td>
                                        <td>iPhone</td>
                                        <td>700</td>
                                        <td><button class="btn btn-primary">Add</button></td>
                                    </tr>
                                    <tr>
                                        <td>123456789</td>
                                        <td>iPhone</td>
                                        <td>700</td>
                                        <td><button class="btn btn-primary">Add</button></td>
                                    </tr>
                                    <tr>
                                        <td>123456789</td>
                                        <td>iPhone</td>
                                        <td>700</td>
                                        <td><button class="btn btn-primary">Add</button></td>
                                    </tr>
                                    <tr>
                                        <td>123456789</td>
                                        <td>iPhone</td>
                                        <td>700</td>
                                        <td><button class="btn btn-primary">Add</button></td>
                                    </tr>
                                    <tr>
                                        <td>123456789</td>
                                        <td>iPhone</td>
                                        <td>700</td>
                                        <td><button class="btn btn-primary">Add</button></td>
                                    </tr>
                                    <tr>
                                        <td>123456789</td>
                                        <td>iPhone</td>
                                        <td>700</td>
                                        <td><button class="btn btn-primary">Add</button></td>
                                    </tr>
                                    <tr>
                                        <td>123456789</td>
                                        <td>iPhone</td>
                                        <td>700</td>
                                        <td><button class="btn btn-primary">Add</button></td>
                                    </tr>
                                    <tr>
                                        <td>123456789</td>
                                        <td>iPhone</td>
                                        <td>700</td>
                                        <td><button class="btn btn-primary">Add</button></td>
                                    </tr>
                                    <tr>
                                        <td>123456789</td>
                                        <td>iPhone</td>
                                        <td>700</td>
                                        <td><button class="btn btn-primary">Add</button></td>
                                    </tr>
                                    <tr>
                                        <td>123456789</td>
                                        <td>iPhone</td>
                                        <td>700</td>
                                        <td><button class="btn btn-primary">Add</button></td>
                                    </tr>
                                    <tr>
                                        <td>123456789</td>
                                        <td>iPhone</td>
                                        <td>700</td>
                                        <td><button class="btn btn-primary">Add</button></td>
                                    </tr>
                                    <tr>
                                        <td>123456789</td>
                                        <td>iPhone</td>
                                        <td>700</td>
                                        <td><button class="btn btn-primary">Add</button></td>
                                    </tr>
                                    <tr>
                                        <td>123456789</td>
                                        <td>iPhone</td>
                                        <td>700</td>
                                        <td><button class="btn btn-primary">Add</button></td>
                                    </tr>
                                    <tr>
                                        <td>123456789</td>
                                        <td>iPhone</td>
                                        <td>700</td>
                                        <td><button class="btn btn-primary">Add</button></td>
                                    </tr>
                                    <tr>
                                        <td>123456789</td>
                                        <td>iPhone</td>
                                        <td>700</td>
                                        <td><button class="btn btn-primary">Add</button></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="border border-4 col-12 col-sm-12 col-md-6 col-lg-6 position-relative">
                        <div>
                            <h1>List of product(s)</h1>
                        </div>
                        <div style="overflow-y: auto; height:690px">
                            <table class="table table-hover table-striped ">
                                <thead>
                                    <tr>
                                        <th>Barcode</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th><label for="number">Quantity</label></th>
                                        <th>Total price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>123456789</td>
                                        <td>iPhone</td>
                                        <td>700</td>
                                        <td>
                                            <input type="number" id="number" name="" value="">
                                        </td>
                                        <td>700</td>
                                        <td>
                                            <button type="" class="btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>123456789</td>
                                        <td>iPhone</td>
                                        <td>700</td>
                                        <td>
                                            <input type="number" id="number" name="" value="">
                                        </td>
                                        <td>700</td>
                                        <td>
                                            <button type="" class="btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>123456789</td>
                                        <td>iPhone</td>
                                        <td>700</td>
                                        <td>
                                            <input type="number" id="number" name="" value="">
                                        </td>
                                        <td>700</td>
                                        <td>
                                            <button type="" class="btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>123456789</td>
                                        <td>iPhone</td>
                                        <td>700</td>
                                        <td>
                                            <input type="number" id="number" name="" value="">
                                        </td>
                                        <td>700</td>
                                        <td>
                                            <button type="" class="btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>123456789</td>
                                        <td>iPhone</td>
                                        <td>700</td>
                                        <td>
                                            <input type="number" id="number" name="" value="">
                                        </td>
                                        <td>700</td>
                                        <td>
                                            <button type="" class="btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>123456789</td>
                                        <td>iPhone</td>
                                        <td>700</td>
                                        <td>
                                            <input type="number" id="number" name="" value="">
                                        </td>
                                        <td>700</td>
                                        <td>
                                            <button type="" class="btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>123456789</td>
                                        <td>iPhone</td>
                                        <td>700</td>
                                        <td>
                                            <input type="number" id="number" name="" value="">
                                        </td>
                                        <td>700</td>
                                        <td>
                                            <button type="" class="btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>123456789</td>
                                        <td>iPhone</td>
                                        <td>700</td>
                                        <td>
                                            <input type="number" id="number" name="" value="">
                                        </td>
                                        <td>700</td>
                                        <td>
                                            <button type="" class="btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>123456789</td>
                                        <td>iPhone</td>
                                        <td>700</td>
                                        <td>
                                            <input type="number" id="number" name="" value="">
                                        </td>
                                        <td>700</td>
                                        <td>
                                            <button type="" class="btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>123456789</td>
                                        <td>iPhone</td>
                                        <td>700</td>
                                        <td>
                                            <input type="number" id="number" name="" value="">
                                        </td>
                                        <td>700</td>
                                        <td>
                                            <button type="" class="btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>123456789</td>
                                        <td>iPhone</td>
                                        <td>700</td>
                                        <td>
                                            <input type="number" id="number" name="" value="">
                                        </td>
                                        <td>700</td>
                                        <td>
                                            <button type="" class="btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>123456789</td>
                                        <td>iPhone</td>
                                        <td>700</td>
                                        <td>
                                            <input type="number" id="number" name="" value="">
                                        </td>
                                        <td>700</td>
                                        <td>
                                            <button type="" class="btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>123456789</td>
                                        <td>iPhone</td>
                                        <td>700</td>
                                        <td>
                                            <input type="number" id="number" name="" value="">
                                        </td>
                                        <td>700</td>
                                        <td>
                                            <button type="" class="btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>123456789</td>
                                        <td>iPhone</td>
                                        <td>700</td>
                                        <td>
                                            <input type="number" id="number" name="" value="">
                                        </td>
                                        <td>700</td>
                                        <td>
                                            <button type="" class="btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>123456789</td>
                                        <td>iPhone</td>
                                        <td>700</td>
                                        <td>
                                            <input type="number" id="number" name="" value="">
                                        </td>
                                        <td>700</td>
                                        <td>
                                            <button type="" class="btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>123456789</td>
                                        <td>iPhone</td>
                                        <td>700</td>
                                        <td>
                                            <input type="number" id="number" name="" value="">
                                        </td>
                                        <td>700</td>
                                        <td>
                                            <button type="" class="btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>123456789</td>
                                        <td>iPhone</td>
                                        <td>700</td>
                                        <td>
                                            <input type="number" id="number" name="" value="">
                                        </td>
                                        <td>700</td>
                                        <td>
                                            <button type="" class="btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div style="width:50%" class="position-absolute bottom-0 start-0 display-6 mb-3">
                            Total: 2800$
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
                <form action="#" method="POST">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" value="">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="number" class="form-control" name="phone" value="">
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

</html>