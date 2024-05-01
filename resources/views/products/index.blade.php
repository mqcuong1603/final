<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <h1>Product List</h1>
    <table class="table table-hover table-striped">
        <thead class="thead-dark">
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
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->barcode }}</td>
                <td>{{ $product->product_name }}</td>
                <td>${{ number_format($product->import_price, 2) }}</td>
                <td>${{ number_format($product->retail_price, 2) }}</td>
                <td>{{ $product->category }}</td>
                <td>
                    <!-- Edit button triggers modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProductModal-{{ $product->id }}">Edit</button>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal for editing products -->
    @foreach ($products as $product)
    <div class="modal fade" id="editProductModal-{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductModalLabel">Edit Product {{ $product->id }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('products.update', $product->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="product_name">Product Name</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" value="{{ $product->product_name }}">
                        </div>
                        <div class="form-group">
                            <label for="barcode">Barcode</label>
                            <input type="text" class="form-control" id="barcode" name="barcode" value="{{ $product->barcode }}">
                        </div>
                        <div class="form-group">
                            <label for="import_price">Import Price</label>
                            <input type="number" class="form-control" id="import_price" name="import_price" value="{{ $product->import_price }}">
                        </div>
                        <div class="form-group">
                            <label for="retail_price">Retail Price</label>
                            <input type="number" class="form-control" id="retail_price" name="retail_price" value="{{ $product->retail_price }}">
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <input type="text" class="form-control" id="category" name="category" value="{{ $product->category }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Update Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
</body>
</html>