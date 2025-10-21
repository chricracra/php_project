<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="utf-8">
  <title>Registro Voti</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>
    .centrato {
      text-align: center;
      background: #000;
      color: #fff;
      padding: 1rem 0;
    }
  </style>
</head>
<body>

  <div class="centrato">
    <h1>Registro Voti</h1>
  </div>

  <div class="container mt-4">
    <form method="post" class="row">
      <div class="col">
        <input type="text" name="nome" class="form-control" placeholder="Nome"
               value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>">
      </div>
      <div class="col">
        <input type="text" name="cognome" class="form-control" placeholder="Cognome"
               value="<?= htmlspecialchars($_POST['cognome'] ?? '') ?>">
      </div>
      <div class="col">
        <input type="text" name="classe" class="form-control" placeholder="Classe"
               value="<?= htmlspecialchars($_POST['classe'] ?? '') ?>">
      </div>
      <div class="col-auto">
        <button type="submit" class="btn btn-primary">Cerca</button>
      </div>
    </form>
    <br><br>
    <hr>
    <br><br>
    </div>
    
    <?php
        function VotiStudenteMateria ($studente_nome, $studente_cognome, $classe, $Elenco) {
                        $medie = [];
                        $materie = [];
                        foreach ($Elenco as $Voti) {
                            $campi = explode(",", $Voti);
                            if (strtolower(trim($campi[0])) == strtolower(trim($studente_cognome)) &&
                                strtolower(trim($campi[1])) == strtolower(trim($studente_nome)) &&
                                strtolower(trim($campi[2])) == strtolower(trim($classe))) {
                                $materia = trim($campi[3]);
                                $voto = (float)$campi[5];
                                if (!isset($materie[$materia])) {
                                    $materie[$materia] = ['somma' => 0, 'count' => 0];
                                }
                                $materie[$materia]['somma'] += $voto;
                                $materie[$materia]['count']++;
                            }
                        }
                        $somma_totale = 0;
                        $count_totale = 0;
                            
                        foreach ($materie as $m => $dati) {
                            $medie[$m] = $dati['somma'] / $dati['count'];
                            $somma_totale += $dati['somma'];
                            $count_totale += $dati['count'];
                        }
                        if ($count_totale > 0) {
                            $media_generale = $somma_totale / $count_totale;
                        }
                        else {
                            $media_generale = 0;
                        }
                        return ['media_generale' => $media_generale, 'medie_materie' => $medie];
                        
                    }
                    function TabelloneClasse($classe, $Elenco) {
                        $materie = [];
                        $studenti = [];
                        $tabellone = [];
                        $matrice = [];

                        foreach ($Elenco as $Voto) {
                            $campi = explode(",", $Voto);
                            if (strtolower(trim($campi[2])) == strtolower(trim($classe))) {
                                $cognome = trim($campi[0]);
                                $nome = trim($campi[1]);
                                $studente = "$cognome $nome";
                                $materia = trim($campi[3]);
                                $voto = (float)$campi[5];

                                if (!isset($materie[$materia])) {
                                    $materie[$materia] = true;
                                }
                                if (!isset($studenti[$studente])) {
                                    $studenti[$studente] = true;
                                }
                                if (!isset($tabellone[$studente][$materia])) {
                                    $tabellone[$studente][$materia] = [];
                                }
                                $tabellone[$studente][$materia][] = $voto;
                            }
                        }
                        $materie = array_keys($materie);
                        sort($materie);
                        $studenti = array_keys($studenti);
                        sort($studenti);
                        foreach ($studenti as $studente) {
                                $riga = ['studente' => $studente];
                                foreach ($materie as $mat) {
                                    if (isset($tabellone[$studente][$mat])) {
                                        $media = array_sum($tabellone[$studente][$mat]) / count($tabellone[$studente][$mat]);
                                        $riga[$mat] = round($media, 2);
                                    }
                                    else {
                                        $riga[$mat] = null;
                                    }
                                }
                                $matrice[] = $riga;
                            }
                        return ['materie' => $materie,'studenti' => $studenti,'dati' => $matrice];
                        
                    }
					$Voti = 'src/random-grades.csv';
					$Elenco = file($Voti);

                    $nome    = trim($_POST['nome']    ?? '');
                    $cognome = trim($_POST['cognome'] ?? '');
                    $classe  = trim($_POST['classe']  ?? '');

                    if ($nome !== '' && $cognome !== '' && $classe !== '') {
                        $ris = VotiStudenteMateria($nome, $cognome, $classe, $Elenco);
                        $media_gen = round($ris['media_generale'], 2);
                        $medie= $ris['medie_materie'];
                        
                        echo "<div class='container'>";
                            echo "<h4>Statistiche per $cognome $nome (Classe $classe)</h4>";
                            echo "<table class='table table-bordered table-striped'>";
                            echo "<thead class='table-dark'>
                                    <tr>
                                      <th>Materia</th>
                                      <th>Media</th>
                                    </tr>
                                  </thead><tbody>";
                            echo "<tr class='table-secondary'>
                                    <td><strong>Media generale</strong></td>
                                    <td><strong>$media_gen</strong></td>
                                  </tr>";
                            foreach ($medie as $mat => $val) {
                                $val = round($val, 2);
                                echo "<tr><td>$mat</td><td>$val</td></tr>";
                            }
                            echo "</tbody></table></div>";
                            exit;
                    }
                    elseif ($classe !== '' && $nome === '' && $cognome === '') {
                        $tab = TabelloneClasse($classe, $Elenco);

                            echo "<div class='container'>";
                            echo "<h4 class='text-center mb-3'>Tabellone Classe $classe</h4>";
                            echo "<table class='table table-bordered table-hover'>";
                            echo "<thead class='table-dark'><tr><th>Studente</th>";
                            foreach ($tab['materie'] as $mat) {
                                echo "<th>$mat</th>";
                            }
                            echo "</tr></thead><tbody>";
                            foreach ($tab['dati'] as $r) {
                                echo "<tr><td><strong>{$r['studente']}</strong></td>";
                                foreach ($tab['materie'] as $mat) {
                                    $v = $r[$mat] !== null ? round($r[$mat], 2) : '-';
                                    echo "<td>$v</td>";
                                }
                                echo "</tr>";
                            }
                            echo "</tbody></table></div>";
                            exit;
                    }
                    else {
                        echo "<div class='container mt-4'>
                                <div class='alert alert-warning'>
                                  Inserisci <strong>Nome + Cognome + Classe</strong> per vedere i voti di uno studente,
                                  oppure <strong>solo Classe</strong> per il tabellone completo.
                                </div>
                              </div>";
                    }

					?>
            
    </body>
</html>
    
