<?php

class usuario extends CI_Model {

    function checkLogin() {
        $x = $this->session->userdata('hotellamolina');
        if ($x)
            return $x;
        else
            return false;
    }

    function setLogin($u, $p) {
        $db = $this->db;
        $sql = "select idusuario,nombre, apellidos, username, accesos from hlm_usuario where username='" . mysql_escape_string($u) . "' and pass=md5('" . mysql_escape_string($p) . "')";
        $x = $db->query($sql)->result_array();
        print_r($x);
        if (count($x) == 1) {
            $this->session->set_userdata("hotellamolina",$x[0]);
            return $x[0];
        }
        else
            return false;
    }

}

?>
