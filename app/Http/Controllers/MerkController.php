<?php

namespace App\Http\Controllers;

use App\merk;
use Illuminate\Http\Request;
use Session;
class MerkController extends Controller
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
           $merk = merk::all();
        return view('merk.index',compact('merk'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('merk.create');
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
        $merk = new merk;
        $merk->nama = $request->nama;
       
          $merk->save();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil menyimpan <b>$merk->merk</b>"
        ]);
        return redirect()->route('merk.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\merk  $merk
     * @return \Illuminate\Http\Response
     */
    public function show(merk $merk)
    {
        $merk = merk::findOrFail($id);
        return view('merk.show',compact('merk'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\merk  $merk
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $merk = merk::findOrFail($id);

        return view('merk.edit',compact('merk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\merk  $merk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $this->validate($request,[
            'nama' => 'required|'
        
             ]);
        $merk = merk::findOrFail($id);
        $merk->nama = $request->nama;
    $merk->save();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil mengedit <b>$merk->merk</b>"
        ]);
        return redirect()->route('merk.index');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\merk  $merk
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $a = merk::findOrFail($id);
        $a->delete();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Data Berhasil dihapus"
        ]);
        return redirect()->route('merk.index');

        //
    }
}
