<?php
/**ARCHIVO QUE CONTIENE LA CLASE 'DB' Y SUS FUNCIONES PARA SER IMPORTADA
  Y USADA EN OTROS ARCHIVOS*/
class DB{

    protected $arreglo;
    protected $dbhost;
    protected $dbuser;
    protected $dbpass;
    protected $dbname;
    public $connect;

    public function connect(){
         $this->arreglo=(parse_ini_file('dbconfig.ini'));;
         $this->dbhost = $this->arreglo['dbhost'];
         $this->dbuser = $this->arreglo['dbuser'];
         $this->dbpass = $this->arreglo['dbpass'];
         $this->dbname = $this->arreglo['dbname'];

        $this->connect = new mysqli($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
        if ($this->connect->error){
            echo 'Error de conexión con el servidor';
        }//fin if
        else{
            //echo 'Conexión exitosa';
        }//fin else
    }//fin connect

    public function insquery($query){
        if ($this->connect->query($query) === TRUE){
            //echo 'Éxito';
        }//fin if
        else{
            echo 'Error: <br>' .  mysqli_error($this->connect);
        }//fin else
    }//fin exquery

    public function selquery($query){
      $result = $this->connect->query($query);
      if (!$result) {
          die('Error en la base de datos: ' . mysqli_error($this->connect));
        }else{
          return $result;
        }//fin else
    }//fin selquery

}//fin de la clase
?>
