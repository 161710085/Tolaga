<?php

namespace App\Http\Controllers;

use App\jenis;
use Illuminate\Http\Request;
use Session;
class JenisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
           $jenis = jenis::all();
        return view('jenis.index',compact('jenis'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jenis.create');
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
            'nama' => 'required|'
                
            ]);
        $jenis = new jenis;
        $jenis->nama = $request->nama;
       
          $jenis->save();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil menyimpan <b>$jenis->jenis</b>"
        ]);
        return redirect()->route('jenis.index');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\jenis  $jenis
     * @return \Illuminate\Http\Response
     */
    public function show(jenis $jenis)
    {
        $jenis = jenis::findOrFail($id);
        return view('jenis.show',compact('jenis'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\jenis  $jenis
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $jenis = jenis::findOrFail($id);

        return view('jenis.edit',compact('jenis'));
  

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\jenis  $jenis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
        {
            $this->validate($request,[
                'nama' => 'required|'
            
                ]);
            $jenis = jenis::findOrFail($id);
            $jenis->nama = $request->nama;
        $jenis->save();
            Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil mengedit <b>$jenis->jenis</b>"
            ]);
            return redirect()->route('jenis.index');

        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\jenis  $jenis
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $a = jenis::findOrFail($id);
        $a->delete();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Data Berhasil dihapus"
        ]);
        return redirect()->route('jenis.index');

}
}