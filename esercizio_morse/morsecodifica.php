<html>
<?php
    function TextToMorse ($text) {
    $morseCode = [
    'a' => '.-',    'b' => '-...',  'c' => '-.-.',
    'd' => '-..',   'e' => '.',     'f' => '..-.',
    'g' => '--.',   'h' => '....',  'i' => '..',
    'j' => '.---',  'k' => '-.-',   'l' => '.-..',
    'm' => '--',    'n' => '-.',    'o' => '---',
    'p' => '.--.',  'q' => '--.-',  'r' => '.-.',
    's' => '...',   't' => '-',     'u' => '..-',
    'v' => '...-',  'w' => '.--',   'x' => '-..-',
    'y' => '-.--',  'z' => '--..',
    '0' => '-----', '1' => '.----', '2' => '..---',
    '3' => '...--', '4' => '....-', '5' => '.....',
    '6' => '-....', '7' => '--...', '8' => '---..',
    '9' => '----.',
    ' ' => '/'
    ];
    $text = strtolower($text);
    $result = [];
    for ($i=0; $i<strlen($text); $i++){
        $char = $text[$i];
        if (isset($morseCode[$char])) {
        $result[] = $morseCode[$char];
        }
    }
    
return implode('  ',$result);
    
}

function morseToText($morse) {
    $morseCode = [
        '.-' => 'a',    '-...' => 'b',  '-.-.' => 'c',
        '-..' => 'd',   '.' => 'e',     '..-.' => 'f',
        '--.' => 'g',   '....' => 'h',  '..' => 'i',
        '.---' => 'j',  '-.-' => 'k',   '.-..' => 'l',
        '--' => 'm',    '-.' => 'n',    '---' => 'o',
        '.--.' => 'p',  '--.-' => 'q',  '.-.' => 'r',
        '...' => 's',   '-' => 't',     '..-' => 'u',
        '...-' => 'v',  '.--' => 'w',   '-..-' => 'x',
        '-.--' => 'y',  '--..' => 'z',
        '-----' => '0', '.----' => '1', '..---' => '2',
        '...--' => '3', '....-' => '4', '.....' => '5',
        '-....' => '6', '--...' => '7', '---..' => '8',
        '----.' => '9',
        '/' => ' '
    ];
    $character = explode(' ', trim($morse));
    $result = '';
    foreach ($character as $charact) {
        if (isset($morseCode[$charact])) {
            $result .= $morseCode[$charact];
        }
    }
    return $result;
}

$morseResult = '';
$textResult = '';

if(isset($_POST['toMorse'])) {
    $morseResult = TextToMorse($_POST['alf']);
    $textResult = $_POST['alf'];
}
elseif(isset($_POST['toText'])) {
    $textResult = MorseToText($_POST['morse']);
    $morseResult = $_POST['morse'];
}



?>
    <head>
        <title> Morse Conversion </title>
        </head>
    
    <body>
    <h1> --- Traduttore Morse --- </h1>
    <h2>
<form action="/esercizio_morse/morsecodifica.php" method="post">
        <label for="testo">
        <textarea name="alf" rows="4" cols="42" placeholder="Ciao, sono il Traduttore..."
style="font-size: 15px;"><?php echo $textResult; ?></textarea>
        </label>
        <br> <br>
    
         <button type="submit" name="toMorse" class="pulsante">
           &#x25BC;
          </button>
        
            <button type="submit" name="toText" class="pulsante">
            &#x25B2;
            </button>
        
        
        <br> <br>
        <label for="morse">
        <textarea name="morse" rows="4" cols="42" placeholder="-.-.  ..  .-  ---  /  ...  ---  -.  ---  /  ..  .-..  /  -  .-.  .-  -..  ..-  -  -  ---  .-.  ." style="font-size: 15px;"><?php echo $morseResult; ?></textarea>
        
        </label>
    </form>
     </h2>
    <style>
        .pulsante {
          font-size: 18px;
          padding: 10px 20px;
          border-radius: 8px;
                   
        }
</style>

    
        
    
    
    
    </html>
