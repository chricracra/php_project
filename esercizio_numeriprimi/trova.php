<html>
    <h3> I numeri primi: </h3>
    <?php
    function isNumeroPrimo($num) {
       for ($i=2; $i<$num; $i++){
           if ($num%$i == 0){
               return false;
           }
       }
        return true;
    }

    $n1 = $_POST["n1"];
    $n2 = $_POST["n2"];
    for ($i = $n1; $i<=$n2; $i++) {
        if (isNumeroPrimo($i)){
            echo "$i" . "<br>";
        }
        
    }

    ?>


    <br>
    <a href="/esercizio_numeriprimi/home_numeri.html"> Torna alla Home </a>
</html>
