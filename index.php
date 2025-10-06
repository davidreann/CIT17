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
echo "<div class='task'><h2>1. Introduce Yourself</h2>";
$name = "Raf";
$age = 21;
$fav_color = "Blue";
echo "Hi, I’m $name, I am $age years old, and my favorite color is $fav_color.";
echo "</div>";

echo "<div class='task'><h2>2. Simple Math</h2>";
$a = 10;
$b = 5;
echo "Sum: " . ($a + $b) . "<br>";
echo "Difference: " . ($a - $b) . "<br>";
echo "Product: " . ($a * $b) . "<br>";
echo "Quotient: " . ($a / $b);
echo "</div>";

echo "<div class='task'><h2>3. Area and Perimeter of a Rectangle</h2>";
$length = 8;
$width = 5;
$area = $length * $width;
$perimeter = 2 * ($length + $width);
echo "Area: $area <br> Perimeter: $perimeter";
echo "</div>";

echo "<div class='task'><h2>4. Temperature Converter</h2>";
$celsius = 25;
$fahrenheit = ($celsius * 9/5) + 32;
echo "$celsius °C = $fahrenheit °F";
echo "</div>";

echo "<div class='task'><h2>5. Swapping Variables</h2>";
$x = 10;
$y = 20;
$temp = $x;
$x = $y;
$y = $temp;
echo "After swapping: x = $x, y = $y";
echo "</div>";

echo "<div class='task'><h2>6. Salary Calculator</h2>";
$basic_salary = 15000;
$allowance = 5000;
$deduction = 2000;
$net_salary = $basic_salary + $allowance - $deduction;
echo "Net Salary: ₱$net_salary";
echo "</div>";

echo "<div class='task'><h2>7. BMI Calculator</h2>";
$weight = 60;
$height = 1.65;
$bmi = $weight / ($height * $height);
echo "Your BMI is " . round($bmi, 2);
echo "</div>";

echo "<div class='task'><h2>8. String Manipulation</h2>";
$sentence = "Learning PHP is fun and easy!";
echo "Sentence: $sentence<br>";
echo "Characters: " . strlen($sentence) . "<br>";
echo "Words: " . str_word_count($sentence) . "<br>";
echo "Uppercase: " . strtoupper($sentence) . "<br>";
echo "Lowercase: " . strtolower($sentence);
echo "</div>";

echo "<div class='task'><h2>9. Bank Account Simulation</h2>";
$balance = 1000;
$deposit = 500;
$withdraw = 300;
$balance = $balance + $deposit - $withdraw;
echo "Current Balance: ₱$balance";
echo "</div>";

echo "<div class='task'><h2>10. Simple Grading System</h2>";
$math = 85;
$english = 90;
$science = 88;
$average = ($math + $english + $science) / 3;
if ($average >= 90) $grade = "A";
elseif ($average >= 80) $grade = "B";
elseif ($average >= 70) $grade = "C";
else $grade = "F";
echo "Average: " . round($average, 2) . "<br>Grade: $grade";
echo "</div>";

echo "<div class='task'><h2>11. Currency Converter</h2>";
$php = 1000;
$usd_rate = 58.5;
$eur_rate = 63.2;
$jpy_rate = 0.39;
echo "₱$php = $" . round($php / $usd_rate, 2) . " USD<br>";
echo "₱$php = €" . round($php / $eur_rate, 2) . " EUR<br>";
echo "₱$php = ¥" . round($php / $jpy_rate, 2) . " JPY";
echo "</div>";

echo "<div class='task'><h2>12. Travel Cost Estimator</h2>";
$distance = 150;
$fuel_consumption = 12;
$fuel_price = 70;
$liters_needed = $distance / $fuel_consumption;
$cost = $liters_needed * $fuel_price;
echo "Estimated Travel Cost: ₱" . round($cost, 2);
echo "</div>";
?>

</body>
</html>
