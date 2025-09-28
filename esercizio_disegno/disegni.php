<?php
$num = $_GET["n"];
$forma = $_GET ["scelta"];
if ($forma == "triangolo") {
    for ($i = 0; $i <=$num; $i++) {
        for ($j = 0; $j < $i; $j++) {
            echo "*";
        }
        echo "<br>";
    }
}
elseif ($forma == "quadrato") {
    for($i=0;$i<$num; $i++){
        for($j=0;$j<$num; $j++){
            echo " * ";
        }
        echo "<br>";
    }
}

elseif ($forma == "triangolo_inverso") {
    for ($i = $num; $i > 0; $i--) {
        
        for ($s = 0; $s < $num - $i; $s++) {
            echo "&thinsp;&thinsp;";
        }
        for ($j = 0; $j < $i; $j++) {
            echo "*";
        }
        echo "<br>";
    }
    
}
elseif ($forma == "quadrato_vuoto") {
    for ($i =0; $i<$num; $i++) {
        echo "*&thinsp;";
    }
    echo "<br>";
    for ($i =0; $i < $num-2 ; $i++) {
        echo "*";
        for ($j=0; $j< $num-2; $j++){
            echo "&thinsp;&thinsp;&thinsp;&thinsp;";
        }
        echo "*" . "<br>";
    }
    for ($i =0; $i<$num; $i++) {
        echo "*&thinsp;";
    }
}

?>

<html>
    <br> <br>
    <a href="/esercizio_disegno/homeasterischi.html"> Torna alla Home </a>
</html>


