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
    <script src="https://kit.fontawesome.com/a076d05399.js.js" crossorigin="anonymous"></script>
</head>

<body onload="setElementHeightToScreenHeight()">
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <a href="/"
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
                        <li class="nav-item">
                            <a href="{{ route('products.index') }}" class="nav-link align-middle px-0">
                                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Product
                                    Catalog</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-people"></i> <span
                                    class="ms-1 d-none d-sm-inline text-info">Transaction</span>
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
                            <span class="d-none d-sm-inline mx-1">Saleman's name</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class=" py-3 col-auto col-md-9 col-xl-10 px-sm-10 container d-flex flex-column">
                <div>
                    <nav class="navbar navbar-expand-sm navbar-dark bg-dark ">
                        <div class="container-fluid">
                            <a class="navbar-brand" href="">Transaction History</a>
                            <div class="collapse navbar-collapse" id="mynavbar">
                                <ul class="navbar-nav me-auto">
                                    <li class="nav-item">
                                    </li>
                                </ul>
                                <form class="d-flex" action="#" method="GET">
                                    <input class="form-control me-2" type="text" placeholder="Search" name="search"
                                        id="search">
                                    <button class="btn btn-primary" type="submit">Search</button>
                                </form>
                            </div>
                        </div>
                    </nav>
                </div>
                <div>
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Transaction Id</th>
                                <th>Customer Email</th>
                                <th>Barcode</th>
                                <th>Quantity</th>
                                <th>Date Buy</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div id="HTML_element" style="overflow-y: auto;">
                    <table class="table table-hover table-striped">
                        <tbody>
                            <tr>
                                <td>123456</td>
                                <td>JohnDoe@example.com</td>
                                <td>1230908070123</td>
                                <td>2</td>
                                <td>12/03/2024</td>
                                <td>2300$</td>
                            </tr>
                            <tr>
                                <td>123456</td>
                                <td>JohnDoe@example.com</td>
                                <td>1230908070123</td>
                                <td>2</td>
                                <td>12/03/2024</td>
                                <td>2300$</td>
                            </tr>
                            <tr>
                                <td>123456</td>
                                <td>JohnDoe@example.com</td>
                                <td>1230908070123</td>
                                <td>2</td>
                                <td>12/03/2024</td>
                                <td>2300$</td>
                            </tr>
                            <tr>
                                <td>123456</td>
                                <td>JohnDoe@example.com</td>
                                <td>1230908070123</td>
                                <td>2</td>
                                <td>12/03/2024</td>
                                <td>2300$</td>
                            </tr>
                            <tr>
                                <td>123456</td>
                                <td>JohnDoe@example.com</td>
                                <td>1230908070123</td>
                                <td>2</td>
                                <td>12/03/2024</td>
                                <td>2300$</td>
                            </tr>
                            <tr>
                                <td>123456</td>
                                <td>JohnDoe@example.com</td>
                                <td>1230908070123</td>
                                <td>2</td>
                                <td>12/03/2024</td>
                                <td>2300$</td>
                            </tr>
                            <tr>
                                <td>123456</td>
                                <td>JohnDoe@example.com</td>
                                <td>1230908070123</td>
                                <td>2</td>
                                <td>12/03/2024</td>
                                <td>2300$</td>
                            </tr>
                            <tr>
                                <td>123456</td>
                                <td>JohnDoe@example.com</td>
                                <td>1230908070123</td>
                                <td>2</td>
                                <td>12/03/2024</td>
                                <td>2300$</td>
                            </tr>
                            <tr>
                                <td>123456</td>
                                <td>JohnDoe@example.com</td>
                                <td>1230908070123</td>
                                <td>2</td>
                                <td>12/03/2024</td>
                                <td>2300$</td>
                            </tr>
                            <tr>
                                <td>123456</td>
                                <td>JohnDoe@example.com</td>
                                <td>1230908070123</td>
                                <td>2</td>
                                <td>12/03/2024</td>
                                <td>2300$</td>
                            </tr>
                            <tr>
                                <td>123456</td>
                                <td>JohnDoe@example.com</td>
                                <td>1230908070123</td>
                                <td>2</td>
                                <td>12/03/2024</td>
                                <td>2300$</td>
                            </tr>
                            <tr>
                                <td>123456</td>
                                <td>JohnDoe@example.com</td>
                                <td>1230908070123</td>
                                <td>2</td>
                                <td>12/03/2024</td>
                                <td>2300$</td>
                            </tr>
                            <tr>
                                <td>123456</td>
                                <td>JohnDoe@example.com</td>
                                <td>1230908070123</td>
                                <td>2</td>
                                <td>12/03/2024</td>
                                <td>2300$</td>
                            </tr>
                            <tr>
                                <td>123456</td>
                                <td>JohnDoe@example.com</td>
                                <td>1230908070123</td>
                                <td>2</td>
                                <td>12/03/2024</td>
                                <td>2300$</td>
                            </tr>
                            <tr>
                                <td>123456</td>
                                <td>JohnDoe@example.com</td>
                                <td>1230908070123</td>
                                <td>2</td>
                                <td>12/03/2024</td>
                                <td>2300$</td>
                            </tr>
                            <tr>
                                <td>123456</td>
                                <td>JohnDoe@example.com</td>
                                <td>1230908070123</td>
                                <td>2</td>
                                <td>12/03/2024</td>
                                <td>2300$</td>
                            </tr>
                            <tr>
                                <td>123456</td>
                                <td>JohnDoe@example.com</td>
                                <td>1230908070123</td>
                                <td>2</td>
                                <td>12/03/2024</td>
                                <td>2300$</td>
                            </tr>
                            <tr>
                                <td>123456</td>
                                <td>JohnDoe@example.com</td>
                                <td>1230908070123</td>
                                <td>2</td>
                                <td>12/03/2024</td>
                                <td>2300$</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    function setElementHeightToScreenHeight() {
        const element = document.getElementById("HTML_element");
        element.style.height = window.innerHeight - 147 + "px";
    }
</script>
</html>
