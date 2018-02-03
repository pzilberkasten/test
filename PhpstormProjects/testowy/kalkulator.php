<?php

class calc
{
    protected $num1 = "";
    protected $num2 = "";
    private $result = "";
    private $history = array();

    public function __construct($num1, $num2)
    {
        $this->num1 = $num1;
        $this->num2 = $num2;
    }

    public function add()
    {
        $this->result = $this->num1 + $this->num2;
        //$this->history += "added num1 to num2 got result = $this->result";
        return $this->result;
    }

    public function multiply()
    {
        $this->result = $this->num1 + $this->num2;
        //$this->history += "multiplied num1 with num2 got result = $this->result";
        return $this->result;
    }

    public function subtract()
    {
        $this->result = $this->num1 - $this->num2;
        //$this->history += "subtracted num1 from num2 got result = $this->result";
        return $this->result;
    }

    public function divide()
    {
        if ($this->num2 == 0) {
            return "nie można dzielić przez zero";
        } else {
            //$this->history += "divided num1 by num2 got result = $this->result";
            $this->result = $this->num1 / $this->num2;
            return $this->result;
        }
    }
}

class AdvancedCalculator extends calc
{
    private $pow_result = 1;

    public function pow()
    {
        //$this->pow_result = 1;
        for ($i = 1; $i <= $this->num2; $i++) {
            $this->pow_result = $this->pow_result * $this->num1;
        }
        return $this->pow_result;
    }
    
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $num1 = $_POST['first'];
    $num2 = $_POST['second'];
    $char = $_POST['char'];
    $result = "";


    $calc_object = new AdvancedCalculator($num1, $num2);

    switch ($char) {
        case "+":
            $result = $calc_object->add();
            break;
        case "*":
            $result = $calc_object->multiply();
            break;
        case "-":
            $result = $calc_object->subtract();
            break;
        case "/":
            $result = $calc_object->divide();
            break;
        case "^":
            $result = $calc_object->pow();
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

    </form>
    <div>
        <?php
        if (isset($result)) {
            echo "Wynik: " . $result;
            unset($result);
        }
        ?>
    </div>
</div>
</body>
</html>