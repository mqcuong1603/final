<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/a076d05399.js.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-5 d-none d-sm-inline">Point of Sale</span>
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <a href="{{route('admin.admin_dashboard')}}" class="nav-link align-middle px-0">
                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline text-info" >Account Management</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Customers Management</span> 
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('products.index')}}" class="nav-link align-middle px-0">
                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Product Catalog</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Transaction</span> 
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Report & Analytics</span> 
                        </a>
                    </li>
                </ul>
                <hr>
                <div class="dropdown pb-4">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://t4.ftcdn.net/jpg/04/75/00/99/360_F_475009987_zwsk4c77x3cTpcI3W1C1LU4pOSyPKaqi.jpg" alt="hugenerd" width="30" height="30" class="rounded-circle">
                        <span class="d-none d-sm-inline mx-1">admin</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="#">Change password</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                    </ul>
                </div>
            </div>
      </div>
      <div class=" py-3 col-auto col-md-9 col-xl-10 px-sm-10 container d-flex flex-column">
        <div>
            <nav class="navbar navbar-expand-sm navbar-dark bg-dark ">
                <div class="container-fluid">
                    <a class="navbar-brand" href="/admin_dashboard">Add Product</a>
                </div>
            </nav>
        </div>
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        @method('POST') 

        <div class="form-productName">
            <label>Product Id:</label>
            <input type="text" class="form-control" id="product_name" name="product_id" value="{{ $product->product_id  }}" required>
        </div>

        <div class="form-productName">
            <label>Product Barcode:</label>
            <input type="text" class="form-control" id="product_barcode" name="barcode" value="{{ $product->product_barcode  }}" required>
        </div>

        <div class="form-productName">
            <label>Product Name:</label>
            <input type="text" class="form-control" id="product_name" name="product_name" value="{{ $product->product_name }}" required>
        </div>

        <div class="form-importPrice">
            <label>Import Price:</label>
            <input type="number" class="form-control" id="import_price" name="import_price" value="{{ $product->import_price }}">
        </div>

        <div class="form-retailPrice">
            <label>Retail Price:</label>
            <input type="number" class="form-control" id="retail_price" name="retail_price" value="{{ $product->retail_price }}">
        </div>

        <div class="form-category">
            <label>Category:</label>
            <input type="text" class="form-control" id="category" name="category" value="{{ $product->category }}" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Add Product</button>
    </form>
</div>
</body>
</html>