<?php

if (isset($_POST["install"])){

	$dbHost     = "localhost"; # url o direccion de la base de datos MySQL
	$dbUsuario  = "root";
	$dbPassword = "";
	$dbNombre   = "cmsblog"; # nombre de la base de datos

	// definicion de comandos/sentencias para CREAR base de datos "cms", tablas y llenado con datos:
	$createDatabase = <<<SQL
		DROP DATABASE IF EXISTS cmsblog;

		CREATE DATABASE cmsblog COLLATE latin1_spanish_ci;
SQL;

	$createTables = <<<SQL
	USE cmsblog;

	CREATE TABLE usuario(
		usuario 	VARCHAR(20) NOT NULL,
		contrasena  VARCHAR(20) NOT NULL,
		nombre 		VARCHAR(100) NOT NULL,
		email 		VARCHAR(100) NULL DEFAULT '1',
	    PRIMARY KEY (usuario)
	);

	CREATE TABLE articulo(
		`id` INT NOT NULL AUTO_INCREMENT,
		usuarioCrea VARCHAR(20) NOT NULL,
		fechaCreacion DATETIME NOT NULL,
		titulo VARCHAR(200) NOT NULL,
		texto VARCHAR(2000) NOT NULL,
		PRIMARY KEY (`id`)
	);


	CREATE TABLE tag(
		idTag INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
		tag VARCHAR(50) NOT NULL
	);

	CREATE TABLE articulo_tag(
		idTag INT NOT NULL,
		idArticulo INT NOT NULL
	);
SQL;

	$alterTables = <<<SQL
	USE cmsblog;

	CREATE INDEX id_index1 ON articulo (usuarioCrea);

	/*ALTER TABLE articulo
		ADD FOREIGN KEY (usuarioCrea)
		REFERENCES usuario(usuario);

	ALTER TABLE articulo_tag
		ADD FOREIGN KEY (idTag)
		REFERENCES tag(idTag);

	ALTER TABLE articulo_tag
		ADD FOREIGN KEY (idArticulo)
		REFERENCES articulo(idArticulo);

	*/

	ALTER TABLE articulo
		ADD CONSTRAINT fk_UsuArticulo
		FOREIGN KEY id_index1(usuarioCrea)
		REFERENCES usuario(usuario);

	/*CREATE INDEX id_index2 ON articulo_tag (idArticulo);
	CREATE INDEX id_index3 ON articulo_tag (idTag);

	ALTER TABLE articulo_tag
	ADD CONSTRAINT fk_ArtTag1
	FOREIGN KEY (idTag)
		REFERENCES tag(idTag);

	ALTER TABLE articulo_tag
	ADD CONSTRAINT fk_ArtTag2
	FOREIGN KEY (idArticulo)
		REFERENCES articulo(idArticulo);
	*/
SQL;

	$insertData = <<<SQL

	USE cmsblog;

	/* insercion datos en tabla USUARIO */
	INSERT INTO usuario(usuario, contrasena, nombre, email) VALUES('steve', '123', 'Steve Jobs', 'steve@apple.com');
	INSERT INTO usuario(usuario, contrasena, nombre, email) VALUES('bill', '456', 'Bill Gates', 'bill@microsoft.com');
	INSERT INTO usuario(usuario, contrasena, nombre, email) VALUES('murray', '789', 'Bill Murray', 'bill@hollywood.com');


	/* insercion datos en tabla ARTICULO */
	INSERT INTO articulo(usuarioCrea, fechaCreacion, titulo, texto)
		VALUES('steve', '2015-06-01', 'silicon valley', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
	INSERT INTO articulo(usuarioCrea, fechaCreacion, titulo, texto)
		VALUES('steve', '2015-06-10', 'ipad', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
	INSERT INTO articulo(usuarioCrea, fechaCreacion, titulo, texto)
		VALUES('murray', '2015-07-08', 'dia de la marmota', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
	INSERT INTO articulo(usuarioCrea, fechaCreacion, titulo, texto)
		VALUES('steve', '2015-07-25', 'wozniak', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
	INSERT INTO articulo(usuarioCrea, fechaCreacion, titulo, texto)
		VALUES('bill', '2015-06-15', 'ms-dos', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
	INSERT INTO articulo(usuarioCrea, fechaCreacion, titulo, texto)
		VALUES('murray', '2015-01-01', 'lost in translation', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
	INSERT INTO articulo(usuarioCrea, fechaCreacion, titulo, texto)
		VALUES('bill', '2015-01-18', 'windows phone', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
	INSERT INTO articulo(usuarioCrea, fechaCreacion, titulo, texto)
		VALUES('murray', '2015-01-02', 'coffe and cigarretes', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
	INSERT INTO articulo(usuarioCrea, fechaCreacion, titulo, texto)
		VALUES('murray', '2015-01-03', 'cazafantasmas', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');

SQL;

	echo "<p>Preparando conexion a base de datos en host: $dbHost ...</p>";
	$db = new mysqli($dbHost, $dbUsuario, $dbPassword);

	echo "<p>Intentando conectarse a base de datos ...</p>";
	if($db->connect_errno > 0){
	    die('No se puede realizar conexión a base de datos [' . $db->connect_error . ']');
	}


	echo "<p>Conexión exitosa</p>";


	echo "<p>Ejecutando creación de base de datos ...</p>";
	if ($db->multi_query($createDatabase)){
		do {
		    // Store first result set
		    if ($result = $db->use_result())
		      	{
		      	while ($row = $result->fetch_row()){
		        	printf("%s\n",$row[0]);
		      	}
		      	$result->close();
		      }
		      /* print divider */
		      if ($db->more_results()) {
		        printf("-----------------\n");
		      }
		}
		while ($db->next_result());
	}


	echo "<p>Ejecutando cración de tablas ...</p>";
	if(!$result = $db->multi_query($createTables)){
	    die('Hubo un error: [' . $db->error . ']');
	}
	do { $db->use_result(); } while( $db->next_result() );

	echo "<p>Ejecutando alteración de tablas ...</p>";
	if(!$result = $db->multi_query($alterTables)){
	    die('Hubo un error: [' . $db->error . ']');
	}
	do { $db->use_result(); } while( $db->next_result() );


	echo "<p>Insertando info inicial en tablas USUARIO y ARTICULO</p>";
	if(!$result = $db->multi_query($insertData)){
	    die('Hubo un error: [' . $db->error . ']');
	}


	$db->close();

}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <title>CmsBlog</title>
</head>

<body>
	<form action="install.php" method="post">
		<button type="submit" name="install" value="install">Crear tablas en Base de Datos MySQL *cmsblog*</button>
	</form>

	<p><Si hay que borrar la base para recrearla, lo haremos usando phpMyAdmin.</p>
</body>

</html>