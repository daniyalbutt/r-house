@extends('admin.layouts.app')
@section('title', 'Add Blog ')
@section('content')
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">{{ $data == null ? 'Add' : 'Update ' }} Blog
                        {{ $data == null ? '' : '#' . $data->id }}</h3>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#"><i class="mdi mdi-home-outline">Blog Management</i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ $data == null ? 'Add' : 'Update ' }} Blog</li>
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
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="box-header with-border">
                            <h4 class="box-title">{{ $data == null ? 'Upload' : 'Update ' }} Blog Details</h4>
                        </div>
                        <!-- /.box-header -->
                        <form class="form" method="post"
                            action="{{ $data == null ? route('blogs.store') : route('blogs.update', $data->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            {{ $data != null ? method_field('PUT') : '' }}
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group{{ $errors->has('name') ? 'has-error' : '' }}">
                                            <label for="name" class="control-label">{{ 'Name' }}</label>
                                            <input class="form-control" name="name" type="text" id="name"
                                                value="{{ $data == null ? old('name') : $data->name }}" required>

                                            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                                        </div>
                                        <div class="form-group{{ $errors->has('author') ? 'has-error' : '' }}">
                                            <label for="author" class="control-label">{{ 'Author' }}</label>
                                            <input class="form-control" name="author" type="text" id="author"
                                                value="{{ $data == null ? old('author') : $data->author }}" required>

                                            {!! $errors->first('author', '<p class="help-block">:message</p>') !!}
                                        </div>
                                        <div class="form-group{{ $errors->has('image') ? 'has-error' : '' }}">
                                            <label for="image" class="control-label">{{ 'Image' }}</label>
                                            <input class="form-control dropify" name="image" type="file" id="image"
                                                {{ $data != null ? 'data-default-file = ' . asset($data->image) : '' }}
                                                required>

                                            {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
                                        </div>
                                        <div class="form-group{{ $errors->has('short_desc') ? 'has-error' : '' }}">
                                            <label for="short_desc" class="control-label">{{ 'Short Desc' }}</label>
                                            <textarea class="editor" id="short_desc" name="short_desc">{!! $data == null ? old('short_desc') : $data->short_desc !!}</textarea>

                                            {!! $errors->first('short_desc', '<p class="help-block">:message</p>') !!}
                                        </div>
                                        <div class="form-group{{ $errors->has('description') ? 'has-error' : '' }}">
                                            <label for="description" class="control-label">{{ 'Description' }}</label>
                                            <textarea class="editor" id="description" name="description">{!! $data == null ? old('description') : $data->description !!}</textarea>

                                            {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                                        </div>

                                        <div class="form-group">
                                            <label for="">Status</label>
                                            <select name="status" id="" class="form-control">
                                                <option value="0"
                                                    {{ $data != null && $data->status == 0 ? 'selected' : '' }}>Active
                                                </option>
                                                <option value="1"
                                                    {{ $data != null && $data->status == 1 ? 'selected' : '' }}>
                                                    Deactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="button" class="btn btn-rounded btn-warning btn-outline mr-1">
                                    <i class="ti-trash"></i> Cancel
                                </button>
                                <button type="submit" class="btn btn-rounded btn-primary btn-outline">
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
    <style>
        .toggle.switch {
            float: right;
            border-radius: 23px;
        }

        span.toggle-handle.btn.btn-light.btn-sm {
            border-radius: 50%;
        }

        .toggle.btn.btn-sm.switch.btn-primary span {
            margin-right: 15px;
        }

        .toggle.btn.btn-sm.switch.btn-light.off span {
            margin-left: 15px;
        }
    </style>
@endpush

@push('js')
    <script>
        $('input[type="checkbox"]').change(function() {
            ($(this).prop("checked")) ? $(this).val(1): $(this).val(0);
        })
    </script>
@endpush
