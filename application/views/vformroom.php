<div id="divroom">
    <form id="frmroom" action="#" method="post">
        <fieldset id="fsethuespedes">
            <legend>Huespedes</legend>
            <div class="frow">
                <label for="htx1">Huesped</label>
                <input type="text" class="" alt="Huesped" name="htx1" id="htx1" />
                <a target="_blank" href="<?= site_url("clientes") ?>" id="addhue"></a>
                <div id="conthuesped">

                </div>
            </div>
        </fieldset>
        <fieldset id="fsetroom">
            <legend>Habitación</legend>
            <div class="frow txtgrande">
                <label for="htx2">Habitación</label>
                <input type="text" class="required" alt="Habitación" name="htx2" id="htx2" />
            </div>
            <div class="frow txtgrande">
                <label for="htx3">Desde</label>
                <input type="text" class="required" alt="Desde" name="htx3" id="htx3" />
            </div>
            <div class="frow txtgrande">
                <label for="htx4">Hasta</label>
                <input type="text" class="required" alt="Hasta" name="htx4" id="htx4" />
            </div>
            <div class="frow">
                <label for="htx5">Hora de entrada</label>
                <input type="text" class="required" alt="Hora de entrada" name="htx5" id="htx5" />
            </div>
            <div class="frow">
                <label for="htx6">Hora de salida</label>
                <input type="text" class="required" alt="Hora de salida" name="htx6" id="htx6" />
            </div>
            <div class="frow">
                <label for="htx7">Hora de Check In</label>
                <input type="text" class="required" alt="Hora de Check In" name="htx7" id="htx7" />
            </div>
            <div class="frow frowcheck">
                <label for="htx8"><input type="checkbox" class="required" alt="No Molestar" name="htx8" id="htx8" /> No Molestar</label>
            </div>
            <div class="frow frowcheck">
                <label for="htx9"><input type="checkbox" class="required" alt="Sleep Out" name="htx9" id="htx9" /> Sleep Out</label>
            </div>
            <div class="frow">
                <label for="htx10">Tip. Reservación</label>
                <select class="required" alt="Tip. Reservación" name="htx10" id="htx10">
                    <option value="0">No Confirmado</option>
                    <option value="1">Confirmado</option>
                    <option value="2">Garantizado</option>
                </select>
            </div>
            <div class="frow">
                <label for="htx11">Grupo</label>
                <input type="text" class="required" alt="Grupo" name="htx11" id="htx11" />
            </div>
            <div class="frow">
                <label for="htx12">Descuento</label>
                <input type="text" class="required" alt="Descuento" name="htx12" id="htx12" />
            </div>
            <div class="frow">
                <label for="htx13">Precio x noche</label>
                <input type="text" class="required" alt="Precio x noche" name="htx13" id="htx13" />
            </div>
            <div class="frow">
                <label for="htx14">Noches</label>
                <input type="text" class="required" alt="Noches" name="htx14" id="htx14" />
            </div>
            <div class="frow">
                <label for="htx15">IGV</label>
                <input type="text" class="required" alt="IGV" name="htx15" id="htx15" />
            </div>
            <div class="frow">
                <label for="htx16">Precio Total</label>
                <input type="text" class="required" alt="Precio Total" name="htx16" id="htx16" />
            </div>
        </fieldset>
    </form>
    <script type="text/javascript">
        //$("#htx5").mask({mask: "(###) ###-####"});
    
        $("#htx5").unmask();
        $("#htx5").mask("99:##");
        
    </script>
</div>