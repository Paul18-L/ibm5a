<!DOCTYPE html>
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// En TelefonoController.php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ibm5a/config/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ibm5a/app/models/Telefono.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/ibm5a/app/models/Persona.php';
class TelefonoController {
    private $telefono;
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->telefono = new Telefono($this->db);
        $this->persona = new Persona($this->db);
    }

    // Mostrar todos los teléfonos
    public function index() {
        $telefonos = $this->telefono->read1();
        require_once '../app/views/telefono/index.php';
    }

    lista_personas = [persona1, persona2, persona3, persona4]

    # 2. Crear algunos teléfonos de ejemplo
    telefono1 = Telefono("123-456-7890")
    telefono2 = Telefono("987-654-3210")
    telefono3 = Telefono("555-123-4567")
    telefono4 = Telefono("777-888-9999")
    telefono5 = Telefono("111-222-3333")

    lista_telefonos = [telefono1, telefono2, telefono3, telefono4, telefono5]

    print("--- Bienvenido al Gestor de Personas y Teléfonos ---")

    while True:
        print("\n" + "="*40)
        print("Menú Principal:")
        print("1. Ver lista de Personas")
        print("2. Ver lista de Teléfonos")
        print("3. Asignar Teléfono a Persona")
        print("4. Crear nueva Persona")
        print("5. Crear nuevo Teléfono")
        print("6. Salir")
        print("="*40)

        opcion = input("Elige una opción: ")

        if opcion == '1':
            print("\n--- Lista de Personas ---")
            if not lista_personas:
                print("No hay personas registradas.")
            for i, persona in enumerate(lista_personas):
                print(f"{i+1}. {persona}")
        
        elif opcion == '2':
            print("\n--- Lista de Teléfonos ---")
            if not lista_telefonos:
                print("No hay teléfonos registrados.")
            for i, tel in enumerate(lista_telefonos):
                print(f"{i+1}. {tel}")

        elif opcion == '3':
            print("\n--- Asignar Teléfono ---")
            if not lista_personas:
                print("No hay personas para asignar un teléfono. Crea una primero.")
                continue
            if not any(tel.propietario is None for tel in lista_telefonos):
                print("No hay teléfonos disponibles para asignar. Crea uno nuevo o libera uno existente.")
                continue

            print("\nPersonas disponibles para asignar un teléfono:")
            personas_sin_telefono = [p for p in lista_personas if p.telefono_asignado is None]
            personas_con_telefono = [p for p in lista_personas if p.telefono_asignado is not None]

            if not personas_sin_telefono and not personas_con_telefono:
                print("No hay personas registradas.")
                continue

            for i, persona in enumerate(personas_sin_telefono):
                print(f"{i+1}. {persona.nombre} (Sin teléfono)")
            if personas_con_telefono:
                print("\nPersonas con teléfono (se puede reasignar):")
                offset = len(personas_sin_telefono)
                for i, persona in enumerate(personas_con_telefono):
                    print(f"{offset + i + 1}. {persona.nombre} (Teléfono actual: {persona.telefono_asignado.numero})")
            
            todas_las_personas_asignables = personas_sin_telefono + personas_con_telefono


            try:
                eleccion_persona_idx = int(input("Elige el número de la persona: ")) - 1
                if not (0 <= eleccion_persona_idx < len(todas_las_personas_asignables)):
                    print("Opción de persona no válida.")
                    continue
                persona_seleccionada = todas_las_personas_asignables[eleccion_persona_idx]

                print("\nTeléfonos disponibles para asignar:")
                telefonos_sin_propietario = [t for t in lista_telefonos if t.propietario is None]
                if not telefonos_sin_propietario:
                    print("No hay teléfonos disponibles para asignar.")
                    continue
                
                for i, tel in enumerate(telefonos_sin_propietario):
                    print(f"{i+1}. {tel.numero}")

                eleccion_telefono_idx = int(input("Elige el número del teléfono a asignar: ")) - 1
                if not (0 <= eleccion_telefono_idx < len(telefonos_sin_propietario)):
                    print("Opción de teléfono no válida.")
                    continue
                
                telefono_seleccionado = telefonos_sin_propietario[eleccion_telefono_idx]
                telefono_seleccionado.asignar_propietario(persona_seleccionada)

            except ValueError:
                print("Entrada no válida. Por favor, ingresa un número.")
            except IndexError:
                print("Selección fuera de rango. Por favor, elige un número válido.")
        
        elif opcion == '4':
            print("\n--- Crear Nueva Persona ---")
            nombre = input("Ingresa el nombre de la nueva persona: ")
            try:
                edad = int(input("Ingresa la edad de la nueva persona: "))
                nueva_persona = Persona(nombre, edad)
                lista_personas.append(nueva_persona)
                print(f"✅ Persona '{nombre}' creada exitosamente.")
            except ValueError:
                print("❌ Edad no válida. Por favor, ingresa un número.")

        elif opcion == '5':
            print("\n--- Crear Nuevo Teléfono ---")
            numero = input("Ingresa el número del nuevo teléfono (ej. 123-456-7890): ")
            # Opcional: podrías añadir validación para el formato del número
            nuevo_telefono = Telefono(numero)
            lista_telefonos.append(nuevo_telefono)
            print(f"✅ Teléfono '{numero}' creado exitosamente.")

        elif opcion == '6':
            print("¡Hasta luego!")
            break
        
        else:
            print("Opción no válida. Por favor, elige una opción del 1 al 6.")




    public function createForm() {


        $personas = $this->persona->read();
        require_once '../app/views/telefono/create.php';
    }





    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo "Formulario recibido";
            if (isset($_POST['numero'])) {
                $this->telefono->idpersona = $_POST['idpersona'];
                $this->telefono->numero = $_POST['numero'];
                if ($this->telefono->create()) {
                    echo "Teléfono creado exitosamente";
                } else {
                    echo "Error al crear el teléfono";
                }
            } else {
                echo "Faltan datos";
            }
        } else {
            echo "Método incorrecto";
        }
        die();
    }

    public function edit($idtelefono) {
        $this->telefono->idtelefono = $idtelefono;
        $telefono = $this->telefono->readOne();
        $personas = $this->persona->read();

        if (!$telefono) {
            die("Error: No se encontró el registro.");
        }

        require_once '../app/views/telefono/edit.php';
    }

    public function eliminar($id) {
        $this->telefono->idtelefono = $idtelefono;
        $telefono = $this->telefono->readOne();

        if (!$telefono) {
            die("Error: No se encontró el registro.");
        }

        require_once '../app/views/telefono/delete.php';
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo "Formulario recibido";
            if (isset($_POST['numero'])) {
                $this->telefono->idpersona = $_POST['idpersona'];
                $this->telefono->numero = $_POST['numero'];
                $this->telefono->idtelefono = $_POST['idtelefono'];
                if ($this->telefono->update()) {
                    echo "Teléfono actualizado exitosamente";
                } else {
                    echo "Error al actualizar el teléfono";
                }
            } else {
                echo "Faltan datos";
            }
        } else {
            echo "Método incorrecto";
        }
        die();
    }

    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['id'])) {
                $this->telefono->id = $_POST['id'];
                if ($this->telefono->delete()) {
                    echo "Teléfono borrado exitosamente";
                    die();
                    header('Location: index.php?msg=deleted');
                    exit;
                } else {
                    header('Location: index.php?msg=error');
                    exit;
                }
            } else {
                echo "Faltan datos";
            }
        } else {
            echo "Método incorrecto";
        }
        die();
    }

public function api() {

        while (ob_get_level()) {
            ob_end_clean();
        }
        $telefonos = $this->telefono->getAll();
        header('Content-Type: application/json');
        echo json_encode($telefonos);
        exit;
    }









}

// Manejo de la acción en la URL
if (isset($_GET['action'])) {
    $controller = new TelefonoController();

    echo "hola";
    switch ($_GET['action']) {
        case 'createForm':
            $controller->createForm();
            break;
 
        case 'create':
            $controller->create();
            break;
        case 'update':
            $controller->update();
            break;
        case 'delete':
            $controller->delete();
            break;

         case 'api':

            $controller->api();
            break;



        default:
            echo "Acción no válida.";
            break;
    }
} else {
 //  echo "No se especificó ninguna acción.";
}
?>
