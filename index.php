<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab Automation</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <?php include 'includes/header.php'; ?>


    <!-- About Us Section -->
    <section class="py-16 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl font-extrabold text-gray-800">About Us</h2>
            <p class="mt-4 text-lg text-gray-600">
                Lab Automation is a cutting-edge platform designed to streamline laboratory management and testing workflows. 
                With our solution, labs can automate processes, generate accurate reports, and focus on delivering high-quality results.
            </p>
        </div>
    </section>

    <!-- What We Do Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-extrabold text-gray-800 text-center">What We Do</h2>
            <div class="mt-10 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-gray-50 shadow-lg rounded-lg p-6 text-center">
                    <div class="text-blue-600 text-5xl mb-4">⚙️</div>
                    <h3 class="text-2xl font-bold text-gray-800">Automated Testing</h3>
                    <p class="mt-4 text-gray-600">Simplify testing workflows with automation tools that ensure precision and efficiency.</p>
                </div>
                <div class="bg-gray-50 shadow-lg rounded-lg p-6 text-center">
                    <div class="text-green-600 text-5xl mb-4">📊</div>
                    <h3 class="text-2xl font-bold text-gray-800">Detailed Reporting</h3>
                    <p class="mt-4 text-gray-600">Generate comprehensive reports with just a few clicks, saving time and effort.</p>
                </div>
                <div class="bg-gray-50 shadow-lg rounded-lg p-6 text-center">
                    <div class="text-purple-600 text-5xl mb-4">🔒</div>
                    <h3 class="text-2xl font-bold text-gray-800">Secure Management</h3>
                    <p class="mt-4 text-gray-600">Keep all your data safe and organized with our state-of-the-art security measures.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Key Features Section -->
    <section class="py-16 bg-gray-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl font-extrabold">Why Choose Lab Automation?</h2>
            <div class="mt-10 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="flex flex-col items-center">
                    <div class="bg-yellow-500 rounded-full h-16 w-16 flex items-center justify-center text-2xl font-bold">⏱️</div>
                    <h3 class="mt-4 text-xl font-semibold">Time-Saving</h3>
                    <p class="mt-2 text-gray-300">Automate repetitive tasks and focus on important research.</p>
                </div>
                <div class="flex flex-col items-center">
                    <div class="bg-blue-500 rounded-full h-16 w-16 flex items-center justify-center text-2xl font-bold">📈</div>
                    <h3 class="mt-4 text-xl font-semibold">Data Accuracy</h3>
                    <p class="mt-2 text-gray-300">Reduce human errors and maintain high data quality.</p>
                </div>
                <div class="flex flex-col items-center">
                    <div class="bg-green-500 rounded-full h-16 w-16 flex items-center justify-center text-2xl font-bold">🛠️</div>
                    <h3 class="mt-4 text-xl font-semibold">Customizable</h3>
                    <p class="mt-2 text-gray-300">Tailor our tools to fit your lab’s unique needs.</p>
                </div>
                <div class="flex flex-col items-center">
                    <div class="bg-red-500 rounded-full h-16 w-16 flex items-center justify-center text-2xl font-bold">💼</div>
                    <h3 class="mt-4 text-xl font-semibold">Easy Integration</h3>
                    <p class="mt-2 text-gray-300">Integrate seamlessly into your existing systems.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>
</body>
</html>
