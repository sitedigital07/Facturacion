<?php

namespace Digitalsite\Facturacion;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model

{

	protected $table = 'facturas';
	public $timestamps = true;

    public function clientes(){
		return $this->belongsTo('Cliente');
	}

		public function productos(){
	return $this->hasMany('Digitalsite\Facturacion\Producto');

	}

}

