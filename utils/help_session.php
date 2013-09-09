<?php
$dureelimite=20*1;

    if (time() - $_SESSION['derniereaction'] > $dureelimite) {
        echo "Session vaut : " . $_SESSION['derniereaction']." et limite : ".$dureelimite;
        //header('Location: ../utils/timeout.php');
    }
    else {
        $_SESSION['derniereaction'] = time();
    }


?>
