<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class merk extends Model
{
    protected $table = 'merks';
    protected $fillable = ['name'];
    public $timestamps = true;

    public function barang()
    {
        return $this->hasMany('App\barang','id_barang');
    }
}
