<?php
$dureelimite=20*1; // period max

    if (time() - $_SESSION['derniereaction'] > $dureelimite) {
        echo "Session vaut : " . $_SESSION['derniereaction']." et limite : ".$dureelimite;
    }
    else {
        $_SESSION['derniereaction'] = time();
    }


?>
