# jquerydbPlantilla

## Descripción
jquerydbPlantilla es un proyecto que proporciona una estructura base para desarrollar aplicaciones web con jQuery que interactúan con bases de datos. La plantilla facilita la implementación de operaciones CRUD (Crear, Leer, Actualizar, Eliminar) utilizando AJAX para comunicarse con un backend basado en PHP y MySQL/MariaDB.

## Características principales
- Implementación completa de CRUD mediante jQuery y AJAX
- Interfaz de usuario responsive y amigable
- Validación de formularios en el lado del cliente
- Gestión asíncrona de datos sin recarga de página
- Estructura modular para facilitar la extensión y el mantenimiento
- Panel de administración básico para gestionar registros

## Tecnologías utilizadas
- Frontend:
  - HTML5
  - CSS3 (con Bootstrap para responsive design)
  - JavaScript
  - jQuery (para manipulación del DOM y peticiones AJAX)
- Backend:
  - PHP (para APIs REST)
  - MySQL/MariaDB (base de datos relacional)

## Requisitos previos
- Servidor web (Apache, Nginx, etc.)
- PHP 7.0 o superior
- MySQL 5.7 o superior / MariaDB 10.0 o superior
- Navegador web moderno con JavaScript habilitado

## Instalación
1. Clona el repositorio:
   ```
   git clone https://github.com/jsersan/jquerydbPlantilla.git
   ```

2. Configura la conexión a la base de datos:
   - Abre el archivo `config/database.php`
   - Edita los parámetros de conexión:
     ```php
     define('DB_HOST', 'localhost');     // Servidor de base de datos
     define('DB_USER', 'usuario');       // Usuario de base de datos
     define('DB_PASS', 'contraseña');    // Contraseña de base de datos
     define('DB_NAME', 'nombre_db');     // Nombre de la base de datos
     ```

3. Importa la estructura de la base de datos:
   - Localiza el archivo SQL en la carpeta `db/`
   - Importa este archivo a tu servidor MySQL/MariaDB usando phpMyAdmin o el cliente MySQL

4. Configura tu servidor web:
   - Asegúrate de que la carpeta del proyecto sea accesible por tu servidor web
   - Configura los permisos adecuados (generalmente 755 para carpetas y 644 para archivos)

5. Accede a la aplicación a través de tu navegador:
   ```
   http://localhost/jquerydbPlantilla/
   ```

## Estructura del proyecto
```
jquerydbPlantilla/
│
├── assets/
│   ├── css/              # Hojas de estilo CSS
│   │   ├── bootstrap.min.css
│   │   └── styles.css    # Estilos personalizados
│   │
│   ├── js/               # Archivos JavaScript
│   │   ├── jquery.min.js
│   │   ├── bootstrap.min.js
│   │   └── app.js        # Funcionalidades principales
│   │
│   └── img/              # Imágenes e iconos
│
├── api/                  # Endpoints para operaciones CRUD
│   ├── create.php        # Crear nuevos registros
│   ├── read.php          # Leer registros existentes
│   ├── update.php        # Actualizar registros
│   └── delete.php        # Eliminar registros
│
├── config/               # Configuración de la aplicación
│   └── database.php      # Configuración de la base de datos
│
├── db/                   # Scripts SQL y schema
│   └── database.sql      # Estructura inicial de la BD
│
├── includes/             # Componentes PHP compartidos
│   ├── header.php        # Cabecera de la aplicación
│   ├── footer.php        # Pie de página
│   └── functions.php     # Funciones auxiliares
│
├── index.html            # Página principal
├── .htaccess             # Configuración de Apache
└── README.md             # Este archivo
```

## Uso básico

### Listar registros
La página principal (`index.html`) muestra una tabla con todos los registros existentes en la base de datos. Los datos se cargan automáticamente mediante AJAX al iniciar la página.

### Crear un nuevo registro
1. Haz clic en el botón "Nuevo Registro"
2. Completa el formulario con los datos requeridos
3. Haz clic en "Guardar"
4. El nuevo registro se añadirá a la tabla sin recargar la página

### Editar un registro existente
1. Haz clic en el icono de edición (lápiz) junto al registro que deseas modificar
2. Actualiza los campos necesarios en el formulario
3. Haz clic en "Actualizar"
4. Los cambios se reflejarán inmediatamente en la tabla

### Eliminar un registro
1. Haz clic en el icono de eliminación (papelera) junto al registro
2. Confirma la eliminación en el cuadro de diálogo
3. El registro se eliminará de la base de datos y desaparecerá de la tabla

### Buscar registros
1. Introduce el término de búsqueda en el campo de búsqueda
2. Los resultados se filtrarán automáticamente mientras escribes

## Ejemplos de código

### Conexión a la base de datos (PHP)
```php
<?php
// Archivo: config/database.php
class Database {
    private $host = "localhost";
    private $username = "usuario_db";
    private $password = "contraseña_db";
    private $db_name = "nombre_db";
    public $conn;
    
    // Obtener la conexión a la base de datos
    public function getConnection() {
        $this->conn = null;
        
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }
        
        return $this->conn;
    }
}
?>
```

### Petición AJAX para cargar datos (JavaScript/jQuery)
```javascript
// Archivo: assets/js/app.js
$(document).ready(function() {
    // Cargar registros al iniciar la página
    loadRecords();
    
    // Función para cargar registros
    function loadRecords() {
        $.ajax({
            url: "api/read.php",
            type: "GET",
            dataType: "json",
            success: function(data) {
                let html = "";
                if (data.records) {
                    $.each(data.records, function(key, record) {
                        html += "<tr>";
                        html += "<td>" + record.id + "</td>";
                        html += "<td>" + record.nombre + "</td>";
                        html += "<td>" + record.descripcion + "</td>";
                        html += "<td>";
                        html += "<button class='btn btn-sm btn-edit' data-id='" + record.id + "'><i class='fa fa-pencil'></i></button> ";
                        html += "<button class='btn btn-sm btn-delete' data-id='" + record.id + "'><i class='fa fa-trash'></i></button>";
                        html += "</td>";
                        html += "</tr>";
                    });
                }
                $("#records-table tbody").html(html);
            },
            error: function() {
                alert("Error al cargar los datos");
            }
        });
    }
});
```

### API para crear un registro (PHP)
```php
<?php
// Archivo: api/create.php
// Encabezados requeridos
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Incluir archivos de conexión y modelo
include_once '../config/database.php';
include_once '../includes/functions.php';

// Instanciar la base de datos y el objeto
$database = new Database();
$db = $database->getConnection();

// Obtener los datos enviados
$data = json_decode(file_get_contents("php://input"));

// Validar datos
if(!empty($data->nombre) && !empty($data->descripcion)) {
    // Sanitizar entrada
    $nombre = sanitizeInput($data->nombre);
    $descripcion = sanitizeInput($data->descripcion);
    
    // Query para insertar
    $query = "INSERT INTO items (nombre, descripcion) VALUES (?, ?)";
    $stmt = $db->prepare($query);
    
    // Ejecutar consulta
    if($stmt->execute([$nombre, $descripcion])) {
        // Respuesta exitosa
        http_response_code(201);
        echo json_encode(array("message" => "Registro creado correctamente."));
    } else {
        // Error en la consulta
        http_response_code(503);
        echo json_encode(array("message" => "No se pudo crear el registro."));
    }
} else {
    // Datos incompletos
    http_response_code(400);
    echo json_encode(array("message" => "No se puede crear el registro. Datos incompletos."));
}
?>
```

## Personalización

### Cambiar el nombre de la tabla
1. Abre los archivos en la carpeta `api/`
2. Busca todas las referencias a `items` y cámbialas por el nombre de tu tabla

### Modificar los campos
1. Actualiza la estructura de la base de datos en `db/database.sql`
2. Modifica los formularios HTML en `index.html`
3. Actualiza las consultas SQL en los archivos de la carpeta `api/`
4. Modifica las funciones JavaScript en `assets/js/app.js`

### Cambiar el aspecto visual
1. Personaliza los estilos en `assets/css/styles.css`
2. Modifica la estructura HTML en `index.html` y en los archivos de `includes/`

## Seguridad
- La plantilla incluye sanitización básica de entradas para prevenir inyección SQL
- Utiliza consultas preparadas para todas las operaciones de base de datos
- Se recomienda implementar autenticación y autorización en un entorno de producción

## Limitaciones y consideraciones
- Esta plantilla está pensada como punto de partida para desarrollo, no como una solución completa para producción
- No incluye manejo de sesiones ni autenticación de usuarios
- Se recomienda implementar validaciones adicionales en el servidor
- Para aplicaciones de producción, considere implementar HTTPS

## Solución de problemas
- **Error de conexión a la base de datos**: Verifica los parámetros en `config/database.php`
- **Las peticiones AJAX fallan**: Asegúrate de que el servidor web pueda procesar PHP
- **Error 404 en las peticiones API**: Verifica la configuración de `.htaccess` y la estructura de carpetas

## Contribuir
Si deseas contribuir a este proyecto:
1. Haz un fork del repositorio
2. Crea una rama para tu funcionalidad (`git checkout -b feature/nueva-funcionalidad`)
3. Haz commit de tus cambios (`git commit -am 'Añade nueva funcionalidad'`)
4. Haz push a la rama (`git push origin feature/nueva-funcionalidad`)
5. Crea un Pull Request

## Licencia
Este proyecto está bajo la Licencia MIT - ver el archivo LICENSE para más detalles.

## Autor
- [jsersan](https://github.com/jsersan)

## Contacto
Para preguntas, sugerencias o contribuciones, por favor abre un issue en el repositorio de GitHub.

---
⭐ Si te ha resultado útil este proyecto, ¡no olvides darle una estrella en GitHub! ⭐
