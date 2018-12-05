var n_autorizan;
var n_invitados;


function IVariables(n_autorizan,n_invitados)
{
	this.n_autorizan=n_autorizan;

	this.n_invitados=n_invitados;
	INumeros();
	
}


function INumeros()
{
	$('#autorizan').empty();
	$('#invitados').empty();

	for(let i=0;i<n_autorizan;i++)
	{
		var nombre= ' <div class="col-sm-12 col-md-6 col-lg-6 badge-check" >'+
                      ' <input type="text" class="form-control" placeholder="Nombre" name="autorizado_'+i+'"  /> '+
                    
                     
                        ' </div>';

		var check= ' <div class="col-sm-12 col-md-6 col-lg-6 badge-check" >'+
                     
                     ' <input type="checkbox" class="switch_1"  name="autorizado_check'+i+'"  /> '+
                     
                        ' </div>';

         $('#autorizan').append(nombre);
         $('#autorizan').append(check);

	}

		for(let i=0;i<n_invitados;i++)
	{
		var nombre= ' <div class="col-sm-12 col-md-6 col-lg-6 badge-check" >'+
                      ' <input type="text" class="form-control" placeholder="Nombre" name="invitado_'+i+'"  /> '+
                    
                     
                        ' </div>';

		var check= ' <div class="col-sm-12 col-md-6 col-lg-6 badge-check" >'+
                     
                     ' <input type="checkbox" class="switch_1"  name="invitado_check'+i+'"  /> '+
                     
                        ' </div>';

         $('#invitados').append(nombre);
         $('#invitados').append(check);

	}






}





