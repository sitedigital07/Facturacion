
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
  
<div class="block">
                                    <!-- Normal Form Title -->
                                    <div class="block-title">
                                        <div class="block-options pull-right">
                                            <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-default toggle-bordered enable-tooltip" data-toggle="button" title="Toggles .form-bordered class">No Borders</a>
                                        </div>
                                        <h2><strong>Crear</strong> Producto</h2>
                                    </div>
                                    <!-- END Normal Form Title -->

                                    <!-- Normal Form Content -->
                                     {{ Form::open(array('method' => 'POST','class' => 'form-horizontal','id' => 'defaultForm', 'url' => array('/productos/create'))) }}
                
                                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                        <div class="form-group">
                                          <div class="col-md-12">
                                             <label class="control-label" for="example-email-input">Producto</label>
                                           {{Form::text('producto', '', array('class' => 'form-control','placeholder'=>'Ingrese nombre producto' ))}}
                                          </div>
                                        </div>
                                       </div>

                                       <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                                          <div class="form-group">
                                          <div class="col-md-12">
                                             <label class="control-label" for="example-email-input">Iva</label>
                                           {{Form::text('iva', '', array('class' => 'form-control','placeholder'=>'Ingrese nombre producto' ))}}
                                          </div>
                                        </div>
                                      </div>

                                      <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                          <div class="form-group">
                                          <div class="col-md-12">
                                             <label class="control-label" for="example-email-input">Precio</label>
                                           {{Form::text('precio', '', array('class' => 'form-control','placeholder'=>'Ingrese nombre producto'))}}
                                          </div>
                                        </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                         <div class="form-group">
                                          <div class="col-md-12">
                                             <label class="control-label" for="example-email-input">Identificador</label>
                                           {{Form::text('identificador', '', array('class' => 'form-control','placeholder'=>'Ingrese nombre producto'))}}
                                          </div>
                                        </div>

                                        </div>

                                       </br>
                                       <br>
                                      
                                        <div class="form-group form-actions">
                                           <div class="col-lg-12">
                                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-user"></i> Crear</button>
                                            <button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> Reset</button>
                                        </div>
                                      </div>
                                    {{Form::close()}}
                                    <!-- END Normal Form Content -->
                                </div>


</div>



<div class="container">
  


 <div class="block full">
                            <div class="block-title">
                                <h2><strong>Productos</strong> Registrados</h2>
                            </div>
                            <p><a href="https://datatables.net/" target="_blank">DataTables</a> is a plug-in for the Jquery Javascript library. It is a highly flexible tool, based upon the foundations of progressive enhancement, which will add advanced interaction controls to any HTML table. It is integrated with template's design and it offers many features such as on-the-fly filtering and variable length pagination.</p>

                            <div class="table-responsive">
                                <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Titulo</th>
                                            <th class="text-center">Producto</th>
                                            <th class="text-center">Valor</th>
                                            <th>Iva</th>
                                            <th>Identificador</th>
                                            <th>Acciones</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                         @foreach($facturacion as $facturacion)
                                        <tr>
                                            <td class="text-center">{{ $facturacion->id }}</td>
                                            <td class="text-center">{{ $facturacion->producto }}</td>
                                            <td>{{ $facturacion->precio}}</td>
                                            <td>{{ $facturacion->iva}}</td>
                                            <td class="text-center">{{ $facturacion->identificador}}</td>
                                            <td class="text-center">
                                             <a href="<?=URL::to('gestion/factura/editar-almacen');?>/{{ $facturacion->id }}"><span  id="tip" data-toggle="tooltip" data-placement="top" title="Editar Contenido" class="btn btn-primary"><i class="fa fa-pencil-square-o sidebar-nav-icon"></i></span></a>
                                             <script language="JavaScript">
                                             function confirmar ( mensaje ) {
                                             return confirm( mensaje );}
                                             </script>
                                             <a href="<?=URL::to('gestion/factura/eliminar-almacen');?>/{{$facturacion->id}}" onclick="return confirmar('¿Está seguro que desea eliminar el registro?')"><span id="tup" data-toggle="tooltip" data-placement="bottom" title="Editar Página" class="btn btn-danger"><i class="hi hi-trash sidebar-nav-icon"></i></span></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                         
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END Datatables Content -->




</div>



<script src="/adminsite/js/pages/tablesDatatables.js"></script>
<script>$(function(){ TablesDatatables.init(); });</script>

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
                     stringLength: {
                        min: 2,
                        max: 100,
                        message: 'El campo producto debe contener un minimo de 2 y un maximo de 100 Caracteres'
                    }
                }
            },
           iva: {
                message: 'The username is not valid',
                validators: {
                    notEmpty: {
                        message: 'Campo obligatorio'
                    },
                     stringLength: {
                        min: 1,
                        max: 3,
                        message: 'El campo IVA debe contener un minimo de 1 y un maximo de 3 Caracteres'
                    },
                    regexp: {
                        regexp: /^[0-9.]+$/,
                        message: 'Campo numerico'
                    }
                }
            },
            precio: {
                message: 'The username is not valid',
                validators: {
                    notEmpty: {
                        message: 'Este campo es obligatorio'
                    },
                     stringLength: {
                        min: 2,
                        max: 15,
                        message: 'El campo precio debe contener un minimo de 2 y un maximo de 15 Caracteres'
                    },
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'Campo numérico'
                    }
                }
            },
            identificador: {
                message: 'The username is not valid',
                validators: {
                    notEmpty: {
                        message: 'Este campo es obligatorio'
                    },
                     stringLength: {
                        min: 2,
                        max: 50,
                        message: 'El campo identificador debe contener un minimo de 2 y un maximo de 50 Caracteres'
                    }
                }
            },
    
        }
    });
});
</script>

  @stop
