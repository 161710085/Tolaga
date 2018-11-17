<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class berita extends Model
{
    protected $table ='beritas';
    protected $fillable = ['judul','isi','foto','slug'];
     public $timestamps=true;
  
}
