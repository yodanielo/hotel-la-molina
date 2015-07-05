<?php
$usuario = $this->session->userdata("hotellamolina");
$tripas = explode("/", uri_string());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo ($params["pagetitle"] ? $params["pagetitle"] . " | " : "") . $params["sitename"]; ?></title>
        <meta name="Description" content="<?php echo $params["sitedescription"]; ?>" />
        <meta name="author" content="<?php echo $params["author"]; ?>" />
        <meta name="owner" content="<?php echo $params["owner"]; ?>" />
        <meta name="robots" content="index, follow" />
        <link rel="icon" href="" type="image/x-icon" />
        <?php
        if (count($params["css"]) > 0) {
            foreach ($params["css"] as $key => $sc) {
                if (substr($sc, 0, 7) == "http://" || substr($sc, 0, 8) == "https://")
                    echo '<link rel="stylesheet" type="text/css" href="' . $sc . '" />' . "\n";
                else
                    echo '<link rel="stylesheet" type="text/css" href="' . site_url('application/css/' . $sc) . '" />' . "\n";
            }
        }
        ?>
        <link rel="stylesheet" type="text/css" href="<?= site_url("less/index/nav.css") ?>" />
        <script type="text/javascript">appPath="<?= site_url() ?>";</script>
        <?php
        if (count($params["scripts"]) > 0) {
            foreach ($params["scripts"] as $key => $sc) {
                if (substr($sc, 0, 7) == "http://" || substr($sc, 0, 8) == "https://")
                    echo '<script type="text/javascript" src="' . $sc . '"></script>' . "\n";
                else
                    echo '<script type="text/javascript" src="' . site_url('application/js/' . $sc) . '"></script>' . "\n";
            }
        }
        ?>

        <script type="text/javascript" src="<?= site_url("application/js/generales.js") ?>"></script>
    </head>
    <body id="bodydentro">
        <div style="display:none;">
            <div id="boxalert"></div>
            <a id="linkalert" title="Alerta" href="#boxalert"></a>
        </div>
        <div id="wrapper">
            <div id="wcol1">
                <div id="c1antesde"></div>
                <div id="c1durante">
                    <div class="titlemodulo">Módulos</div>
                    <div class="cuerpomodulo">
                        <ul id="menu1">
                            <li class="<?= ($tripas[0] == "reservas" ? "active " : "") ?>"><a href="<?= site_url("inicio") ?>">Reservaciones</a></li>
                            <li class="<?= ($tripas[0] == "checkin" ? "active " : "") ?>"><a href="<?= site_url("checkin") ?>">Check-In</a></li>
                            <li class="<?= ($tripas[0] == "checkout" ? "active " : "") ?>"><a href="<?= site_url("checkout") ?>">check-out</a></li>
                            <li class="<?= ($tripas[0] == "caja" ? "active " : "") ?>"><a href="<?= site_url("caja") ?>">Caja</a></li>
                            <li class="<?= ($tripas[0] == "reportes/rpt1" ? "active " : "") ?>"><a href="<?= site_url("reportes") ?>">Reportes</a>
                                <ul>
                                    <li class="<?= ($tripas[0] == "reportes" && $tripas[1]=="rpt1" ? "active " : "") ?>"><a href="<?= site_url("reportes/rpt1") ?>">Reportes</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="c1despuesde"></div>
            </div>
            <div id="wcol2">
                <div id="barraapp"><div id="maintitle">Hotel La Molina</div></div>