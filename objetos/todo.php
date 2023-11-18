<?php
class Todo
{

    public $conn;
    private $table = "checklist";

    public $id;
    public $titulo;
    public $descripcion;
    public $estado;
    public $fecha;
    public $editado;
    public $responsable;
    public $tipo_tarea;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function get_por_hacer()
    {
        $query = 'SELECT * FROM checklist WHERE estado="Por Hacer"';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function get_en_progreso()
    {
        $query = 'SELECT * FROM checklist WHERE estado="En Progreso"';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function get_terminada()
    {
        $query = 'SELECT * FROM checklist WHERE estado="Terminada"';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function insert_new(){
        $query = "INSERT INTO " . $this->table . " SET titulo=:titulo, descripcion=:descripcion, estado=:estado, fecha=:fecha, responsable=:responsable, tipo_tarea=:tipo_tarea";

        $stmt = $this ->conn->prepare($query);

        $this->titulo = htmlspecialchars(strip_tags($this->titulo));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->estado = htmlspecialchars(strip_tags($this->estado));
        $this->fecha = htmlspecialchars(strip_tags($this->fecha));
        $this->responsable = htmlspecialchars(strip_tags($this->responsable));
        $this->tipo_tarea = htmlspecialchars(strip_tags($this->tipo_tarea));

        $stmt->bindParam(":titulo", $this->titulo);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":estado", $this->estado);
        $stmt->bindParam(":fecha", $this->fecha);
        $stmt->bindParam(":responsable", $this->responsable);
        $stmt->bindParam(":tipo_tarea", $this->tipo_tarea);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    public function edit(){
        $query = "UPDATE " . $this->table . " SET titulo=:titulo, descripcion=:descripcion, estado=:estado, fecha=:fecha, responsable=:responsable, tipo_tarea=:tipo_tarea , editado = 1
        WHERE id=:id";

        $stmt = $this ->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->titulo = htmlspecialchars(strip_tags($this->titulo));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->estado = htmlspecialchars(strip_tags($this->estado));
        $this->fecha = htmlspecialchars(strip_tags($this->fecha));
        $this->responsable = htmlspecialchars(strip_tags($this->responsable));
        $this->tipo_tarea = htmlspecialchars(strip_tags($this->tipo_tarea));

        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":titulo", $this->titulo);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":estado", $this->estado);
        $stmt->bindParam(":fecha", $this->fecha);
        $stmt->bindParam(":responsable", $this->responsable);
        $stmt->bindParam(":tipo_tarea", $this->tipo_tarea);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    public function delete(){
        $query = "DELETE FROM " . $this->table . " WHERE id=:id";

        $stmt = $this ->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":id", $this->id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }
}
