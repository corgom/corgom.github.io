* http://ben.balter.com/2015/01/11/hacking-github/
* http://htmledit.squarefree.com/
* https://zapier.com/app/explore?services=github

* http://imgur.com/3GSYBWg
* http://imgur.com/delete/NjCKPn3TSSS7Pal

## *Ejercicio clase*

# HTML FORM > PHP > MySQL

## Requisitos

1. WAMP iniciado (si tienes problemas, <a href="http://www.aprenderaprogramar.com/foros/index.php?topic=163.0">mira acá</a>)
   1. Deben estar iniciados todos los servicios (Apache, PHP), pero sobre todo MySQL.
   1. Si no arranca wamp correctamente, <a href="http://blog.andersonrubio.com/2011/10/wamp-no-funciona-icono-naranja.html">aquí una posible solucion</a>.
1. Editor de texto Sublime Text (o similar, incluso Dreamweaver)
1. Carpeta **cms** de trabajo copiado en ruta o path **[Unidad]\wamp\www\**
   Si existe la carpeta en path destino, borrar la existente y copiar
   carpeta propia.
1. Abrir en navegador web (firefox o chrome) tu sitio web, que será
    la url [http://localhost/cms/](http://localhost/cms/)
1. Abrir en otra pestaña del navegador la interfaz web para MySQL <a href="http://localhost/phpmyadmin/">phpMyAdmin</a>
1. Bajar <a href="https://raw.githubusercontent.com/corgom/corgom.github.io/master/dev-mysql/install-db-cms/install.php">archivo php</a> que crea la base de datos y tablas basicas para nuestro sitio web
   1. Ejecutar el script en una pestaña nueva en el navegador web (p.e. http://localhost/cms/install.php)

## Enviar datos de formulario y generar sentencia sql `INSERT`

Ya tenemos creado el formulario siguiente en **articulo_nuevo.php**

<img src="http://i.imgur.com/3GSYBWg.png?1" />

En nuestro codigo de esta pagina php tenemos como destino otro documento php

```html
<form method="post" action="articulo_guarda.php">
```

por lo cual, vamos a recibir y manipular o procesar los datos enviados desde el formulario html.
Vamos a trabajar inicialmente con dos de los 3 campos: `titulo`, `texto`

### Actividad

En articulo_guarda.php vamos a hacer lo siguiente:

1. recuperar los campos de formulario `titulo` y `texto` en dos variables php llamados `$art_titulo` y `$art_texto` respectivamente
   1. usando `isset()` valida la existencia de las variables, si alguna de las dos o las dos no existen o no estan inicializadas redirige al usuario a **articulo_nuevo.php**
2. completa la siguiente sentencia SQL

  ```sql
  INSERT INTO articulo(usuarioCrea, fechaCreacion, titulo, texto) VALUES('murray', NOW(), ...)
  ``` 
  como ves, el comando INSERT esta practicamente terminado, lo que tienes que hacer es concatenar de algun modo el contenido de las dos variables php para que la sentencia SQL sea valida y se puedan insertar efectivamente los dos datos capturados en el formulario html por el usuario en la tabla articulo de la base de datos cmsblog
