<?php
// Start the session
session_start();
?>
<nav class="bg-gradient-to-r from-purple-700 via-indigo-600 to-blue-600 text-white shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="index.php" class="text-3xl font-extrabold tracking-wide hover:text-yellow-400 transition">
                    Lab<span class="text-yellow-300">Automation</span>
                </a>
            </div>
            <!-- Navigation Links -->
            <div class="hidden md:flex space-x-8 font-medium">
                <a href="index.php" class="hover:text-yellow-400 transition">Home</a>
                <a href="pages/dashboard.php" class="hover:text-yellow-400 transition">Dashboard</a>
                <!-- <a href="pages/reports.php" class="hover:text-yellow-400 transition">Reports</a> -->
            </div>
            <!-- User Section -->
            <div class="flex items-center space-x-4">
                <?php if (isset($_SESSION['user_name'])): ?>
                    <span class="bg-white text-purple-600 font-semibold px-3 py-1 rounded-md shadow-sm">
                        Hi, <?php echo htmlspecialchars($_SESSION['user_name']); ?>
                    </span>
                    <a href="auth/logout.php" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg shadow-md transition">
                        Logout
                    </a>
                <?php else: ?>
                    <a href="auth/login.php" class="hover:bg-white hover:text-purple-700 text-white px-4 py-2 rounded-lg border border-white shadow-md transition">
                        Login
                    </a>
                    <a href="auth/register.php" class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded-lg shadow-md transition">
                        Sign Up
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>
