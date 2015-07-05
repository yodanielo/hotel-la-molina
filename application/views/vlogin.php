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
        <script type="text/javascript">siteurl="<?= site_url() ?>";</script>
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
    <body id="bodylogin">
        <div id="logincentro">
            <img id="bannersup" src="<?= site_url("application/images/toplogin.jpg") ?>"/>
            <div id="contform">
                <form id="frmlogin" action="<?=site_url("")?>" method="post">
                    <div class="frow">
                        <label for="Usuario">Usuario</label>
                        <input type="text" class="required" alt="Usuario" name="txt1" id="txt1" />
                    </div>
                    <div class="frow">
                        <label for="Contraseña">Contraseña</label>
                        <input type="password" class="required" alt="Contraseña" name="txt2" id="txt2" />
                    </div>
                    <div class="frow">
                        <input type="submit" class="" value="Entrar"/>
                    </div>
                </form>
                <script type="text/javascript">
<?php
if (isset($params["rpt"]) && $params["rpt"]==false) {
    ?>
            msgbox("Usuario o contraseña incorrectos", 1);
    <?php
}
?>
    $("#frmlogin").formValidator(function(a,b){
        if(a!=""){
            msgbox(a, 1)
        }
    },{
                        
    })
                </script>
            </div>
        </div>
    </body>
</html>