
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
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
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Edit</a>
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
    
</div>
</body>
</html>
