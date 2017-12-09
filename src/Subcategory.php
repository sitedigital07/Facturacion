<?php

namespace Digitalsite\Facturacion;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model

{

	 protected $guarded = [];

     public function categories(){

     	return $this->belongsTo('Digitalsite\Facturacion\Category');
     }


}
