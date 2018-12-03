@extends('layouts.admin')
@section('content')
<div class="row">
	<div class="container">
		<div class="col-md-12">
			<div class="panel panel-primary">
			  <div class="panel-heading">Data berita
			  	<div class="panel-title pull-right">
@role('admin')
			  		<a href="{{ route('berita.create') }}">Tambah</a>
			 @endrole
			  	</div>
			  </div>
			  <div class="panel-body">
			  	<div class="table-responsive">
				  <table class="table table-bordered">
				  	<thead>
			  		<tr>
			  		  <th>No</th>	
					  <th>Judul </th>
					  <th>Isi Berita</th>
					  <!-- <th>Slug</th> -->
	
					  <!-- <th>Foto</th> -->
					  <th colspan="2">Action</th>
			  		</tr>
				  	</thead>
				  	<tbody>
				  		<?php $nomor = 1; ?>
				  		@php $no = 1; @endphp
				  		@foreach($berita as $data)
				  	  <tr>
				    	<td>{{ $no++ }}</td>
				    	<td>{{ $data->judul }}</td>
				    	<td><p>{{ $data->isi }}</p></td>
				    	<!-- <td>{{ $data->slug }}</td> -->
				    	<!-- <td><img src="{{asset('assets/img/berita/'.$data->foto)}}" style="max-height: 125px ; max-width: 125px;margin-top: 7px;"></td> -->
				    	
				    	
						<td>
							@role('admin')
							<a class="btn btn-warning" href="{{ route('berita.edit',$data->id) }}">Edit</a>
						</td>
						<td>
							<form method="post" action="{{ route('berita.destroy',$data->id) }}">
								<input name="_token" type="hidden" value="{{ csrf_token() }}">
								<input type="hidden" name="_method" value="DELETE">

								<button type="submit" class="btn btn-danger">Delete</button>
							</form>

						</td>
						@endrole
				      </tr>
				      @endforeach	
				  	</tbody>
				  </table>
				</div>
			  </div>
			</div>	
		</div>
	</div>
</div>
@endsection