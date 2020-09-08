<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ListApp</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
</head>
<body>

        <!-- Links -->
      <nav class="navbar navbar-dark navbar-expand-sm bg-dark">

        <!-- Links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="../../01_text_files/">Tekstitiedostot</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../01_simple-xml-php/">XML-tiedosto (Simple)</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="../02_xml-dom-php/">XML-tiedosto (DOM)</a>
          </li>
        </ul>
      
      </nav>

    <div class="container">
        <h1>ListApp</h1>
        <p>Tässä PHP-listasovellus. Tervetuloa!</p>
    </div>

    <div class="container">
        <form method="POST" action="save.php">
            <div class="form-group">
                <label for="tuote">Tuote</label>
                <input type="text" placeholder="anna tuote" name="tuote" id="tuote" class="form-control">
            </div>
            <div class="form-group">
                <label for="maara">Määrä</label>
                <input type="number" placeholder="määrä" name="maara" id="maara" class="form-control">
            </div>
            <button class="btn btn-primary">Lähetä</button>
        </form>
    </div>

    <div class="container">
      <ul class="list-group">
<?php
  
        // Näytetään XML
        $xml = simplexml_load_file('data/list.xml');
        
        foreach($xml->tuote as $tuote){
          echo '<li class="list-group-item">' . $tuote->nimi . '(' . $tuote->määrä . ')' . '</li>';
        }

?>
      </ul>
    </div>



</body>
</html>