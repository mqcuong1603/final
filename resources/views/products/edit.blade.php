


<div class="container">
    <h2>Edit Product</h2>
    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT') 

        <div class="form-productName">
            <label>Product Name:</label>
            <input type="text" class="form-control" id="product_name" name="product_name" value="" required>
        </div>

        <div class="form-importPrice">
            <label>Import Price:</label>
            <input type="number" class="form-control" id="import_price" name="import_price" value="">
        </div>

        <div class="form-retailPrice">
            <label>Retail Price:</label>
            <input type="number" class="form-control" id="retail_price" name="retail_price" value="">
        </div>

        <div class="form-category">
            <label>Category:</label>
            <input type="text" class="form-control" id="category" name="category" value="" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Product</button>
    </form>
</div>

