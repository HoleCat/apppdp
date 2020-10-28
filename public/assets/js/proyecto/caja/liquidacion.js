eventosliquidacion();

var datacompras;

function eventosliquidacion(){
	seteventview('/New/new_caja');
	set_ruta('/Delete/trash_uso_liquidacion?iduso=');
	setview('#form-historico','#content','/Old/old_caja');
}

$(function(){
	setviewliquidacion('#formliquidacion','#content','/Caja/Liquidacion');
})