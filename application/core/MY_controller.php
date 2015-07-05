<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of controller
 *
 * @author daniel
 */
class padre extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //$this->session->unset_userdata("hotellamolina");
    }

    public function checkPermisos($perms) {
        $usuario = $this->usuario->checkLogin("hotellamolina");
        $this->params["usuario"]=$usuario;
        //$this->session->unset_userdata("hotellamolina");
        if ($usuario) {
            if (!is_array($perms))
                $pp = array($perms);
            else
                $pp = $perms;
            if (in_array($usuario["accesos"], $pp))
                return true;
            else
                redirect(site_url());
        }
        else
            redirect(site_url());
    }

    public function loadHTML($page, $params=array(), $header="header", $footer="footer") {
        if (!$params)
            $params = array();
        $default = array(
            "sitename" => config_item("sitename"),
            "pagetitle" => config_item("pagetitle"),
            "sitedescription" => config_item("sitedescription"),
            "author" => config_item("author"),
            "owner" => config_item("owner"),
            "css" => array(
                "jquery-ui-1.8.17.custom.css",
            ),
            "scripts" => array(
                "jquery-1.7.1.min.js",
                "jquery-ui-1.8.17.custom.min.js",
            )
        );
        $cad = '';
        $params = array_merge_recursive($default, $params);
        //$params = $this->merge($default, $params);
        if ($header && trim($header) != "") {
            $cad.=$this->load->view($header, array("params" => $params), true);
        }
        $cad.=$this->load->view($page, array("params" => $params), true);
        if ($footer && trim($footer) != "") {
            $cad.=$this->load->view($footer, array("params" => $params), true);
        }
        echo $cad;
    }

    protected function merge($a, $b) {
        if (count($a) > 0) {
            foreach ($a as $key => $r) {
                if (isset($b[$key])) {
                    if (!is_array($a[$key]) || !is_array($b[$key])) {
                        $a[$key] = $b[$key];
                    } else {
                        $a[$key] = $this->merge($a[$key], $b[$key]);
                    }
                }
            }
        }
        if (count($b) > 0) {
            foreach ($b as $key => $r) {
                if (!is_array($a[$key]) || !is_array($b[$key]))
                    $a[$key] = $b[$key];
                else {
                    $a[$key] = $this->merge($a[$key], $b[$key]);
                }
            }
        }
        return $a;
    }

}

?>
