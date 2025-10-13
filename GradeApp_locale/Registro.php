<html>
	<head>
		<title> Registro Voti </title>
        <style>
        .centrato {
            text-align: center;
            background-color: black;
            color: white;
        }
        </style>

		</head>
		
		<body>
			<h1 class="centrato"> Registro Voti </h1>
			
			<form action="" method="post" >
				<label for="Inserimento_Dati">
				<input type="text" name="nome" placeholder="Nome" value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>" >
				&thinsp;
				&thinsp;
				<input type="text" name="cognome" placeholder="Cognome" value="<?= htmlspecialchars($_POST['cognome'] ?? '') ?>">
				&thinsp;
				&thinsp;
				<input type="text" name="classe" placeholder="Classe" value="<?= htmlspecialchars($_POST['classe'] ?? '') ?>">
				&thinsp;
				&thinsp;
				<input type="text" name="materia" placeholder="Materia" value="<?= htmlspecialchars($_POST['materia'] ?? '') ?>">
				<br> <br>
				<input type="submit" name="dati" value="Cerca">
				</label>
				</form>
				<hr>
				<?php
                    function VotiStudente ($studente_nome, $studente_cognome, $Elenco) {
                        $count = 0;
                        $SommaVoti = 0;
                        
                        foreach ($Elenco as $Voti) {
                            $campi = explode(",", $Voti);
                            if (strtolower($studente_cognome) == strtolower($campi[0]) && strtolower($studente_nome) == strtolower($campi[1])) {
                                $count++;
                                $SommaVoti += $campi[5];
                                
                            }
                        }
                        return $SommaVoti/$count;
                        
                    }
                    function VotiStudenteMateria ($studente_nome, $studente_cognome, $materia, $Elenco) {
                        $count = 0;
                        $SommaVoti = 0;
                        
                        foreach ($Elenco as $Voti) {
                            $campi = explode(",", $Voti);
                            if (strtolower($studente_cognome) == strtolower($campi[0]) && strtolower($studente_nome) == strtolower($campi[1]) && strtolower($materia) == strtolower($campi[3])) {
                                $count++;
                                $SommaVoti += $campi[5];
                            }
                        }
                        return $SommaVoti/$count;
                    }
                    function VotiClasseMateria ($classe, $materia, $Elenco) {
                        $count = 0;
                        $SommaVoti = 0;
                        
                        foreach ($Elenco as $Voti) {
                            $campi = explode(",", $Voti);
                            if (strtolower($classe) == strtolower($campi[2]) && strtolower($materia) == strtolower($campi[3])) {
                                $count++;
                                $SommaVoti += $campi[5];
                            }
                        }
                        return $SommaVoti/$count;
                    }
                    function VotiClasse ($classe, $Elenco) {
                        $count = 0;
                        $SommaVoti = 0;
                        
                        foreach ($Elenco as $Voti) {
                            $campi = explode(",", $Voti);
                            if (strtolower($classe) == strtolower($campi[2])) {
                                $count++;
                                $SommaVoti += $campi[5];
                            }
                        }
                        return $SommaVoti/$count;
                    }

					$Voti = 'src/random-grades.csv';
					$Elenco = file($Voti);

                    $nome = $_POST["nome"];
                    $cognome = $_POST["cognome"];
                    $materia = $_POST["materia"];
                    $classe = $_POST["classe"];

                    if ($nome != "" && $cognome != "" && $materia != "") {
                        $media = VotiStudenteMateria($nome, $cognome, $materia, $Elenco);
                        echo "<br>La media è $media";
                    }
                    elseif ($nome != "" && $cognome != "" && $materia == "") {
                        $media = VotiStudente($nome, $cognome, $Elenco);
                        echo "<br>La media è $media";
                    }
                    elseif ($classe != "" && $materia != "") {
                        $media = VotiClasseMateria($classe, $materia, $Elenco);
                        echo "<br>La media è $media";
                    }
                    elseif ($classe != "" && $materia == "") {
                        $media = VotiClasse($classe, $Elenco);
                        echo "<br>La media è $media";
                    }
                    else {
                        echo "<br>Non abbastanza dati inseriti";
                    }
                    
                    
					?>
			</body>
</html>
    
