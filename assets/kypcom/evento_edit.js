var casas;
var autorizan
var n_invitados;
var invitados;

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


function IVariables(invitados)
{
	
this.invitados=invitados;
this.inicia_invitados();

}

function inicia_invitados()
{
	n_invitados=invitados.length;
	var cuenta = document.getElementById('n_invitados');
	cuenta.value=n_invitados;
	let conteo = 1;

	for(let invitado of invitados)
	{
		var numero=conteo;
		var item= ' <div class="col-sm-12 col-md-4 campo" id="inputf_'+numero+'"  >'+

	'<div class="form-group" >'+
                         
  '<input class="form-control" placeholder="Nombre del invitado" id="name_i'+numero+'" type="text" value="'+invitado.invitado+'" name="invitado_'+conteo+'" required>'+
                        '</div>'+
                        ' </div>';

  $('#invitados').append(item);
  conteo++;
	}

}



function add_invitado()
{
	var cuenta = document.getElementById('n_invitados');
	n_invitados++;

	var invitado= ' <div class="col-sm-12 col-md-4 campo" id="inputf_'+n_invitados+'">'+

	'<div class="form-group" >'+
                         
  '<input class="form-control" placeholder="Nombre del invitado" type="text" id="name_i'+n_invitados+'"  name="invitado_'+n_invitados+'" required>'+
                        '</div>'+
                        ' </div>';

  $('#invitados').append(invitado);
  cuenta.value=n_invitados;
}

function destroy_invitado()
{
	console.log('llega')
	if(n_invitados > 1)
	{
		
	var cuenta = document.getElementById('n_invitados');
	var eliminar='#inputf_'+n_invitados;
	$(eliminar).remove();
	n_invitados--;
 	cuenta.value=n_invitados;


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

	let dif =fech2.getTime()-fech1.getTime();
    dif = dif/ 3600000;



	if(fech1.getTime() < fech2.getTime() && dif <= 24)
	{
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
	
	var evento = document.getElementById('evento').value ;

	if(evento !="" )
	{
		//console.log('pasa primero')
		//valida invitados 
		for(var i=0;i<n_invitados;i++)
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




