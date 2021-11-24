<?php
    include 'database.php';
    session_start();

    $tabsize = (isset($_POST['tabsize'])) ? $_POST['tabsize'] : 'vazio';
    $tablinhas = explode('x', $tabsize)[0];
    $tabcolunas = explode('x', $tabsize)[1];
    $numBombs = (isset($_POST['numBombs'])) ? $_POST['numBombs'] : 'vazio';
    $gameMode = (isset($_POST['gameMode'])) ? $_POST['gameMode'] : 'vazio';
    $playedTime = (isset($_POST['playedTime'])) ? $_POST['playedTime'] : 'vazio';
    $date = (isset($_POST['date'])) ? $_POST['date'] : 'vazio';
    $status = (isset($_POST['status'])) ? $_POST['status'] : 'vazio';

    if(isset($_POST['tabsize']))
    {
        // Gravar partida
        $db = new Database();
        $cmd = new DBCommands();
        $codusuario = $_SESSION["codusuario"];
        $insertCMD = $cmd::INSERT_INTO_GAMEMATCH($codusuario, $tablinhas, $tabcolunas, $numBombs, $gameMode, $playedTime, $status, $date);
        $db->executeCommand($insertCMD);
    }

    $result = [
        'username'    =>  $_SESSION["username"],
        'tabsize'     =>  $tabsize,
        'numBombs'    =>  $numBombs,
        'gameMode'    =>  $gameMode,
        'playedTime'  =>  $playedTime,
        'date'        =>  $date,
        'status'      =>  $status
    ];
    echo json_encode($result);
?>