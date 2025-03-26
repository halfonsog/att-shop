<?php
require __DIR__.'/vendor/autoload.php';

// Test 1: Check if file exists
$file = __DIR__.'/app/Http/Controllers/AuthController.php';
echo "File exists: " . (file_exists($file) ? "YES" : "NO");

// Test 2: Check if class is loadable
echo "\nClass exists: ";
echo class_exists('App\Http\Controllers\AuthController') ? "YES" : "NO";