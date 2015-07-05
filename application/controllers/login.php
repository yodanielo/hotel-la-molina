<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends padre {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index() {
        if ($_POST["txt1"] && $_POST["txt2"]) {
            $this->params["rpt"]=$this->usuario->setLogin($_POST["txt1"],$_POST["txt2"]);
        }
        if ($this->usuario->checkLogin() !== false){
            switch($this->params["rpt"]["accesos"]){
                case 0:
                    redirect("reservas");
                    break;
                case 1:
                    break;
                case 2:
                    break;
            }
                
        }
        else {
            $this->params["scripts"][] = "jquery.formvalidator.min.js";
            $this->loadHTML("vlogin", $this->params, "", "");
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */