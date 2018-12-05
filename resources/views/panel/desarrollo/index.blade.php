@extends('panel.template.main')
@section('opciones')

        <div class="row">
                            <div class="col-xl-12">
                                <div class="page-title-box">
                                    <h4 class="page-title float-left title-section">Fraccionamientos </h4>

                                    <ol class="breadcrumb float-right">
                                        <button class="btn btn-agregar"  data-toggle="modal" data-target="#create_frac"><i class="mdi mdi-plus"></i> Agregar Fraccionamiento</button>
                                      
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
                                        		<th>Nombre</th>
                                            <th># P-Autorizan</th>
                                            <th># V-Confianza</th>
                                            <th>Activo</th>
                                        		<th>Opciones</th>

                                        	</tr>
                                        </thead>
                                        <tbody>
                                        	@foreach($fraccionamientos as $fraccionamiento)
                                        	<tr>
                                        		
                                        		<td>{{ $fraccionamiento->fraccionamiento }}</td>
                                            <td>{{ $fraccionamiento->n_autorizan }}</td>
                                            <td>{{ $fraccionamiento->n_confianza }}</td>
                                            <td style="text-transform: uppercase;">{{ $fraccionamiento->activo }}</td>
                                        		<td>
                                        		  <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#c{{ $fraccionamiento->id }}"">
                          <i class="mdi mdi-pencil"></i>
                        </button>

                       
                          <a type="button" class="btn btn-danger" href="{{route('frac.destroy',$fraccionamiento->id)}}" onclick="return confirm('¿Eliminiar el fraccionamiento?')" class="btn btn-danger">
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

@foreach($fraccionamientos as $fraccionamiento)
<div class="modal fade" id="c{{ $fraccionamiento->id }}" tabindex="-1" role="dialog" aria-labelledby="edit_cat" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar fraccionamiento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    
    {!! Form::open(['route'=>['fraccionamiento.update',$fraccionamiento],'method'=>'PUT']) !!}

    <div class="row">
      
      <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Fraccionamiento</label>
                          {!! Form::text('fraccionamiento',$fraccionamiento->fraccionamiento,['class'=>'form-control','required']) !!}
                      
                        </div>

                      
                    </div>
                        <div class="col-sm-12 col-md-4 col-lg-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1"># P-Autorizan</label>
                          {!! Form::text('n_autorizan',$fraccionamiento->n_autorizan,['class'=>'form-control','required']) !!}
                      
                        </div>

                      
                    </div>
                        <div class="col-sm-12 col-md-4 col-lg-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1"># V-Confianza</label>
                          {!! Form::text('n_confianza',$fraccionamiento->n_confianza,['class'=>'form-control','required']) !!}
                      
                        </div>

                      
                    </div>

                     <div class="col-sm-12 col-md-4 col-lg-4">
                        <div class="form-group">
                          <label >Estatus</label>
                           <select required name="activo" class="form-control " >
                 @if($fraccionamiento->activo=='si')
                  <option selected value="si">Activo</option>
                         <option value="no">Inactivo</option>
                  @endif
                  @if($fraccionamiento->activo=='no')
                     <option selected value="no">Inactivo</option>
                  <option  value="si">Activo</option>
                      
                  @endif
     
     
               
                       </select>
                         
                      
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


<div class="modal fade" id="create_frac" tabindex="-1" role="dialog" aria-labelledby="create_usr" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar fraccionamiento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    {!! Form::open(['route'=>'fraccionamiento.store','method'=>'POST']) !!}

    <div class="row">
      
       <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Fraccionamiento</label>
                          {!! Form::text('fraccionamiento',null,['class'=>'form-control','required']) !!}
                      
                        </div>

                      
                    </div>
                        <div class="col-sm-12 col-md-4 col-lg-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1"># P-Autorizan</label>
                          {!! Form::text('n_autorizan',null,['class'=>'form-control','required']) !!}
                      
                        </div>

                      
                    </div>
                        <div class="col-sm-12 col-md-4 col-lg-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1"># V-Confianza</label>
                          {!! Form::text('n_confianza',null,['class'=>'form-control','required']) !!}
                      
                        </div>

                      
                    </div>

                      <div class="col-sm-12 col-md-4 col-lg-4">
                        <div class="form-group">
                          <label >Estatus</label>
                           <select required name="activo" class="form-control " >
                        <option  >Selecciona el estatus</option>
                        <option  value="si">Activo</option>
                         <option value="no">Inactivo</option>
                
               
                       </select>
                         
                      
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