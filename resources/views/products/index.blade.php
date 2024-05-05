<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>


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
                    <a href=" {{route('admin.admin_dashboard') }}"
                        class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-5 d-none d-sm-inline">Point of Sale</span>
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                        id="menu">
                        <li class="nav-item">
                            <a href="{{ route('admin.admin_dashboard') }}" class="nav-link align-middle px-0">
                                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Account
                                    Management</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Customers
                                    Management</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('products.index') }}" class="nav-link align-middle px-0">
                                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline text-info">Product
                                    Catalog</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Transaction</span>
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
                            <span class="d-none d-sm-inline mx-1">admin</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="{{ route('admin.changePassword')}}">Change password</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-auto col-md-9 col-xl-10 px-sm-10 py-3 container d-flex flex-column">
                <div>
                    <nav class="navbar navbar-expand-sm navbar-dark bg-dark ">
                        <div class="container-fluid">
                            <a class="navbar-brand" href="{{ route('products.index') }}">Product Catalog</a>
                            <a href="{{ route('products.create') }}">
                                <button class="navbar-brand btn btn-success">Add Product</button>
                            </a>
                            <div class="collapse navbar-collapse" id="mynavbar">
                                <ul class="navbar-nav me-auto">
                                </ul>
                                <form action="{{ route('product.search') }}" class="d-flex" method="GET">
                                    <input class="form-control me-2" type="text" placeholder="Search"
                                        value="{{ $search ?? '' }}" autofocus id="search" name="search">
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
                                <th>ID</th>
                                <th>Barcode</th>
                                <th>Product Name</th>
                                <th>Import Price</th>
                                <th>Retail Price</th>
                                <th>Category</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div id="HTML_element" style="overflow-y: auto;">
                    <table class="table table-hover table-striped">
                        @foreach ($products as $product)
                            <tr>
                                <td style="width: 4%;">{{ $product->id }}</td>
                                <td style="width: 15%;">{{ $product->barcode }}</td>
                                <td style="width: 21%;">{{ $product->product_name }}</td>
                                <td style="width: 18%;">${{ number_format($product->import_price, 2) }}</td>
                                <td style="width: 17%;">${{ number_format($product->retail_price, 2) }}</td>
                                <td style="width: 13%;">{{ $product->category }}</td>
                                <td>
                                    <!-- Edit button triggers modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#editProductModal-{{ $product->id }}">Edit</button>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger delete-btn"
                                            onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal for editing products -->
    @foreach ($products as $product)
        <div class="modal fade" id="editProductModal-{{ $product->id }}" tabindex="-1" role="dialog"
            aria-labelledby="editProductModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProductModalLabel">Edit Product {{ $product->id }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('products.update', $product->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="product_name">Product Name</label>
                                <input type="text" class="form-control" id="product_name" name="product_name"
                                    value="{{ $product->product_name }}">
                            </div>
                            <div class="form-group">
                                <label for="barcode">Barcode</label>
                                <input type="text" class="form-control" id="barcode" name="barcode"
                                    value="{{ $product->barcode }}">
                            </div>
                            <div class="form-group">
                                <label for="import_price">Import Price</label>
                                <input type="number" class="form-control" id="import_price" name="import_price"
                                    value="{{ $product->import_price }}">
                            </div>
                            <div class="form-group">
                                <label for="retail_price">Retail Price</label>
                                <input type="number" class="form-control" id="retail_price" name="retail_price"
                                    value="{{ $product->retail_price }}">
                            </div>
                            <div class="form-group">
                                <label for="category">Category</label>
                                <input type="text" class="form-control" id="category" name="category"
                                    value="{{ $product->category }}">
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Update Product</button>
                            <button type="submit" class="btn btn-primary mt-3">Update Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    </div>
    <script>
        function setElementHeightToScreenHeight() {
            const element = document.getElementById("HTML_element");
            element.style.height = window.innerHeight - 147 + "px";
            element.style.height = window.innerHeight - 147 + "px";
        }
    </script>
    {{-- // Search bar autofocus --}}
    <script>
        window.onload = function() {
            var input = document.getElementById('search');
            var len = input.value.length;
            input.focus();
            input.setSelectionRange(len, len);
        }
    </script>

</body>

</html>
