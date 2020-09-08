<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ListApp</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
</head>
<body>
      <nav class="navbar navbar-dark navbar-expand-sm bg-dark">

        <!-- Links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" href="">Tekstitiedostot</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../02_xml/01_simple-xml-php/">XML-tiedosto (Simple)</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../02_xml/02_xml-dom-php/">XML-tiedosto (DOM)</a>
          </li>
        </ul>
      
      </nav>


    <div class="container">
        <h1>ListApp</h1>
        <p>Tässä PHP-listasovellus, joka käyttää tietovarastona tekstitiedostoa.</p>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-sm">
          <h2>Lisää tuote</h2>
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
        <div class="col-sm">
          <h2>Tuotelista</h2>
          <ul class="list-group">
            <?php
            // Näytetään tekstitiedoston sisältö

            $my_file = fopen('data/lista.txt','r');
            
            while (!feof($my_file)){
              echo '<li class="list-group-item">';
                echo fgets($my_file);
              echo "</li>";
            }
            ?>
        </ul>
        </div>
    </div>

</body>
</html>