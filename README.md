# Instalación

Para instalar Laravel usar Composer.
Luego de eso, correr en terminal:
`composer update`
`composer install`
en la carpeta del proyecto.

# Uso
### Para acceder a las APIs desde el navegador:

`http://localhost:8000/api/<prefix>/<APIName>?<param>=<value>`
E.g.:
`http://localhost:8000/api/users/getAlumno?id=1`

Se puede usar ./routes/AppEndpoints.http como referencia.
