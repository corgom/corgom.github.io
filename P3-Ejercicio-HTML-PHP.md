### Desarrollo de aplicaciones web

# Ejercicios prácticos

**Keywords**: [`HTML5`][html5], `form`, `input`, `post`, `PHP`, `ftp`, `website`, `url`, `$_POST[]`, `issset()`, [`mysqli`][mysqli], `SQL`

## Objetivo

Aplicar los conceptos y ejercicios vistos en clase sobre el tema *Desarrollo de aplicaciones web usando HTML, PHP y MySQL*, para **avanzar** con la publicación de un sitio web funcional que permite crear un blog.

## Instrucciones

Realiza cada unos de los pasos de forma incremental segun se te indica.

La conexion ftp lo puedes hacer con el cliente ftp de tu preferencia ([FileZilla][1], [CyberDuck][2], etc.). Ya se te proporcionó con anterioridad la información para hacer la conexión a tu sitio ftp, los datos mínimos requeridos son:

   * **ip o url del ftp** / *host*
   * **puerto** / *port* (default: 21)
   * **usuario** / *user*
   * y **contraseña** / *password*.

Vas a usar dos carpetas, una local y una remota, a continuación su explicación.

### CARPETA DE TRABAJO

Tienes una carpeta llamada `cms`  (o `cmsblog`), que está ubicada en disco duro en la ruta `[UnidadDiscoDuro]\wamp\www\` o en tu memoria USB. La carpeta `cms` debe contener la ultima versión trabajada en clase. Nos referiremos a esta carpeta como **`CARPETA DE TRABAJO`**.

Si tu carpeta está en la ruta `[UnidadDiscoDuro]\wamp\www\`, puedes visualiar tu sitio web con la URL `http://localhost/cms`. Recuerda que el servidor web (WAMP) ejecuta o procesa los scripts php antes de enviar los documentos HTML al navegador.

### CARPETA REMOTA

Y tienes un carpeta en un servidor FTP que llamaremos **`CARPETA REMOTA`**. Para acceder esta carpeta requieres de un cliente FTP y de los datos de conexion que te proporcioné en alguna de las clases.

Con la conexión FTP **publicas** tu sitio web, ya que aquí puedes subir, modificar, mover y eliminar archivos en tu `CARPETA REMOTA`. Esto es equivalente a copiar de tu USB el directorio `cms` a la ruta de `www` de WAMP.

### WEB SITE

Para visualizar en un *browser* tu sitio web que está contenido en la `CARPETA REMOTA` tienes que usar la URL especifica para tí. De manera general, tu URL es `http://[ip]/~corne/[usuario_ftp_sin_@]`, donde `[usuario_ftp_sin_@]` se corresponde con tu usuario ftp pero sin incluir la arroba y lo que viene despues, por ejemplo para ver el sitio web de Jonatan escribimos en el navegador `http://[ip]/~corne/jmunoz`

![Screenshot raw site](http://i.imgur.com/t3MUla6.png)

En el url anterior, unicamente falta sustituir `[ip]` que se corresponde con la IP del servidor ftp mencionado anteriormente.

A esta url le llamaremos de ahora en adelante **`WEB SITE`**.
   
## Ejercicios

### ./install.php

Vas a crear las tablas de tu base de datos para tu sitio web en el servidor remoto.

En [este documento][tarea-decimas-extra] esta la definición de las tablas de tu base de datos y los datos de carga inicial, en caso de requerirlo mas adelante.

1. Borra el archivo `./install.php` de tu `CARPETA DE TRABAJO`.

2. Borra todo el contenido (archivos y subcarpetas) de tu `CARPETA REMOTA`.

3. Mediante conexión FTP copia o sube todo el **contenido** (archivos y subcarpetas) de tu `CARPETA DE TRABAJO` a la `CARPETA REMOTA`.
   
   En este punto, una vez copiado todo a tu `CARPETA REMOTA`, puedes visitar tu `WEB SITE` con la URL correspondiente. Tu `WEB SITE` será reflejo fiel de tu `CARPETA DE TRABAJO` visto en un navegador web. Ahora falta crear las tablas de la base de datos para que no salgan errores al visitar paginas de tu sitio que consultan a MySQL.

4. Baja el nuevo archivo php [`install.php`][install.php] a tu `CARPETA DE TRABAJO`. Este nuevo `install.php` tiene correciones respecto al original usado en clase.

5. Abre en tu editor favorito el archivo `./install.php`, y actualiza la sección de configuracion de conexion a tu base de datos MySQL. Localiza estas lineas php en tu codigo:
    
   ```php
    if (isset($_POST["install"])){

        $dbHost     = "localhost"; # url o direccion de la base ...
        $dbUsuario  = "root";
        $dbPassword = "";
        $dbNombre   = "cmsblog"; # nombre de la base de datos

        ...
   ```
       
   Los datos de conexion que ahí tiene son los que usaste en la clase. Los parametros de conexión para **tu base** de datos MySQL en el servidor remoto es como sigue:

   ```php
    if (isset($_POST["install"])){

        $dbHost     = "localhost"; # url o direccion de la base ...
        $dbUsuario  = "corne_[usuario_ftp_sin_@]";
        $dbPassword = "[password_ftp]";
        $dbNombre   = "corne_cmsblog_[usuario_ftp_sin_@]"; # nombre de la base de datos

        ...
   ```
  
   Tienes que sustituir `[usuario_ftp_sin_@]` y `[password_ftp]` con sus valores respectivos. El valor de `$dbHost` se queda como `localhost` porque la base de datos MySQL que vas a usar es *local* al servidor en donde se ejecutan tus páginas PHP.

   Siguiendo con el ejemplo de Jonatan, tendríamos nuestra sección de configuración actualizado así:

   ```php
    if (isset($_POST["install"])){

        $dbHost     = "localhost"; # url o direccion de la base ...
        $dbUsuario  = "corne_jmunoz";
        $dbPassword = "123456";
        $dbNombre   = "corne_cmsblog_jmunoz"; # nombre de la base de datos

        ...
   ```

   Obviamente, el password no es el real.

   Asegurate que los datos estén correctos. Si te marca error alguno de los ejercicios posteriores, regresa a este punto y revisa que tus datos estén correctos.
   
6. Guarda los cambios en tu archivo `./install.php`

7. Para que se creen las tablas y se carguen los registros de prueba en tu base de datos, como lo hicimos en clase, debes ejecutar el php `./install.php` en el servidor remoto, para ello has de usar la url de tu `WEB SITE` `http://[ip]/~corne/[usuario_ftp_sin_@]/install.php`

8. Valida que la base de datos se haya creado correctamente:

  1. Actualiza la configuracion de la conexion a la base de datos MySQL en el archivo `./admin.php`, usa los mismos datos de conexión a MySQL que usaste en `./install.php`:

    ```php
    <?php
  
    $db = new mysqli('localhost', 'corne_[usuario_ftp_sin_@]', '[password_ftp]', 'corne_cmsblog_[usuario_ftp_sin_@]'); //con indicacion de nombre de base de datos
    //$db = new mysqli('localhost', 'root', ''); //sin indicacion de nombre de base de datos
  
    if($db->connect_errno > 0){
        die('No es posible conectarse a la base de datos [' . $db->connect_error . ']');
    }
    ```

  2. Ahora ve a tu sitio web `http://[ip]/~corne/[usuario_ftp_sin_@]/` y logueate en la correspondiente pantalla de *login*.
  
  3. Si tu *login* fue exitoso, este debe redirigirte a la página `./admin.php` en donde verás el listado de los titulos de los articulos publicados o existentes en la tabla `articulo`, **que fue hasta donde llegamos en la ultima clase**.
   
  ![Screenshot web site logued](http://i.imgur.com/DxttdzD.png)

### ./admin.php

En `./admin.php` actualmente generamos con php una tabla html que contiene los datos consultados de la tabla `articulo`, y mostramos dos columnas que son `id` y `titulo`. El codigo html generado por php debe ser parecido a (quizás varie en los saltos de linea o espacios, pero los tags deben generarse en el orden indicado):

```html
<table>
    <tr>
        <td>1</td>
        <td>silicon valley</td>
    </tr>
    <tr>
        <td>2</td>
        <td>ipad</td>
    </tr>
    ...
    <tr>
        <td>15</td>
        <td>cazafantasmas</td>
    </tr>
</table>
```

Si tu salida html no es así, corrige o completa tu fuente `./admin.php` para que tenga la salida de tags como se indicó anteriormente.

1. El ejercicio consiste en modificar el fuente `./admin.php` de manera que la salida html ahora sea:

   ```html
   <table>
       <tr>
           <td>1</td>
           <td> <a href="articulo_edita.php?id=1"> silicon valley </a> </td>
       </tr>
       <tr>
           <td>2</td>
           <td> <a href="articulo_edita.php?id=2"> ipad </a> </td>
       </tr>
       ...
       <tr>
           <td>15</td>
           <td> <a href="articulo_edita.php?id=15"> cazafantasmas </a> </td>
       </tr>
   </table>
   ```

### index.php

Usando como referencia la consulta a la base de datos MySQL que se hizo en `./admin.php`, modificar `./index.php` de manera que genere el siguiente conjunto de tags HTML intermezclado con el contenido obtenido de la base de datos:

```html
<h2>[Titulo del articulo]</h2>
<h3>por: [Usuario creó el articulo]</h3>
<pre><code>
[Texto del articulo]
</code></pre>
```

donde dice `[Titulo del articulo]`, `[Usuario creó el articulo]` y `[Texto del articulo]` ahí debe aparecer los valores recuperados de la base de datos.

 El conjunto de tags se debe generar por cada registro regresado por la consulta a MySQL, es decir, si por ejemplo mostraramos los 3 primeros registros la salida HTML sería:
 
```html
<h2>silicon valley</h2>
<h3>por: steve</h3>
<pre><code>
Lorem ipsum ad his blandit partiendo, eum...
</code></pre>

<h2>ipad</h2>
<h3>por: steve</h3>
<pre><code>
Lorem ipsum ad his blandit partiendo, eum...
</code></pre>

<h2>dia de la marmota</h2>
<h3>por: murray</h3>
<pre><code>
Lorem ipsum ad his blandit partiendo, eum...
</code></pre>
```


[1]: https://filezilla-project.org/ "FileZilla"
[2]: https://cyberduck.io/?l=es "CyberDuck"
[introHtml]: http://www.desarrolloweb.com/manuales/21/ "Intro HTML"
[html5]: http://www.axtro.es/2011/1/29/12236/manual-de-html5-en-espanol---1-de-3 "HTML 5"
[mysqli]: http://codular.com/php-mysqli "MySQL > mysqli"
[install.php]: http://corgom.github.io/resources/install.php "Install PHP-MySQL"
[tarea-decimas-extra]: https://github.com/corgom/corgom.github.io/blob/master/P3-Tarea-MySQL-Extra.md "Puntos Extra"
