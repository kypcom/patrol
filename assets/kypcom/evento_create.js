
var casas;
var autorizan
var invitados=1;

$(document).ready(function () {

	    jQuery('#timepicker').timepicker({
        defaultTIme: false,
          showMeridian: false,
        icons: {
            up: 'zmdi zmdi-chevron-up',
            down: 'zmdi zmdi-chevron-down'
        }
    });

	        jQuery('#timepicker2').timepicker({
        defaultTIme: false,
          showMeridian: false,
        icons: {
            up: 'zmdi zmdi-chevron-up',
            down: 'zmdi zmdi-chevron-down'
        }
    });

	          jQuery('#datepicker-autoclose').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true
    });
	                  jQuery('#datepicker-autoclose2').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",

        todayHighlight: true
    });
});


function IVariables(casas,autorizan)
{
	this.casas=casas;

	this.autorizan=autorizan;


}

function add_invitado()
{
	var cuenta = document.getElementById('n_invitados');
	invitados++;
	var invitado= ' <div class="col-sm-12 col-md-4 campo >'+

	'<div class="form-group" id="inputf_'+invitados+'">'+
                         
  '<input class="form-control" placeholder="Nombre del invitado" type="text" id="name_i'+invitados+'"  name="invitado_'+invitados+'" required>'+
                        '</div>'+
                        ' </div>';

  $('#invitados').append(invitado);
  cuenta.value=invitados;
}

function destroy_invitado()
{
	if(invitados > 1)
	{

	var cuenta = document.getElementById('n_invitados');
	var elminar='#inputf_'+invitados;
	$(elminar).remove();
	invitados--;
 	 cuenta.value=invitados;


	}

}



function change_calle()
{
	var calle = document.getElementById('id_calle');
	var casa = document.getElementById('id_casa');

	// Se limpian casas
    casa.innerHTML = '<option value="">Seleccione la casa</option>';

	casas.forEach(function(casa){
		if(casa.id_calle==calle.value)
		{
			var agregar = document.getElementById('id_casa');
			var casa_new=document.createElement("option");
			casa_new.text= casa.numero;
			casa_new.value= casa.id;
			
			agregar.add(casa_new);
		}
	})
	

}

function change_casa()
{
	var autoriza = document.getElementById('id_autoriza');
	var casa = document.getElementById('id_casa');

	// Se limpian casas
    autoriza.innerHTML = '<option value="">Seleccione quien autoriza </option>';

	autorizan.forEach(function(aut){
		if(aut.id_casa==casa.value)
		{
			var agregar = document.getElementById('id_autoriza');
			var aut_new=document.createElement("option");
			aut_new.text= aut.autoriza;
			aut_new.value= aut.autoriza;
			
			agregar.add(aut_new);
		}
	})
	

}

function checar_fechas(){

	var hi = document.getElementById('timepicker');
	var fi = document.getElementById('datepicker-autoclose');
	var hf = document.getElementById('timepicker2');
	var ff = document.getElementById('datepicker-autoclose2');

	//var fech1 = this.create_date(fi.value,hi.value);
	//var fech2= this.create_date(ff.value,hf.value);



	var fech1= new Date( fi.value +" "+ hi.value);
	var fech2= new Date( ff.value +" "+ hf.value);

	console.log(fech1);
	console.log(fech2);

	let dif =fech2.getTime()-fech1.getTime();

	console.log(dif);

    dif = dif/ 3600000;

    console.log(dif);

	if(fech1.getTime() < fech2.getTime() && dif <= 24)
	{

		//console.log('pasa');
		//

		if(this.validar())
		{
			//console.log('pasa');
			document.formulariof.submit();
		}
		else{
			swal({
  	title: 'Error  ',
  	text: 'Ningun campo puede estar vacio ',
  	type: 'error'});

  	return ;
		}
	}
	
	else
	{
	swal({
  	title: 'Error  ',
  	text: 'Verifica las fechas ingresadas (no mayores a 24hrs)',
  	type: 'error'});

  	return ;

	}

	
}

function validar()
{

	var respuesta = false ;
	var calle = document.getElementById('id_calle').value;
	var casa = document.getElementById('id_casa').value;
	var autoriza = document.getElementById('id_autoriza').value;
	var evento = document.getElementById('evento').value ;

	if(calle != "" && casa != "" && evento !="" &&autoriza != "")
	{
		//console.log('pasa primero')
		//valida invitados 
		for(var i=0;i<invitados;i++)
		{

			var checar = i+1;
			var item =document.getElementById('name_i'+checar).value;
			//console.log(item);
			if(item != "")
			{
				//console.log('pasa segundo')
				respuesta = true;
			}
		}

		

	}


	return respuesta;

}





