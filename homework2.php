<?php

header('Content-Type: text/html;charset=utf-8');

echo("<h1>Задание 1</h1><br>");

$a = 5;
$b = -8;

if($a>=0 && $b>=0){
    echo("Разность чисел = ");
    echo(($a-$b<0) ? -($a-$b) : ($a-$b));
}elseif($a<0 && $b<0){
    echo("Произведение чисел = ");
    echo($a*$b);
}elseif(($a>=0 && $b<0)||($a<0 && $b>=0)){
    echo("Сумма чисел = ");
    echo($a+$b);
}

echo("<h1>Задание 3</h1><br>");

function calcSum($firstArg, $secondArg){
    if(is_numeric($firstArg)&&is_numeric($secondArg)){
        return $firstArg+$secondArg;
    }
    return false;
}

function calcDiff($firstArg, $secondArg){
    if(is_numeric($firstArg)&&is_numeric($secondArg)){
        return ($firstArg-$secondArg<0) ? -($firstArg-$secondArg) : $firstArg-$secondArg;
    }
    return false;
}

function calcDiv($firstArg, $secondArg){
    if(is_numeric($firstArg)&&is_numeric($secondArg)){
        if($secondArg<>0){
            return $firstArg/$secondArg;
        }
        
    }
    return false;
}

function calcMult($firstArg, $secondArg){
    if(is_numeric($firstArg)&&is_numeric($secondArg)){
        return $firstArg*$secondArg;
    }
    return false;
}

echo "Сумма чисел {$a} и {$b} = ";
echo calcSum($a, $b);
echo "<br>";

echo "Разность чисел {$a} и {$b} = ";
echo calcDiff($a, $b);
echo "<br>";

echo "Результат деления {$a} на {$b} = ";
echo calcDiv($a, $b);
echo "<br>";

echo "Произведение {$a} и {$b} = ";
echo calcMult($a, $b);
echo "<br>";

echo "<h1>Задание 4</h1><br>";


function getResult(int $param1, int $param2, callable $callback){
    return $callback($param1,$param2);
}

echo "Сумма чисел {$a} и {$b} = ";
echo getResult($a,$b,function($p1,$p2){
    return calcSum($p1, $p2);
});
echo "<br>";

echo("Разность чисел {$a} и {$b} = ");
echo getResult($a,$b,function($p1,$p2){
    return calcDiff($p1, $p2);
});
echo "<br>";

echo("Результат деления {$a} на {$b} = ");
echo getResult($a,$b,function($p1,$p2){
    return calcDiv($p1, $p2);
});
echo "<br>";

echo "Произведение {$a} и {$b} = ";
echo getResult($a,$b,function($p1,$p2){
    return calcMult($p1, $p2);
});

echo "<h1>Задание 5</h1><br>";

echo "<footer>";

echo "Brand (c) ";
echo date('Y');

echo "</footer>";

echo "<h1>Задание 6</h1><br>";

function power($val, int $pow){
    if($pow<=1){
        return $val;
    }
    return $val*power($val, --$pow);
}

$a = 2;
$b = 4;

echo "Степень {$b} числа {$a} = ";
echo power($b, $a);

echo "<h1>Задание 7</h1><br>";

$h = date('G');
$m = date('i');
$fh = function(int $par){
    if($par==1||$par==21){
        return "час";
    }elseif($par>1&&$par<5||$par>21){
        return "часа";
    }else{
        return "часов";
    }
};

$fm = function(int $par){
    if($par>=5&&$par<21){
        return "минут";
    }
    $mod = $par%10;
    if($par==1||$mod==1){
        return "минута";
    }elseif(($par>=2&&$par<=4)||($mod>=2&&$mod<=4)){
        return "минуты";
    }
    return "минут";
};

echo "Текущее время ";
echo "{$h} {$fh($h)} {$m} {$fm($m)}"

?>
