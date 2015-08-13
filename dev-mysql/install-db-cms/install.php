<?php

$dbHost     = "localhost"; # url o direccion de la base de datos MySQL
$dbUsuario  = "root";
$dbPassword = "";
$dbNombre   = "cmsblog"; # nombre de la base de datos

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <title>Creando Tablas para CMS</title>
</head>

<body>
<?php

// definicion de comandos/sentencias para CREAR base de datos "cms", tablas y llenado con datos:
$createDatabase = "
	DROP DATABASE IF EXISTS cmsblog;

	CREATE DATABASE cmsblog COLLATE latin1_spanish_ci;";

$createTables = "
USE cmsblog;

CREATE TABLE usuario(
	usuario 	VARCHAR(20) NOT NULL,
	contrasena  VARCHAR(20) NOT NULL,
	nombre 		VARCHAR(100) NOT NULL,
	email 		VARCHAR(100) NULL DEFAULT '1'
);

CREATE TABLE articulo(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	usuarioCrea VARCHAR(20) NOT NULL,
	fechaCreacion DATETIME NOT NULL,
	titulo VARCHAR(200) NOT NULL,
	texto VARCHAR(2000) NOT NULL
);


CREATE TABLE tag(
	idTag INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	tag VARCHAR(50) NOT NULL
	);

CREATE TABLE articulo_tag(
	idTag INT NOT NULL,
	idArticulo INT NOT NULL
	);


ALTER TABLE articulo
	ADD FOREIGN KEY (usuario)
	REFERENCES usuario(usuario);

ALTER TABLE articulo_tag
	ADD FOREIGN KEY (idTag)
	REFERENCES tag(idTag);

ALTER TABLE articulo_tag
	ADD FOREIGN KEY (idArticulo)
	REFERENCES articulo(idArticulo);

";

$alterTables = "
USE cmsblog;

CREATE INDEX id_index1 ON articulo (usuario);

ALTER TABLE articulo
	ADD CONSTRAINT fk_UsuArticulo
	FOREIGN KEY (usuarioCrea)
	REFERENCES usuario(usuario);

CREATE INDEX id_index2 ON articulo_tag (idArticulo);
CREATE INDEX id_index3 ON articulo_tag (idTag);

ALTER TABLE articulo_tag
ADD CONSTRAINT fk_ArtTag1
FOREIGN KEY (idTag)
	REFERENCES tag(idTag);

ALTER TABLE articulo_tag
ADD CONSTRAINT fk_ArtTag2
FOREIGN KEY (idArticulo)
	REFERENCES articulo(idArticulo);

";

$insertData = "
/* insercion datos en tabla USUARIO */
INSERT INTO usuario(usuario, contrasena, nombre, email) VALUES('steve', '123', 'Steve Jobs', 'steve@apple.com');
INSERT INTO usuario(usuario, contrasena, nombre, email) VALUES('bill', '456', 'Bill Gates', 'bill@microsoft.com');
INSERT INTO usuario(usuario, contrasena, nombre, email) VALUES('murray', '789', 'Bill Murray', 'bill@hollywood.com');


/* insercion datos en tabla ARTICULO */
INSERT INTO articulo(usuarioCrea, fechaCreacion, titulo, texto)
	VALUES('steve', '	'2015-06-01', 'silicon valley', 'Lorem ipsum ad his blandit partiendo, eum...');
INSERT INTO articulo(usuarioCrea, fechaCreacion, titulo, texto)
	VALUES('steve', '	'2015-06-10', 'ipad', 'Lorem ipsum ad his blandit partiendo, eum...');
INSERT INTO articulo(usuarioCrea, fechaCreacion, titulo, texto)
	VALUES('murray', '	'2015-07-08', 'dia de la marmota', 'Lorem ipsum ad his blandit partiendo, eum...');
INSERT INTO articulo(usuarioCrea, fechaCreacion, titulo, texto)
	VALUES('steve', '	'2015-07-25', 'wozniak', 'Lorem ipsum ad his blandit partiendo, eum...');
INSERT INTO articulo(usuarioCrea, fechaCreacion, titulo, texto)
	VALUES('bill', '	'2015-06-15', 'ms-dos', 'Lorem ipsum ad his blandit partiendo, eum...');
INSERT INTO articulo(usuarioCrea, fechaCreacion, titulo, texto)
	VALUES('murray', '	'2015-01-01', 'lost in translation', 'Lorem ipsum ad his blandit partiendo, eum...');
INSERT INTO articulo(usuarioCrea, fechaCreacion, titulo, texto)
	VALUES('bill', '	'2015-01-18', 'windows phone', 'Lorem ipsum ad his blandit partiendo, eum...');
INSERT INTO articulo(usuarioCrea, fechaCreacion, titulo, texto)
	VALUES('murray', '	'2015-01-02', 'coffe and cigarretes', 'Lorem ipsum ad his blandit partiendo, eum...');
INSERT INTO articulo(usuarioCrea, fechaCreacion, titulo, texto)
	VALUES('murray', '	'2015-01-03', 'cazafantasmas', 'Lorem ipsum ad his blandit partiendo, eum...');

";

echo "<p>Preparando conexion a base de datos en host: $dbHost ...</p>";
$db = new mysqli($dbHost, $dbUsuario, $dbPassword);

echo "<p>Intentando conectarse a base de datos ...</p>";
if($db->connect_errno > 0){
    die('No se puede realizar conexión a base de datos [' . $db->connect_error . ']');
}


echo "<p>Conexión exitosa</p>";


echo "<p>Ejecutando cración de base de datos ...</p>";
if(!$result = $db->multi_query($createDatabase)){
    die('Hubo un error: [' . $db->error . ']');
}
do { $db->use_result(); } while( $db->next_result() );


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



?>




</body>

</html>