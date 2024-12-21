<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include '../config/database.php'; // Include your database connection file

// Handle the form submission
if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Raw password
    $confirm_password = $_POST['confirm_password']; // Confirm password field
    $role = 'staff'; // Set role as 'staff' by default

    // Password and Confirm Password check
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match.');</script>";
    } else {
        // Encrypt the password before storing
        $password = md5($password); // Use password_hash() for better security, this is for demo purposes

        // Check if the email already exists in the database
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        // Fetch the user details
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // If the email already exists
            echo "<script>alert('Email already exists.');</script>";
        } else {
            // Insert the new user into the database
            $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)");
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->bindParam(':role', $role, PDO::PARAM_STR);
            
            // Execute the query and check if the user is successfully inserted
            if ($stmt->execute()) {
                $_SESSION['user_id'] = $conn->lastInsertId();
                $_SESSION['user_name'] = $name;
                $_SESSION['role'] = $role; // Store the default 'staff' role in the session
                header("Location: /path/to/login.php"); // Redirect to login page after successful registration
                exit();
            } else {
                echo "<script>alert('Registration failed. Please try again later.');</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Register for Lab Automation System">
    <meta name="keywords" content="lab automation, register, user registration">
    <meta name="author" content="Lab Automation Team">
    <title>Register - Lab Automation</title>
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

    <!-- Register Form -->
    <div class="bg-white p-8 rounded-lg shadow-2xl w-full max-w-sm border border-gray-300 backdrop-blur-sm">
        <h2 class="text-3xl font-extrabold mb-6 text-center text-gray-800">Register</h2>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                <input type="text" name="name" id="name" required
                    class="mt-2 px-4 py-2 w-full border border-gray-300 rounded-lg bg-gray-50 text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300">
            </div>
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
            <div class="mb-6">
                <label for="confirm_password" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" required
                    class="mt-2 px-4 py-2 w-full border border-gray-300 rounded-lg bg-gray-50 text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300">
            </div>
            <button type="submit" name="register"
                class="w-full bg-gradient-to-r from-purple-500 to-blue-500 hover:from-purple-600 hover:to-blue-600 text-white font-semibold py-3 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                Register
            </button>
        </form>
        <p class="mt-4 text-center text-sm text-gray-600">
            Already have an account? <a href="login.php" class="text-blue-500 hover:text-blue-700">Login here</a>
        </p>
    </div>

    <script>
        particlesJS.load('particles-js', 'particles.json', function () {
            console.log('Particles.js config loaded');
        });
    </script>
</body>
</html>
