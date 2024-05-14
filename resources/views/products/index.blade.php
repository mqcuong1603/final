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
                    <a href=" {{ route('admin.admin_dashboard') }}"
                        class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-5 d-none d-sm-inline">Point of Sale</span>
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                        id="menu">
                        <li class="nav-item">
                            <a href="{{ route('admin.admin_dashboard') }}" class="nav-link align-middle px-0">
                                <i class="fs-4 bi-house"></i> <h5><span class="ms-1 d-none d-sm-inline">Account
                                    Management</span></h5>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('products.index') }}" class="nav-link align-middle px-0">
                                <i class="fs-4 bi-house"></i> <h4><span class="ms-1 d-none d-sm-inline badge bg-info">Product
                                    Catalog</span></h4>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-people"></i> <h5><span class="ms-1 d-none d-sm-inline">Report &
                                    Analytics</span></h5>
                            </a>
                        </li>
                    </ul>
                    <hr>
                    <div class="dropdown pb-4">
                        <a href="#" style="position:fixed; bottom:20px; left:20px;"
                            class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                            id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://t4.ftcdn.net/jpg/04/75/00/99/360_F_475009987_zwsk4c77x3cTpcI3W1C1LU4pOSyPKaqi.jpg"
                                alt="hugenerd" width="30" height="30" class="rounded-circle">
                            <span class="d-none d-sm-inline mx-1">admin</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
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
                <div class="mt-3" id="HTML_element" style="overflow-y: auto;">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr class="">
                                <th class="text-center" style="background-color: rgb(168, 168, 168)">ID</th>
                                <th class="text-center" style="background-color: rgb(168, 168, 168)">Barcode</th>
                                <th class="text-center" style="background-color: rgb(168, 168, 168)">Product Name</th>
                                <th class="text-center" style="background-color: rgb(168, 168, 168)">Import Price</th>
                                <th class="text-center" style="background-color: rgb(168, 168, 168)">Retail Price</th>
                                <th class="text-center" style="background-color: rgb(168, 168, 168)">Category</th>
                                <th class="text-center" style="background-color: rgb(168, 168, 168)">Actions</th>
                            </tr>
                        </thead>
                        @foreach ($products as $product)
                            <tr>
                                <td class="text-center">{{ $product->id }}</td>
                                <td class="text-center">{{ $product->barcode }}</td>
                                <td class="text-center">{{ $product->product_name }}</td>
                                <td class="text-center">${{ number_format($product->import_price, 2) }}</td>
                                <td class="text-center">${{ number_format($product->retail_price, 2) }}</td>
                                <td class="text-center"><span class="badge rounded-pill bg-secondary">{{ $product->category }}</span></td>
                                <td class="text-center">
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    </div>
    <script>
        window.onload = function() {
            const element = document.getElementById("HTML_element");
            element.style.height = window.innerHeight - 107 + "px";
            var input = document.getElementById('search');
            var len = input.value.length;
            input.focus();
            input.setSelectionRange(len, len);
        }
    </script>
</body>

</html>