@extends('admin.layouts.app')
@section('title', 'Add Banner')
@section('content')
<div class="container-full">
	<div class="content-header">
	    <div class="d-flex align-items-center">
	        <div class="mr-auto">
	            <h3 class="page-title">{{ $data == null ? 'Add' : 'Update ' }} Banner {{ $data == null ? '' :'#'.$data->id }}</h3>
	            <div class="d-inline-block align-items-center">
	                <nav>
	                    <ol class="breadcrumb">
	                        <li class="breadcrumb-item">
	                        	<a href="#"><i class="mdi mdi-home-outline">Banner Management</i></a>
	                        </li>
	                        <li class="breadcrumb-item active" aria-current="page">{{ $data == null ? 'Add' : 'Update ' }} Banner</li>
	                    </ol>
	                </nav>
	            </div>
	        </div>
	    </div>
	</div>
	<section class="content">
	    <div class="row">
	        <div class="col-lg-12 col-12">
	            <div class="box">
	                <div class="box-header with-border">
	                    <h4 class="box-title">{{ $data == null ? 'Upload' : 'Update ' }} Banner Details</h4>
	                </div>
	                <!-- /.box-header -->
	                <form class="form" method="post" action="{{ $data == null ? route('banner.store') : route('banner.update', $data->id) }}" enctype="multipart/form-data" id="file-upload">
                	@csrf
                	{{ $data != null ? method_field('PUT') : '' }}
	                    <div class="box-body">
	                        <div class="row">
	                            <div class="col-md-12">
	                            	<div class="form-group">
	                            		<label for="">Title</label>
	                            		<input type="text" name="title" value="{{ $data == null ? old('title') : $data->title }}" class="form-control">
	                            	</div>
	                            	<div class="form-group">
	                            		<label for="">Sub Title</label>
	                            		<input type="text" name="subtitle" value="{{ $data == null ? old('subtitle') : $data->subtitle }}" class="form-control">
	                            	</div>
	                            	<div class="form-group">
	                            		<label for="">Description</label>
	                            		<textarea class="form-control" name="description">{!! $data == null ? old('description') : $data->description !!}</textarea>
	                            	</div>
	                            	<div class="form-group">
	                            		<label for="">Image</label>
	                            		<input type="file" class="dropify" name="image" {{ $data != null ? 'data-default-file = ' .asset($data->image) : ''}}>
	                            	</div>
	                            	<div class="form-group">
	                            		<label for="">Status</label>
	                            		<select name="status" id="" class="form-control">
	                            			<option value="0" {{ ($data != null) && ($data->status == 0) ? 'selected' : '' }}>Active</option>
	                            			<option value="1" {{ ($data != null) && ($data->status == 1) ? 'selected' : '' }}>Deactive</option>
	                            		</select>
	                            	</div>
									<div class="form-group">
										<div class="progress">
											<div class="progress-bar progress-bar-striped progress-bar-animated bg-success result" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%" id="progressBar">0%</div>
											
										</div>
									</div>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="box-footer">
	                        <button type="button" class="btn btn-rounded btn-warning btn-outline mr-1">
	                        <i class="ti-trash"></i> Cancel
	                        </button>
	                        <button type="submit" class="btn btn-rounded btn-primary btn-outline" onclick="progress()"
							>
	                        <i class="ti-save-alt"></i> Save
	                        </button>
	                    </div>
	                </form>
	            </div>
	        </div>
	    </div>
	</section>
</div>

@endsection

@push('css')
<style></style>
@endpush

@push('js')
<script></script>
@endpush
