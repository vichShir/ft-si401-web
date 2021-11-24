<?php
//===========================================================================
//============================ Database Settings ============================
//===========================================================================

/**
 * Especifique as configurações do seu banco de dados aqui (MariaDB)
 * 
 * AZURE_CLOUD_MARIADB = true -> usando MariaDB na nuvem (conexão SSL)
 * AZURE_CLOUD_MARIADB = false -> usando MariaDB no localhost
 */
define("AZURE_CLOUD_MARIADB", false);
define("DB_DATABASE", "campominado");
if(AZURE_CLOUD_MARIADB)
{
	define("DB_SERVER", "progweb.mariadb.database.azure.com");
	define("DB_USERNAME", "vichshir@progweb");
	define("DB_PASSWORD", "x9GCjKmGkV4EMLs");
	define("DB_SSL_FILEPATH", "misc/BaltimoreCyberTrustRoot.crt.pem");
}
else
{
	define("DB_SERVER", "localhost");
	define("DB_USERNAME", "root");
	define("DB_PASSWORD", "");
}

//===========================================================================
//================================ SQL Project ==============================
//===========================================================================

/**
 * "Configurações do projeto SQL"
 *   - Tabela de usuário.
 * 	 - Tabela de partida.
 */
define("SQL_TABLE_NAME_USER", "usuario");
define("SQL_TABLE_NAME_GAMEMATCH", "partida");

/**
 * "Digite os seus comandos SQL aqui"
 *   - Criação das tabelas.
 *   - Inserção nas tabelas.
 *   - Alteração das tabelas.
 *   - Selecionar das tabelas.
 * 
 */
define("SQL_CMD_CREATE_USER", "CREATE TABLE usuario(
					codusuario INT UNSIGNED NOT NULL AUTO_INCREMENT,
					cpf CHAR(11) NOT NULL,
					nomecompleto VARCHAR(40) NOT NULL,
					dtnascimento DATE NOT NULL,
					telefone CHAR(11) NOT NULL,
					email VARCHAR(40) NOT NULL,
					username VARCHAR(30) NOT NULL,
					password VARCHAR(20) NOT NULL,
					PRIMARY KEY(codusuario)
		    )");
define("SQL_CMD_CREATE_GAMEMATCH", "CREATE TABLE partida(
			        codpartida MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
			        codusuario INT UNSIGNED NOT NULL,
			        tablinhas TINYINT UNSIGNED NOT NULL,
			        tabcolunas TINYINT UNSIGNED NOT NULL,
			        numbombas TINYINT UNSIGNED NOT NULL,
			        modo CHAR(1) NOT NULL,
			        tempojogado TIME NOT NULL,
			        status CHAR(1) NOT NULL,
			        dtpartida DATE NOT NULL,
			        PRIMARY KEY(codpartida, codusuario),
					FOREIGN KEY (codusuario) REFERENCES usuario (codusuario)
		    )");

define("SQL_CMD_INSERT_INTO_USER", "INSERT INTO " . SQL_TABLE_NAME_USER .
					" (cpf, nomecompleto, dtnascimento, telefone, email, username, password) VALUES ");
define("SQL_CMD_INSERT_INTO_GAMEMATCH", "INSERT INTO " . SQL_TABLE_NAME_GAMEMATCH .
					" (codusuario, tablinhas, tabcolunas, numbombas, modo, tempojogado, status, dtpartida) VALUES ");

define("SQL_CMD_SELECT_ID_NAME_FROM_USER", "SELECT codusuario, username FROM " . SQL_TABLE_NAME_USER);
define("SQL_CMD_SELECT_ALL_FROM_GAMEMATCH", "SELECT * FROM " . SQL_TABLE_NAME_GAMEMATCH);
?>