 @extends ('adminsite.layout')
 

  @section('ContenidoSite-01')


   <div class="content-header">
     <ul class="nav-horizontal text-center">
 <li>
       <a href="/gestion/factura"><i class="fa fa-users"></i> Clientes</a>
      </li>

      <li>
       <a href="/gestion/factura/editar-empresa"><i class="fa fa-building"></i> Configurar Empresa</a>
      </li>
      <li>
       <a href="/gestion/factura/crear-producto"><i class="fa fa-shopping-basket"></i> Crear Producto</a>
      </li>
      <li>
       <a href="/informe/generar-informe"><i class="fa fa-file-text"></i> Informes</a>
      </li>
       <li>
       <a href="/gestion/factura/factura-cliente"><i class="fa fa-user-plus"></i> Crear Cliente</a>
      </li>
     </ul>
    </div>

 <div class="container">
  <?php $status=Session::get('status'); ?>
  @if($status=='ok_create')
   <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Usuario registrado con éxito</strong>
   </div>
  @endif

  @if($status=='ok_delete')
   <div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Usuario eliminado con éxito</strong>
   </div>
  @endif

  @if($status=='ok_update')
   <div class="alert alert-warning">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Usuario actualizado con éxito</strong>
   </div>
  @endif

 </div>








<div class="container">
  


 <div class="block full">
                            <div class="block-title">
                                <h2><strong>Clientes</strong> Registrados</h2>
                            </div>
                            <p><a href="https://datatables.net/" target="_blank">DataTables</a> is a plug-in for the Jquery Javascript library. It is a highly flexible tool, based upon the foundations of progressive enhancement, which will add advanced interaction controls to any HTML table. It is integrated with template's design and it offers many features such as on-the-fly filtering and variable length pagination.</p>

                            <div class="table-responsive">
                                <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Tercero</th>
                                            <th class="text-center">Nombre</th>
                                            <th>Tipo Documento</th>
                                            <th># Documento</th>
                                            <th>Ciudad</th>
                                            <th>Fecha de Inicio</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($facturacion)
                                         @foreach($facturacion as $facturacion)
                                        <tr>
                                            <td class="text-center">
                                              @if($facturacion->terceros == 1)
                                               Cliente
                                              @elseif($facturacion->terceros == 2)
                                               Proveedor
                                              @elseif($facturacion->terceros == 3)
                                               Empleado
                                              @endif
                                            </td>
                                            <td class="text-center">{{ $facturacion->p_nombre }}</td>
                                            <td>
                                              @if($facturacion->t_documento == 1)
                                               NIT
                                              @elseif($facturacion->t_documento == 2)
                                               Cédula Ciudadania
                                              @elseif($facturacion->t_documento == 3)
                                               Cédula  Extranjeria
                                              @endif
                                            </td>
                                            <td>{{ $facturacion->documento}}</td>
                                            <td>{{ $facturacion->ciudad }}</td>
                                            <td>{{ $facturacion->ingreso }}</td>
                                            <td class="text-center">
                                              <a href="<?=URL::to('gestion/factura/lista-facturas');?>/{{ $facturacion->id }}"><span  id="tip" data-toggle="tooltip" data-placement="top" title="Editar Contenido" class="btn btn-warning"><i class="fa fa-list-alt sidebar-nav-icon"></i></span></a>
                                             @if($facturacion->t_persona =='natural')
                                              <a href="<?=URL::to('gestion/factura/editar-cliente');?>/{{ $facturacion->id }}"><span  id="tip" data-toggle="tooltip" data-placement="top" title="Editar Contenido" class="btn btn-primary"><i class="fa fa-pencil-square-o sidebar-nav-icon"></i></span></a>
                                             @elseif($facturacion->t_persona =='juridica')
                                              <a href="<?=URL::to('gestion/factura/editar-cliente/juridica');?>/{{ $facturacion->id }}"><span  id="tip" data-toggle="tooltip" data-placement="top" title="Editar Contenido" class="btn btn-primary"><i class="fa fa-pencil-square-o sidebar-nav-icon"></i></span></a>
                                             @endif
                                              <script language="JavaScript">
                                              function confirmar ( mensaje ) {
                                              return confirm( mensaje );}
                                              </script>
                                              <a href="<?=URL::to('gestion/factura/eliminar-cliente/');?>/{{$facturacion->id}}" onclick="return confirmar('¿Está seguro que desea eliminar el registro?')"><span id="tup" data-toggle="tooltip" data-placement="bottom" title="Editar Página" class="btn btn-danger"><i class="hi hi-trash sidebar-nav-icon"></i></span></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                         @else
                                          <div class="alert alert-danger fade in">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                                          <strong>NO</strong> hay usuarios registrados aun.</div>
                                         @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END Datatables Content -->




</div>




<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

    <script src="/adminsite/js/pages/tablesDatatables.js"></script>
        <script>$(function(){ TablesDatatables.init(); });</script>
  

  @stop

  
     
    

