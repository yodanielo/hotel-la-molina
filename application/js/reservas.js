startEngine=function(){
    //asigna la posibilidad de seleccion
    scx1=0;
    scy1=0;
    scx2=0;
    scy2=0;
    srx1=0;
    sry1=0;
    srx2=0;
    sry2=0;
    sc=0;
    $(".tcellcdia").click(function(){
        if(!$(this).hasClass("cellres") && !$(this).hasClass("cellbusy") && !$(this).hasClass("cellmtto")){
            if(sc==0){//primer click
                sc=1;
                scx1=$(this).parent().find(".tcellcdia").index($(this));
                scy1=$(this).parent().parent().find(".trowhab").index($(this).parent());
            }
            else{//segundo click
                sc=0;
                //es cuando la reserva se va hacer, se deben reconocer las fechas 
                //y asignarlas a las reservas
                displayForm({
                    path:"reservas/formReserva",
                    title:"Nueva Reservación",
                    buttons:{
                        "Depósito":function(){
                            
                        },
                        "Guardar":function(){
                            
                        },
                        "Cancelar":function(){
                            $(this).dialog("close");
                        }
                    }
                }, function(obj){
                    //before display
                    tipos=new Array("", "Simple","Doble","Triple","Matrimonial")
                    $(".trowhab").each(function(){
                        if($(this).find(".sccell").length>0){
                            id1=$(this).find(".sccell:first").attr("id").split("_");
                            id2=$(this).find(".sccell:last").attr("id").split("_");
                            cad='';
                            cad+='<div class="itemhab" id="hab'+id1[1]+'">';
                            cad+='<div class="iconesthab mal"></div>';
                            cad+='<span class="titlehabitem">'+id1[1]+'-'+tipos[id1[2]]+"</span><br/>";
                            //m-d-y
                            cad+='D:&nbsp;<span class="ihf1">'+id1[4]+"-"+id1[3]+"-"+id1[5]+'</span>&nbsp;&nbsp;&nbsp;&nbsp;H:&nbsp;<span class="ihf2">'+id2[4]+"-"+id2[3]+"-"+id2[5]+"</span>";
                            cad+='<input type="hidden" class="idresroom" value="" />';
                            cad+='</div>';
                            $(obj).find("#conthabitaciones").append(cad);
                        }
                    })
                    //asigno el evento para ver el detalle de las habs
                    $(".itemhab").click(function(){
                        hab=$(this).attr("id").split("hab").join("");
                        irr=$(this).find(".idresroom");
                        if(irr.val())
                            idresroom="&idresroom="+irr.val();
                        else
                            idresroom="";
                        fec1=$(this).find(".ihf1").html();
                        fec2=$(this).find(".ihf2").html();
                        //si se le pasa un ID entonces es viejo y las fechas no se consideran
                        //si no hay ID entonces es nuevo, y las fechas se consideran, si no se pasan genera error
                        displayForm({
                            path:"reservas/getRoom",
                            params:"room="+hab+"&fec1="+fec1+"&fec2="+fec2+idresroom,
                            title:$(this).find(".titlehabitem").html(),
                            buttons:{}
                        },function(){
                        });
                    })
                });
                
            }
        }
    });
    $(".tcellcdia").hover(function(){
        //document.title="a"+Math.ceil(Math.random()*10);
        scx2=$(this).parent().find(".tcellcdia").index($(this));
        scy2=$(this).parent().parent().find(".trowhab").index($(this).parent());
            
        srx1=scx1;
        sry1=scy1;
        srx2=scx2;
        sry2=scy2;
        //document.title=srx1+" - "+sry1+" @ "+srx2+" - "+sry2;
        if(scx2<=scx1){
            srx1=scx2;
            srx2=scx1;
        }
        if(scy2<=scy1){
            sry1=scy2;
            sry2=scy1;
        }
        ok=true;
        if(sc==1){
            $(".sccell").removeClass("sccell");
            document.title=sry1+" @ "+sry2;
            //document.title=$(".trowhab:gt("+(sry1-1)+")").filter(":lt("+(sry2+1-sry1)+")").length;
            $(".trowhab"+(sry1-1>-1?":gt("+(sry1-1)+")":"")).filter(":lt("+(sry2+1-sry1)+")").each(function(){
                //a=$(".tcelldia:gt("+(srx1-1)+"):lt("+(srx2+1)+")");
                a=$(this).find(".tcellcdia"+(srx1-1>-1?":gt("+(srx1-1)+")":"")).filter(":lt("+(srx2+1-srx1)+")");
                if(!$(a).hasClass("cellres") && !$(a).hasClass("cellbusy") && !$(a).hasClass("cellmtto") && ok==true){
                    //document.title=$(a).length;
                    $(a).addClass("sccell");
                }
                else{
                    ok=false;
                    sc=0;
                }
            });
        }
    });
}
cargardatos=function(n){
    d=$("input:radio[name=radio]:checked").val();
    $.ajax({
        url:site_url("reservas/getGrid") ,
        data:"fechai="+encodeURIComponent(d)+"&display="+encodeURIComponent(d)+"&direccion="+n,
        type:"POST",
        success:function(data){
            $("#tablares").html(data);
            //aqui se deberia cargar los datos de las habitaciones listadas en la variable asignaciones
            //cargar_hab(asignaciones);
            startEngine();
        }
    });
}
    
$(function() {
    //estilo de radios
    $( "#radio" ).buttonset();
    $("#c1antesde").html('<div id="calendarionav"></div>');
    $("#c1antesde #calendarionav").datepicker(calendarsettings);
    cargardatos(0);
});