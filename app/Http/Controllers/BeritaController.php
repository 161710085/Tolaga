<?php

namespace App\Http\Controllers;

use App\berita;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\Datatables\DataTables;
use Session;
class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request, Builder $builder)
    { 
        if ($request->ajax()) {
       $berita = berita::all();
        return Datatables::of($berita)
                ->addColumn('action', function ($berita) {  
                    return view('datatable._action', [
                    'model'=> $berita,
                    'form_url'=> route('berita.destroy', $berita->id),
                    'edit_url' => route('berita.edit',$berita->id),
                    'confirm_message' => 'Yakin mau menghapus ' .$berita->name . '?'
    
                ]);
                })->make(true);
    }
    $html = $builder
        ->addColumn(['data' => 'judul', 'name'=>'judul','title'=>'Judul Berita'])
        ->addColumn(['data' => 'isi', 'name'=>'isi','title'=>'Isi Berita'])
    
        ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false,
                     'searchable'=>false]);
    return view('berita.index', compact('html'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('berita.create');
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
            'judul' => 'required|',
            'isi' => 'required|',
            'foto' => 'required|',
            'slug' => 'required|',                
            ]);
        $berita = new berita;
        $berita->judul = $request->judul;
        $berita->isi = $request->isi;
        $berita->slug = $request->slug;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $destinationPath = public_path().'/assets/img/berita/';
            $filename = str_random(6).'_'.$file->getClientOriginalName();
            $uploadSuccess = $file->move($destinationPath, $filename);
            $berita->foto = $filename;
     }
       
          $berita->save();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil menyimpan <b>$berita->berita</b>"
        ]);
        return redirect()->route('berita.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function show(berita $berita)
    {
        $berita = berita::findOrFail($id);
        return view('berita.show',compact('berita'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function edit(berita $berita)
    {
        $berita = berita::findOrFail($id);

        return view('berita.edit',compact('berita'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, berita $berita)
    {
        
        $this->validate($request,[
            'judul' => 'required|',
        'isi' => 'required|',
        'foto' => 'required|',
        'slug' => 'required|',
]);

$berita = berita::findOrFail($id);
$berita->judul = $request->judul;
$berita->isi = $request->isi;
            $berita->slug = $request->slug;
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $destinationPath = public_path().'/assets/img/berita/';
                $filename = str_random(6).'_'.$file->getClientOriginalName();
                $uploadSuccess = $file->move($destinationPath, $filename);
        
            // hapus foto lama, jika ada
            if ($berita->foto) {
            $old_foto = $berita->foto;
            $filepath = public_path() . DIRECTORY_SEPARATOR . '/assets/img/berita'
            . DIRECTORY_SEPARATOR . $berita->foto;
                try {
                File::delete($filepath);
                } catch (FileNotFoundException $e) {
            // File sudah dihapus/tidak ada
                }
            }
            $berita->foto = $filename;
    }
    
            $berita->save();
           Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil mengedit <b>$berita->nama</b>"
            ]);
            return redirect()->route('berita.index');
        }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function destroy(berita $berita)
    {
        $berita = berita::findOrFail($berita->id);
        if ($berita->foto) {
            $old_foto = $berita->foto;
            $filepath = public_path() . DIRECTORY_SEPARATOR . 'assets/img/berita/'
            . DIRECTORY_SEPARATOR . $berita->foto;
            try {
            File::delete($filepath);
            } catch (FileNotFoundException $e) {
            // File sudah dihapus/tidak ada
            }
            }
        $berita->delete();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Data Berhasil dihapus"
        ]);
        return redirect()->route('berita.index');
    }
}
