<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Change Password</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <style>
        .error-message {
            color: red;
            display: none;
        }
    </style>
</head>

<body style="background-color: rgb(60, 60, 60)">
    <div class="container mt-3">
        <div class="row flex-nowrap">
            <div style="background-color: #2b2b2b; margin-top:15%; width:500px; height:450px"
                class="mx-auto border-none rounded-3">
                <h2 style="color: white" class="text-center mt-3">Reset Password</h2>
                <form class="w-50" action="{{ route('admin.updatePassword', $user->email) }}" method="POST"
                    onsubmit="return checkPasswordMatch();">
                    @method('PUT')
                    @csrf
                    <div class="mb-3 mt-3">
                        <label style="color: white" for="currentPassword" class="form-label">Current Password</label>
                        <div style="width:475px" class="input-group">
                            <input type="password" class="form-control" id="currentPassword" name="currentPassword"
                                placeholder="Enter current password">
                            <button class="btn btn-outline-secondary" type="button" id="toggleCurrentPassword">
                                <i class="bi bi-eye"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                        <path
                                            d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                    </svg></i>
                            </button>
                        </div>
                    </div>
                    <div style="width:475px" class="mb-3 mt-3">
                        <label style="color: white" for="newPassword" class="form-label">New Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="newPassword" name="newPassword"
                                placeholder="Enter new password">
                            <button class="btn btn-outline-secondary" type="button" id="toggleNewPassword">
                                <i class="bi bi-eye">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                        <path
                                            d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                    </svg>
                                </i>
                            </button>
                        </div>
                    </div>
                    <div style="width:475px" class="mb-3 mt-3">
                        <label style="color: white" for="confirmPassword" class="form-label">Confirm Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                                placeholder="Confirm new password">
                            <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                                <i class="bi bi-eye">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                        <path
                                            d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                    </svg>
                                </i>
                            </button>
                        </div>
                    </div>
                    <div style="width:475px" id="newPasswordError" class="error-message text-center mt-3">
                        <span>New password and confirm password are not match.</span>
                    </div>
                    <button style="width:475px" type="submit" class="btn btn-primary mt-3">Change Password</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function togglePasswordVisibility(inputFieldId) {
            const inputField = document.getElementById(inputFieldId);
            if (inputField.type === "password") {
                inputField.type = "text";
            } else {
                inputField.type = "password";
            }
        }

        document.getElementById("toggleCurrentPassword").addEventListener("click", function() {
            togglePasswordVisibility("currentPassword");
        });

        document.getElementById("toggleNewPassword").addEventListener("click", function() {
            togglePasswordVisibility("newPassword");
        });

        document.getElementById("toggleConfirmPassword").addEventListener("click", function() {
            togglePasswordVisibility("confirmPassword");
        });
    </script>

    <script>
        const passwordField = document.getElementById("password");
        const togglePassword = document.querySelector(".password-toggle-icon i");

        togglePassword.addEventListener("click", function() {
            if (passwordField.type === "password") {
                passwordField.type = "text";
                togglePassword.classList.remove("fa-eye");
                togglePassword.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                togglePassword.classList.remove("fa-eye-slash");
                togglePassword.classList.add("fa-eye");
            }
        });

        function checkPasswordMatch() {
            var newPassword = document.getElementById('newPassword').value;
            var confirmPassword = document.getElementById('confirmPassword').value;

            if (newPassword !== confirmPassword) {
                document.getElementById('newPasswordError').style.display = 'block';
                return false;
            } else {
                document.getElementById('newPasswordError').style.display = 'none';
            }

            return true;
        }
    </script>
</body>

</html>