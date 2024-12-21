<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include '../config/database.php'; // Include your database connection file

// Check if form is submitted
if(isset($_SESSION['user_id'])){
    header('Location: ../index.php');

}

if (isset($_POST['login'])) {
   
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = md5($_POST['password']);
 
//     // Sanitize input to prevent SQL Injection
    

    // Check if user exists in the database
 // Use PDO to prepare and execute the query
$stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
$stmt->bindParam(':email', $email, PDO::PARAM_STR);
$stmt->execute();

// Fetch the user details
$user = $stmt->fetch(PDO::FETCH_ASSOC);


    // Check password and start session if user is authenticated
    if ($user && $password == $user['password']) {
        // User authenticated successfully
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['role'] = $user['role'];

            header("Location: ../pages/dashboard.php"); // Redirect to admin dashboard
        exit();
    } else {
        echo "<script>alert('Invalid email or password');</script>";
    }
}
// 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login to Lab Automation System">
    <meta name="keywords" content="lab automation, login, authentication">
    <meta name="author" content="Lab Automation Team">
    <title>Login - Lab Automation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/particles.js"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        #particles-js {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: -1;
        }
    </style>
</head>
<body class="bg-gradient-to-r from-blue-500 via-purple-600 to-blue-700 text-white flex items-center justify-center h-screen relative">
    <div id="particles-js"></div>

    <!-- Login Form -->
    <div class="bg-white p-8 rounded-lg shadow-2xl w-full max-w-sm border border-gray-300 backdrop-blur-sm">
        <h2 class="text-3xl font-extrabold mb-6 text-center text-gray-800">Login</h2>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" required
                    class="mt-2 px-4 py-2 w-full border border-gray-300 rounded-lg bg-gray-50 text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300">
            </div>
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" required
                    class="mt-2 px-4 py-2 w-full border border-gray-300 rounded-lg bg-gray-50 text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300">
            </div>
            <button type="submit" name="login"
                class="w-full bg-gradient-to-r from-purple-500 to-blue-500 hover:from-purple-600 hover:to-blue-600 text-white font-semibold py-3 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                Login
            </button>
        </form>
        <p class="mt-4 text-center text-sm text-gray-600">
            Don't have an acount? <a href="register.php" class="text-blue-500 hover:text-blue-700">Register here</a>
        </p>
    </div>

    <script>
        particlesJS.load('particles-js', 'particles.json', function () {
            console.log('Particles.js config loaded');
        });
    </script>
</body>
</html>
