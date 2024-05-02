
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </head>
  <body>
    <h1 style="color: white">POINT OF SALE</h1>
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
        <a href="/Finail-3/final/public/products">Product Catalog</a>
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
        <th>Image</th>
        <th>Name</th>
        <th>Email</th>
        <th>Status</th>
        <th>Lock</th>
        <th>Activate</th> <!-- New column -->
        <th>Edit</th> <!-- New column for hamburger menu -->
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
                    <a href="#" data-bs-toggle="modal" data-bs-target="#editModal-{{ $salesman->id }}" data-salesman-id="{{ $salesman->id }}" data-salesman-name="{{ $salesman->fullName }}" data-salesman-email="{{ $salesman->email }}">Edit</a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#lockModal-{{$salesman->id}}" data-salesman-id="{{ $salesman->id }}" data-salesman-email="{{ $salesman->email }}">Lock</a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#deleteModal-{{$salesman->id}}" data-salesman-id="{{ $salesman->id }}" data-salesman-name="{{ $salesman->fullName }}">Delete</a>
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


@foreach($salesmen as $salesman)
    <!-- Edit Modal -->
    <div class="modal fade" id="editModal-{{ $salesman->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit User {{ $salesman->fullName }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.update', $salesman->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" class="form-control" id="fullName" name="fulName" value="{{ $salesman->fullName }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $salesman->email }}">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="active" {{ $salesman->status == 'activate'? 'selected' : '' }}>Activate</option>
                                <option value="inactive" {{ $salesman->status == 'inactivate'? 'selected' : '' }}>Inactivate</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
  </body>
</html>