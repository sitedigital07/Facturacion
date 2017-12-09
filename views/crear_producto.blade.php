
@extends ('adminsite.layout')



    @section('cabecera')
    @parent

   
    <link rel="stylesheet" href="/validaciones/dist/css/bootstrapValidator.css"/>

    <script type="text/javascript" src="/validaciones/vendor/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="/validaciones/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/validaciones/dist/js/bootstrapValidator.js"></script>

    @stop

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
  <div class="row">
                            <div class="col-md-12">
                                <!-- Basic Form Elements Block -->
                                <div class="block">
                                    <!-- Basic Form Elements Title -->
                                    <div class="block-title">
                                        <div class="block-options pull-right">
                                            <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-default toggle-bordered enable-tooltip" data-toggle="button" title="Toggles .form-bordered class">No Borders</a>
                                        </div>
                                        <h2><strong>Crear</strong> Producto</h2>
                                    </div>
                                    <!-- END Form Elements Title -->
                                    
                                    <!-- Basic Form Elements Content -->
                                      
                                      {{Form::open(array('method' => 'POST','oninput' => 'v_total.value=parseInt(v_unitario.value)*parseInt(cantidad.value)', 'class' => 'form-horizontal','id' => 'defaultForm', 'url' => array('/gestion/factura/creacion-producto'))) }}

                                      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                       <div class="form-group">
                                            <label for="example-nf-email">Producto</label>
                                                 <select class="form-control input-sm" name="producto" id="producto">
                                             <option value="" disabled selected style="display: none;">Seleccione producto</option>
                                              @foreach($categories as $category)
                                             <option value="{{$category->id}}">{{$category->producto}} - {{$category->identificador}}  </option>
                                              @endforeach
                                            </select>
                                        </div>
                                        </div>

                                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                         <div class="form-group">
                                            <label for="example-nf-email">Valor unitario</label>
                                               <select class="form-control input-sm" name="v_unitario" id="v_unitario">
                                              <option value=""></option>
                                             </select>
                                        </div>
                                        </div>
                                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                                         <div class="form-group">
                                            <label for="example-nf-email">Iva</label>
                                                <select class="form-control input-sm" name="iva" id="iva">
                                              <option value=""></option>
                                             </select>
                                        </div>
                                        </div>

                                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                                        <div class="form-group">
                                            <label for="example-nf-email">Cantidad</label>
                                                <input style="padding:0px 10px 0px 10px" type="number" class="form-control input-sm" min="1" name="cantidad" width="100%">   
                                        </div>
                                        </div>

                                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                        <div class="form-group">
                                            <label for="example-nf-email">Descuento</label>
                                              <input type="text" class="form-control input-sm" name="descuento" placeholder="Ingrese identificador">     
                                        </div>
                                        </div>

                                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                        <div class="form-group">
                                            <label for="example-nf-email">Valor total</label>
                                             <input class="form-control input-sm" name="v_total" for="v_unitario cantidad">
                                        </div>
                                         </div> 

                                         <div class="col-xs-2 col-sm-2 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="example-nf-email">Descripcion</label>
                                             <input class="form-control input-sm" name="descripcion" placeholder="Ingrese descripcion">
                                        </div>
                                         </div> 
                                     
                                        <input type="hidden" name="identificador" value="{{Request::segment(2)}}">

                                        <div class="form-group hidden-sm hidden-xs hidden-md hidden-lg">
                                         <label for="">Product</label>
                                          <select class="form-control input-sm" name="product" id="product">
                                           <option value=""></option>
                                          </select>
                                        </div>
                                        @foreach($retefuente as $retefuente)
                                         <input type="hidden" name="retefuente" id="input" class="form-control" value="{{$retefuente->retefuente}}">
                                         <input type="hidden" name="cliente" id="input" class="form-control" value="{{$retefuente->cliente_id}}">
                                        @endforeach
                                        

                                          <div class="form-group form-actions">
                                            <div class="col-md-9">
                                                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> Submit</button>
                                                <button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> Reset</button>
                                            </div>
                                        </div>
                                    {{ Form::close() }}
                                
                                </div>
                                <!-- END Basic Form Elements Block -->
                            </div>
                          </div>
                          
</div>







<div class="container">
<table class="table table-striped">
  <thead bgcolor="#fafcfc">
    <tr>
       <th>Id</th>
      <th>Producto</th>
      <th>Cantidad</th>
      <th>Iva</th>
      <th>Valor Total</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
      @foreach($facturacion as $facturacion)
    <tr>
       <td>{{ $facturacion->id }}</td>
       <td>{{ $facturacion->product }}</td>
       <td>{{ $facturacion->cantidad}}</td>
       <td>{{ $facturacion->iva}}</td>
       <td>{{ $facturacion->v_total}}</td>
      <td>
       <a href="<?=URL::to('gestion/factura/editar-producto');?>/{{ $facturacion->id }}"><span  id="tip" data-toggle="tooltip" data-placement="top" title="Editar Contenido" class="btn btn-primary"><span class="fa fa-pencil-square-o sidebar-nav-icon"></span></span></a>
        <script language="JavaScript">
        function confirmar ( mensaje ) {
        return confirm( mensaje );}
        </script>
       <a href="<?=URL::to('gestion/factura/eliminar-producto');?>/{{$facturacion->id}}" onclick="return confirmar('¿Está seguro que desea eliminar el registro?')"><span id="tup" data-toggle="tooltip" data-placement="bottom" title="Editar Página" class="btn btn-danger"><span class="hi hi-trash sidebar-nav-icon"></span></span></a>
      </td>
    </tr>
     @endforeach
  </tbody>
</table>
</div>

 <script type="text/javascript">
$(document).ready(function() {
    $('#defaultForm').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
          
             producto: {
                message: 'The username is not valid',
                validators: {
                    notEmpty: {
                        message: 'Este campo es obligatorio'
                    },
                    regexp: {
                        regexp: /^[ a-zA-Z0-9_\.ñáéíóú]+$/,
                        message: 'The username can only consist of alphabetical, number, dot and underscore'
                    }
                }
            },
             cantidad: {
                message: 'The username is not valid',
                validators: {
                    notEmpty: {
                        message: 'Este campo es obligatorio'
                    },
                    regexp: {
                        regexp: /^[ a-zA-Z0-9_\.ñáéíóú]+$/,
                        message: 'The username can only consist of alphabetical, number, dot and underscore'
                    }
                }
            },
          
        }
    });
});
</script>


<script src="/adminsite/js/pages/tablesDatatables.js"></script>
<script>$(function(){ TablesDatatables.init(); });</script>

 <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
 {{ Html::script('//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.0/js/bootstrapValidator.min.js') }}

<script>
  $('#producto').on('change',function(e){
  console.log(e);
  var cat_id = e.target.value;
  $.get('/{{Request::path()}}/ajax-subcat?cat_id=' + cat_id, function(data){
  $('#v_unitario').empty();
  $.each(data, function(index, subcatObj){
  $('#v_unitario').append('<option value="'+subcatObj.precio+'">'+subcatObj.precio+'</option>');
  });
  $('#iva').empty();
  $.each(data, function(index, subcatObj){
  $('#iva').append('<option value="'+subcatObj.iva+'">'+subcatObj.iva+'</option>');
  });
  $('#product').empty();
  $.each(data, function(index, subcatObj){
  $('#product').append('<option value="'+subcatObj.producto+'">'+subcatObj.producto+'</option>');
  });
  });
  });

    </script>

   

  @stop
