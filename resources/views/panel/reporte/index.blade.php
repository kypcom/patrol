@extends('panel.template.main')
@section('opciones')

        <div class="row">
                            <div class="col-xl-12">
                                <div class="page-title-box">
                                    <h4 class="page-title float-left title-section">{{ $fraccionamiento }} / Reportes  </h4>

                                    <ol class="breadcrumb float-right">

                                          <button class="btn btn-agregar"  data-toggle="modal" data-target="#create_rep"><i class="mdi mdi-plus"></i> Agregar Reporte</button>
                                      
                                    </ol>

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
@endsection

@section('content')

<div class="row">
	   <div class="col-12">
                                <div class="card-box table-responsive">
                                	   <table id="tabla_js" class="table table-striped table-bordered">
                                        <thead>
                                        	<tr>
                                        		
                                            <th>Calle / Número</th> 
                                            <th>FECHA REPORTE</th>
                                            <th>PRIORIDAD</th>
                                            <th>ESTATUS</th>
                                            <th>OPCIONES</th>

                                        	</tr>
                                        </thead>
                                        <tbody>
                                        	@foreach($reportes as $reporte)
                                        	<tr>
                                        		
                                        	@if($reporte->creado == 'COLONO')
                                            <td>{{ $reporte->calle }} / {{ $reporte->numero }} </td>
                                            @else
                                            <td>{{ $reporte->creado }}  </td>
                                            @endif
                                   
                                            <td>{{ $reporte->created_at }}</td>
                                            <td>{{ $reporte->prioridad }}</td>
                                            <td >{{ $reporte->estatus }}</td>

                                   
                                            <td>

                                <a href="{{route('reporte.edit',$reporte->id)}}" class="btn btn-warning" >
                          <i class="mdi mdi-pencil"></i>
                        </a>
                         <a type="button" class="btn btn-danger" href="{{route('reporte.destroy',$reporte->id)}}" onclick="return confirm('¿Eliminiar el reporte?')" class="btn btn-danger">
                          <i class="mdi mdi-delete"></i>
                        </a>

                       
                          
                    </td>
                                        		

                                        	</tr>

                                        	@endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>


</div>


<div class="modal fade" id="create_rep" tabindex="-1" role="dialog" aria-labelledby="create_usr" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Reporte</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    {!! Form::open(['route'=>'reporte.store','method'=>'POST','files'=>true]) !!}

    <div class="row">

         <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                          <label >PRIORIDAD</label>
                           <select required name="prioridad" class="form-control " >
            <option value="">Selecciona la prioridad</option>
            <option value="Alta" style="color:red;">ALTA</option>
            <option value="Media">MEDIA</option>
            <option value="Baja">BAJA</option>
     
            </select>        
            </div>                
                    </div>

                             <div class="col-sm-12  col-md-12 col-lg-12 campo">
                          <div class="form-group">
                            <label for="exampleInputPassword1">DESCRIPCIÓN</label>
                             <div class="form-line">
           <textarea class="form-control" id="descripcion" required   name="descripcion" required></textarea>  
                                           </div>
                                         </div>
                         </div>
                           <div class="col-md-12">
                               

                                    <h4 class="header-title m-t-0 m-b-30">FOTO</h4>

                                    <input type="file" class="dropify"  name="foto" /><br>
                               
                            </div>
      

                    
    </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
       
        {!!Form::submit('Guardar',['class'=>'btn btn-success mr-2'])!!}
      {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>

@endsection