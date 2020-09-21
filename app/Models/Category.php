<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function articleCount(){
        return $this->hasmany('App\Models\article','category_id','id')->count();
                            //Baglanacag model   //modelin id-si // esas id
    }
}
