<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container" >
            <div class="row" >
                <h3 align="center">Simple Tea</h3>
            </div>
            <div class="row" >
              <p>
                    <a href="create.php" class="btn btn-success">Dodaj svoj čaj</a>
                </p>
                
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Naziv čaja</th>
                      <th>Opis</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include 'baza.php';
                   $pdo = Baza::connect();
                   $sql = 'SELECT * FROM caj ORDER BY id DESC';
                   foreach ($pdo->query($sql) as $row) {
                       echo '<tr>';
                       echo '<td>'. $row['naziv'] . '</td>';
                       echo '<td>'. $row['opis'] . '</td>';
                       echo '<td width=250>';
                       echo '<a class="btn" href="read.php?id='.$row['id'].'">Pogledaj</a>';
                       echo ' ';
                       echo '<a class="btn btn-success" href="update.php?id='.$row['id'].'">Ažuriraj</a>';
                       echo ' ';
                       echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'" action="delete.php?akcija=brisanje&id=<?php echo $id ?>" >Obriši</a>';
                       echo '</td>';
                       echo '</tr>';
                   }
                   Baza::disconnect();
                  ?>
                  </tbody>
            </table>
        </div>
    </div> <!-- /container -->
  </body>
</html>