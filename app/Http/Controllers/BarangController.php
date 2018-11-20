<?php

namespace App\Http\Controllers;

use App\barang;
use Illuminate\Http\Request;
use App\kategori;
use App\merk;
use App\jenis;
class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $barang = barang::with('merk')->get();
        return view('barang.index',compact('barang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = kategori::all();
        $merk = merk::all();
        $jenis = jenis::all();
        return view('barang.create',compact('kategori','merk','jenis'));
    //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'nama' => 'required|',
            'id_kategori' => 'required|',
            'id_merk' => 'required|',
            'id_jenis' => 'required|',
            'deskripsi' => 'required|',
            'harga' => 'required|',
            'slug' => 'required|',
            ]);

            $barang = new barang;
            $barang->nama = $request->nama;
            $barang->id_kategori = $request->id_kategori;
            $barang->id_merk = $request->id_merk;
            $barang->id_jenis = $request->id_jenis;
            $barang->deskripsi = $request->deskripsi;
            $barang->harga = $request->harga;
            $barang->slug = $request->slug;
            $barang->save();
            Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan <b>$barang->nama</b>"
            ]);
            return redirect()->route('barang.index');
            
            
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(barang $barang)
    {
        
            $barang = barang::findOrFail($id);
           return view('barang.show',compact('barang'));
   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(barang $barang)
    {
        $barang = barang::findOrFail($id);
        $kategori = kategori::all();
        $selectedkategori = barang::findOrFail($id)->id_kategori;
        $merk = merk::all();
        $selectedmerk = barang::findOrFail($id)->id_merk;
        $selectedjenis = $barang->jenis->pluck('id')->toArray();
        $jenis = jenis::all();
        // dd($selected);
        return view('barang.edit',compact('barang','kategori','selectedkategori','merk','selectedmerk','selectedjenis','jenis'));
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, barang $barang)
    {
        $this->validate($request,[
            'nama' => 'required|',
            'id_kategori' => 'required|',
            'id_merk' => 'required|',
            'id_jenis' => 'required|',
            'deskripsi' => 'required|',
            'harga' => 'required|',
            'slug' => 'required|',
        ]);
        $barang = barang::findOrFail($id);
        $barang->nama = $request->nama;
        $barang->id_kategori = $request->id_kategori;
        $barang->id_merk = $request->id_merk;
        $barang->id_jenis = $request->id_jenis;
        $barang->deskripsi = $request->deskripsi;
        $barang->harga = $request->harga;
        $barang->slug = $request->slug;
        $barang->save();
        Session::flash("flash_notification", [
         "level"=>"success",
         "message"=>"Berhasil mengedit <b>$barang->nama</b>"
         ]);
         return redirect()->route('barang.index');
     
 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(barang $barang)
    {
        $a = kategori::findOrFail($id);
        $a->delete();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Data Berhasil dihapus"
        ]);
        return redirect()->route('kategori.index');
    }
}
