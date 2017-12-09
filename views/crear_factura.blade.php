
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
       <li>
       <a href="/gestion/factura/crear-facturacion/{{$contenido->id}}"><i class="hi hi-list-alt"></i> Crear Factura</a>
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
                                <h2><strong>Facturas</strong> Registradas</h2>
                            </div>
                            <p><a href="https://datatables.net/" target="_blank">DataTables</a> is a plug-in for the Jquery Javascript library. It is a highly flexible tool, based upon the foundations of progressive enhancement, which will add advanced interaction controls to any HTML table. It is integrated with template's design and it offers many features such as on-the-fly filtering and variable length pagination.</p>

                            <div class="table-responsive">
                                <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Id Factura</th>
                                            <th class="text-center">Dirigido</th>
                                            <th>Fecha Emisión</th>
                                            <th>Fecha Vencimiento</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($facturacion)
                                         @foreach($facturacion as $facturacion)
                                        <tr>
                                            <td class="text-center">{{ $facturacion->id }}</td>
                                            <td class="text-center">{{ $facturacion->dirigido }}</td>
                                            <td>{{ $facturacion->f_emision }}</td>
                                            <td>{{ $facturacion->f_vencimiento}}</td>
                                            <td class="text-center">
                                             <a href="<?=URL::to('Facturacione');?>/{{ $facturacion->id }}"><span  id="tip" data-toggle="tooltip" data-placement="top" title="Editar Contenido" class="btn btn-warning"><i class="fa fa-list-alt sidebar-nav-icon"></i></span></a>
         <a href="<?=URL::to('gestion/factura/editar-factura');?>/{{ $facturacion->id }}"><span  id="tip" data-toggle="tooltip" data-placement="top" title="Editar Contenido" class="btn btn-primary"><i class="fa fa-pencil-square-o sidebar-nav-icon"></i></span></a>
      <script language="JavaScript">
function confirmar ( mensaje ) {
return confirm( mensaje );}
</script>
   
  <a href="<?=URL::to('gestion/factura/generar-factura/');?>/{{$facturacion->id}}" target="_blank"><span id="tup" data-toggle="tooltip" data-placement="bottom" title="Editar Página" class="btn btn-info"><span class="fa fa-file"></span></span></a>
  <a href="<?=URL::to('gestion/factura/generar-facturacopia/');?>/{{$facturacion->id}}" target="_blank"><span id="tup" data-toggle="tooltip" data-placement="bottom" title="Editar Página" class="btn btn-info"><span class="fa fa-clipboard"></span></span></a>
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





   {{ Html::script('Calendario/jquery/jquery.min.js') }}
   
  <script type="text/javascript">
$(document).ready(function(){
    $('#datetimepicker7').datetimepicker({
      pickTime: true,
      format: 'MM/DD/YYYY'

    });
});
</script>
<script type="text/javascript">
$(document).ready(function(){
    $('#datetimepicker9').datetimepicker({
      pickTime: true,
      format: 'MM/DD/YYYY'

    });
});
</script>


     {{ Html::script('Calendario/js/moment.min.js') }}
     {{ Html::script('Calendario/js/bootstrap-datetimepicker.min.js') }}
     
     {{ Html::script('Calendario/js/validator.js')}}
     {{ Html::script('//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.0/js/bootstrapValidator.min.js') }}
   
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>

  @stop

