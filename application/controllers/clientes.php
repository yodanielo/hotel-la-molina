<?php

class clientes extends padre{
    public function __construct() {
        parent::__construct();
    }
    /**
     * devuelve un JSON con las coincidencias de una busqueda de clientes
     */
    function getAuto() {
        $s=mysql_escape_string($this->input->get('term',true));
        $db=$this->db;
        $sql="select idpersona as id, concat(nombre,' ',apellidos) as value from hlm_pernatural where lcase(concat(nombre,' ',apellidos)) like lcase('%$s%') union
              select idpersona, razsocial from hlm_perjuridica where razsocial like '%$s%' limit 5";
        $res=$db->query($sql)->result_array();
        echo json_encode($res);
    }
}

?>
