# Tarea

## 1. PHP y MySQL

1. Define que es MySQL
1. Define y explica **cada una de las tres** `APIs` disponibles para conectarse a MySQL
1. Menciona ventajas y desventajas de cada una de las APIs o forma de conectarse a MySQL
1. Cuál de los tres métodos de conexión es el más recomendable y por qué

## 2. PHP-MySQL
5. Escribe un ejemplo de conexion válida a una base de datos MySQL usando **`PHP`** y **`MySQLi`**

## 3. Ejercicios SQL para 1/2 punto (0.5) extra en calificacion final:

Tenemos dos tablas SQL:

---

* `usuario`

  Tipo llave | Columna | Tipo dato
  -----------:|---------|----------
  **PK** | ***usuario*** | VARCHAR(20)
    | contrasena | VARCHAR(20)
    | nombre | VARCHAR(100)
    | email | VARCHAR(100)

* `articulo`

  Tipo llave | Columna | Tipo dato
  -----------:|---------|----------
  **PK** |id | INT NOT NULL AUTO_INCREMENT
  **FK** |***usuarioCrea*** | VARCHAR(20)
    | fechaCreacion | DATETIME
    | titulo | VARCHAR(200)
    | texto | VARCHAR(2000)
 
---

y el contenido de las tablas respectivamente es:

usuario | contrasena | nombre | email
---|---|---|---
steve|123|Steve Jobs|steve@apple.com
bill|456|Bill Gates|bill@microsoft.com
murray|678|Bill Murray|bill@hollywood.com

id | usuarioCrea | fechaCreacion | titulo | texto
---:|---|---|---|---
1 | steve | 2015-06-01 | demo |Lorem ipsum ad his blandit partiendo, eum...
2 | steve |2015-06-10 | alpha |Lorem ipsum ad his blandit partiendo, eum...
3 | bill |2015-05-20 | beta|Lorem ipsum ad his blandit partiendo, eum...
4 | murray | 2015-07-08| dia especial|Lorem ipsum ad his blandit partiendo, eum...
5 | steve | 2015-07-25| experiencias|Lorem ipsum ad his blandit partiendo, eum...
6 | bill | 2015-06-15 | tareas|Lorem ipsum ad his blandit partiendo, eum...
7 | murray | 2015-01-01| prueba|Lorem ipsum ad his blandit partiendo, eum...
8 | bill | 2015-01-18 | toc toc|Lorem ipsum ad his blandit partiendo, eum...

---

resuelve y contesta lo siguiente:

1. Qué valor regresa la siguiente sentencia SQL:
    ```sql
    SELECT COUNT(*) FROM articulo WHERE usuarioCrea = 'steve'
    ```
    
1. Qué valor regresa la siguiente sentencia SQL:
    ```sql
    SELECT MAX(id) FROM articulo WHERE usuarioCrea = 'murray'
    ```
    
1. Qué valor regresa la siguiente sentencia SQL:
    ```sql
    SELECT MIN(fechaCreacion) FROM articulo WHERE usuarioCrea = 'bill'
    ```

1. Usando `INNER JOIN` escribir sentencia SQL que recupere valores de las columnas
   de ambas tablas: nombre, email, fechaCreacion y titulo.
   
   El resultado del *query* tiene que ser parecido a:
  
   nombre | email | fechaCreacion | titulo
   -------|-------|---------------|-------
   steve jobs |steve@apple.com    |2015-01-01 |demo
   steve jobs |steve@apple.com    |2015-06-10 |alfa
   bill gates |bill@microsoft.com |2015-05-20 |beta
   ...|...|...|...
   
1. Escribir sentencia SQL que obtenga el `id` del **ultimo articulo** cuyo autor tenga el nombre `bill murray`.
Considerar que la consulta siempre debe regresar el `id` del ultimo articulo, este valor no va a ser fijo,
ya que según se vayan insertando registros nuevos a la tabla este `id` regresado por el query irá cambiando.
   
   Condiciones de la respuesta:
   1. debe ser un query combinado (subquerys)
   1. debes o puedes usar INNER JOIN. 
