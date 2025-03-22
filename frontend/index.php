<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/materia/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body {
            background-color: #f4f5f7;
        }
    </style>
</head>
<body>
    <section class="text-center">
        <div class="p-5 bg-image" style="
              background-image: url('https://mdbootstrap.com/img/new/textures/full/171.jpg');
              height: 300px;"></div>

        <div class="card mx-4 mx-md-5 shadow-5-strong bg-body-tertiary" style="
              margin-top: -100px;
              backdrop-filter: blur(30px);">
            <div class="card-body py-5 px-md-5">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6">
                        <h2 class="fw-bold mb-5">CALAPE</h2>
                        <form id="loginForm">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                                    <input type="email" id="email" class="form-control" placeholder="Enter your email" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                    <input type="password" id="password" class="form-control" placeholder="Enter your password" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>

                        <p class="text-center text-muted mt-3">
                            Don't have an account? <a href="signup.php" class="text-decoration-none">Sign up</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const loginForm = document.getElementById("loginForm");

            loginForm.addEventListener("submit", function (event) {
                event.preventDefault();
                const email = document.getElementById("email").value;
                const password = document.getElementById("password").value;

                fetch("http://127.0.0.1:8000/api/login", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ email, password })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.token) {
                        localStorage.setItem("token", data.token);
                        window.location.href = "dashboard.html";
                    } else {
                        alert("Invalid email or password.");
                    }
                })
                .catch(error => console.error("Login error:", error));
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
