<!DOCTYPE html>
<html lang="en">

<head>

    <head>

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Admin Dashboard</title>
            <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
                crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
            </script>
            <style>
                .hold:hover {
                    color: white;

                }
            </style>
        </head>

    <body onload="setElementHeightToScreenHeight()">
        <div class="container-fluid">
            <div class="row flex-nowrap">
                <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                    <div
                        class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                        <a href=" {{ route('admin.admin_dashboard') }}"
                            class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                            <span style="margin-left:44px" class="fs-5 d-none d-sm-inline">Point of Sale</span>
                        </a>
                        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                        id="menu">
                        <li class="nav-item">
                            <a href="{{ route('admin.admin_dashboard') }}" class="mt-3 nav-link align-middle px-0">
                                <i class="fs-4 bi-house"></i> <h5><span class="ms-1 d-none d-sm-inline badge bg-info">Account
                                    Management</span></h5>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('products.index') }}" class="mt-3 nav-link align-middle px-0">
                                <i class="fs-4 bi-house"></i> <h6><span class="ms-1 d-none d-sm-inline">Product
                                    Catalog</span></h6>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="mt-3 nav-link px-0 align-middle">
                                <i class="fs-4 bi-people"></i> <h6><span class="ms-1 d-none d-sm-inline">Report &
                                    Analytics</span></h6>
                            </a>
                        </li>
                    </ul>
                        <hr>
                        <div class="dropdown pb-4">
                            <a href="#"
                                class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                                id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="https://t4.ftcdn.net/jpg/04/75/00/99/360_F_475009987_zwsk4c77x3cTpcI3W1C1LU4pOSyPKaqi.jpg"
                                    alt="hugenerd" width="30" height="30" class="rounded-circle">
                                <span class="d-none d-sm-inline mx-1">admin</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark text-small shadow"
                                aria-labelledby="dropdownUser1">
                                <li><a class="dropdown-item"
                                        href="{{ route('admin.changePassword', Auth::guard('admin')->user()->email) }}">Change
                                        password</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="{{ route('admin.logout') }}">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class=" col-auto col-md-9 col-xl-10 px-sm-10 d-flex flex-column">
                    <div>
                        <nav class="navbar navbar-expand-sm navbar-dark bg-dark my-3">
                            <div class="container-fluid">
                                <a class="navbar-brand" href="{{ route('admin.admin_dashboard') }}">List Of
                                    Salespersons</a>
                                <a href="#" class="navbar-brand">
                                    <button class="btn btn-success" data-bs-target="#addModal"
                                        data-bs-toggle="modal">Create
                                        salesperson account</button>
                                </a>
                                <div class="collapse navbar-collapse" id="mynavbar">
                                    <ul class="navbar-nav me-auto">
                                    </ul>
                                    <form action="{{ route('admin.search') }}" class="d-flex" method="GET">
                                        <input name="search" id="search" class="form-control me-2" type="text"
                                            placeholder="Search" value="{{ $search ?? '' }}" autofocus>
                                        <button class="btn btn-primary" type="submit">Search</button>
                                    </form>
                                </div>
                            </div>
                        </nav>
                    </div>
                    <div id="HTML_element" style="overflow-y: auto">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th style="background-color: rgb(168, 168, 168)" class="text-center">Image</th>
                                    <th style="background-color: rgb(168, 168, 168)" class="text-center">Name</th>
                                    <th style="background-color: rgb(168, 168, 168)" class="text-center">Email</th>
                                    <th style="background-color: rgb(168, 168, 168)" class="text-center">Lock</th>
                                    <th style="background-color: rgb(168, 168, 168)" class="text-center">Activate</th>
                                    <th style="background-color: rgb(168, 168, 168)" class="text-center">Edit</th>
                                </tr>
                            </thead>
                    <tbody>
                        @foreach ($salesmen as $salesman)
                            <tr>
                                <td class="text-center">Placeholder Image</td>
                                <td class="text-center">{{ $salesman->fullName }}</td>
                                <td class="text-center">{{ $salesman->email }}</td>
                                <td class="text-center">
                                    @if ($salesman->isLocked == 0)
                                        <span class="badge bg-success">Unlock</span>
                                    @else
                                        <span class="badge bg-danger">Lock</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($salesman->isActivated == 0)
                                        Inactivate
                                    @else
                                        Activate
                                    @endif
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-primary dropdown-toggle"
                                            data-bs-toggle="dropdown">
                                            ☰
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" data-bs-toggle="modal" href="#"
                                                    data-bs-target="#editModal-{{ $salesman->id }}"
                                                    data-salesman-id="{{ $salesman->id }}"
                                                    data-salesman-name="{{ $salesman->fullName }}"
                                                    data-salesman-email="{{ $salesman->email }}">Edit</a></li>
                                            <li>
                                                <form method="POST"
                                                    action="{{ route('admin.changeLock', ['email' => urlencode($salesman->email)]) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="dropdown-item">
                                                        @if ($salesman->isLocked == 0)
                                                            Lock
                                                        @else
                                                            Unlock
                                                        @endif
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" data-bs-toggle="modal" href="#"
                                                    data-bs-target="#confirm-delete-{{ str_replace(['@', '.'], '_', $salesman->email) }}"
                                                    data-salesman-email="{{ $salesman->email }}"
                                                    data-salesman-id="{{ $salesman->id }}"
                                                    data-salesman-name="{{ $salesman->fullName }}">Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                </table>
            </div>
        </div>

        @foreach ($salesmen as $salesman)
            <!-- Edit Modal -->
            <div class="modal fade" id="editModal-{{ $salesman->id }}" tabindex="-1" role="dialog"
                aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Salesman {{ $salesman->fullName }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

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
                                <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Delete Account Modal -->
            <div class="modal fade" id="confirm-delete-{{ str_replace(['@', '.'], '_', $salesman->email) }}"
                tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header h3">
                            Delete Account
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this account
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cancel</button>
                            <form method="post" action="{{ route('admin.delete', $salesman->email) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach


        <div class="modal fade " id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Add Salesman</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.create') }}" method="POST" id="addForm">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label for="name">Full Name</label>
                                <input type="text" class="form-control" name="fullName" value="">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" value="">
                            </div>
                            <button type="submit" class="btn btn-primary mt-3" id="addSalesman"
                                data-bs-toggle="modal" data-bs-target="#confirmModal">
                                Add Salesman
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmModalLabel">Confirm Add Salesman</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to add this salesman?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary mt-3" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary mt-3" id="confirmAdd">Confirm</button>
                    </div>
                </div>
            </div>
        </div>


        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script>
            document.getElementById('addSalesman').addEventListener('click', function(event) {
                event.preventDefault();
                $('#confirmModal').modal('show');
            });

            document.getElementById('confirmAdd').addEventListener('click', function() {
                document.getElementById('addForm').submit();
            });
        </script>
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
                        dropdownContentB.style.display = (dropdownContentB.style.display === 'block') ? 'none' :
                            'block';

                        // Close other dropdown menus
                        dropdownBs.forEach((otherDropdownB) => {
                            if (otherDropdownB !== dropdownB) {
                                const otherDropdownContentB = otherDropdownB.querySelector(
                                    '.dropdown-contentB');
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
                if (element) {
                    element.style.height = window.innerHeight - 145 + "px";
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                window.addEventListener('resize', setElementHeightToScreenHeight);
                setElementHeightToScreenHeight();
            });
        </script>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- // Search bar autofocus --}}
        <script>
            window.onload = function() {
                const element = document.getElementById("HTML_element");
                element.style.height = window.innerHeight - 130 + "px";
                var input = document.getElementById('search');
                var len = input.value.length;
                input.focus();
                input.setSelectionRange(len, len);
            }
        </script>
    </body>

    <script>
        $(document).ready(function() {
            $('#editModal').modal('show');
        });
    </script>
    </body>

</html>