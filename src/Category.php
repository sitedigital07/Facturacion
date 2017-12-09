<?php

namespace Digitalsite\Facturacion;

use Illuminate\Database\Eloquent\Model;

class Category extends Model

{

	
	public $guarded = [];

	public function subcategories(){

//Se relaciona uno a muchos
		return $this->hasMany('Digitalsite\Facturacion\Subcategory');
	}

}




