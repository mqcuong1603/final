<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/editP.css">
</head>
<body>
    <h1>Point of Sale</h1>
    <div class="container">
    <header>
      <div class="admin-box" id="adminBox"> Admin <div class="dropdown">
          <button class="dropbtn" id="dropdownBtn">▼</button>
          <div class="dropdown-content" id="dropdownContent">
            <a href="#">Change Password</a>
          </div>
        </div>
      </div>
    </header>
    <div class="detail-box"> Product Details </div>
    <div class="sidebar">
        <a href="#account">Account Management</a>
        <a href="#createSales">Create Sales Account</a>
        <a href="#product_catalog">Product Catalog</a>
        <a href="#customer">Customer Management</a>
        <a href="#transaction">Transaction</a>
        <a href="#report">Report & Analytics</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="content">
        <form action="#" method="POST">
            <div class="form-input">
                <label>Product Name:</label>
                <input type="text" class="form-control" id="product_name" name="product_name" value="" required>
            </div>

            <div class="form-input">
                <label>Import Price:</label>
                <input type="number" class="form-control" id="import_price" name="import_price" value="">
            </div>

            <div class="form-input">
                <label>Retail Price:</label>
                <input type="number" class="form-control" id="retail_price" name="retail_price" value="">
            </div>

            <div class="form-input">
                <label>Category:</label>
                <input type="text" class="form-control" id="category" name="category" value="" required>
            </div>

            <button type="submit" class="btn1 btn-primary">Save</button>
            <button type="submit" class="btn2 btn-primary">Cancel</button>
        </form>
    </div>
    <div class="image-container">
    <img src="css/images/product1.jpg" alt="Product Image">
    </div>
</div>

</body>
</html>
