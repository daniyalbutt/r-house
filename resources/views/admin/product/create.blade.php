@extends('admin.layouts.app')
@section('title', 'Add Product')
@section('sidebar_content')
    <div class="box no-shadow box-bordered border-light" id="image">

        <h5 class="pro-img-head">Product Image</h5>


        <div class="form-group box-footer">
            <input type="file" class="dropify" name="image"
                {{ $data != null ? 'data-default-file = ' . asset($data->image) : '' }}>
            <span id="imageerror" class="d-none error-span "></span>


        </div>

    </div>
    <div class="box no-shadow box-bordered border-light">
        <h5 class="pro-img-head">Product Gallery</h5>
        <input type="hidden" id="productimages"
            value="{{ $data ? ($data->images ? json_encode($data->images) : '') : '' }}">
        <div class="file-loading">
            <input id="image-file" name="input-ficons-5[]" multiple type="file">
        </div>

    </div>
@endsection
@section('content')
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">{{ $data == null ? 'Add' : 'Update ' }} Product
                        {{ $data == null ? '' : '#' . $data->id }}</h3>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#"><i class="mdi mdi-home-outline">Product Management</i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ $data == null ? 'Add' : 'Update ' }} Product</li>
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
                            <h4 class="box-title">{{ $data == null ? 'Upload' : 'Update ' }} Product Details</h4>
                        </div>
                        <div class="box-body">

                            <!-- /.box-header -->
                            <form class="form" method="post"
                                action="{{ $data == null ? route('product.store') : route('product.update', $data->id) }}"
                                enctype="multipart/form-data" id="productform" id="file-upload">
                                @csrf
                                {{ $data != null ? method_field('PUT') : method_field('POST') }}
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="font-weight-700 font-size-16">Product Title</label>

                                                <input type="text" id="name" name="name"
                                                    value="{{ $data == null ? old('name') : $data->name }}"
                                                    class="form-control" placeholder="Product Title" required>
                                                <span id="nameerror" class="d-none error-span "></span>
                                            </div>
                                        </div>
                                        @php
                                            $category = App\Models\Category::all();
                                        @endphp
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="font-weight-700 font-size-16">Category</label>
                                                <select class="form-control select2" id="category_id" name="category_id" tabindex="1" required>
                                                    <option value="">Select Category</option>
                                                    @foreach ($category as $item)
                                                        <option
                                                            {{ $data != null ? ($data->category_id == $item->id ? 'selected' : '') : '' }}
                                                            value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                <span id="categoryerror" class="d-none error-span "></span>
                                            </div>
                                        </div>

                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="font-weight-700 font-size-16">Price</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="ti-money"></i></div>

                                                    <input type="number" id="price" name="price" step="0.01"
                                                        value="{{ $data == null ? old('price') : $data->price }}"
                                                        class="form-control" placeholder="00.00">
                                                    <span id="priceerror" class="d-none error-span "></span>


                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="font-weight-700 font-size-16">Whole Sale Price</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="ti-money"></i></div>
                                                    <input type="number" id="whole_price" name="whole_price" step="0.01"
                                                        value="{{ $data == null ? old('whole_price') : $data->whole_price }}"
                                                        class="form-control" placeholder="00.00">
                                                    <span id="whole_priceerror" class="d-none error-span "></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="font-weight-700 font-size-16">Stock (in units)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="ti-cut"></i></div>
                                                    <input type="number" id="stock" name="stock" step="0.01"
                                                        value="{{ $data == null ? old('discount') : $data->stock }}"
                                                        class="form-control" placeholder="10">
                                                    <span id="stockerror" class="d-none error-span "></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="font-weight-700 font-size-16">Extension Essentials</label>
                                                <div class="input-group">
                                                    <select name="extension_type" id="extension_type" class="form-control select2" required>
                                                        <option value="" {{ $data && $data->extension_type == '' ? 'selected' : '' }}>Select Extension Type</option>

                                                        <optgroup label="Professional / Semi-Permanent Extensions">
                                                            <option value="k-tip" {{ $data && $data->extension_type == 'k-tip' ? 'selected' : '' }}>K-Tips (Keratin / Fusion)</option>
                                                            <option value="i-tip" {{ $data && $data->extension_type == 'i-tip' ? 'selected' : '' }}>I-Tips (Micro Bead / Micro Link)</option>
                                                            <option value="nano-tip" {{ $data && $data->extension_type == 'nano-tip' ? 'selected' : '' }}>Nano Tips (Nano Rings)</option>
                                                            <option value="flat-tip" {{ $data && $data->extension_type == 'flat-tip' ? 'selected' : '' }}>Flat Tips (Hybrid Tips)</option>
                                                            <option value="u-tip" {{ $data && $data->extension_type == 'u-tip' ? 'selected' : '' }}>U-Tips</option>
                                                            <option value="v-tip" {{ $data && $data->extension_type == 'v-tip' ? 'selected' : '' }}>V-Tips</option>
                                                            <option value="tape-in" {{ $data && $data->extension_type == 'tape-in' ? 'selected' : '' }}>Tape-Ins</option>
                                                            <option value="weft" {{ $data && $data->extension_type == 'weft' ? 'selected' : '' }}>Weft Extensions (Sewn-in / Beaded)</option>
                                                            <option value="hand-tied-weft" {{ $data && $data->extension_type == 'hand-tied-weft' ? 'selected' : '' }}>Hand-Tied Wefts</option>
                                                            <option value="machine-weft" {{ $data && $data->extension_type == 'machine-weft' ? 'selected' : '' }}>Machine Wefts</option>
                                                            <option value="genius-weft" {{ $data && $data->extension_type == 'genius-weft' ? 'selected' : '' }}>Genius Wefts</option>
                                                            <option value="seamless-weft" {{ $data && $data->extension_type == 'seamless-weft' ? 'selected' : '' }}>Seamless / Flat Wefts</option>
                                                        </optgroup>

                                                        <optgroup label="Temporary / Removable Extensions">
                                                            <option value="clip-in" {{ $data && $data->extension_type == 'clip-in' ? 'selected' : '' }}>Clip-Ins</option>
                                                            <option value="halo" {{ $data && $data->extension_type == 'halo' ? 'selected' : '' }}>Halo Extensions</option>
                                                            <option value="ponytail" {{ $data && $data->extension_type == 'ponytail' ? 'selected' : '' }}>Ponytail Extensions</option>
                                                            <option value="bang" {{ $data && $data->extension_type == 'bang' ? 'selected' : '' }}>Bang / Fringe Extensions</option>
                                                            <option value="wrap" {{ $data && $data->extension_type == 'wrap' ? 'selected' : '' }}>Wrap Extensions</option>
                                                        </optgroup>

                                                        <optgroup label="Specialized / Custom">
                                                            <option value="bulk-hair" {{ $data && $data->extension_type == 'bulk-hair' ? 'selected' : '' }}>Bulk Hair (for Braiding / Custom Bonds)</option>
                                                            <option value="hybrid" {{ $data && $data->extension_type == 'hybrid' ? 'selected' : '' }}>Hybrid Extensions (Custom Combos)</option>
                                                        </optgroup>
                                                    </select>
                                                    <span id="dealerror" class="d-none error-span "></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="font-weight-700 font-size-16">Trending Product</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="ti-cut"></i></div>
                                                    <select name="trending" class="form-control" id="trending">
                                                        <option value="1"
                                                            {{ $data != null ? ($data->trending == 1 ? 'selected' : '') : '' }}>
                                                            Yes</option>
                                                        <option value="0"
                                                            {{ $data != null ? ($data->trending == 0 ? 'selected' : '') : '' }}>
                                                            No</option>
                                                    </select>
                                                    <span id="trendingerror" class="d-none error-span "></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="font-weight-700 font-size-16">Featured Product</label>
                                                <div class="radio-list">
                                                    <label class="radio-inline p-0 mr-10">
                                                        <div class="radio radio-info">
                                                            <input type="radio" name="featured" id="featured_yes"
                                                                value="1"
                                                                {{ $data != null ? ($data->featured == 1 ? 'checked' : '') : '' }}>
                                                            <label for="featured_yes">Yes</label>
                                                        </div>
                                                    </label>
                                                    <label class="radio-inline">
                                                        <div class="radio radio-info">
                                                            <input type="radio" name="featured" id="featured_no"
                                                                value="0"
                                                                {{ $data != null ? ($data->featured == 0 ? 'checked' : '') : '' }}>
                                                            <label for="featured_no">No</label>
                                                        </div>
                                                    </label>

                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="font-weight-700 font-size-16">Status</label>
                                                <div class="radio-list">
                                                    <label class="radio-inline p-0 mr-10">
                                                        <div class="radio radio-info">
                                                            <input type="radio" name="status" id="radio1"
                                                                value="1"
                                                                {{ $data != null ? ($data->status == 1 ? 'checked' : '') : '' }}>
                                                            <label for="radio1">Published</label>

                                                        </div>
                                                    </label>
                                                    <label class="radio-inline">
                                                        <div class="radio radio-info">
                                                            <input type="radio" name="status" id="radio2"
                                                                value="0"
                                                                {{ $data != null ? ($data->status == 0 ? 'checked' : '') : '' }}>
                                                            <label for="radio2">Draft</label>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>

                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="font-weight-700 font-size-16">Product Description</label>
                                                <textarea value={{ $data == null ? old('description') : $data->description }} id="description" name="description"
                                                    class="editor" required>{{ $data == null ? old('description') : $data->description }}</textarea>
                                                <span id="descriptionerror" class="d-none error-span"></span>

                                            </div>
                                        </div>
                                    </div>

                                    <div id="variation-repeater" class="repeater">
                                        <hr>
                                        <h4>Product Variation</h4>
                                        <hr>
                                        <div class="items" data-group="variation">
                                            @if ($data && $data->attributeValueProducts->isNotEmpty())
                                            @foreach ($data->attributeValueProducts as $variation)
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="attribute">Attribute</label>
                                                            <input 
                                                                type="text" 
                                                                value="{{ $variation->attribute ? $variation->attribute->name : 'N/A' }}" 
                                                                class="form-control" 
                                                                disabled
                                                            >
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label for="attribute_value">Attribute Value</label>
                                                            <input 
                                                                type="text" 
                                                                value="{{ $variation->attribute_value }}" 
                                                                class="form-control" 
                                                                disabled
                                                            >
                                                        </div>

                                                        <div class="col-md-2">
                                                            <label for="addon">Price Addon</label>
                                                            <input 
                                                                type="number" 
                                                                step="0.01" 
                                                                value="{{ $variation->addon }}" 
                                                                class="form-control" 
                                                                disabled
                                                            >
                                                        </div>

                                                        <div class="col-md-2">
                                                            <label class="text-right d-block">Action</label>
                                                            <div class="d-flex justify-content-end align-items-center h-full">
                                                                <button 
                                                                    type="button"
                                                                    class="waves-effect waves-light btn btn-sm btn-rounded btn-primary-light mb-5 del"
                                                                    onclick="deleteVariation($(this).closest('.form-group'), {{ $variation->id }})"
                                                                >
                                                                    <i class="ti-trash"></i> Delete
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif

                                            <div class="repeater">

                                                <div class="items">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label for="attrbuite">Attribute</label>
                                                                <select name="variation[attrbuite][]"
                                                                    class="attr form-control select2" required>
                                                                    <option value=null hidden selected>Select Attribute
                                                                    </option>
                                                                    @foreach ($attributes as $attribute)
                                                                        <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="price">Attribute Value</label>
                                                                <input type="text" class="form-control" name="variation[attrbuite_values][]" placeholder="Attribute Value">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label for="price">Price Addon</label>
                                                                <input type="number" name="variation[addon][]"
                                                                    step="0.01" value="0" class="form-control" required>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label for="price" class="text-right d-block">Action</label>
                                                                <div
                                                                    class="d-flex justify-content-end align-items-center h-full">
                                                                    <button type="button"
                                                                        class="waves-effect waves-light btn btn-sm btn-rounded btn-primary-light mb-5 del"
                                                                        onclick="$(this).parent().parent().parent().remove()">
                                                                        <i class="ti-trash"></i> Delete
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-primary repeater-add-btn btn-sm">Add New Attribute</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions mt-10">
                                    <button type="button" id="saveSubmit" class="btn btn-primary">
                                        <i class="fa fa-check"></i> Save /
                                        Add</button>
                                    <button type="button" class="btn btn-danger">Cancel</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection

@push('css')
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/css/fileinput.min.css" media="all"
        rel="stylesheet" type="text/css" />

    <style>
        .file-caption .input-group {
            display: none;
        }

        .dropzone {
            background: white;
            border-radius: 5px;
            border: 2px dashed #fd683e;
            border-image: none;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        h5.pro-img-head {
            padding: 10px 10px;
            margin: 0;
        }
    </style>
@endpush

@push('js')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css"
        crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/fileinput.min.js"></script>
    <script>
        var productImages = $('#productimages').val().length > 0 ? JSON.parse($('#productimages').val()) : []
        console.log(productImages);
        var urls = [],
            initialPreviewConfig = [],
            initialPreviewAsData = false;
        if (Object.keys(productImages).length > 0) {
            productImages.forEach(function(obj, index) {

                urls.push(window.location.origin + '/' + obj);

                initialPreviewConfig.push({
                    caption: obj.split('/').slice(-1)[0],
                    downloadUrl: window.location.origin + '/' + obj,
                    url: "{{ route('product.delete_img') }}",
                    key: '{{ $data ? $data->id : '0' }}',
                    extra: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        path: obj
                    }
                })
            });

            initialPreviewAsData = true

        }



        var formData = new FormData();
        $("#image-file").fileinput({
            showUpload: false,
            uploadUrl: "{{ $data == null ? route('product.store') : route('product.update', $data->id) }}",
            theme: 'fa',
            initialPreview: urls,
            initialPreviewAsData: initialPreviewAsData,
            initialPreviewConfig: initialPreviewConfig,
            uploadAsync: false,
            browseOnZoneClick: true,
            initialPreviewShowDelete: true,
            dropZoneEnabled: true,
            overwriteInitial: false,
            maxFileSize: 20000000,
            maxFilesNum: 20,
            uploadExtraData: function() {
                return {
                    created_at: $('.created_at').val()
                };
            }
        }).on('filebatchselected', function(event, files) {

            $.each(files, function(index, value) {
                formData.append('productgalleries[]', value['file'])
            });
        });
    </script>
    <script>
        $(document).ready(function() {

            $('#saveSubmit').click(function(e) {
                removeAllErrors();
                var productForm = new FormData($('#productform').get(0));
                formData.forEach(function(value, key) {
                    productForm.append('gallery[]', value)
                });

                if ($('.dropify')[0].files[0]) {
                    productForm.append('image', $('.dropify')[0].files[0])
                }
                $.ajax({

                    xhr: function() {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function(evt) {
                            loaderShow()
                        }, false);
                        return xhr;
                    },
                    method: 'post',
                    processData: false,
                    contentType: false,
                    cache: false,

                    data: productForm,
                    enctype: 'multipart/form-data',
                    url: $('#productform').attr('action'),
                }).done(function(response) {
                    loaderHide()
                    if ($('input[name="_method"]').val() == 'POST') {
                        $('#image-file').fileinput('clear');
                        $(".dropify").trigger("click");
                    }
                    swal("SUCCESS!", "Product Added Successfully", "success");


                }).fail(function(jqxhr, textStatus, error) {

                    $.each(jqxhr.responseJSON.errors, function(key, value) {
                        $('#' + key).addClass('error-control');
                        $("#" + key + 'error').text(value[0]);
                        $("#" + key + 'error').removeClass('d-none');
                    });
                    loaderHide()
                    swal("ERROR!", jqxhr.responseJSON.message, "error");
                });



            });

        })
    </script>

    <script type="text/javascript">
        const deleteVariation = (elem, id) => {
            $.ajax({
                url: "{{ route('delete.variation') }}",
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id
                },
                success: function(response) {
                    if (response.status) {
                        swal("SUCCESS!", "Variation deleted!", "success");
                    }
                    console.log(elem)
                    $(elem).remove();
                },
                error: function(xhr) {
                    console.log(xhr.responseJSON);
                    alert('An error occurred.');
                }
            });
        }

        $('.repeater .repeater-add-btn').click(function() {
            var entryClone = $(this).siblings('.items').first().children().last().clone();
            $(entryClone).find('input[type="text"], input[type="number"], input[type="file"], textarea').val('');
            $(entryClone).find('.dropify-wrapper').remove();
            var newFileInput = $('<input>', {
                type: 'file',
                class: 'dropify',
                name: 'variation[image][]'
            });
            $(entryClone).find('.dropify-wrapper-section').append(newFileInput);
            $(this).siblings('.items').first().append(entryClone);
            newFileInput.dropify({
                messages: {
                    default: 'Drag and drop a file here or click',
                    replace: 'Drag and drop or click to replace',
                    remove: 'Remove',
                    error: 'Ooops, something wrong happened.'
                }
            });
            $(entryClone).find('.select2-container').remove();
            $(entryClone).find('.select2').removeClass('select2-hidden-accessible');
            $('.select2').select2();
        });



    </script>
@endpush
