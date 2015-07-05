<div class="frow">
    <label for="txt1">algo</label>
    <input type="text" class="required" alt="algo" name="txt1" id="txt1" />
</div>
<script type="text/javascript">
    $.fn.mascara=function(st){
        defecto={
            mask:"##",
            valorvacio:"_",
            siemprevisible:false
        };
        st=$.extend(defecto, st);
        ///encuentra la posicion del cursor dentro del texto
        caret=function(input){
            var pos = 0;
            // IE Support
            el=$(input)[0];
            if (document.selection) 
            {
                el.focus ();
                var Sel = document.selection.createRange();
                var SelLength = document.selection.createRange().text.length;
                Sel.moveStart ('character', -el.value.length);
                pos = Sel.text.length - SelLength;
            }
            // Firefox support
            else if (el.selectionStart || el.selectionStart == '0')
                pos = el.selectionStart;

            return pos;

        }
        sincro=function(input){
            cc=0;
            m=st["mask"].split("");
            t=$(input).val().split("");
            lleva=true;
            mix="";
            for(i=0;i<m.length;i++){
                if(m[i]=="\\"){
                    lleva=true;
                }
                if(t[cc]==null)
                    t[cc]=" ";
                if(lleva==false){
                    //se toma como palabra reservada
                    switch(m[i]){
                        case "#":
                            //se trata de un numero
                            //luego cuando lo mejore tambien evaluará por ejm: #[1-9] o #[7] o #[5-+]
                            nn=t[cc].charCodeAt(0)
                            n1="0".charCodeAt(0);
                            n2="9".charCodeAt(0);
                            if(n1<nn && nn<n2)
                                mix+=t[cc];
                            else
                                mix+=st["valorvacio"];
                            cc++;
                            break;
                        case "a":
                            //se trata de una letra
                            //luego cuando lo mejore tambien evaluará por ejm: a[a-sA-Q] o a[a-S] etc
                            nn=t[cc].charCodeAt(0)
                            n1="a".charCodeAt(0);
                            n2="z".charCodeAt(0);
                            n3="A".charCodeAt(0);
                            n4="Z".charCodeAt(0);
                            if((n1<nn && nn<n2)||(n3<nn && nn<n3))
                                mix+=t[cc];
                            else
                                mix+=st["valorvacio"];
                            c++;
                            break;
                        case "\\":
                            lleva=true;
                            break;
                        default:
                            //cualquier otro caracter dentro de la mascara
                            mix+=m[i];
                    }
                }
                else{
                    //se toma como simple caracter
                    if(t[cc]==m[i])
                        mix+=t[cc];
                    else
                        mix+=st["valorvacio"];
                    lleva=false;
                    cc++;
                }
            }
            $(input).val(mix);
        }
        if(!st["mask"]==""){
            $(this).each(function(){
                ///chekea si la informacion ingresdaa coincide con la mascara
                $(this).keypress(function(e){
                    position=caret(this);
                    valor=$(this).val();
                    p1=valor.substr(0, position);
                    p2=valor.substr(position+2);
                    $(this).val(p1+String.fromCharCode(e.which)+p2);
                    sincro(this);
                })
                $(this).focus(function(){
                    sincro(this);
                })
                /*$(input).blur(function(){
                    if(st["siemprevisible"]==false){
                        
                    }
                })*/
                sincro(this);
            })
        }
    }
    $("#txt1").mascara();
    $("#txt1").focus();
</script>