<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\foto_barang;
use App\kategori;
use App\jenis;
use App\merk;
use App\barang;
class FrontEndController extends Controller
{
    public function foto_barang() 
    
    {
        $barang = barang::all();
        return view('frontend.home',compact('barang'));
    }
    public function shop() 
    
    {
        $barang = barang::all();
        return view('frontend.shop',compact('barang'));
    }
    public function single(barang $barang) 
    
    {
        return view('frontend.single',compact('barang'));
    }
}
