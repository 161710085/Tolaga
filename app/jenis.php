<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jenis extends Model
{
    protected $table = 'jenis';
    protected $fillable = ['name'];
    public $timestamps = true;

    public function barang()
    {
        return $this->hasMany('App\barang','id_barang');
    }
}
