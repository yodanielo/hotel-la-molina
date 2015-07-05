/**
 * despliega un cuadro de mensaje
 * mensaje = el mensaje que irá
 * icono = estos valores
 * 0=informacion
 * 1=admiracion
 * 2=error
 */
function msgbox(mensaje,icono,botones) {
    if($("#msgbox").length==0){
        $("body").prepend('<div id="msgbox"></div>');
    }
    if(botones==null){
        botones={
            "Aceptar":function(){
                $(this).dialog("close");
            }
        }
    }
    msgboxtitle=new Array("Información","Advertencia","Error");
    $("#msgbox").html(mensaje);
    $("#msgbox").dialog({
        "title":msgboxtitle[icono],
        "modal":true,
        "buttons":botones,
        "close":function(event,ui){
            $("#msgbox").html("");
        }
    });
}

/**
 * despliega un window
 */
displayForm=function(settings,beforeDisplay,afterDisplay){
    defecto={
        path:"",
        params:"",
        title:"Hotel La Molina",
        buttons:{
            "ok":function(){
                $(this).dialog("close");
            }
        }
    }
    st=$.extend(defecto, settings);
    if($(".plantillaform").length==0){
        $("body").append('<div style="display:none;" id="contplantillaform"><div class="plantillaform">{text}</div></div>');
    }
    obj=$(".plantillaform").clone();
    idform="frm"+Math.ceil(Math.random()*9999999+1);
    $(obj).attr("id",idform);
    $(obj).appendTo("#contplantillaform");
    $.ajax({
        url:site_url(st["path"]),
        data:st["params"],
        method:"post",
        success:function(data){
            $(obj).html($(obj).html().split("{text}").join(data));
            if(beforeDisplay!=null)
                beforeDisplay(obj);
            $("#"+idform).dialog({
                title:st["title"],
                modal:true,
                buttons:st["buttons"],
                close:function(){
                    $(this).remove();
                }
            })
            if(afterDisplay!=null)
                afterDisplay(obj);
        }
    });
    
    
    
}
/**
 * proporcinoa una URL hacia una ruta dada
 * @params path la ruta relativa
 */
function site_url(path) {
    if(path==null){
        path="";
    }
    return appPath+path;
}