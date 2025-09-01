php
<?php
@session_start();

// --- SIMULACIÓN DE CLASE DE BASE DE DATOS ---
// --- ¡DEBES REEMPLAZAR ESTO CON TU CONEXIÓN REAL Y USAR SENTENCIAS PREPARADAS! ---
class Database {
    private static $instance = null;
    private $conn; // Aquí iría tu objeto de conexión (PDO, MySQLi)

    private function __construct() {
        // Simula la conexión - Reemplaza con tu lógica de conexión real
        // Ejemplo con PDO:
        // try {
        //     $dsn = "mysql:host=127.0.0.1;dbname=bd_restaurante;charset=utf8mb4";
        //     $this->conn = new PDO($dsn, "tu_usuario_bd", "tu_contraseña_bd", [
        //         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        //         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        //         PDO::ATTR_EMULATE_PREPARES => false,
        //     ]);
        //     echo "<!-- Conectado a bd_restaurante --> <br>";
        // } catch (PDOException $e) {
        //     // Manejar error de conexión apropiadamente
        //     die("Error de conexión a la BD: " . $e->getMessage());
        // }
        echo "<!-- Simulación: Conectado a bd_restaurante --> <br>";
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    // Método para consultas que devuelven resultados (SELECT)
    public function query($sql, $params = []) {
        echo "<!-- Simulación: Ejecutando Query: $sql con params: " . print_r($params, true) . " --> <br>";
        // En una implementación real con PDO:
        // $stmt = $this->conn->prepare($sql);
        // $stmt->execute($params);
        // return $stmt->fetchAll();

        // --- Datos de ejemplo para simulación (basados en tu estructura) ---
        if (strpos($sql, "SELECT MAX(no_egreso) as max_egreso FROM encabezado_egresos") !== false) {
            return [['max_egreso' => 50]]; // Ejemplo de último egreso
        }
        if (strpos($sql, "SELECT con_id, con_descripcion FROM concepto WHERE con_estado='Activo'") !== false) {
            return [
                ['con_id' => 2, 'con_descripcion' => 'Pago a terceros'],
                // Añade más conceptos activos si los tienes
            ];
        }
        if (strpos($sql, "SELECT fp_id, fp_descripcion FROM forma_pago WHERE fp_estado='Activo'") !== false) {
            return [
                ['fp_id' => 1, 'fp_descripcion' => 'Efectivo'],
                ['fp_id' => 2, 'fp_descripcion' => 'Transferencia'],
            ];
        }
        // Para terceros, combinamos clientes y usuarios como ejemplo
        if (strpos($sql, "SELECT cli_id as id, CONCAT(cli_nombre, ' ', cli_apellidos) as nombre, 'cliente' as tipo FROM cliente WHERE cli_estado='Activo'") !== false) {
            return [
                ['id' => 2, 'nombre' => 'Juan Galvis Osorio', 'tipo' => 'cliente'],
            ];
        }
        if (strpos($sql, "SELECT usu_id as id, CONCAT(usu_nombre, ' ', usu_apellido) as nombre, 'usuario' as tipo FROM usuario WHERE usu_estado='Activo'") !== false) {
             return [
                ['id' => 1234, 'nombre' => 'Admin ', 'tipo' => 'usuario'],
             ];
        }
        return [];
    }

    // Método para consultas que no devuelven resultados (INSERT, UPDATE, DELETE)
    public function execute($sql, $params = []) {
        echo "<!-- Simulación: Ejecutando Execute: $sql con params: " . print_r($params, true) . " --> <br>";
        // En una implementación real con PDO:
        // $stmt = $this->conn->prepare($sql);
        // return $stmt->execute($params); // Devuelve true en éxito
        return true; // Simula éxito
    }

    public function getLastInsertId() {
        // En una implementación real con PDO:
        // return $this->conn->lastInsertId();
        return rand(1, 1000); // Simula
    }

    // Si usas transacciones con PDO
    // public function beginTransaction() { $this->conn->beginTransaction(); }
    // public function commit() { $this->conn->commit(); }
    // public function rollBack() { $this->conn->rollBack(); }
}
// --- FIN DE SIMULACIÓN DE CLASE DE BASE DE DATOS ---

class EgresoController {

    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getCrearEgreso() {
        $siguienteNoEgreso = 1;
        $conceptos = [];
        $formasPago = [];
        $terceros = [];

        try {
            // 1. Obtener el siguiente número de egreso
            $resultMaxEgreso = $this->db->query("SELECT MAX(no_egreso) as max_egreso FROM encabezado_egresos");
            if (!empty($resultMaxEgreso) && $resultMaxEgreso[0]['max_egreso'] !== null) {
                $siguienteNoEgreso = intval($resultMaxEgreso[0]['max_egreso']) + 1;
            }

            // 2. Obtener conceptos activos
            $conceptos = $this->db->query("SELECT con_id, con_descripcion FROM concepto WHERE con_estado='Activo' ORDER BY con_descripcion");

            // 3. Obtener formas de pago activas
            $formasPago = $this->db->query("SELECT fp_id, fp_descripcion FROM forma_pago WHERE fp_estado='Activo' ORDER BY fp_descripcion");

            // 4. Obtener terceros (Clientes y Usuarios activos como ejemplo)
            // La vista deberá manejar cómo mostrar estos y qué valor enviar (ej. 'cliente-2' o 'usuario-1234')
            // o podrías tener un campo separado para el tipo de tercero.
            // Por simplicidad, aquí los juntamos. La `tercero_identificacion` en la BD es VARCHAR(15).
            $clientesActivos = $this->db->query("SELECT cli_id as id_tercero, CONCAT(cli_nombre, ' ', cli_apellidos, ' (Cliente)') as nombre_tercero FROM cliente WHERE cli_estado='Activo' ORDER BY nombre_tercero");
            $usuariosActivos = $this->db->query("SELECT usu_login as id_tercero, CONCAT(usu_nombre, ' ', usu_apellido, ' (Usuario)') as nombre_tercero FROM usuario WHERE usu_estado='Activo' ORDER BY nombre_tercero");

            $terceros = array_merge($clientesActivos, $usuariosActivos);
            // Podrías necesitar ordenar $terceros si es importante
            // usort($terceros, function($a, $b) { return strcmp($a['nombre_tercero'], $b['nombre_tercero']); });


        } catch (Exception $e) {
            error_log("Error en getCrearEgreso: " . $e->getMessage());
            $_SESSION['errores_egreso'] = ["Ocurrió un error al cargar los datos iniciales: " . $e->getMessage()];
            // Considera no continuar y mostrar un error fatal o redirigir a una página de error.
        }

        // Renombrar para que coincida con el ejemplo anterior si la vista ya usa $numDoc
        $numDoc = $siguienteNoEgreso;

        // Limpiar mensajes previos de la sesión para que no se muestren repetidamente
        $errores_previos = $_SESSION['errores_egreso'] ?? [];
        $datos_previos = $_SESSION['datos_formulario_egreso'] ?? [];
        $mensaje_exito = $_SESSION['mensaje_exito_egreso'] ?? null;

        unset($_SESSION['errores_egreso'], $_SESSION['datos_formulario_egreso'], $_SESSION['mensaje_exito_egreso']);


        // Pasar las variables a la vista.
        include_once '../view/Egreso/GuiCrearEgreso.php';
    }

    public function postGuardarEgreso() {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: index.php?action=crearEgreso"); // Ajusta la ruta si es necesario
            exit;
        }

        // 1. Recoger los datos del formulario
        $no_egreso = filter_input(INPUT_POST, 'no_egreso', FILTER_SANITIZE_NUMBER_INT);
        // fecha_documento se toma con CURRENT_TIMESTAMP() o la envías desde el form. Asumamos que se envía.
        $fecha_documento_str = filter_input(INPUT_POST, 'fecha_documento'); // Ej: YYYY-MM-DD
        $tercero_identificacion = filter_input(INPUT_POST, 'tercero_identificacion', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        $detalle = filter_input(INPUT_POST, 'detalle', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        $fp_id = filter_input(INPUT_POST, 'fp_id', FILTER_SANITIZE_NUMBER_INT);
        $conceptoEgreso_codigo = filter_input(INPUT_POST, 'conceptoEgreso_codigo', FILTER_SANITIZE_NUMBER_INT);
        $no_documento_referencia = filter_input(INPUT_POST, 'no_documento_referencia', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES); // El no_documento de la tabla
        $valor_egreso = filter_input(INPUT_POST, 'valor_egreso', FILTER_VALIDATE_FLOAT);

        // Asumimos que el login del usuario está en la sesión
        // Ajusta 'usu_login' si usas otra key en la sesión (ej. 'usuario_id' y luego buscas el login)
        $usu_crea = $_SESSION['usu_login'] ?? 'sistema'; // O manejar si no hay sesión

        $estado_egreso = 'Activo'; // Estado por defecto al crear

        // 2. Validar los datos
        $errores = [];
        if (empty($no_egreso)) {
            $errores[] = "El número de egreso es obligatorio.";
        }
        if (empty($fecha_documento_str) || !$this->validarFecha($fecha_documento_str)) {
            $errores[] = "La fecha del documento es obligatoria y debe tener un formato válido (YYYY-MM-DD).";
        }
        if (empty($tercero_identificacion)) {
            $errores[] = "Debe seleccionar o ingresar un tercero.";
        }
         if (strlen($tercero_identificacion) > 15) {
            $errores[] = "La identificación del tercero no puede exceder los 15 caracteres.";
        }
        if (empty($detalle)) {
            $errores[] = "El detalle es obligatorio.";
        }
        if (strlen($detalle) > 250) {
            $errores[] = "El detalle no puede exceder los 250 caracteres.";
        }
        if (empty($fp_id)) {
            $errores[] = "Debe seleccionar una forma de pago.";
        }
        if (empty($conceptoEgreso_codigo)) {
            $errores[] = "Debe seleccionar un concepto de egreso.";
        }
        if (empty($no_documento_referencia)) { // Puede ser opcional, ajusta si es necesario
            // $errores[] = "El número de documento de referencia es obligatorio.";
        }
         if (strlen($no_documento_referencia) > 15) {
            $errores[] = "El número de documento de referencia no puede exceder los 15 caracteres.";
        }
        if ($valor_egreso === false || $valor_egreso <= 0) {
            $errores[] = "El valor del egreso debe ser un número positivo.";
        }
        if (empty($usu_crea) || strlen($usu_crea) > 15) {
             $errores[] = "No se pudo identificar al usuario creador o excede el límite.";
        }


        if (!empty($errores)) {
            $_SESSION['errores_egreso'] = $errores;
            $_SESSION['datos_formulario_egreso'] = $_POST;
            header("Location: index.php?action=crearEgreso"); // Ajusta la ruta
            exit;
        }

        try {
            // $this->db->beginTransaction(); // Si tu BD lo soporta y quieres usar transacciones

            // Convertir fecha al formato de la BD si es necesario (TIMESTAMP espera YYYY-MM-DD HH:MM:SS)
            // Si tu campo `fecha_documento` es solo DATE, YYYY-MM-DD es suficiente.
            // Para TIMESTAMP, si solo tienes fecha, puedes añadir la hora actual:
            $fecha_documento_db = $fecha_documento_str . ' ' . date('H:i:s');
            // Si tu columna es DATE, simplemente: $fecha_documento_db = $fecha_documento_str;


            $sqlEgreso = "INSERT INTO encabezado_egresos
                            (no_egreso, fecha_documento, tercero_identificacion, detalle, fp_id, conceptoEgreso_codigo, no_documento, valor_egreso, usu_crea, estado)
                          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $paramsEgreso = [
                $no_egreso,
                $fecha_documento_db, // Usar la fecha formateada para DB
                $tercero_identificacion,
                $detalle,
                $fp_id,
                $conceptoEgreso_codigo,
                $no_documento_referencia,
                $valor_egreso,
                $usu_crea,
                $estado_egreso
            ];

            $exitoGuardado = $this->db->execute($sqlEgreso, $paramsEgreso);

            if (!$exitoGuardado) {
                throw new Exception("Error al guardar el encabezado del egreso.");
            }

            // Aquí no necesitamos actualizar un consecutivo separado si `no_egreso` se calcula antes.
            // Si `no_egreso` fuera autoincremental en la tabla `encabezado_egresos`,
            // no lo enviaríamos en el INSERT y lo obtendríamos con $this->db->getLastInsertId()
            // y no necesitaríamos calcularlo al principio.

            // $this->db->commit(); // Si usaste transacciones

            $_SESSION['mensaje_exito_egreso'] = "Comprobante de Egreso N° {$no_egreso} guardado exitosamente.";
            // Limpiar datos del formulario de la sesión tras éxito
            unset($_SESSION['datos_formulario_egreso']);
            header("Location: index.php?action=crearEgreso"); // O a una lista
            exit;

        } catch (Exception $e) {
            // $this->db->rollBack(); // Si usaste transacciones
            error_log("Error en postGuardarEgreso: " . $e->getMessage() . " --- SQL: " . ($sqlEgreso ?? 'No SQL') . " --- Params: " . print_r($paramsEgreso ?? [], true));
            $_SESSION['errores_egreso'] = ["Ocurrió un error grave al guardar el egreso: " . $e->getMessage()];
            $_SESSION['datos_formulario_egreso'] = $_POST; // Mantener datos para corregir
            header("Location: index.php?action=crearEgreso"); // Ajusta la ruta
            exit;
        }
    }

    private function validarFecha($date, $format = 'Y-m-d') {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }
}

// --- Lógica de Enrutamiento Simple (Ejemplo) ---
/*
// Asegúrate de que este archivo (o tu enrutador principal) define la sesión si no está iniciada.
// if (session_status() == PHP_SESSION_NONE) {
//     session_start();
// }

// Simulación de sesión de usuario para pruebas
// $_SESSION['usu_login'] = 'admin'; // Descomenta y ajusta para probar `usu_crea`

$action = $_GET['action'] ?? 'crearEgreso'; // Acción por defecto

$egresoController = new EgresoController();

switch ($action) {
    case 'crearEgreso':
        $egresoController->getCrearEgreso();
        break;
    case 'guardarEgreso':
        $egresoController->postGuardarEgreso();
        break;
    default:
        // Considera mostrar una página 404 o un mensaje más amigable
        echo "Acción no válida solicitada.";
        // header("HTTP/1.0 404 Not Found");
        // include '404.php'; // Si tienes una página de error 404
        break;
}
*/
?>
