@extends('layouts.admin')
@section('content')
<div class="row">
	<div class="container">
		<div class="col-md-12">
			<div class="panel panel-primary">
			  <div class="panel-heading">Edit Data barang 
			  	<div class="panel-title pull-right"><a href="{{ url()->previous() }}">Kembali</a>
			  	</div>
			  </div>
			  <div class="panel-body">
			  	<form action="{{ route('barang.update',$barang->id) }}" method="post" >
			  		<input name="_method" type="hidden" value="PATCH">
        			{{ csrf_field() }}
			  		<div class="form-group {{ $errors->has('nama') ? ' has-error' : '' }}">
			  			<label class="control-label">Nama barang</label>	
			  			<input type="text" name="nama" class="form-control" value="{{ $barang->nama }}"  required>
			  			@if ($errors->has('nama'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nama') }}</strong>
                            </span>
                        @endif
                        <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">kategori</label>
                                <select class="form-control" name="id_kategori" required>
                                    @foreach($kategori as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                    @endforeach()
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">merk</label>
                                <select class="form-control" name="id_merk" required>
                                    @foreach($merk as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                    @endforeach()
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">jenis</label>
                                <select class="form-control" name="id_jenis" required>
                                    @foreach($jenis as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                    @endforeach()
                                </select>
                            </div>
                            <div class="form-group {{ $errors->has('deskripsi') ? ' has-error' : '' }}">
			  			<label class="control-label">deskripsi </label>	
			  			<input type="text" name="deskripsi" class="form-control" value="{{ $barang->deskripsi }}"  required>
			  			@if ($errors->has('deskripsi'))
                            <span class="help-block">
                                <strong>{{ $errors->first('deskripsi') }}</strong>
                            </span>
                        @endif
                        <div class="form-group {{ $errors->has('size') ? ' has-error' : '' }}">
			  			<label class="control-label">size barang</label>	
			  			<input type="text" name="size" class="form-control" value="{{ $barang->size }}"  required>
			  			@if ($errors->has('size'))
                            <span class="help-block">
                                <strong>{{ $errors->first('size') }}</strong>
                            </span>
                        @endif
                        <div class="form-group {{ $errors->has('harga') ? ' has-error' : '' }}">
			  			<label class="control-label">harga barang</label>	
			  			<input type="text" name="harga" class="form-control" value="{{ $barang->harga }}"  required>
			  			@if ($errors->has('harga'))
                            <span class="help-block">
                                <strong>{{ $errors->first('harga') }}</strong>
                            </span>
                        @endif
                        <div class="form-group {{ $errors->has('stok') ? ' has-error' : '' }}">
			  			<label class="control-label">stok barang</label>	
			  			<input type="text" name="stok" class="form-control" value="{{ $barang->stok }}"  required>
			  			@if ($errors->has('stok'))
                            <span class="help-block">
                                <strong>{{ $errors->first('stok') }}</strong>
                            </span>
                        @endif
			  		<div class="form-group">
			  			<button type="submit" class="btn btn-primary">Simpan</button>
			  		</div>
			  	</form>
			  </div>
			</div>	
		</div>
	</div>
</div>
@endsection