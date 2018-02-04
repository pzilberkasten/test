<?php

class calc
{
    private $history = array();

    public function __construct()
    {
        $this->history = array();
    }

    public function add($num1, $num2)
    {
        $result = $num1 + $num2;
        $this->history[] = "added num1 to num2 got result = $result";

        return $result;
    }

    public function multiply($num1, $num2)
    {
        $result = $num1 * $num2;
        $history[] = "multiplied num1 with num2 got result = $result";

        return $result;
    }

    public function subtract($num1, $num2)
    {
        $result = $num1 - $num2;
        $history[] = "subtracted num1 from num2 got result =$result";

        return $result;
    }

    public function divide($num1, $num2)
    {
        if ($num2 == 0) {

            return "nie można dzielić przez zero";
        } else {
            $result = $num1 / $num2;
            $history[] = "divided num1 by num2 got result = $result";
        }

        return $result;
    }


    public function printOperations()
    {
        foreach ($this->history as $history) {
            echo $history . "<br>";
        }
    }

    public function clearOperations()
    {
        foreach ($this->history as $history) {
            $history[] = "";
        }
    }
}

class AdvancedCalculator extends calc
{
    private $pow_result = 1;

    static public $pi = 3.14;

    public function pow($num1, $num2)
    {
        for ($i = 1; $i <= $num2; $i++) {
            $this->pow_result = $this->pow_result * $num1;
        }
        return $this->pow_result;
    }

}

var_dump(AdvancedCalculator::$pi);

$calc_object = new AdvancedCalculator();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $num1 = $_POST['first'];
    $num2 = $_POST['second'];
    $char = $_POST['char'];
    $result = "";


    switch ($char) {
        case "+":
            $result = $calc_object->add($num1, $num2);
            break;
        case "*":
            $result = $calc_object->multiply($num1, $num2);
            break;
        case "-":
            $result = $calc_object->subtract($num1, $num2);
            break;
        case "/":
            $result = $calc_object->divide($num1, $num2);
            break;
        case "^":
            $result = $calc_object->pow($num1, $num2);
            break;
    }
}

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <title>Kalkurator obiektowy</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="container">
    Kalkulator prosty<br><br><br>
    <form method="post">
        <input type="number" name="first" id="first">
        <select name="char">
            <option value="+">+</option>
            <option value="-">-</option>
            <option value="*">*</option>
            <option value="/">/</option>
            <option value="^">^</option>
        </select>
        <input type="number" name="second" id="second"><br><br>
        <input type="submit" value="oblicz"><br><br>
        <input type="submit" value="pokaz" name="print" id="print">
        <input type="submit" value="wyczysc" name="clear" id="clear"><br><br>

    </form>
    <div>
        <?php
        if (isset($result)) {
            echo "Wynik: " . $result;
            unset($result);
        }
        ?>
    </div>
    <div class="history">
        <!--//TODO Jak wywołać tu te funkcje do historii???-->
        <?php
        //if(isset($_POST['print'])) {
        $calc_object->printOperations();
        // }
        ?>
    </div>
</div>
</body>
</html>