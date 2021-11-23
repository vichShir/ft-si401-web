<?php
    $tabsize = (isset($_POST['tabsize'])) ? $_POST['tabsize'] : 'vazio';
    $numBombs = (isset($_POST['numBombs'])) ? $_POST['numBombs'] : 'vazio';
    $gameMode = (isset($_POST['gameMode'])) ? $_POST['gameMode'] : 'vazio';
    $playedTime = (isset($_POST['playedTime'])) ? $_POST['playedTime'] : 'vazio';
    $date = (isset($_POST['date'])) ? $_POST['date'] : 'vazio';
    $isVictory = (isset($_POST['isVictory'])) ? $_POST['isVictory'] : 'vazio';

    $result = [
        'tabsize' => $tabsize,
        'numBombs' => $numBombs,
        'gameMode' => $gameMode,
        'playedTime' => $playedTime,
        'date' => $date,
        'isVictory' => $isVictory
    ];
    echo json_encode($result);
?>