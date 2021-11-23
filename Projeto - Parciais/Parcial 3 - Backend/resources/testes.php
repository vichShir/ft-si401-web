<html>
    <head>
        <meta charset="utf-8">
        <title>PHP Test</title>

        <script>
        let xhttp;

        function enviarDados() {
            let nomeUsuario = document.getElementById("ajaxTextbox").value;
            xhttp = new XMLHttpRequest();

            if (!xhttp) {
                alert('Não foi possível criar um objeto XMLHttpRequest.');
                return false;
            }
            xhttp.onreadystatechange = mostraResposta;
            xhttp.open('POST', 'data-teste1.php', true);
            xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            //xhttp.send('userName=' + encodeURIComponent(nomeUsuario));
            xhttp.send('');
        }

        function mostraResposta() {
            try {
                if (xhttp.readyState === XMLHttpRequest.DONE) {
                    if (xhttp.status === 200) {
                        let resposta = JSON.parse(xhttp.responseText);

                        let table = "";
                        resposta.forEach(jogador => {
                            table += "<tr>";
                            table += "<td>" + jogador.cpf + "</td>";
                            table += "<td>" + jogador.nome + "</td>";
                            table += "<td>" + jogador.dtnascimento + "</td>";
                            table += "<td>" + jogador.telefone + "</td>";
                            table += "<td>" + jogador.email + "</td>";
                            table += "<td>" + jogador.username + "</td>";
                            table += "<td>" + jogador.password + "</td>";
                            table += "</tr>";
                        });

                        document.getElementById("tabela").innerHTML += table;
                    }
                    else {
                        alert('Um problema ocorreu.');
                    }
                }
            } 
            catch (e) {
                alert("Ocorreu uma exceção: " + e.description);
            }
        }
        </script>
    </head>
    <body>

    <h1>Teste de AJAX</h1>
    <label>Digite seu nome:<input type="text" id="ajaxTextbox"/></label>
    <button id="ajaxButton" onclick="enviarDados()">Clique aqui!</button>
    <br>

    <table border="1" align="center" id="tabela">
    <tr>
      <td>CPF</td>
      <td>Nome completo</td>
      <td>Data nascimento</td>
      <td>telefone</td>
      <td>email</td>
      <td>usuario</td>
      <td>senha</td>
    </tr>

    <?php
    
    include 'database.php';

    //$db = new Database();
    $cmd = new DBCommands();
    
    // Insert
    $cpf = '64784567831'; 
    $nome = 'João'; 
    $dtnascimento = '2002-08-21'; 
    $telefone = '11986374851';
    $email = 'joao.abel@email.com';
    $username = 'joao';
    $password = '3464grgsgsdg';
    $insertCMD = $cmd::insertJogadorCMD($cpf, $nome, $dtnascimento, $telefone, $email, $username, $password);
    //echo $insertCMD;
    //$db->executeCommand($insertCMD);

    // Query
    /*$result = $db->executeQuery($cmd::$getJogadorCMD);
    foreach($result as $jogador)
    echo
    "<tr>
        <td>{$jogador['cpf']}</td>
        <td>{$jogador['nome']}</td>
        <td>{$jogador['dtnascimento']}</td>
        <td>{$jogador['telefone']}</td>
        <td>{$jogador['email']}</td>
        <td>{$jogador['username']}</td>
        <td>{$jogador['password']}</td>
    </tr>";                   
    echo "<br/>";*/

    // Create tables
    $query_create_jogador = "CREATE TABLE jogador(
        cpf CHAR(11) NOT NULL,
        nome VARCHAR(40) NOT NULL,
        dtnascimento DATE NOT NULL,
        telefone CHAR(11) NOT NULL,
        email VARCHAR(40) NOT NULL,
        username VARCHAR(30) NOT NULL,
        password VARCHAR(20) NOT NULL,
        PRIMARY KEY(cpf)
    );";

    $query_create_partida = "CREATE TABLE partida(
        numpartida BIGINT NOT NULL,
        username VARCHAR(30) NOT NULL,
        status CHAR(1) NOT NULL,
        dtpartida DATE NOT NULL,
        linhas TINYINT UNSIGNED NOT NULL,
        colunas TINYINT UNSIGNED NOT NULL,
        bombas TINYINT UNSIGNED NOT NULL,
        modo CHAR(1) NOT NULL,
        tempo TIME NOT NULL,
        PRIMARY KEY(numpartida),
        FOREIGN KEY(username) REFERENCES jogador,
        UNIQUE(username)
    );";
    ?> 
    </body>
</html>