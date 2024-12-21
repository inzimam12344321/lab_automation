<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Lab Automation - Simplify lab management and testing processes with modern solutions.">
    <meta name="keywords" content="lab automation, testing, reports, automation system, lab management">
    <meta name="author" content="Lab Automation Team">
    <title>Lab Automation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        /* Custom Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f3f4f6;
        }
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, #6b46c1, #4f46e5);
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(to bottom, #4c1d95, #4338ca);
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">
    <!-- Navbar -->
    <?php include 'navbar.php'; ?>
    <header class="bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 text-white py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold tracking-tight">
                Welcome to <span class="text-yellow-300">Lab Automation</span>
            </h1>
            <p class="mt-4 text-base sm:text-lg md:text-xl">
                Simplify your lab management and testing workflows with ease.
            </p>
            <div class="mt-6 flex flex-col sm:flex-row justify-center items-center gap-4">
                <a href="auth/register.php" class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 sm:px-6 py-2 sm:py-3 rounded-lg text-sm sm:text-lg font-medium shadow-lg transition">
                    Get Started
                </a>
                <?php if (isset($_SESSION['user_name'])): ?>
                    <a href="pages/reports.php" class="bg-white text-blue-500 hover:text-blue-600 px-4 sm:px-6 py-2 sm:py-3 rounded-lg text-sm sm:text-lg font-medium shadow-lg transition">
                        View Reports
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </header>
    <main class="container mx-auto px-4 py-6">
