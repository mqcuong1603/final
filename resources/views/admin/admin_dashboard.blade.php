
@foreach($users as $user){
    <tr>
        <td>{{ $user->fullName }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->status }}</td>
    </tr>
}
@endforeach

@foreach($salesmen as $salesman){
    <tr>
        <td>{{ $salesman->fullName }}</td>
    </tr>
}
@endforeach



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/admin.css">
  </head>
  <body>
    <h1>POINT OF SALE</h1>
    <div class="account-box"> Account Management </div>
    <header>
      <div class="admin-box" id="adminBox"> Admin <div class="dropdown">
          <button class="dropbtn" id="dropdownBtn">▼</button>
          <div class="dropdown-content" id="dropdownContent">
            <a href="#">Change Password</a>
          </div>
        </div>
      </div>
    </header>
    <div class="search-bar">
      <input type="text" class="search-input" placeholder="Search...">
      <button>Search</button>
    </div>
    <div class="content">
      <div class="sidebar">
        <a href="#account">Account Management</a>
        <a href="#createSales">Create Sales Account</a>
        <a href="#product_catalog">Product Catalog</a>
        <a href="#customer">Customer Management</a>
        <a href="#transaction">Transaction</a>
        <a href="#report">Report & Analytics </a>
        <a href="logout.php">Logout</a>
      </div>
      <div class="table-container1">
        <h2>List of Salespersons</h2>
        <table>
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
          @foreach($users as $user){
          <tr>
              <td>{{ $user->fullName }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ $user->status }}</td>
          </tr>
          }
          @endforeach
            <!-- Add more rows if needed -->
          </tbody>
        </table>
      </div>
      <div class="table-container2">
        <h2>New Account</h2>
        <table>
          <thead>
            <tr>
              <th>Name</th>
              <th>Role</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Luong Minh Dat</td>
              <td>Administrator</td>
            </tr>
            <tr>
              <td>Lu Dat Luan</td>
              <td>Salesperson</td>
            </tr>
            <tr>
              <td>Lu Dat Luan</td>
              <td>Salesperson</td>
            </tr>
            <!-- Add more rows if needed -->
          </tbody>
        </table>
      </div>
    </div>
    <script>
      // Lấy tham chiếu đến admin box và dropdown content
      const adminBox = document.getElementById('adminBox');
      const dropdownContent = document.getElementById('dropdownContent');
      // Thêm sự kiện click cho admin box
      adminBox.addEventListener('click', function() {
        // Kiểm tra trạng thái hiện tại của dropdown content
        if (dropdownContent.style.display === 'block') {
          // Nếu dropdown đang hiển thị, ẩn nó đi
          dropdownContent.style.display = 'none';
        } else {
          // Nếu dropdown đang ẩn, hiển thị nó lên
          dropdownContent.style.display = 'block';
        }
      });
      // Đóng dropdown khi click bên ngoài dropdown content
      document.addEventListener('click', function(event) {
        if (!adminBox.contains(event.target) && !dropdownContent.contains(event.target)) {
          dropdownContent.style.display = 'none';
        }
      });
      // Ngăn chặn sự kiện click từ dropdown content lan sang admin box
      dropdownContent.addEventListener('click', function(event) {
        event.stopPropagation(); // Ngăn chặn sự kiện click lan sang admin box
      });
    </script>
  </body>
</html>