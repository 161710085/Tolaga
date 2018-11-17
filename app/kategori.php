<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    protected $table = 'kategoris';
    protected $fillable = ['name'];
    public $timestamps = true;

    public function barang()
    {
        return $this->hasMany('App\barang','id_barang');
    }
}
