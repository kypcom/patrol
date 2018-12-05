@extends('panel.template.main')
@section('opciones')

        <div class="row">
                            <div class="col-xl-12">
                                <div class="page-title-box">
                                    <h4 class="page-title float-left title-section">{{ $fraccionamiento }} / Eventos</h4>

                                    <ol class="breadcrumb float-right">
                                        <a href="{{route('evento.create')}}" class="btn btn-agregar" ><i class="mdi mdi-plus"></i> Agregar Evento</a>
                                      
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
                                        		<th>Calle y Número</th>
                                            <th>Evento</th>
                                            <th>Estatus</th>
                                            <th>Autoriza</th>
                                            <th>Inicio</th>
                                            <th>Final</th>
                                         		<th>Opciones</th>

                                        	</tr>
                                        </thead>
                                        <tbody>
                                        	@foreach($eventos as $evento)
                                        	<tr>
                                        		
                                        		<td>{{ $evento->calle }} / {{ $evento->numero }}</td>
                                            <td>{{ $evento->evento }}</td>
                                            <td class="mayus">{{ $evento->estatus }}</td>
                                            <td>{{ $evento->autoriza }}</td>
                                            <td>{{ $evento->inicia }}</td>
                                            <td>{{ $evento->termina }}</td>
                                        		<td>
                                        <a href="{{route('evento.edit',$evento->id)}}" type="button" class="btn btn-warning"  >
                          <i class="mdi mdi-pencil"></i>
                        </a>

                       
                          <a type="button" class="btn btn-danger" href="{{route('evento.destroy',$evento->id)}}" onclick="return confirm('¿Eliminiar el evento?')" class="btn btn-danger">
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