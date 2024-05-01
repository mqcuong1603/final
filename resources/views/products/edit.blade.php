<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/editP.css">
</head>
<body>
<div class="container">
    <h2>Edit Product</h2>
    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT') 

        <div class="form-productName">
            <label>Product Name:</label>
            <input type="text" class="form-control" id="product_name" name="product_name" value="{{ $product->product_name  }}" required>
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

        <button type="submit" class="btn btn-primary">Update Product</button>
    </form>
</div>
</body>
</html>