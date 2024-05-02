<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add products</title>
</head>
<body>
<div class="container">
    <h2>add Product</h2>
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        @method('POST') 

        <div class="form-productName">
            <label>Product Id:</label>
            <input type="text" class="form-control" id="product_name" name="product_id" value="{{ $product->product_id  }}" required>
        </div>

        <div class="form-productName">
            <label>Product Barcode:</label>
            <input type="text" class="form-control" id="product_name" name="product_barcode" value="{{ $product->product_barcode  }}" required>
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

        <button type="submit" class="btn btn-primary">Add Product</button>
    </form>
</div>
</body>
</html>