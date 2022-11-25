# TPE-API

## Importar la base de datos
- importar base de datos DataBase/db_cafeteria.sql

###  RECURSOS
Actualmente están disponibles para consulta mediante nuestra API los siguientes recursos:

- productos
- categorias
- comentarios

###  PARAMETROS

- **order** especifica si los resultados se muestran en orden ascendente o descendente. Puede tomar solamente los valores *asc* y *desc*. Por defecto, los resultados se muestran desordenados. 


###  CONSUMO DE LA API
Están disponibles para su utilización en esta API los métodos GET, POST y DELETE. 

##### Metodo GET (http://localhost/TPE-API/api/recurso/:ID)

Al consultar los recursos con el método GET, obtendrá la siguiente información detallada de cada uno de ellos, 

Ejemplo de una consulta GET sobre el recurso ***categorias*** con id = 2 (http://localhost/TPE-API/api/categorias/2)
```
{
    "id": "2",
    "nombre": "Postres"
}
```

Ejemplo de una consulta GET sobre el recurso ***productos*** con id = 16 (http://localhost/TPE-API/api/productos/16)

```
{
    "nombre": "Te Negro",
    "precio": "50",
    "descripcion": "Lorem ipsum dolor sit amet consectetur adipiscing elit, curabitur phasellus odio lacus nunc tortor, sociosqu mus aliquet tempus curae quam.",
    "id": "16",
    "nombre_categoria": "Te"
}
```
```
Nota: En el caso de no especificar un id, se obtendrá la colección de recursos, según los parámetros opcionales especificados 
_(ver detalle de parámetros en punto anterior)_
```
Ejemplo de una consulta GET sobre el recurso ***comentarios*** de un producto con id = 16 (http://localhost/TPE-API/api/product/16/comment)

```
[
    {
        "id": "3",
        "comentario": "Muy Bueno!",
        "id_producto": "16"
    },
    {
        "id": "4",
        "comentario": "Exelente",
        "id_producto": "16"
    }
]
```
##### Metodo POST (http://localhost/TPE-API/api/recurso)

Para realizar una inserción de elemento con el método POST, se debe especificar la siguiente información en formato JSON, según el recurso correspondiente:

Ejemplo de método POST sobre el recurso ***categorias***.

```
{
    {"nombre": "Postres"}
}
```

Ejemplo de método POST sobre el recurso ***productos***.

```
{
        "nombre": "Te verde",
        "precio": "50",
        "id": "16",
        "categoria": "3"
    }
```
Ejemplo de método POST sobre el recurso ***comentarios***.(http://localhost/TPE-API/api/product/16/comment)


```
{
       "comentario": "Muy Bueno!"
    }
```


##### Metodo DELETE

La API permite la eliminación de un recurso, para lo cual se debe conocer el id del recurso a eliminar y especificalo en el endpoint. 

Ejemplo de método DELETE que elimina el registro id= 16 del recurso ***productos***.

```
http://localhost/TPE-API/api/products/16
```
Ejemplo de método DELETE que elimina el registro id= 16 del recurso ***categorias***.

```
http://localhost/TPE-API/api/categorias/3
```
```
Nota: En el caso de eliminar una categoria, se eliminaran los productos asignados a dicha categoria.
```
Ejemplo de método DELETE que elimina el registro id= 5 del recurso ***comentarios***.

```
http://localhost/TPE-API/api/comment/5
```
