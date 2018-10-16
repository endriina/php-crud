<?php
     
    require 'baza.php';
 
    if ( !empty($_POST)) {
        
        $nazivError = null;
        $opisError = null;
         
        
        $naziv = $_POST['naziv'];
        $opis = $_POST['opis'];
         
        
        $valid = true;
        if (empty($naziv)) {
            $nazivError = 'Unesi naziv čaja';
            $valid = false;
        }
         
        if (empty($opis)) {
            $opisError = 'Unesi opis čaja';
            $valid = false;
        }
        
         
        // Unos podataka
        if ($valid) {
            $pdo = Baza::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO caj (naziv,opis) values(?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($naziv,$opis));
            Baza::disconnect();
            header("Location: index.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Unos čaja</h3>
                    </div>
             
                    <form class="form-horizontal" action="create.php" method="post">
                      <div class="control-group <?php echo !empty($nazivError)?'error':'';?>">
                        <label class="control-label">Naziv čaja</label>
                        <div class="controls">
                            <input name="naziv" type="text"  placeholder="naziv" value="<?php echo !empty($naziv)?$naziv:'';?>">
                            <?php if (!empty($nazivError)): ?>
                                <span class="help-inline"><?php echo $nazivError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($opisError)?'error':'';?>">
                        <label class="control-label">Unesi kratak opis čaja</label>
                        <div class="controls">
                            <input name="opis" type="text" placeholder="opis" value="<?php echo !empty($opis)?$opis:'';?>">
                            <?php if (!empty($opisError)): ?>
                                <span class="help-inline"><?php echo $opisError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Spremi</button>
                          <a class="btn" href="index.php">Natrag</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>