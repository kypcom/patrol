@extends('panel.template.main')
@section('opciones')

        <div class="row">
                            <div class="col-xl-12">
                                <div class="page-title-box">
                                    <h4 class="page-title float-left title-section">{{ $fraccionamiento }} / Calles </h4>

                                    <ol class="breadcrumb float-right">
                                        <button class="btn btn-agregar"  data-toggle="modal" data-target="#create_calle"><i class="mdi mdi-plus"></i> Agregar Calle</button>
                                      
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
                                        		<th>Fraccionamiento</th>
                                            <th>Calle</th> 
                                        		<th>Opciones</th>

                                        	</tr>
                                        </thead>
                                        <tbody>
                                        	@foreach($calles as $calle)
                                        	<tr>
                                        		
                                        		<td>{{ $calle->fraccionamiento }}</td>
                                            <td>{{ $calle->calle }}</td>
                                   
                                        		<td>
                                        		  <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#c{{ $calle->id }}"">
                          <i class="mdi mdi-pencil"></i>
                        </button>

                       
                          <a type="button" class="btn btn-danger" href="{{route('calle.destroy',$calle->id)}}" onclick="return confirm('¿Eliminiar la calle y todas sus casas?')" class="btn btn-danger">
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

@foreach($calles as $calle)
<div class="modal fade" id="c{{ $calle->id }}" tabindex="-1" role="dialog" aria-labelledby="edit_cat" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Calle</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    
    {!! Form::open(['route'=>['calle.update',$calle],'method'=>'PUT']) !!}

    <div class="row">
      
      <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Nombre de la calle</label>
                          {!! Form::text('calle',$calle->calle,['class'=>'form-control','required']) !!}
                      
                        </div>

                      
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

@endforeach


<div class="modal fade" id="create_calle" tabindex="-1" role="dialog" aria-labelledby="create_calle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Calle</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    {!! Form::open(['route'=>'calle.store','method'=>'POST']) !!}

    <div class="row">
      
       <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Nombre de la calle</label>
                          {!! Form::text('calle',null,['class'=>'form-control','required']) !!}
                      
                        </div>

                      
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