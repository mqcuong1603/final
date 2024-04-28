
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
</head>
<body>
    {{-- @section('content') --}}
<div class="container">
    <h1>Product List</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Barcode</th>
                <th>Name</th>
                <th>Import Price</th>
                <th>Retail Price</th>
                <th>Category</th>
                {{-- <th>Actions</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->barcode }}</td>
                <td>{{ $product->product_name }}</td>
                <td>{{ $product->import_price }}</td>
                <td>{{ $product->retail_price }}</td>
                <td>{{ $product->category }}</td>
                {{-- <td>{{ $product->creation_date }}</td>
                <td>{{ $product->created_at }}</td>
                <td>{{ $product->updated_at }}</td>
                <td>{{ $product->creation_date }}</td> --}}
                {{-- <td>
                    <a href="{{ route('products.update', $product) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td> --}}
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{-- @endsection --}}
</body>
</html>
