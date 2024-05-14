<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Information Details</title>

    <!-- Add missing id attribute to the HTML element -->
    <style>
        .error-message {
            color: red;
            display: none;
        }
    </style>

    <!-- Add missing id attribute to the HTML element -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</head>

<body style="background-color: rgb(60, 60, 60)">
    <div class="container mt-3">
        <div class="row flex-nowrap">
            <div style="background-color: #2b2b2b; margin-top:15%; width:500px; height:350px" class="mx-auto border-none rounded-3">
                <!-- Add a new form for changing password -->
                <h2 style="color: white" class="text-center mt-3">Reset Password</h2>
                <form class="w-50" action="{{ route('sales.updatePassword', ['token' => $token]) }}" method="POST"
                    onsubmit="return checkPasswordMatch();">
                    @csrf
                    @method('PUT')
                    <div class="mb-3 mt-3">
                        <label style="color: white" for="newPassword" class="form-label">New Password</label>
                        <div style="width:475px" class="input-group">
                            <input type="password" class="form-control" name="newPassword" id="newPassword"
                                placeholder="Enter new password" required>
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
                    <div class="mb-3 mt-3">
                        <label style="color: white" for="confirmPassword" class="form-label">Confirm Password</label>
                        <div style="width:475px" class="input-group">
                            <input type="password" class="form-control" name="confirmPassword" id="confirmPassword"
                                placeholder="Confirm new password" required>
                            <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                                <i  class="bi bi-eye">
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
                        <div style="width:475px" id="newPasswordError" class="error-message text-center mt-3">
                            <span>New password and confirm password are not match.</span>
                        </div>
                    </div>
                    <button style="width:475px" type="submit" class="btn btn-primary mt-3">Change Password</button>
                </form>
            </div>
        </div>
    </div>
    </div>
    <script>
        window.onload = function() {
            const togglePassword = function(inputId, toggleId) {
                const passwordInput = document.getElementById(inputId);
                const toggle = document.getElementById(toggleId);
                toggle.addEventListener('click', function(e) {
                    // toggle the type attribute
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    // toggle the eye / eye slash icon
                    this.classList.toggle('bi-eye');
                });
            }

            togglePassword('newPassword', 'toggleNewPassword');
            togglePassword('confirmPassword', 'toggleConfirmPassword');
        }

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
