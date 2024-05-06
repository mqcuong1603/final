<!DOCTYPE html>
<html lang="en">

<head>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/a076d05399.js.js" crossorigin="anonymous"></script>
    <style>
      .hold:hover {
        color:white;

            }
        </style>
    </head>

<body onload="setElementHeightToScreenHeight()">
<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-5 d-none d-sm-inline">Point of Sale</span>
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <a href="/admin_dashboard" class="nav-link align-middle px-0">
                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline text-info" >Account Management</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Customers Management</span> 
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/products" class="nav-link align-middle px-0">
                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Product Catalog</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Transaction</span> 
                        </a>
                    </li>
                    <li>
                        <a href="{{route('products.create')}}" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Add products</span> 
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Report & Analytics</span> 
                        </a>
                    </li>
                </ul>
                <hr>
                <div class="dropdown pb-4">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://t4.ftcdn.net/jpg/04/75/00/99/360_F_475009987_zwsk4c77x3cTpcI3W1C1LU4pOSyPKaqi.jpg" alt="hugenerd" width="30" height="30" class="rounded-circle">
                        <span class="d-none d-sm-inline mx-1">admin</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="#">Change password</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                    </ul>
                </div>
            </div>
      </div>
      <div class=" col-auto col-md-9 col-xl-10 px-sm-10 d-flex flex-column">
        <div>
          <nav class="navbar navbar-expand-sm navbar-dark bg-dark ">
                        <div class="container-fluid">
                        <a class="navbar-brand" href="javascript:void(0)">List Of Salepersons</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="mynavbar">
                        <ul class="navbar-nav me-auto">
                        </ul>
                        <form class="d-flex">
                            <input class="form-control me-2" type="text" placeholder="Search">
                            <button class="btn btn-primary" type="button">Search</button>
                        </form>
                        </div>
                    </div>
                </nav>
            </div>
            <div>
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Lock</th>
                            <th>Activate</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                </table>
            </div id="HTML_element" style="overflow-y: auto">
            <table class="table table-hover table-striped">
                <tbody>
                    @foreach ($salesmen as $salesman)
                        <tr>
                            <td style="width:17%">Placeholder Image</td>
                            <td style="width:14%">{{ $salesman->fullName }}</td>
                            <td style="width:19.5%">{{ $salesman->email }}</td>
                            <td style="width:15%">
                              @if ($salesman->isLocked == 0)
                                Unlock
                              @else
                                Lock
                              @endif
                            </td>
                            <td style="width:20.6%">
                              @if ($salesman->isActivated == 0)
                                Inactivate
                              @else
                                Activate
                              @endif
                            <td>
                                <!-- <div class="dropdown">
                                    <button class="btn" type="button" dropdown-toggle="dropdown">☰</button>
                                    <ul class="dropdown-menu">
                                      <li>
                                        <a href="#" data-bs-toggle="modal" class="dropdown-item"
                                          >Edit</a>
                                      </li>
                                      <li>
                                        <a href="#" data-bs-toggle="modal" class="dropdown-item"
                                          >Lock</a>
                                      </li>
                                      <li>
                                        <a href="#" data-bs-toggle="modal" class="dropdown-item"
                                          >Delete</a>
                                      </li>
                                    </ul>
                                </div> -->
                                <div class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                                  ☰
                                  </button>
                                  <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" data-bs-toggle="modal" href="#"
                                          data-bs-target="#editModal-{{ $salesman->id }}"
                                          data-salesman-id="{{ $salesman->id }}"
                                          data-salesman-name="{{ $salesman->fullName }}"
                                          data-salesman-email="{{ $salesman->email }}">Edit</a></li>
                                    <li><a class="dropdown-item" data-bs-toggle="modal" href="#"
                                          data-bs-target="#lockModal-{{ $salesman->id }}"
                                          data-salesman-id="{{ $salesman->id }}"
                                          data-salesman-email="{{ $salesman->email }}">Lock</a></li>
                                    <li><a class="dropdown-item" data-bs-toggle="modal" href="#" 
                                          data-bs-target="#deleteModal-{{ $salesman->id }}"
                                          data-salesman-id="{{ $salesman->id }}"
                                          data-salesman-name="{{ $salesman->fullName }}">Delete</a></li>
                                  </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Admin Dropdown -->
    @foreach ($salesmen as $salesman)
        <!-- Edit Modal -->
        <div class="modal fade" id="editModal-{{ $salesman->id }}" tabindex="-1" role="dialog"
            aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Salesman {{ $salesman->fullName }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                      <form action="{{ route('admin.update', $salesman->email) }}" method="POST">
                          @csrf
                          @method('PUT')
                          <div class="form-group">
                              <label for="name">Full Name</label>
                              <input type="text" class="form-control" id="fullName" name="fullName"
                                  value="{{ $salesman->fullName }}">
                          </div>
                          <div class="form-group">
                              <label for="email">Email</label>
                              <input type="email" class="form-control" id="email" name="email"
                                  value="{{ $salesman->email }}">
                          </div>
                          <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="1" {{ $salesman->isActivated == 1 ? 'selected' : '' }}>
                                    Activate</option>
                                <option value="0" {{ $salesman->isActivated == 0 ? 'selected' : '' }}>
                                    Inactivate</option>
                            </select>
                        </div>
                          <button type="submit" class="btn btn-primary">Save Changes</button>
                      </form>
                  </div>
                </div>
            </div>
        </div>
    @endforeach
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- Admin Dropdown -->
    @foreach ($salesmen as $salesman)
        <!-- Edit Modal -->
        <div class="modal fade" id="editModal-{{ $salesman->id }}" tabindex="-1" role="dialog"
            aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Salesman {{ $salesman->fullName }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                      <form action="{{ route('admin.update', $salesman->email) }}" method="POST">
                          @csrf
                          @method('PUT')
                          <div class="form-group">
                              <label for="name">Full Name</label>
                              <input type="text" class="form-control" id="fullName" name="fullName"
                                  value="{{ $salesman->fullName }}">
                          </div>
                          <div class="form-group">
                              <label for="email">Email</label>
                              <input type="email" class="form-control" id="email" name="email"
                                  value="{{ $salesman->email }}">
                          </div>
                          <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="1" {{ $salesman->isActivated == 1 ? 'selected' : '' }}>
                                    Activate</option>
                                <option value="0" {{ $salesman->isActivated == 0 ? 'selected' : '' }}>
                                    Inactivate</option>
                            </select>
                        </div>
                          <button type="submit" class="btn btn-primary">Save Changes</button>
                      </form>
                  </div>
                </div>
            </div>
        </div>
    @endforeach
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    


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
    <script>
        function setElementHeightToScreenHeight() {
          const element = document.getElementById("HTML_element");
          element.style.height = window.innerHeight - 145 + "px";
        }

        document.addEventListener('DOMContentLoaded', function() {
            window.addEventListener('resize', setElementHeightToScreenHeight);
            setElementHeightToScreenHeight();
        });
    </script>
</body>

</html>
