@extends('panel.template.main')
@section('opciones')

        <div class="row">
                            <div class="col-xl-12">
                                <div class="page-title-box">
                                    <h4 class="page-title float-left title-section">{{ $fraccionamiento }} / Casas </h4>

                                    <ol class="breadcrumb float-right">

                                          <a href="{{route('casa.create')}}"
                                        class="btn btn-agregar"  ><i class="mdi mdi-plus"></i> Agregar Casa</a>
                                      
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
                                        		<th>Número</th>
                                            <th>Teléfono</th>
                                            <th>Activo</th>
                                            <th>Opciones</th>

                                        	</tr>
                                        </thead>
                                        <tbody>
                                        	@foreach($casas as $casa)
                                        	<tr>
                                        		
                                        		<td>{{ $casa->fraccionamiento }}</td>
                                            <td>{{ $casa->calle }}</td>
                                            <td>{{ $casa->numero }}</td>
                                            <td>{{ $casa->telefono }}</td>
                                            <td class="mayus">{{ $casa->activo }}</td>
                                   
                                        		<td>
                                        		  <a href="{{route('casa.edit',$casa->id)}}" class="btn btn-warning" >
                          <i class="mdi mdi-pencil"></i>
                        </a>

                       
                          <a type="button" class="btn btn-danger" href="{{route('casa.destroy',$casa->id)}}" onclick="return confirm('¿Eliminiar casa ?')" class="btn btn-danger">
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

@endsection