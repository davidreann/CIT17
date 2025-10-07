<!DOCTYPE html>
<html>
<head>
    <title>PHP Basic Tasks</title>
</head>
<body>

<h1>PHP Basic Exercises</h1>

<?php
echo "<h2>1. Introduce Yourself</h2>";
$name = "Rafa";
$age = 21;
$fav_color = "yellow";
echo "Hi, Im $name, I am $age years old, and my favorite color is $fav_color.";

echo "<h2>2. Simple Math</h2>";
$a = 10;
$b = 5;
echo "Sum: " . ($a + $b) . "<br>";
echo "Difference: " . ($a - $b) . "<br>";
echo "Product: " . ($a * $b) . "<br>";
echo "Quotient: " . ($a / $b);

echo "<h2>3. Area and Perimeter of a Rectangle</h2>";
$length = 8;
$width = 5;
$area = $length * $width;
$perimeter = 2 * ($length + $width);
echo "Length: $length <br> Width: $width <br> <b>Area:</b> $area <br><br> <b>Perimeter:</b> $perimeter";

echo "<h2>4. Temperature Converter</h2>";
$celsius = 25;
$fahrenheit = ($celsius * 9/5) + 32;
echo "<br>$celsius °C  =  $fahrenheit °F";

echo "<h2>5. Swapping Variables</h2>";
$x = 10;
$y = 20;
$temp = $x;
$x = $y;
$y = $temp;
echo "<br>After swapping: x = $x, y = $y";

echo "<h2>6. Salary Calculator</h2>";
$basic_salary = 13000;
$allowance = 5000;
$deduction = 2000;
$net_salary = $basic_salary + $allowance - $deduction;
echo "Basic Salary: $basic_salary <br> Allowance: $allowance <br> Deduction: $deduction <br><br> <b>Net Salary:</b> ₱$net_salary";

echo "<h2>7. BMI Calculator</h2>";
$weight = 60;
$height = 1.65;
$bmi = $weight / ($height * $height);
echo "Weight: $weight <br> Height: $height <br><br> Your BMI is " . round($bmi, 2);

echo "<h2>8. String Manipulation</h2>";
$sentence = "The quick brown fox jumps over the lazy dog.";
echo "Sentence: $sentence<br>";
echo "Characters: " . strlen($sentence) . "<br>";
echo "Words: " . str_word_count($sentence) . "<br>";
echo "Uppercase: " . strtoupper($sentence) . "<br>";
echo "Lowercase: " . strtolower($sentence);

echo "<h2>9. Bank Account Simulation</h2>";
$balance = 1000;
$deposit = 500;
$withdraw = 300;
$balance = $balance + $deposit - $withdraw;
echo "Balance: $balance <br> Deposit: $deposit <br> Withdraw: $withdraw <br><br> <b>Current Balance:</b> ₱$balance";

echo "<h2>10. Simple Grading System</h2>";
$math = 85;
$english = 90;
$science = 88;
$average = ($math + $english + $science) / 3;
if ($average >= 90) $grade = "A";
elseif ($average >= 80) $grade = "B";
elseif ($average >= 70) $grade = "C";
else $grade = "F";
echo "Grades <br> Math = $math <br> Science = $science <br> English = $english <br> Average: " . round($average, 2) . "<br><br><b>Grade:</b> $grade";

echo "<h2>11. Currency Converter</h2>";
$php = 1000;
$usd_rate = 58.5;
$eur_rate = 63.2;
$jpy_rate = 0.39;
echo "₱$php = $" . round($php / $usd_rate, 2) . " USD<br>";
echo "₱$php = €" . round($php / $eur_rate, 2) . " EUR<br>";
echo "₱$php = ¥" . round($php / $jpy_rate, 2) . " JPY";

echo "<h2>12. Travel Cost Estimator</h2>";
$distance = 150;
$fuel_consumption = 12;
$fuel_price = 70;
$liters_needed = $distance / $fuel_consumption;
$cost = $liters_needed * $fuel_price;
echo "Distance: $distance <br> Fuel Consumption: $fuel_consumption <br> Fuel Price: $fuel_price <br> Liters Needed: $liters_needed <br><br> <b>Estimated Travel Cost:</b> ₱" . round($cost, 2);

?>

</body>
</html>
