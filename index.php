<!DOCTYPE html>
<html>
<head>
    <title>PHP Basic Tasks</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background: #f5f5f5;
        }
        h2 {
            color: #2c3e50;
        }
        .task {
            background: #fff;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        code {
            color: #27ae60;
            font-weight: bold;
        }
    </style>
</head>
<body>

<h1>PHP Basic Exercises</h1>

<?php
// 1. Introduce Yourself
echo "<div class='task'><h2>1. Introduce Yourself</h2>";
$name = "Raf";
$age = 21;
$fav_color = "Blue";
echo "Hi, I’m $name, I am $age years old, and my favorite color is $fav_color.";
echo "</div>";

// 2. Simple Math
echo "<div class='task'><h2>2. Simple Math</h2>";
$a = 10;
$b = 5;
echo "Sum: " . ($a + $b) . "<br>";
echo "Difference: " . ($a - $b) . "<br>";
echo "Product: " . ($a * $b) . "<br>";
echo "Quotient: " . ($a / $b);
echo "</div>";

// 3. Area and Perimeter of a Rectangle
echo "<div class='task'><h2>3. Area and Perimeter of a Rectangle</h2>";
$length = 8;
$width = 5;
$area = $length * $width;
$perimeter = 2 * ($length + $width);
echo "Area: $area <br> Perimeter: $perimeter";
echo "</div>";

// 4. Temperature Converter
echo "<div class='task'><h2>4. Temperature Converter</h2>";
$celsius = 25;
$fahrenheit = ($celsius * 9/5) + 32;
echo "$celsius °C = $fahrenheit °F";
echo "</div>";

// 5. Swapping Variables
echo "<div class='task'><h2>5. Swapping Variables</h2>";
$x = 10;
$y = 20;
$temp = $x;
$x = $y;
$y = $temp;
echo "After swapping: x = $x, y = $y";
echo "</div>";

// 6. Salary Calculator
echo "<div class='task'><h2>6. Salary Calculator</h2>";
$basic_salary = 15000;
$allowance = 5000;
$deduction = 2000;
$net_salary = $basic_salary + $allowance - $deduction;
echo "Net Salary: ₱$net_salary";
echo "</div>";

// 7. BMI Calculator
echo "<div class='task'><h2>7. BMI Calculator</h2>";
$weight = 60; // kg
$height = 1.65; // meters
$bmi = $weight / ($height * $height);
echo "Your BMI is " . round($bmi, 2);
echo "</div>";

// 8. String Manipulation
echo "<d
