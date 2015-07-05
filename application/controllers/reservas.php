<?php

class reservas extends padre {

    public function __construct() {
        parent::__construct();
        $this->checkPermisos(array(0));
    }

    /**
     * la primera pantalla de reservas
     */
    function index() {
        $this->params["scripts"][] = "jquery.mask2.js";
        $this->params["scripts"][] = "jquery.formvalidator.min.js";
        $this->params["css"][] = site_url("less/index/reservas.css");
        $this->loadHTML("vreservas.php", $this->params);
    }

    /**
     * 
     */
    function prueba() {
        $this->loadHTML("vprueba", $this->params);
    }
    
    /**
     * el grid propiamente dicho
     */
    function getGrid() {
        $db = $this->db;
        $sql = "select a.*,(select b.tipo from hlm_roomtipo b where b.idroom=a.idroom order by b.fecinicio desc limit 1) as tipo from hlm_room a order by tipo";
        $res = $this->db->query($sql)->result();

        $nombredias = array("", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa", "Do");
        $fecha = $this->input->post("fechai", true); //fecha de inicio
        $display = $this->input->post("display", true); //x mes o dias
        $direccion = $this->input->post("direccion", true); //atras o adelante o refresh
        $objf = new DateTime(date("Y-m-d", $fecha));

        switch ($direccion) {
            case 0://refresh
                $fechai = $objf->format('Y-m-d');
                $nday = intval($objf->format("w"));
                $fechaf = $objf->add(date_interval_create_from_date_string('30 days'))->format('Y-m-d');
                break;
            case 1://adelante
                $fechai = $objf->add(date_interval_create_from_date_string('31 days'))->format('Y-m-d');
                $nday = intval($objf->format("w"));
                $fechaf = $objf->add(date_interval_create_from_date_string('61 days'))->format('Y-m-d');
                break;
            case -1://atras
                $fechai = $objf->sub(date_interval_create_from_date_string('31 days'))->format('Y-m-d');
                $nday = intval($objf->format("w"));
                $fechaf = $objf->sub(date_interval_create_from_date_string('1 days'))->format('Y-m-d');
                break;
        }
        $tf1 = explode("-", $fechai);
        $tf2 = explode("-", $fechaf);
        $dias = array();
        $i = $tf1[1];
        $z = $tf1[0];
        do {
            switch (intval($i)) {
                case intval($tf1[1]):
                    $d = intval($tf1[2]);
                    break;
                /* case intval($tf2[1]):
                  $d = intval($tf2[2]);
                  break; */
                default:
                    $d = 1;
            }
            for ($j = $d; $j <= $this->_ultimodia($tf1[0] . "-" . $i . "-" . $d) && count($dias) < 31; $j++) {
                $dias[$i . "_" . $j . "_" . $z] = $j;
                //$dias[$tf1[1] . "_" . $j] = $j;
            }
            $i++;
            if ($i == 13) {
                $i = 1;
                $z++;
            }
        } while ($i <= $tf2[1]);
        $aux1 = '';
        $aux2 = '';
        $fday = $nday;
        foreach ($dias as $k => $dd) {
            $aux1.='<td class="tcellcdia resth1" id="resth1_' . $i . '"></td>';
            $aux2.='<td class="tcellcdia resth2" id="resth2_' . $i . '" alt="' . $fday . '">' . $dias[$k] . '<br/>' . $nombredias[$fday] . '</td>';
            $fday++;
            if ($fday == 8) {
                $fday = 1;
            }
        }
        $cad = '';
        $cad.='<table border="1" cellpadding="0" cellspacing="0" border-color="#ccc">';
        $cad.='    <tr><td class="tcellcol1 resth1">Disponibles</td>' . $aux1 . '</tr>';
        $cad.='    <tr><td class="tcellcol1 resth2">Habitación</td>' . $aux2 . '</tr>';
        $sql = "select a.*,(select b.tipo from hlm_roomtipo b where b.idroom=a.idroom order by b.fecinicio desc limit 1) as tipo from hlm_room a order by tipo";
        $res = $this->db->query($sql)->result();
        $tipo = 0;
        $tipos = array("", "Simple", "Doble", "Triple", "Matrimonial");
        if (count($res) > 0)
            foreach ($res as $k => $r) {
                if ($tipo != $r->tipo) {
                    $tipo = $r->tipo;
                    $cad.='<tr><td class="tcellseparator" colspan="32">' . $tipos[$tipo] . '</td></tr>';
                }
                $cad.='<tr class="trowhab"><td class="tcellcol1">' . $r->numero . '</td>';
                $fday = $nday;
                foreach ($dias as $l => $dd) {
                    $cad.='<td class="tcellcdia' . ($fday > 5 ? " tcellfds" : "") . '" id="h_' . $r->numero . "_" . $tipo . "_" . $l . '"></td>';
                    $fday++;
                    if ($fday == 8) {
                        $fday = 1;
                    }
                }
                $cad.='</tr>';
            }
        $cad.='</table>';
        $fechai.=' 00:00:00';
        $fechaf.=' 23:59:59';
        $sql = "select a.*,b.numero from hlm_detroom a inner join hlm_room b on a.idroom=b.idroom where a.fecinicio between '$fechai' and '$fechaf' or a.fecfin between '$fechai' and '$fechaf'";
        $res = $this->db->query($sql)->result();
        $ubics = array();
        $pattern = "/(.[^-]*)\-(.[^-]*)\-(.[^ ]*) (.*)/";
        if (count($res) > 0)
            foreach ($res as $r) {
                $ubics[] = array($r->numero, preg_replace($pattern, "", $r->fecinicio), preg_replace($pattern, "", $r->fecfin));
            }
        $cad.='
            <script type="text/javascript">
                asignaciones=' . json_encode($ubics) . ';
            </script>';
        echo $cad;
    }

    /**
     * devuelve el ultimo del mes
     * @param string $fecha le fecha a partir de la cual se obtendrá el último dia del mes
     * @return int el ultimo dia del mes indicado
     */
    function _ultimodia($fecha) {
        $xfecha = explode("-", $fecha);
        $fecha = $xfecha[0] . "-" . $xfecha[1] . "-15";
        $obj = new DateTime($fecha);
        $fechai = $obj->add(date_interval_create_from_date_string('1 months'))->format('Y-m-1');
        $obj = new DateTime($fechai);
        $fechai = $obj->sub(date_interval_create_from_date_string('1 days'))->format('Y-m-d');
        $aux = explode("-", $fechai);
        return $aux[2];
    }

    /**
     * despliega el formulario de nuevo folio
     */
    function formReserva() {
        $this->loadHTML("vformreserva", $this->params, "", "");
    }

    /**
     * despliega el formulario de habitación
     */
    function getRoom() {
        $this->loadHTML("vformroom", $this->params, "", "");
    }

}

?>
