# Conexion a base de datos MySQL con PHP

## Requisitos

1. WAMP iniciado (si tienes problemas, <a href="http://www.aprenderaprogramar.com/foros/index.php?topic=163.0">mira acá</a>)
   1. Deben estar iniciados todos los servicios (Apache, PHP), pero sobre todo MySQL.
   1. Si no arranca wamp correctamente, <a href="http://blog.andersonrubio.com/2011/10/wamp-no-funciona-icono-naranja.html">aquí una posible solucion</a>.
1. Editor de texto Sublime Text (o similar, incluso Dreamweaver)
1. Carpeta **cms** de trabajo copiado en ruta o path **Unidad]\wamp\www\**
   Si existe la carpeta en path destino, borrar la existente y copiar
   carpeta propia.
1. Abrir en navegador web (firefox o chrome) tu sitio web, que será
    la url [http://localhost/cms/](http://localhost/cms/)
1. Abrir en otra pestaña del navegador la interfaz web para MySQL <a href="http://localhost/phpmyadmin/">phpMyAdmin</a>

## MySQLi

De las 3 APIs disponibles para conectarse a MySQL desde PHP vamos a usar **mysqli**

codigo de conexion valida php a mysql

```php
<?php

$db = new mysqli('localhost', 'root', '', 'cms'); //con indicacion de nombre de base de datos
//$db = new mysqli('localhost', 'root', ''); //sin indicacion de nombre de base de datos

if($db->connect_errno > 0){
    die('No es posible conectarse a la base de datos [' . $db->connect_error . ']');
}

//query sql
$sql = "SELECT nombre, email FROM usuario";

//ejecucion de query y recuperacion de resultados
//en variable $result
$result = $db->query($sql);

//validar si hay resultados (registros retornados por
//la ejecucion del query)
if(!$result){
    die('Hubo un error al ejecutar la consulta [' . $db->error . ']');
}
else
{
   while($row = $result->fetch_assoc()){
       echo $row['nombre'] . "(" . $row['email'] . ')<br />';
   }
}

//liberar memoria
$result->free();

?>
```


