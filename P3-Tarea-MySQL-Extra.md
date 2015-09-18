Tarea extra
===========

Ejercicios SQL para 0.5 puntos extra para 3er parcial
------------------------------------------------------------------

Tenemos una base de datos con dos tablas SQL:

* usuario

  Tipo llave | Columna | Tipo dato
  -----------:|---------|----------
  `PK` | **`usuario`** | `VARCHAR(20) NOT NULL`
    | `contrasena` | `VARCHAR(20) NOT NULL`
    | `nombre` | `VARCHAR(100) NOT NULL`
    | `email` | `VARCHAR(100) NOT NULL`

* articulo

  Tipo llave | Columna | Tipo dato
  -----------:|---------|----------
  `PK` |`id` | `INT NOT NULL AUTO_INCREMENT`
  `FK` |**`usuarioCrea`** | `VARCHAR(20) NOT NULL`
    | `fechaCreacion` | `DATETIME NOT NULL`
    | `titulo` | `VARCHAR(200) NOT NULL`
    | `texto` | `VARCHAR(2000) NOT NULL`

y el contenido de las tablas respectivamente es:

usuario | contrasena | nombre | email
---|---|---|---
steve|123|Steve Jobs|steve@apple.com
bill|456|Bill Gates|bill@microsoft.com
murray|678|Bill Murray|bill@hollywood.com

id | usuarioCrea | fechaCreacion | titulo | texto
---:|---|---|---|---
1 | steve | 2015-06-01 | silicon valley | Lorem ipsum ad his blandit partiendo, eum...
2 | steve |2015-06-10 | ipad | Lorem ipsum ad his blandit partiendo, eum...
4 | murray | 2015-07-08| dia de la marmota | Lorem ipsum ad his blandit partiendo, eum...
5 | steve | 2015-07-25| wozniak | Lorem ipsum ad his blandit partiendo, eum...
6 | bill | 2015-06-15 | ms-dos | Lorem ipsum ad his blandit partiendo, eum...
7 | murray | 2015-01-01| lost in translation | Lorem ipsum ad his blandit partiendo, eum...
8 | bill | 2015-01-18 | windows phone | Lorem ipsum ad his blandit partiendo, eum...
9 | murray | 2015-01-02 | coffe and cigarretes | Lorem ipsum ad his blandit partiendo, eum...
15 | murray | 2015-01-03 | cazafantasmas | Lorem ipsum ad his blandit partiendo, eum...


resuelve y contesta lo siguiente:

1. [4p] Qué valor regresa la siguiente sentencia SQL:
    ```sql
    SELECT COUNT(*) FROM articulo WHERE usuarioCrea = 'steve'
    ```
    
1. [8p] Qué valor regresa la siguiente sentencia SQL:
    ```sql
    SELECT MAX(id) FROM articulo WHERE usuarioCrea = 'murray'
    ```
    
1. [8p] Qué valor regresa la siguiente sentencia SQL:
    ```sql
    SELECT MIN(fechaCreacion) FROM articulo WHERE usuarioCrea = 'bill'
    ```

1. [30p] escribir sentencia SQL que obtenga el siguiente resultado
   (el orden de los renglones puede variar):

   nombre | email | titulo | fechaCreacion
   -------|-------|---------------|-------
   Steve Jobs | steve@apple.com    | silicon valley     | 2015-06-01
   Steve Jobs | steve@apple.com    | ipad               | 2015-06-10
   Bill Murray| bill@hollywood.com | dia de la marmota  | 2015-07-08
   ...|...|...|...
   
   Es decir, obtener listado completo de la base de datos donde se incluya
   la informacion del nombre del autor, email del autor,
   titulo de su articulo y fecha de creacion de su articulo.
   
   Tips: Usar `INNER JOIN`, usar alias en nombres de tablas
   
1. [50p] Escribir un query que obtenga el siguiente resultado:

    Nombre | Articulos publicados
    -------|---------------------
    Bill Gates | 2
    Bill Murray | 4
    Steve Jobs | 3
    
    Es decir, obtener la cantidad de articulos publicados por cada
    autor existentes en la base de datos.
    
    Tips: usar `INNER JOIN`/`JOIN`, usar `GROUP BY`, usar alias en nombres de tablas
   
