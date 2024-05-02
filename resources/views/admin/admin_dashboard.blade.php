


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css')}}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
        <div class="card-deck">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Total Accounts</h5>
      <p class="card-text">{{ $salesmen->count() }}</p>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Active Accounts</h5>
      <p class="card-text">{{ $salesmen->where('isActivated', '1')->count() }}</p>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Locked Accounts</h5>
      <p class="card-text">{{ $salesmen->where('isLocked', '1')->count() }}</p>
    </div>
  </div>
</div>
    <table>
        <thead>
    <tr>
        <th>Image</th>
        <th>Name</th>
        <th>Email</th>
        <th>Status</th>
        <th>Lock</th>
        <th>Activate</th> 
        <th>Edit</th>
    </tr>
</thead>

<tbody>
@foreach($salesmen as $salesman)
    <tr>
        <td>Placeholder Image</td>
        <td>{{ $salesman->fullName }}</td>
        <td>{{ $salesman->email }}</td>
        <td>{{ $salesman->status }}</td>
        <td>Lock</td> 
        <td>Activate</td> 
        <td>
            <div class="dropdownB">
                <button class="dropbtnB">☰</button>
                <div class="dropdown-contentB">
                    <a href="#" data-toggle="modal" data-target="#editModal" data-salesman-id="{{ $salesman->id }}" data-salesman-name="{{ $salesman->fullName }}" data-salesman-email="{{ $salesman->email }}">Edit</a>
                    <a href="#" data-toggle="modal" data-target="#lockModal" data-salesman-id="{{ $salesman->id }}" data-salesman-email="{{ $salesman->email }}">Lock</a>
                    <a href="#" data-toggle="modal" data-target="#deleteModal" data-salesman-id="{{ $salesman->id }}" data-salesman-name="{{ $salesman->fullName }}">Delete</a>
                </div>
            </div>
        </td>
    </tr>
@endforeach

</tbody>
    </table>
</div>
    </div>
     <!-- Admin Dropdown -->
    <script>
      const adminBox = document.getElementById('adminBox');
      const dropdownContent = document.getElementById('dropdownContent');
      adminBox.addEventListener('click', function() {
        if (dropdownContent.style.display === 'block') {
          dropdownContent.style.display = 'none';
        } else {
          dropdownContent.style.display = 'block';
        }
      });
      document.addEventListener('click', function(event) {
        if (!adminBox.contains(event.target) && !dropdownContent.contains(event.target)) {
          dropdownContent.style.display = 'none';
        }
      });
      dropdownContent.addEventListener('click', function(event) {
        event.stopPropagation(); 
      });
    </script>

           <!-- Burger Dropdown -->
      <script>
        const dropdownBs = document.querySelectorAll('.dropdownB');

dropdownBs.forEach((dropdownB) => {
  const dropbtnB = dropdownB.querySelector('.dropbtnB');
  const dropdownContentB = dropdownB.querySelector('.dropdown-contentB');

  if (dropbtnB && dropdownContentB) {
    // Hide the dropdown content by default
    dropdownContentB.style.display = 'none';

    dropbtnB.addEventListener('click', (event) => {
      event.stopPropagation();
      dropdownContentB.style.display = (dropdownContentB.style.display === 'block')? 'none' : 'block';

      // Close other dropdown menus
      dropdownBs.forEach((otherDropdownB) => {
        if (otherDropdownB!== dropdownB) {
          const otherDropdownContentB = otherDropdownB.querySelector('.dropdown-contentB');
          otherDropdownContentB.style.display = 'none';
        }
      });
    });
  }
});

function editSalesman(name) {
        console.log(`Edit ${name}`);
    }

    // Function to lock a salesman
    function lockSalesman(email) {
        console.log(`Lock ${email}`);
    }

    // Function to delete a salesman
    function deleteSalesman(name) {
        console.log(`Delete ${name}`);
    }
      </script>
    

    <script>
     // Add an event listener to the edit button
$(document).on('click', '[data-toggle="modal"]', function(event) {
    event.preventDefault();
    var salesmanId = $(this).data('salesman-id');
    var salesmanName = $(this).data('salesman-name');
    var salesmanEmail = $(this).data('salesman-email');

    // Populate the modal form with the salesman's information
    $('#salesman_id').val(salesmanId);
    $('#fullName').val(salesmanName);
    $('#email').val(salesmanEmail);

    // Show the modal
    $('#editModal').modal('show');
});
    </script>
  </body>
</html>