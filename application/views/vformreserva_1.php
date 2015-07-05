<div id="contformfolio">
    <form id="frmfolio" method="post" action="#">
        <fieldset id="fsetfoliopagador">
            <legend>Cliente Pagador</legend>
            <div class="frow">
                <label for="fol1">Cod. Cliente</label>
                <input type="text" class="" alt="Cod. Cliente" name="fol1" id="fol1" />
                <div id="banderacli"></div>
            </div>
            <div class="frow">
                <label for="fol2">Persona</label>
                <select class="" alt="Persona" name="fol2" id="fol2">
                    <option value="0">Natural</option>
                    <option value="1">Jurídica</option>
                </select>
            </div>
            <div class="boxshuff boxpernatural">
                <div class="frow">
                    <label for="fol3">Nombres</label>
                    <input type="text" class="posiblereq" alt="Nombres" name="fol3" id="fol3" />
                </div>
                <div class="frow">
                    <label for="fol13">Apellidos</label>
                    <input type="text" class="posiblereq" alt="Apellidos" name="fol13" id="fol13" />
                </div>
                <div class="frow">
                    <label for="fol4">Tip. Doc</label>
                    <select class="" alt="Tip. Doc" name="fol4" id="fol4">
                        <option value="0">DNI</option>
                        <option value="1">Carnet de Extrangeria</option>
                        <option value="2">Lic. Conducir</option>
                    </select>
                </div>
                <div class="frow">
                    <label for="fol5">Num. Doc</label>
                    <input type="text" class="posiblereq" alt="Num. Doc" name="fol5" id="fol5" />
                </div>
                <div class="frow">
                    <label for="fol6">Telefono</label>
                    <input type="text" class="posiblereq" alt="Telefono" name="fol6" id="fol6" />
                </div>
                <div class="frow">
                    <label for="fol7">Dirección</label>
                    <input type="text" class="posiblereq" alt="Dirección" name="fol7" id="fol7" />
                </div>
                <div class="frow">
                    <label for="fol8">Residencia</label>
                    <select class="" alt="Residencia" name="fol8" id="fol8">
                        <option value="0">Local</option>
                        <option value="1">Nacional</option>
                        <option value="2">Extrangero</option>
                    </select>
                </div>
                <div class="frow">
                    <label for="fol9">Clasificación</label>
                    <select class="" alt="Clasificación" name="fol9" id="fol9">
                        <option value="">Grupo Nacional</option>
                        <option value="">Empresa</option>
                        <option value="">Turista Extrangero</option>
                        <option value="">Turista Nacional</option>
                        <option value="">Turista Local</option>
                    </select>
                </div>
            </div>
            <div class="boxshuff boxperjuridica" style="display:none;">
                <div class="frow">
                    <label for="fol10">Razón Social</label>
                    <input type="text" class="posiblereq" alt="Razón Social" name="fol10" id="fol10" />
                </div>
                <div class="frow">
                    <label for="fol11">RUC</label>
                    <input type="text" class="posiblereq" alt="RUC" name="fol11" id="fol11" />
                </div>
                <div class="frow">
                    <label for="fol12">Contacto</label>
                    <input type="text" class="posiblereq" alt="Nombre del Contacto" name="fol12" id="fol12" />
                </div>
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
    $("#fol2").change(function(){
        if($(this).val()==0){
            $(".boxpernatural").slideDown(450, function(){});
            $(".boxperjuridica").slideUp(450, function(){});
        }
        if($(this).val()==1){
            $(".boxpernatural").slideUp(450, function(){});
            $(".boxperjuridica").slideDown(450, function(){});
        }
        $(".posiblereq").val("");
        $("#fol1").val("");
    })
    $("#fol2").val("0");
    //para buscar el codigo de cliente
    $("#fsetfoliopagador #fol1").blur(function(){
        $("#fsetfoliopagador #banderacli").addClass("bwait");
        datos='';
        if($("#fol1").val()!="")
            datos+='&id='+encodeURIComponent($("#fol1").val());
        if($("#fol3").val()!="" && $("#fol13").val()){
            datos+='&nombre='+encodeURIComponent($("#fol3").val());
            datos+='&apellidos='+encodeURIComponent($("#fol13").val());
        }
        if($("#fol5").val()!="")
            datos+='&tipdoc='+encodeURIComponent($("#fol4").val())+"&numdoc="+encodeURIComponent($("#fol5").val());
        if(datos!=""){
            datos=datos.toString().substr(1);
            $.ajax({
                url:site_url("reservas/searchCli"),
                data:datos,
                success:function(data){
                    //aqui el codigo para buscar un cliente
                    $("#fsetfoliopagador #banderacli").removeClass("bwait");
                }
            })
        }
        else
            $("#fsetfoliopagador #banderacli").removeClass("bwait");
    })
    //chekea si las habitaciones fueron llenadas correctamente
    checkRooms=function(){
        if($(".iconesthab.mal").length>-1)
            return false;
        else
            return true;
    }
    $("#frmfolio").formValidator(function(a,b){
        if(a!=""){
            
        }
    },{

    })
</script>