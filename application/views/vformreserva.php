<div id="contformfolio">
    <form id="frmfolio" method="post" action="#">
        <fieldset id="fsetfoliopagador">
            <legend>Cliente Pagador</legend>
            <div class="frow">
                <label for="fol1">Cliente</label>
                <input type="text" class="required" alt="Cliente" name="fol1" id="fol1" />
                <a target="_blank" href="<?=site_url("clientes")?>" id="addcli"></a>
                <div id="contcliente"></div>
            </div>
            <div class="frow">
                <label for="fol9">Grupo</label>
                <input type="text" class="posiblereq" alt="Grupo" name="fol9" id="fol9" />
            </div>
        </fieldset>
        <fieldset id="fsetfoliorooms">
            <legend>Habitaciones</legend>
            <div id="conthabitaciones">

            </div>
        </fieldset>
    </form>
</div>
<script type="text/javascript">
    //chekea si las habitaciones fueron llenadas correctamente
    deletecli=function(){
        $("#contcliente").html("");
    }
    $("#fol1").autocomplete({
        source:site_url("clientes/getAuto"),
        minLength:2,
        select:function(event,ui){
            if(ui.item){
                cad='';
                cad+='<div id="cliselected">';
                cad+='<div id="delcli" onclick="deletecli()"></div>';
                cad+='<a id="modcli" target="_blank" href="'+site_url("clientes/index/"+ui.item.id)+'"></a>';
                cad+='<span>'+ui.item.value+'</span>';
                cad+='<input type="hidden" id="idcli" value="'+ui.item.id+'" />';
                cad+='</div>';
                $("#contcliente").html(cad);
            }
        }
    });
    checkRooms=function(){
        if($(".iconesthab.mal").length>-1)
            return false;
        else
            return true;
    }
    $("#frmfolio").submit(function(){
        if($("#idcli").length==1){
            
            $.ajax({
                url:site_url("reservas/newfolio"),
                type:"POST",
                data:"idcli="+encodeURIComponent($("#idcli").val())+cuartos,
                success:function(data){
                    if(data.indexOf("okok")==-1){
                        //quiere decir que hubo un error
                        msgbox(data, 2);
                    }
                }
            })
        }
    })
</script>