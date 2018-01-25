<?php

Route::group(['middleware' => ['auths','administrador']], function () {
    //

Route::get('gestion/factura', 'Digitalsite\Facturacion\Http\FacturacionController@index');
Route::get('gestion/factura/editar-empresa', 'Digitalsite\Facturacion\Http\FacturacionController@editarempresa');
Route::get('gestion/factura/crear-producto', 'Digitalsite\Facturacion\Http\FacturacionController@createproducto');
Route::get('gestion/factura/actualizar-empresa', 'Digitalsite\Facturacion\Http\FacturacionController@update');
Route::get('gestion/factura/factura-cliente/juridico', 'Digitalsite\Facturacion\Http\FacturacionController@juridico');
Route::resource('gestion/factura/crear-cliente', 'Digitalsite\Facturacion\Http\FacturacionController@create');
Route::resource('gestion/factura/editar-cliente/juridica', 'Digitalsite\Facturacion\Http\FacturacionController@editarclientejuridica');
Route::resource('gestion/factura/editar-cliente', 'Digitalsite\Facturacion\Http\FacturacionController@editarcliente');
Route::resource('gestion/factura/actualizar-cliente', 'Digitalsite\Facturacion\Http\FacturacionController@actualizar');
Route::resource('gestion/factura/lista-facturas', 'Digitalsite\Facturacion\Http\FacturacionController@facturaempresa');
Route::resource('gestion/factura/crear-factura', 'Digitalsite\Facturacion\Http\FacturacionController@createfactura');
Route::resource('gestion/factura/editar-factura', 'Digitalsite\Facturacion\Http\FacturacionController@editarfactura');
Route::resource('gestion/factura/actualizar-factura', 'Digitalsite\Facturacion\Http\FacturacionController@updatefactura');
Route::resource('gestion/factura/generar-factura', 'Digitalsite\Facturacion\Http\FacturacionController@pdf');
Route::resource('gestion/factura/generar-facturacopia', 'Digitalsite\Facturacion\Http\FacturacionController@pdfcopia');
Route::resource('gestion/factura/creargasto', 'Digitalsite\Facturacion\Http\FacturacionController@creargasto');

Route::resource('gestion/factura/generar-producto', 'Digitalsite\Facturacion\Http\FacturacionController@facturaproducto');
Route::resource('gestion/factura/creacion-producto', 'Digitalsite\Facturacion\Http\FacturacionController@creatproducto');

Route::resource('gestion/factura/eliminar-producto', 'Digitalsite\Facturacion\Http\FacturacionController@eliminarproducto');
Route::resource('gestion/factura/editar-producto', 'Digitalsite\Facturacion\Http\FacturacionController@editarproducto');
Route::resource('gestion/factura/actualizar-producto', 'Digitalsite\Facturacion\Http\FacturacionController@actualizarproducto');
Route::resource('gestion/factura/factura-cliente', 'Digitalsite\Facturacion\Http\FacturacionController@crearcliente');
Route::resource('gestion/factura/control-gastos', 'Digitalsite\Facturacion\Http\FacturacionController@gastos');
Route::resource('gestion/factura/crear-gasto', 'Digitalsite\Facturacion\Http\FacturacionController@creargastos');
Route::resource('gestion/factura/crear-concepto', 'Digitalsite\Facturacion\Http\FacturacionController@crearconcepto');
Route::resource('gestion/factura/ingresarconcepto', 'Digitalsite\Facturacion\Http\FacturacionController@ingresarconcepto');
Route::resource('gestion/factura/eliminar-concepto', 'Digitalsite\Facturacion\Http\FacturacionController@eliminarconcepto');
Route::resource('gestion/factura/editar-concepto', 'Digitalsite\Facturacion\Http\FacturacionController@editarconcepto');
Route::resource('gestion/factura/updateconcepto', 'Digitalsite\Facturacion\Http\FacturacionController@updateconcepto');

Route::resource('gestion/factura/actualizarinput', 'Digitalsite\Facturacion\Http\FacturacionController@actualizarinput');


Route::resource('gestion/factura/eliminar-cliente', 'Digitalsite\Facturacion\Http\FacturacionController@eliminarcliente');
Route::resource('gestion/factura/eliminar-almacen', 'Digitalsite\Facturacion\Http\FacturacionController@eliminaralmacen');
Route::resource('gestion/factura/editar-almacen', 'Digitalsite\Facturacion\Http\FacturacionController@editaralmacen');
Route::resource('gestion/factura/crear-facturacion', 'Digitalsite\Facturacion\Http\FacturacionController@crearfactura');
Route::resource('gestion/factura/eliminar-gasto', 'Digitalsite\Facturacion\Http\FacturacionController@eliminargasto');
Route::resource('gestion/factura/editar-gasto', 'Digitalsite\Facturacion\Http\FacturacionController@editargasto');
Route::resource('gestion/factura/actualizargasto', 'Digitalsite\Facturacion\Http\FacturacionController@actualizargasto');

Route::get('gestion/factura/informe', function()
{
	$clientes = DB::table('clientes')->get();
 return View::make('facturacion::informe', compact('clientes'));
});

Route::get('informe/cliente/{id}', function($id) {

   $users = DB::table('facturas')
      ->join('productos', 'facturas.ids', '=', 'productos.factura_id')
      ->where('productos.cliente', '=', $id)->get();
   $total = DB::table('productos')->where('cliente', '=', $id)->sum('v_total');
   $iva = DB::table('productos')->where('cliente', '=', $id)->sum('costoiva');
   $retefuente = DB::table('productos')->where('cliente', '=', $id)->sum('rtefte');
   $ica = DB::table('productos')->where('cliente', '=', $id)->sum('rteica');
   $prefijo = DB::table('empresas')->where('id', 1)->get();


	$pdf = PDF::loadView('vista', compact('users', 'total', 'iva','retefuente', 'ica', 'prefijo'));
	return $pdf->stream();
});


Route::post('informe/general', function(){
       
       $min_price = Input::has('min_price') ? Input::get('min_price') : 0;
       $max_price = Input::has('max_price') ? Input::get('max_price') : 10000000;
       $clientes =  Input::get('cliente') ;
       $estados =  Input::get('estado') ;
   
       $users = DB::table('clientes')
         ->join('facturas', 'clientes.id', '=', 'facturas.cliente_id')
         ->whereBetween('f_emision', array($min_price, $max_price))
         ->where('cliente_id', 'like', '%' . $clientes . '%')
         ->where('estadof', 'like', '%' . $estados . '%')
         ->get();

         $unitarios =  $productos = DB::table('productos')
        ->join('facturas', 'productos.factura_id', '=', 'facturas.id')
        ->whereBetween('f_emision', array($min_price, $max_price))
         ->where('cliente_id', 'like', '%' . $clientes . '%')
         ->where('estadof', 'like', '%' . $estados . '%')
          ->selectRaw('sum(v_total) as sum')
          ->selectRaw('sum(masiva) as sumiva')
          ->selectRaw('sum(rtefte) as rtefte')
          ->selectRaw('sum(rteica) as rteica')
          ->selectRaw('factura_id as mus')
          ->groupBy('factura_id')
          ->get();


         $total = DB::table('productos')
         ->join('facturas', 'productos.factura_id', '=', 'facturas.id')
         ->whereBetween('f_emision', array($min_price, $max_price))
         ->where('cliente_id', 'like', '%' . $clientes . '%')
         ->where('estadof', 'like', '%' . $estados . '%')
         
         ->sum('v_total');

          $iva = DB::table('productos')
         ->join('facturas', 'productos.factura_id', '=', 'facturas.id')
         ->whereBetween('f_emision', array($min_price, $max_price))
         ->where('cliente_id', 'like', '%' . $clientes . '%')
         ->where('estadof', 'like', '%' . $estados . '%')
         
         ->sum('costoiva');

         $fuente = DB::table('productos')
         ->join('facturas', 'productos.factura_id', '=', 'facturas.id')
         ->whereBetween('f_emision', array($min_price, $max_price))
         ->where('cliente_id', 'like', '%' . $clientes . '%')
         ->where('estadof', 'like', '%' . $estados . '%')
         
         ->sum('rtefte');

         $ica = DB::table('productos')
         ->join('facturas', 'productos.factura_id', '=', 'facturas.id')
         ->whereBetween('f_emision', array($min_price, $max_price))
         ->where('cliente_id', 'like', '%' . $clientes . '%')
         ->where('estadof', 'like', '%' . $estados . '%')
         ->sum('rteica');

         $productos = DB::table('productos')
        ->join('facturas', 'productos.factura_id', '=', 'facturas.id')
        ->whereBetween('f_emision', array($min_price, $max_price))
         ->where('cliente_id', 'like', '%' . $clientes . '%')
         ->where('estadof', 'like', '%' . $estados . '%')
          ->selectRaw('sum(v_total) as sum')
          ->selectRaw('sum(masiva) as masiva')
          ->selectRaw('sum(rtefte) as rtefte')
          ->selectRaw('sum(rteica) as rteica')
          ->selectRaw('cliente_id as mus')
          ->groupBy('cliente_id')
          ->get();

          $empresa = DB::table('empresas')->where('id', 1)->get();

            $conteo = DB::table('clientes')
        ->join('facturas', 'clientes.id', '=', 'facturas.cliente_id')
        ->whereBetween('f_emision', array($min_price, $max_price))
         ->where('cliente_id', 'like', '%' . $clientes . '%')
         ->where('estadof', 'like', '%' . $estados . '%')
          ->selectRaw('count(cliente_id) as sum')
          ->selectRaw('cliente_id as mus')
          ->groupBy('cliente_id')
          ->get();

          $facturas = DB::table('facturas')->count();
          $cuentas = DB::table('productos')
          ->get();

          $prefijo = Digitalsite\Facturacion\Empresa::find(1);

        $clientes = DB::table('clientes')->get();

        $pdf = app('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        
      $pdf = PDF::loadView('facturacion::informefac', compact('users', 'clientes', 'total', 'empresa', 'iva', 'fuente', 'ica', 'productos', 'facturas', 'conteo', 'prefijo', 'min_price', 'max_price', 'unitarios'));
        $pdf->setPaper('A4', 'landscape');
      return  $pdf->stream();
});


Route::get('informe/generar-informe', function(){
      $clientes = DB::table('clientes')->get();
      return View::make('facturacion::filtro')->with('clientes', $clientes);
});



Route::get('informe/generar-informacion', function(){
  
      return View::make('facturacion::filtroinfo');
});



  Route::post('/productos/create', function(App\Http\Requests\AlmacenCreateRequest $Request){

$category = Digitalsite\Facturacion\Category::create([
	'producto' => Input::get('producto'),
  'identificador' => Input::get('identificador')

	]);


$subcategory = new Digitalsite\Facturacion\Subcategory([
	'iva' => Input::get('iva'),
	'identificador' => Input::get('identificador'),
	'precio' => Input::get('precio'),
	'producto' => Input::get('producto'),



	]);
$category->subcategories()->save($subcategory);

return Redirect('gestion/factura/crear-producto')->with('status', 'ok_create');

	});





  Route::post('/productos/update/{id}', function($id, App\Http\Requests\AlmacenUpdateRequest $request){


DB::table('categories')
            ->where('id', $id)
            ->update(array('producto' => Input::get('producto'),'identificador' => Input::get('identificador')));

DB::table('subcategories')
            ->where('category_id', $id)
            ->update(array('iva' => Input::get('iva'),'identificador' => Input::get('identificador'),'precio' => Input::get('precio'),'producto' => Input::get('producto')));





return Redirect('gestion/factura/crear-producto')->with('status', 'ok_create');

	});


Route::get('darioma/pdf', function() {
	$pdf = PDF::loadView('vista');
	return $pdf->stream();;
}

	);


 Route::get('Facturacione/{id}/ajax-subcat', function($id){

	$cat_id = Input::get('cat_id');

	$subcategories = Digitalsite\Facturacion\Subcategory::where('category_id', '=', $cat_id)->get();

	return Response::json($subcategories);
});

Route::get('indexa', function(){

return View::make('indexa');
});



 Route::get('Facturacione/{id}',function($id)
{
$facturacion = Digitalsite\Facturacion\Factura::find($id)->Productos;
		$contenido = Digitalsite\Facturacion\Factura::find($id);
		$categories = Digitalsite\Facturacion\Category::all();
		$product = Digitalsite\Facturacion\Almacen::Orderby('id', 'desc')->take(10)->pluck('producto','id');
		$retefuente = DB::table('facturas')->join('clientes','clientes.id','=','facturas.cliente_id')->where('facturas.id', '=', $id)->get();
	    return View::make('facturacion::crear_producto')->with('retefuente', $retefuente)->with('facturacion', $facturacion)->with('contenido', $contenido)->with('product', $product)->with('categories', $categories);
});



 Route::post('informe/generalgasto', function(){
       
       $min_price = Input::has('min_price') ? Input::get('min_price') : 0;
       $max_price = Input::has('max_price') ? Input::get('max_price') : 10000000;
       $clientes =  Input::get('cliente') ;
       $estados =  Input::get('estado') ;
   
      
          $unitarios  = DB::table('gastos')
          ->whereBetween('fecha', array($min_price, $max_price))
          ->selectRaw('sum(valor) as valor')
          ->selectRaw('sum(valornogra) as valornogra')
          ->selectRaw('sum(iva) as iva')
          ->selectRaw('sum(impuesto) as impuesto')
          ->selectRaw('sum(valorfac) as valorfac')
          ->selectRaw('sum(retefuente) as retefuente')
          ->selectRaw('sum(reteica) as reteica')
          ->selectRaw('sum(descuento) as descuento')
          ->selectRaw('sum(totaldes) as totaldes')
          ->selectRaw('sum(neto) as neto')
          ->get();

          $gastos = DB::table('gastos')
          ->whereBetween('fecha', array($min_price, $max_price))
          ->orderBy('mes')
          ->get();


          $resultados =  DB::table('gastos')
          ->whereBetween('fecha', array($min_price, $max_price))
          ->selectRaw('mes')
          ->selectRaw('sum(neto) as valor')
   
          ->groupBy('mes')
          ->get();


         $total = DB::table('productos')
         ->join('facturas', 'productos.factura_id', '=', 'facturas.id')
         ->whereBetween('f_emision', array($min_price, $max_price))
         ->where('cliente_id', 'like', '%' . $clientes . '%')
         ->where('estadof', 'like', '%' . $estados . '%')
         
         ->sum('v_total');

          $iva = DB::table('productos')
         ->join('facturas', 'productos.factura_id', '=', 'facturas.id')
         ->whereBetween('f_emision', array($min_price, $max_price))
         ->where('cliente_id', 'like', '%' . $clientes . '%')
         ->where('estadof', 'like', '%' . $estados . '%')
         
         ->sum('costoiva');

         $fuente = DB::table('productos')
         ->join('facturas', 'productos.factura_id', '=', 'facturas.id')
         ->whereBetween('f_emision', array($min_price, $max_price))
         ->where('cliente_id', 'like', '%' . $clientes . '%')
         ->where('estadof', 'like', '%' . $estados . '%')
         
         ->sum('rtefte');

         $ica = DB::table('productos')
         ->join('facturas', 'productos.factura_id', '=', 'facturas.id')
         ->whereBetween('f_emision', array($min_price, $max_price))
         ->where('cliente_id', 'like', '%' . $clientes . '%')
         ->where('estadof', 'like', '%' . $estados . '%')
         ->sum('rteica');

         $productos = DB::table('productos')
        ->join('facturas', 'productos.factura_id', '=', 'facturas.id')
        ->whereBetween('f_emision', array($min_price, $max_price))
         ->where('cliente_id', 'like', '%' . $clientes . '%')
         ->where('estadof', 'like', '%' . $estados . '%')
          ->selectRaw('sum(v_total) as sum')
          ->selectRaw('sum(masiva) as masiva')
          ->selectRaw('sum(rtefte) as rtefte')
          ->selectRaw('sum(rteica) as rteica')
          ->selectRaw('cliente_id as mus')
          ->groupBy('cliente_id')
          ->get();

          $empresa = DB::table('empresas')->where('id', 1)->get();

            $conteo = DB::table('clientes')
        ->join('facturas', 'clientes.id', '=', 'facturas.cliente_id')
        ->whereBetween('f_emision', array($min_price, $max_price))
         ->where('cliente_id', 'like', '%' . $clientes . '%')
         ->where('estadof', 'like', '%' . $estados . '%')
          ->selectRaw('count(cliente_id) as sum')
          ->selectRaw('cliente_id as mus')
          ->groupBy('cliente_id')
          ->get();

          $facturas = DB::table('facturas')->count();
          $cuentas = DB::table('productos')
          ->get();

          $prefijo = Digitalsite\Facturacion\Empresa::find(1);

        $clientes = DB::table('clientes')->get();

        $pdf = app('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        
      $pdf = PDF::loadView('facturacion::informegasto', compact('users', 'clientes', 'resultados', 'gastos', 'total', 'empresa', 'iva', 'fuente', 'ica', 'productos', 'facturas', 'conteo', 'prefijo', 'min_price', 'max_price', 'unitarios'));
        $pdf->setPaper('Legal', 'landscape');
      return  $pdf->stream();
});


});