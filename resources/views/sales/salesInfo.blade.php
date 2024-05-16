<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Personal Information</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <style>
        .avatar-container {
            border: 2px dashed #ced4da;
            padding: 0;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
            height: 300px;
            /* Adjust the height as needed */
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .avatar-container:hover {
            background-color: #f8f9fa;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .avatar-container input[type="file"] {
            display: none;
        }

        .avatar-container .overlay {
            position: absolute;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .avatar-container:hover .overlay {
            opacity: 1;
        }
    </style>
</head>

<body onload="setElementHeightToScreenHeight()">
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <a href="{{ route('sales.sales_dashboard') }}"
                        class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span style="margin-left:44px" class="fs-5 d-none d-sm-inline">Point of Sale</span>
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                        id="menu">
                        <li class="nav-item">
                            <a href="{{ route('sales.sales_dashboard') }}" class="mt-3 nav-link align-middle px-0">
                                <i class="fs-4 bi-house"></i>
                                <h5><span class="ms-1 d-none d-sm-inline badge bg-info">Customer
                                        Management</span></h5>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('sales.sales_transaction') }}" class="mt-3 nav-link px-0 align-middle">
                                <i class="fs-4 bi-people"></i>
                                <h6><span class="ms-1 d-none d-sm-inline">Transaction</span></h6>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('sales.report') }}" class="mt-3 nav-link px-0 align-middle">
                                <i class="fs-4 bi-people"></i>
                                <h6><span class="ms-1 d-none d-sm-inline">Report &
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
                            <span class="d-none d-sm-inline mx-1">{{ Auth::guard('salesman')->user()->username }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="{{ route('sales.salesInfo', Auth::guard('salesman')->user()->email) }}">Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('sales.logout') }}">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col py-3">
                <!-- Main content area -->
                <div style="height: 500px" class="border px-3 pt-2">
                    <h3 class="text-center">Personal Information</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <form id="personalInfoForm">
                                <div class="mb-3">
                                    <label for="fullName" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="fullName" name="fullName" required
                                        value="{{ $salesman->fullName }}">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required
                                        value="{{ $salesman->email }}">
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" required
                                        value="{{ $salesman->phone }}">
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" required
                                        value="{{ $salesman->address }}">
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#changePasswordModal">Change Password</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6 d-flex align-items-center">
                            <img src="{{ asset('storage/' . $salesman->profilePicture) }}" alt="Salesman Image"
                                style="width: 300px; height: 300px; object-fit: cover; margin-left:170px" class="rounded-3">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Change Password Modal -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('sales.editPassword', $salesman->email) }}" id="changePasswordForm"
                        method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="newPassword" name="newPassword"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                                required>
                        </div>
                        <div id="passwordAlert" class="text-danger" style="display: none;">Passwords do not match!
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script>
        function setElementHeightToScreenHeight() {
            const element = document.getElementById("HTML_element");
            element.style.height = window.innerHeight - 145 + "px";
        }

        function changeAvatar() {
            document.getElementById('avatarInput').click();
        }

        function previewAvatar(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const container = document.querySelector('.avatar-container');
                container.style.backgroundImage = `url(${reader.result})`;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>

</html>
