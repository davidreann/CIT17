<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Basic Tasks</title>
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
        }
        .box {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            margin: 15px auto;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            width: 65%;

        }
        h1 {
            color: #333;
        }
        .button {
            background-color:rgb(216, 211, 141); /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px 2px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color:rgb(233, 232, 180);
        }
    </style>
</head>
<body>

<h1>PHP Basic Exercises</h1>

<form method="post">
    <button type="submit" name="exercise" value="1" class="button">Exercise 1</button>
    <button type="submit" name="exercise" value="2" class="button">Exercise 2</button>
    <button type="submit" name="exercise" value="3" class="button">Exercise 3</button><br>
    <button type="submit" name="exercise" value="4" class="button">Exercise 4</button>
    <button type="submit" name="exercise" value="5" class="button">Exercise 5</button>
    <button type="submit" name="exercise" value="6" class="button">Exercise 6</button><br>
    <button type="submit" name="exercise" value="7" class="button">Exercise 7</button>
    <button type="submit" name="exercise" value="8" class="button">Exercise 8</button>
    <button type="submit" name="exercise" value="9" class="button">Exercise 9</button><br>
    <button type="submit" name="exercise" value="10" class="button">Exercise 10</button>
    <button type="submit" name="exercise" value="11" class="button">Exercise 11</button>
    <button type="submit" name="exercise" value="12" class="button">Exercise 12</button><br>
</form>

<?php
if (isset($_POST['exercise'])) {
    $exercise = $_POST['exercise'];

    switch ($exercise) {
      case 1:
    echo '<div class="box"><h2>Exercise 1: Introduce Yourself</h2>';

    echo '<form method="post">
            <input type="hidden" name="exercise" value="1">
            <label>Name: <input type="text" name="name" required></label><br><br>
            <label>Age: <input type="number" name="age" required></label><br><br>
            <label>Favorite Color: <input type="text" name="color" required></label><br><br>
            <input type="submit" class="button" value="Submit">
          </form>';

    if (!empty($_POST['name']) && !empty($_POST['age']) && !empty($_POST['color'])) {
        $name = htmlspecialchars($_POST['name']);
        $age = (int) $_POST['age'];
        $fav_color = htmlspecialchars($_POST['color']);

        echo "<br><b>Hi, I'm $name, I am $age years old, and my favorite color is $fav_color.</b>";
    }
    echo '</div>';
    break;

        case 2:
            echo '<div class="box"><h2>Exercise 2: Simple Math</h2>';
            echo '<form method="post">
                    <input type="hidden" name="exercise" value="2">
                    <label>a: <input type="number" name="a" required></label><br><br>
                    <label>b: <input type="number" name="b" required></label><br><br>
                    <input type="submit" class="button" value="Submit">
                </form>';

            if (!empty($_POST['a']) && !empty($_POST['b'])) {
            $a = (int) $_POST['a'];
            $b = (int) $_POST['b'];

            echo "a = $a <br> b = $b <br><br>";
            echo "Sum: " . ($a + $b) . "<br>";
            echo "Difference: " . ($a - $b) . "<br>";
            echo "Product: " . ($a * $b) . "<br>";
            echo "Quotient: " . ($b != 0 ? $a / $b : 'Undefined (division by zero)') . "<br>";
        }
    echo "</div>";
    break;

        case 3:
            echo '<div class="box"><h2>Exercise 3: Area and Perimeter of a Rectangle</h2>';
            $length = 8;
            $width = 5;
            $area = $length * $width;
            $perimeter = 2 * ($length + $width);
            echo "Length: $length <br> Width: $width <br> <b>Area:</b> $area <br><br> <b>Perimeter:</b> $perimeter</div>";
            break;
            
        case 4:
            echo '<div class="box"><h2>Exercise 4: Temperature Converter</h2>';
            $celsius = 25;
            $fahrenheit = ($celsius * 9/5) + 32;
            echo "$celsius °C = $fahrenheit °F</div>";
            break;

        case 5:
            echo '<div class="box"><h2>Exercise 5: Swapping Variables</h2>';
            $x = 10; $y = 20;
            $temp = $x;
            $x = $y;
            $y = $temp;
            echo "After swapping: x = $x, y = $y</div>";
            break;

        case 6:
            echo '<div class="box"><h2>Exercise 6: Salary Calculator</h2>';
            $basic_salary = 13000;
            $allowance = 5000;
            $deduction = 2000;
            $net_salary = $basic_salary + $allowance - $deduction;
            echo "Basic Salary: $basic_salary <br> Allowance: $allowance <br> Deduction: $deduction <br><br> <b>Net Salary:</b> ₱$net_salary</div>";
            break;

        case 7:
            echo '<div class="box"><h2>Exercise 7: BMI Calculator</h2>';
            $weight = 60;
            $height = 1.65;
            $bmi = $weight / ($height * $height);
            echo "Weight: $weight <br> Height: $height <br><br> Your BMI is " . round($bmi, 2) . "</div>";
            break;

        case 8:
            echo '<div class="box"><h2>Exercise 8: String Manipulation</h2>';
            $sentence = "The quick brown fox jumps over the lazy dog.";
            echo "Sentence: $sentence<br>";
            echo "Characters: " . strlen($sentence) . "<br>";
            echo "Words: " . str_word_count($sentence) . "<br>";
            echo "Uppercase: " . strtoupper($sentence) . "<br>";
            echo "Lowercase: " . strtolower($sentence) . "</div>";
            break;

        case 9:
            echo '<div class="box"><h2>Exercise 9: Bank Account Simulation</h2>';
            $balance = 1000;
            $deposit = 500;
            $withdraw = 300;
            $balance = $balance + $deposit - $withdraw;
            echo "Balance: $balance <br> Deposit: $deposit <br> Withdraw: $withdraw <br><br> <b>Current Balance:</b> ₱$balance</div>";
            break;

        case 10:
            echo '<div class="box"><h2>Exercise 10: Simple Grading System</h2>';
            $math = 85;
            $english = 90;
            $science = 88;
            $average = ($math + $english + $science) / 3;
            if ($average >= 90) $grade = "A";
            elseif ($average >= 80) $grade = "B";
            elseif ($average >= 70) $grade = "C";
            else $grade = "F";
            echo "Grades <br> Math = $math <br> Science = $science <br> English = $english <br> Average: " . round($average, 2) . "<br><br><b>Grade:</b> $grade</div>";
            break;

        case 11:
            echo '<div class="box"><h2>Exercise 11: Currency Converter</h2>';
            $php = 1000;
            $usd_rate = 58.5;
            $eur_rate = 63.2;
            $jpy_rate = 0.39;
            echo "₱$php = $" . round($php / $usd_rate, 2) . " USD<br>";
            echo "₱$php = €" . round($php / $eur_rate, 2) . " EUR<br>";
            echo "₱$php = ¥" . round($php / $jpy_rate, 2) . " JPY</div>";
            break;
            
        case 12:
            echo '<div class="box"><h2>Exercise 12: Travel Cost Estimator</h2>';
            $distance = 150;
            $fuel_consumption = 12;
            $fuel_price = 70;
            $liters_needed = $distance / $fuel_consumption;
            $cost = $liters_needed * $fuel_price;
            echo "Total Cost: $cost";
            break;
        }
    }
?>


