<?php
$usuario = $this->session->userdata("hotellamolina");
$tripas = explode("/", uri_string());
?>
<div id="barrasec">
    <form>
        Desde <span id="fecinicio"><?= date("d-m-Y") ?></span>&nbsp;a&nbsp;<span id="fecfin"></span>&nbsp;|&nbsp;Ver por 
        <span id="radio">
            <input type="radio" id="radio1" name="radio" value="mes" checked="checked" /><label for="radio1">Mes</label>
            <input type="radio" id="radio2" name="radio" value="dia" /><label for="radio2">Día</label>
        </span>
        &nbsp;|&nbsp;
        <span id="navegador">
            <a href="#" id="btnatras" class="<?= ($usuario["hist"] == 0 ? "unabled" : "") ?>">&lt;&lt;Atras</a>&nbsp;&nbsp;
            <a href="#" id="btnadelante" class="">Adelante&gt;&gt;</a>
        </span>
    </form>
</div>
<div id="tablares"></div>
<script type="text/javascript">
    fechai='<?= mktime(0, 0, 0, date('m'), date('d'), date('Y')) ?>';
    sitepath='<?= site_url("") ?>';
    calendarsettings={
<?= ($usuario["hist"] == 0 ? "'minDate': 0" : "") ?>
    }
</script>
<script type="text/javascript" src="<?= site_url("application/js/reservas.js") ?>"></script>
