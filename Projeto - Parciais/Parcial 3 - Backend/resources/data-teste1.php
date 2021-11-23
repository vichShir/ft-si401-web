<?php
    include 'database.php';

    if(isset($_POST['userName']))   // Inserir
    {
        
    }

    $db = new Database();
    $cmd = new DBCommands();
    $result = $db->executeQuery($cmd::$getJogadorCMD);            

    echo json_encode($result);
?>