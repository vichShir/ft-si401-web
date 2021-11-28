<?php
//===========================================================================
//=============================== O que falta? ==============================
//===========================================================================

/**
 * 1. Ranking (pegar todas as partidas, ordenar e exibir no html)
 * 2. Sessões (armazenar codusuario e username)
 * 3. Login, cadastro e editar perfil (verificar login no BD, inserir no BD e update no DB)
 */

//===========================================================================
//============================ Database Settings ============================
//===========================================================================

/**
 * Especifique as configurações do seu banco de dados aqui (MariaDB)
 * 
 * USING_CLOUD_MARIADB = true -> usando MariaDB na nuvem
 * USING_CLOUD_MARIADB = false -> usando MariaDB localhost
 *
 * USING_SSL_CONNECTION = true -> especifique o caminho da chave p/ conexão SSL
 * USING_SSL_CONNECTION = false -> desabilitar conexão SSL
 */
define("USING_CLOUD_MARIADB", true);
define("USING_SSL_CONNECTION", false);
define("DB_PORT", "5001");
define("DB_DATABASE", "campominado");
if(USING_CLOUD_MARIADB)
{
    // Configurações utilizando o provedor MariaDB SkySQL aberto até 26/12
    define("DB_SERVER", "web.mdb0002361.db1.skysql.net");
	define("DB_USERNAME", "DB00005107");
	define("DB_PASSWORD", "86o7KC0Rp?]rjg6EJ4H3a_FtAf");
}
else
{
	define("DB_SERVER", "localhost");
	define("DB_USERNAME", "root");
	define("DB_PASSWORD", "");
}

if(USING_SSL_CONNECTION)
{
    define("DB_SSL_FILEPATH", "misc/BaltimoreCyberTrustRoot.crt.pem");
}
else
{
    define("DB_SSL_FILEPATH", "");
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
					PRIMARY KEY(codusuario),
                    UNIQUE(cpf)
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

define("SQL_CMD_UPDATE_USER", "UPDATE " . SQL_TABLE_NAME_USER . " SET ");

define("SQL_CMD_TOP_GAMEMATCHS", "SELECT u.username, p.tablinhas, p.tabcolunas, p.tempojogado
                                FROM usuario u INNER JOIN partida p
                                    ON u.codusuario = p.codusuario
                                WHERE status = 'V'
                                ORDER BY p.tablinhas DESC, p.tabcolunas DESC, p.tempojogado ASC
                                LIMIT 10");
?>