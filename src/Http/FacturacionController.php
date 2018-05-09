<?php


namespace Digitalsite\Facturacion\Http;
use App\Http\Requests\ClienteCreateRequest;
use App\Http\Requests\ProductoCreateRequest;
use App\Http\Requests\EmpresaUpdateRequest;
use App\Http\Requests\ClienteUpdateRequest;
use App\Http\Requests\FacturaUpdateRequest;
use App\Http\Requests\FacturaCreateRequest;
use Digitalsite\Facturacion\Cliente;
use Digitalsite\Facturacion\Empresa;
use Digitalsite\Facturacion\Almacen;
use Digitalsite\Facturacion\Factura;
use Digitalsite\Facturacion\Producto;
use Digitalsite\Facturacion\Max;
use Digitalsite\Facturacion\Category;
use Digitalsite\Facturacion\Gasto;
use Digitalsite\Facturacion\Concepto;
use DB;
use PDF;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;


use Illuminate\Http\Request;
class FacturacionController extends Controller{

 public function __construct()
    {
        $this->middleware('auth');
    }


public function index(){
        
	    	$facturacion = Cliente::all();
	    return view('facturacion::hola')->with('facturacion', $facturacion);
     
}



    public function editarempresa(){

		$facturacion = Empresa::find(1);
		return view('facturacion::editar_empresa')->with('facturacion', $facturacion);
	    }


public function createproducto(){

	
		$facturacion = Max::join('categories','categories.id','=','subcategories.category_id')->get();
	    return view('facturacion::crear_almacen')->with('facturacion', $facturacion);
		}

		public function crearcliente(){
	    return view('facturacion::crear_cliente');
		}


		public function gastos(){
		$gastos = Gasto::all();
	    return view('facturacion::gastos')->with('gastos', $gastos);
		}

		public function creargastos(){
		$concepto = Concepto::pluck('concepto', 'id');

	    return view('facturacion::crear-gastos', compact('id', 'concepto'));
		}

		public function crearconcepto(){
		$conceptos = Concepto::all();
	    return view('facturacion::crear-concepto')->with('conceptos', $conceptos);
		}


      public function update(EmpresaUpdateRequest $request) {
 
		$input = Input::all();
		$facturacion = Empresa::find(1);
		$facturacion->r_social =  Input::get('r_social');
		$facturacion->nit = Input::get('nit');
		$facturacion->direccion = Input::get('direccion');
		$facturacion->telefono = Input::get('telefono');
		$facturacion->ciudad = Input:: get ('ciudad');
		$facturacion->email = Input:: get ('email');
		$facturacion->aed = Input:: get ('aed');
		$facturacion->t_ica = Input:: get ('t_ica');
		$facturacion->t_cree = Input:: get ('t_cree');
		$facturacion->regimen = Input:: get ('regimen');
		$facturacion->r_factura = Input:: get ('r_factura');
		$facturacion->n_mercantil = Input:: get ('n_mercantil');
		$facturacion->website = Input:: get ('website');
		$facturacion->c_comercio = Input:: get ('c_comercio');
		$facturacion->f_ingreso = Input:: get ('start');
		$facturacion->prefijo = Input:: get ('prefijo');
		$facturacion->image = Input::get('FilePath');
		$facturacion->color = Input::get('color');
		$facturacion->coloruno = Input::get('coloruno');
		$facturacion->colordos = Input::get('colordos');
		$facturacion->save();

		return Redirect('gestion/factura')->with('status', 'ok_create');

    }



    public function ingresarconcepto(){
	
	$contenido = new Concepto;
	$contenido->concepto = Input::get('concepto');
	$contenido->save();
	return Redirect('gestion/factura/crear-concepto/')->with('status', 'ok_create');
	}

	public function editarconcepto($id){
	$conceptos = Concepto::find($id);
	return view('facturacion::editar-concepto')->with('conceptos', $conceptos);
	}


  public function updateconcepto($id){
	$input = Input::all();
	$contenido = Concepto::find($id);
	$contenido->concepto = Input::get('concepto');
	$contenido->save();
	return Redirect('gestion/factura/crear-concepto/')->with('status', 'ok_create');
	}

    public function create() {
 
		$facturacion = new Cliente;
		$facturacion->terceros = Input::get('terceros');
		$facturacion->t_persona = Input::get('t_persona');
		$facturacion->p_apellido = Input::get('p_apellido');
		$facturacion->s_apellido = Input::get('s_apellido');
		$facturacion->p_nombre = Input:: get ('p_nombre');
		$facturacion->s_nombre = Input:: get ('s_nombre');
		$facturacion->t_documento = Input:: get ('t_documento');
		$facturacion->documento = Input:: get ('documento');
		$facturacion->direccion = Input:: get ('direccion');
		$facturacion->telefono = Input:: get ('telefono');
		$facturacion->ciudad = Input:: get ('ciudad');
		$facturacion->email = Input:: get ('email');
		$facturacion->estado = Input:: get ('estado');
		$facturacion->proceso = Input:: get ('situacion');
		$facturacion->ingreso = Input:: get ('start');
		$facturacion->regimen = Input:: get ('regimen');
		$facturacion->retefuente = Input:: get ('retefuente');
		$facturacion->save();

		return Redirect('/gestion/factura')->with('status', 'ok_create');

    }

       public function editarclientejuridica($id){

		$facturacion = Cliente::find($id);
		return view('facturacion::editar_juridica')->with('facturacion', $facturacion);
	    }

    
   public function editarcliente($id){

		$facturacion = Cliente::find($id);
		return view('facturacion::editar_cliente')->with('facturacion', $facturacion);
	    }


       public function actualizar($id, ClienteUpdateRequest $request){

        $input = Input::all();
		$facturacion = Cliente::find($id);
		$facturacion->terceros = Input::get('terceros');
		$facturacion->t_persona = Input::get('t_persona');
		$facturacion->p_apellido = Input::get('p_apellido');
		$facturacion->s_apellido = Input::get('s_apellido');
		$facturacion->p_nombre = Input:: get ('p_nombre');
		$facturacion->s_nombre = Input:: get ('s_nombre');
		$facturacion->t_documento = Input:: get ('t_documento');
		$facturacion->documento = Input:: get ('documento');
		$facturacion->direccion = Input:: get ('direccion');
		$facturacion->telefono = Input:: get ('telefono');
		$facturacion->ciudad = Input:: get ('ciudad');
		$facturacion->email = Input:: get ('email');
		$facturacion->estado = Input:: get ('estado');
		$facturacion->proceso = Input:: get ('situacion');
		$facturacion->ingreso = Input:: get ('start');
		$facturacion->regimen = Input:: get ('regimen');
		$facturacion->retefuente = Input:: get ('retefuente');
		$facturacion->save();

		return Redirect('/gestion/factura')->with('status', 'ok_create');
       
	    }

	public function facturaempresa($id){

		$facturacion = Cliente::find($id)->Facturas;
		$contenido = Cliente::find($id);
	    return view('facturacion::crear_factura')->with('facturacion', $facturacion)->with('contenido', $contenido);
		}


  public function createfactura(FacturaCreateRequest $request) {
 
		$facturacion = new Factura;
		$facturacion->cliente_id = Input:: get ('identificador');
		$facturacion->observaciones = Input:: get ('observaciones');
		$facturacion->dirigido = Input:: get ('dirigido');
		$facturacion->f_emision = Input:: get ('start');
		$facturacion->f_vencimiento = Input:: get ('end');
		$facturacion->estadof = Input:: get ('estado');
		$facturacion->save();

		return Redirect('gestion/factura/lista-facturas/'.$facturacion->cliente_id)->with('status', 'ok_create');

    }

 public function editarfactura($id){

		$facturacion = Factura::find($id);
		return View('facturacion::editar_factura')->with('facturacion', $facturacion);
	    }   


	       public function updatefactura($id, FacturaUpdateRequest $request) {
 
 		$input = Input::all();
		$facturacion = Factura::find($id);
		$facturacion->cliente_id = Input:: get ('identificador');
		$facturacion->observaciones = Input:: get ('observaciones');
		$facturacion->dirigido = Input:: get ('dirigido');
		$facturacion->f_emision = Input:: get ('start');
		$facturacion->f_vencimiento = Input:: get ('end');
		$facturacion->estadof = Input:: get ('estado');
		$facturacion->save();

		return Redirect('gestion/factura/lista-facturas/'.$facturacion->cliente_id)->with('status', 'ok_update');

    }


		public function pdf($id){
		$empresa = DB::table('empresas')->where('id', 1)->get();
		$users = DB::table('facturas')->count();

		$empresario = DB::table('empresas')->min('desde');
		
		$total = $users+$empresario;
		$totalazo = DB::table('productos')->where('factura_id', '=', $id)->groupBy('factura_id')->sum('v_total');
		$totalseis = DB::table('productos')->where('factura_id', '=', $id)->where('iva', '=', '16')->sum('costoiva');
		$totaldiez = DB::table('productos')->where('factura_id', '=', $id)->where('iva', '=', '10')->sum('costoiva');
		$totalnueve = DB::table('productos')->where('factura_id', '=', $id)->where('iva', '=', '19')->sum('costoiva');
		$descuento = DB::table('productos')->where('factura_id', '=', $id)->sum('descue');
		$totaliva = $totalazo*16/100;
		$color = Empresa::find(1);
		$grantotal = $totalazo+$totaliva;
		$totalito = DB::table('productos')->where('factura_id', '=', $id)->sum('masiva');
		$rteica = DB::table('productos')->where('factura_id', '=', $id)->sum('rteica');
		$rtefte = DB::table('productos')->where('factura_id', '=', $id)->sum('rtefte');
		$rteiva = DB::table('productos')->where('factura_id', '=', $id)->sum('rteiva');
		$post = DB::table('facturas')->where('id', $id)->pluck('cliente_id');
		$name = DB::table('facturas')->where('id', '=', $id)->get();
		$prefijo = DB::table('empresas')->where('id', 1)->get();
		$producto = DB::table('productos')->where('factura_id', '=', $id)->get();
		$cliente = DB::table('clientes')->where('id', '=', $post)->get();
		
		$pdf = PDF::loadView('facturacion::pdf', compact('empresa','color','cliente','prefijo','producto','name','totalazo','totaliva','grantotal','totalseis','totaldiez','usuarios','total', 'totalnueve', 'iva', 'totalito','descuento','rtefte','rteica','rteiva'));
		return $pdf->stream(); 
		}


		public function pdfcopia($id){
		$empresa = DB::table('empresas')->where('id', 1)->get();
		$users = DB::table('facturas')->count();

		$empresario = DB::table('empresas')->min('desde');

		$total = $users+$empresario;
		$totalazo = DB::table('productos')->where('factura_id', '=', $id)->groupBy('factura_id')->sum('v_total');
		$totalseis = DB::table('productos')->where('factura_id', '=', $id)->where('iva', '=', '16')->sum('costoiva');
		$totaldiez = DB::table('productos')->where('factura_id', '=', $id)->where('iva', '=', '10')->sum('costoiva');
		$totalnueve = DB::table('productos')->where('factura_id', '=', $id)->where('iva', '=', '19')->sum('costoiva');
		$descuento = DB::table('productos')->where('factura_id', '=', $id)->sum('descue');
		$totaliva = $totalazo*16/100;
		$color = Empresa::find(1);
		$grantotal = $totalazo+$totaliva;
		$totalito = DB::table('productos')->where('factura_id', '=', $id)->sum('masiva');
		$rteica = DB::table('productos')->where('factura_id', '=', $id)->sum('rteica');
		$rtefte = DB::table('productos')->where('factura_id', '=', $id)->sum('rtefte');
		$rteiva = DB::table('productos')->where('factura_id', '=', $id)->sum('rteiva');
		$post = DB::table('facturas')->where('id', $id)->pluck('cliente_id');
		$name = DB::table('facturas')->where('id', '=', $id)->get();
		$prefijo = DB::table('empresas')->where('id', 1)->get();
		$producto = DB::table('productos')->where('factura_id', '=', $id)->get();
		$cliente = DB::table('clientes')->where('id', '=', $post)->get();
		
		$pdf = PDF::loadView('facturacion::pdfcopia', compact('empresa','color','cliente','prefijo','producto','name','totalazo','totaliva','grantotal','totalseis','totaldiez','usuarios','total', 'totalnueve', 'iva', 'totalito','descuento','rtefte','rteica','rteiva'));
		return $pdf->stream(); 
		}


public function facturaproducto($id){


	    $facturacion = Factura::find($id)->Productos;
		$contenido = Factura::find($id);
		$categories = Category::all();
		$product = Almacen::Orderby('id', 'desc')->take(10)->pluck('producto','id');
		
	    return view('facturacion::crear_producto')->with('facturacion', $facturacion)->with('contenido', $contenido)->with('product', $product)->with('categories', $categories);
		}




   public function creatproducto(ProductoCreateRequest $Request) {
        $contenido = Empresa::find(1);
        
		$facturacion = new Producto;
		$facturacion->cliente = Input:: get ('cliente');
		$facturacion->retefuente = Input:: get ('retefuente');
		$facturacion->reteiva = DB::table('clientes')->where('id', $facturacion->cliente)->value('regimen');
		$facturacion->factura_id = Input:: get ('identificador');
		$facturacion->producto = Input:: get ('producto');
		$facturacion->product = Input:: get ('product');
		$facturacion->cantidad = Input:: get ('cantidad');
		$facturacion->v_unitario = Input:: get ('v_unitario');
	    $facturacion->iva = Input:: get ('iva');
	    $facturacion->descuento = Input:: get ('descuento');
	    $facturacion->descripcion = Input:: get ('descripcion');
	    $facturacion->descue = $facturacion->v_unitario*$facturacion->cantidad*$facturacion->descuento/100;
	    $facturacion->v_total = $facturacion->v_unitario*$facturacion->cantidad-$facturacion->descue;
	    $facturacion->rteica = $facturacion->v_total*$contenido->t_ica/1000;
	    $facturacion->rtefte = $facturacion->v_total*$facturacion->retefuente/100;
	    $facturacion->masiva = $facturacion->v_total*$facturacion->iva/100+$facturacion->v_total;
	    $facturacion->costoiva = $facturacion->v_total*$facturacion->iva/100;
	    if($facturacion->reteiva == 1)
		 $facturacion->rteiva = 0;
		else
	    $facturacion->rteiva = $facturacion->costoiva*15/100;

		
		$facturacion->save();

		return Redirect('Facturacione/'.$facturacion->factura_id)->with('status', 'ok_create');

    }

		public function eliminarproducto($id){

		$facturacion = Producto::find($id);
		$facturacion->delete();
		return Redirect('Facturacione/'.$facturacion->factura_id)->with('status', 'ok_delete');
		}

		public function eliminarconcepto($id){

		$facturacion = Concepto::find($id);
		$facturacion->delete();
		return Redirect('gestion/factura/crear-concepto')->with('status', 'ok_delete');
		}


 		public function editarproducto($id){

		$facturacion = DB::table('productos')->where('id', "=", $id)->get();
		$facturado = DB::table('productos')->where('id', "=", $id)->first();
		$retefuente = Factura::where('id', $facturado->factura_id)->first();
		return view('facturacion::editar_producto')->with('facturacion', $facturacion)->with('retefuente', $retefuente);
	    }

	    public function crearfactura($id){
	     $contenido = Cliente::find($id);
		return view('facturacion::crear_facturacion')->with('contenido', $contenido);
	    }

	     public function editaralmacen($id){

		$facturacion = DB::table('categories')->where('id', "=", $id)->get();
		$subfacturacion = DB::table('subcategories')->where('category_id', "=", $id)->get();
		return view('facturacion::editar_almacen')->with('facturacion', $facturacion)->with('subfacturacion', $subfacturacion);
	    }

	        public function juridico(){

		return view('facturacion::crear_juridico');
	    }


	      public function actualizarproducto($id) {
 		$contenido = Empresa::find(1);
 		$input = Input::all();
		$facturacion = Producto::find($id);
		$facturacion->cliente = Input:: get ('cliente');
		$facturacion->factura_id = Input:: get ('identificador');
		$facturacion->retefuente = Input:: get ('retefuente');
		$facturacion->reteiva = DB::table('clientes')->where('id', $facturacion->cliente)->value('regimen');
		$facturacion->producto = Input:: get ('producto');
		$facturacion->product = Input:: get ('product');
		$facturacion->cantidad = Input:: get ('cantidad');
		$facturacion->v_unitario = Input:: get ('v_unitario');
	    $facturacion->iva = Input:: get ('iva');
	    $facturacion->descuento = Input:: get ('descuento');
	    $facturacion->descripcion = Input:: get ('descripcion');
		$facturacion->descue = $facturacion->v_unitario*$facturacion->cantidad*$facturacion->descuento/100;
	    $facturacion->v_total = $facturacion->v_unitario*$facturacion->cantidad-$facturacion->descue;
	    $facturacion->rteica = $facturacion->v_total*$contenido->t_ica/1000;
	    $facturacion->rtefte = $facturacion->v_total*$facturacion->retefuente/100;
	    $facturacion->masiva = $facturacion->v_total*$facturacion->iva/100+$facturacion->v_total;
	    $facturacion->costoiva = $facturacion->v_total*$facturacion->iva/100;

	     if($facturacion->reteiva == 1)
		 $facturacion->rteiva = 0;
		else
	    $facturacion->rteiva = $facturacion->costoiva*15/100;

		$facturacion->save();

			return Redirect('Facturacione/'.$facturacion->factura_id)->with('status', 'ok_update');

    }



    public function eliminarcliente($id){

		$facturacion = Cliente::find($id);
		$facturacion->delete();
		return Redirect('gestion/factura')->with('status', 'ok_delete');
		}

	 public function eliminargasto($id){

		$facturacion = Gasto::find($id);
		$facturacion->delete();
		return Redirect('gestion/factura/control-gastos')->with('status', 'ok_delete');
		}

	public function eliminaralmacen($id){

		$contenido = Category::find($id);
		$contenido->delete();
		return Redirect('gestion/factura/crear-producto')->with('status', 'ok_delete');
		}


		public function editargasto($id){

		$gastos = Gasto::where('id', '=', $id)->get();
		$conceptualizacion = Gasto::join('concepto','concepto.id','=','gastos.concepto')->get();
		$concepto = Concepto::all();
		return view('facturacion::editar-gastos')->with('gastos', $gastos)->with('concepto', $concepto)->with('conceptualizacion', $conceptualizacion);
	    }

	    public function actualizargasto($id){

        $input = Input::all();
		$contenido = Gasto::find($id);
		$contenido->mes = Input::get('mes');
		$contenido->fecha = Input::get('fecha');
		$contenido->compra = Input::get('compra');
		$contenido->tercero = Input::get('tercero');
		$contenido->documento = Input::get('documento');
		$contenido->direccion = Input::get('direccion');
		$contenido->ciudad = Input::get('ciudad');
		$contenido->telefono = Input::get('telefono');
		$contenido->tipo = Input::get('tipo');
		$contenido->descripcion = Input::get('descripcion');
		$contenido->concepto = Input::get('concepto');
		$contenido->valor = Input::get('valor');
		$contenido->valornogra = Input::get('valornogra');
		$contenido->conceptoiva = Input::get('conceptoiva');
		$contenido->iva = Input::get('iva');
		$contenido->impuesto = Input::get('impuesto');
		$contenido->valorfac = Input::get('valorfac');
		$contenido->retefuente = Input::get('retefuente');
		$contenido->reteica = Input::get('reteica');
		$contenido->reteiva = Input::get('reteiva');
		$contenido->descuento = Input::get('descuento');
		$contenido->totaldes = Input::get('totaldes');
		$contenido->neto = Input::get('neto');
		$contenido->save();

		return Redirect('gestion/factura/control-gastos')->with('status', 'ok_create');
       
	    }

	        	    public function creargasto(){
	
	$contenido = new Gasto;
	$contenido->mes = Input::get('mes');
	$contenido->fecha = Input::get('fecha');
	$contenido->compra = Input::get('compra');
	$contenido->tercero = Input::get('tercero');
	$contenido->documento = Input::get('documento');
	$contenido->direccion = Input::get('direccion');
	$contenido->ciudad = Input::get('ciudad');
	$contenido->telefono = Input::get('telefono');
	$contenido->tipo = Input::get('tipo');
	$contenido->descripcion = Input::get('descripcion');
	$contenido->concepto = Input::get('concepto');
	$contenido->valor = Input::get('valor');
	$contenido->valornogra = Input::get('valornogra');
	$contenido->conceptoiva = Input::get('conceptoiva');
	$contenido->iva = Input::get('iva');
	$contenido->impuesto = Input::get('impuesto');
	$contenido->valorfac = Input::get('valorfac');
	$contenido->retefuente = Input::get('retefuente');
	$contenido->reteica = Input::get('reteica');
	$contenido->reteiva = Input::get('reteiva');
	$contenido->descuento = Input::get('descuento');
	$contenido->totaldes = Input::get('totaldes');
	$contenido->neto = Input::get('neto');
	$contenido->save();

	return Redirect('gestion/factura/control-gastos')->with('status', 'ok_create');
	}

	      public function pdfview(Request $request)
    {
        $items = DB::table("gastos")->get();
        view()->share('items',$items);


        if($request->has('download')){
            $pdf = PDF::loadView('pdfview');
            return $pdf->download('pdfview.pdf');
        }


        return view('pdfview');
    }

}








