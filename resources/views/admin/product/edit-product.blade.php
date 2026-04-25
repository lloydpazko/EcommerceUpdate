<!-- EXTRACT DASHBOARD -->
@extends('admin.layouts.app')
@section('style')
<link href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                <h1>
                    <small>Product Information AdminPanel-Version 2.1</small>
                </h1>
                </div>
                    <div class="col-sm-12" style="text-align:right;">
                        {{-- <ol class="breadcrumb">
                            <li><a href="{{ url('admin-adminv2/create-admin') }}" class="btn btn-primary"><i class="fa fa-dashboard"></i> New Admin-Account</a></li>
                          </ol> --}}
                    </div>
            </div>
        </div>
      </section>

      <!-- import responce messages -->
      @include('admin.layouts._messages')
      <!-- end responce messages -->

      <!-- Main content -->
      <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                  <div class="box-header">
                    <h3 class="box-title">Edit Product</h3>
                  </div><!-- /.box-header -->
                  <!-- form start -->

                  <form action="" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Title <span style="color:red;">*</label>
                                <input type="text" class="form-control" value="{{ old('title', $product->title) }}" name="title" placeholder="Product title here" required>
                              </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>SKU <span style="color:red;">*</label>
                                <input type="text" class="form-control" value="{{ old('title', $product->sku) }}" name="sku" placeholder="SKU here" required>
                              </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>category <span style="color:red;">*</label>
                                    <select class="form-control" required id="ChangeCategory" name="category_id">
                                        <option value="">Select Type of Category</option>
                                        @foreach($getCategory as $category)
                                        <option {{ ($product->category_id == $category->id) ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                              </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Sub category<span style="color:red;">*</label>
                                    <select class="form-control" id="getSubCategory" required name="sub_category_id">
                                        <option value="">Select Type of Sub Category</option>
                                        @foreach($GetSubCategory as $subcategory)
                                        <option {{ ($product->sub_category_id == $subcategory->id) ? 'selected' : '' }} value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                        @endforeach
                        </select>
                              </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Brand<span style="color:red;">*</label>
                            <select class="form-control" id="brand" name="brand_id" required>
                                <option value="">Select Brand</option>
                                @foreach($brand as $branddisplay)
                                <option {{ ($product->brand_id == $branddisplay->id) ? 'selected' : '' }} value="{{ $branddisplay->id }}">{{ $branddisplay->name }}</option>
                                @endforeach
                            </select>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                        <div class="form-group">
                            <label>colors <span style="color:red;">*</label>
                                @foreach($getColor as $color)
                                    @php
                                        $checked = '';
                                    @endphp
                                    @foreach($product->getColor as $pcolor)
                                    @if($pcolor->color_id == $color->id)
                                    @php
                                        $checked = 'checked';
                                    @endphp
                                    @endif
                                    @endforeach
                                <div>
                                    <label>
                                        <input {{ $checked }} type="checkbox" name="color_id[]" value="{{ $color->id}}">{{ $color->name }}
                                    </label>
                                    @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Price (php)<span style="color:red;">*</label>
                                {{-- <input type="text" class="form-control" value="{{ old('price', $product->price) }}" name="price" placeholder="Price 000.00 PHP" required> --}}

                                <input type="text" class="form-control" value="{{ $product->price}}" name="price" placeholder="Price 000.00 PHP" required>
                              </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Old Price (php) <span style="color:red;">*</label>
                                {{-- <input type="text" class="form-control" value="{{ old('old_price', $product->old_price) }}" name="price" placeholder="Old Price 000.00 PHP" required> --}}

                                <input type="text" class="form-control" value="{{ $product->old_price}}" name="old_price" placeholder="Old Price 000.00 PHP" required>
                              </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                        <div class="form-group">
                            <label>Size <span style="color:red;">*</label>
                                <div>
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Price (php)</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody id="AppendSize">
                                            @php
                                            $i_s = 1;
                                            @endphp
                                            @foreach($product->getSize as $size)
                                            <tr id="DeleteSize{{ $i_s }}">
                                                <td>
                                                    <input type="text" name="size[{{$i_s}}][name]" value="{{ $size->name }}" class="form-control" placeholder="Size">
                                                </td>

                                                <td>
                                                    <input type="text" name="size[{{$i_s }}][price]" value="{{ $size->price }}" class="form-control" placeholder="Price 0000.00PHP">
                                                </td>

                                                <td style="width:100px;">
                                                    <button type="button" id="{{$i_s}}" class="btn btn-danger DeleteSize">Delete</button>
                                                </td>
                                            </tr>
                                            @php
                                            $i_s++;
                                            @endphp
                                            @endforeach
                                            <tr>
                                                <td>
                                                    <input type="text" name="size[100][name]" class="form-control" placeholder="Size">
                                                </td>

                                                <td>
                                                    <input type="text" name="size[100][price]" class="form-control" placeholder="Price 0000.00PHP">
                                                </td>

                                                <td style="width:100px;">
                                                    <button type="button" class="btn btn-primary Addsize">add</button>
                                                </td>
                                            </tr>
                                            </tr>
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </hr>
                <hr>
                {{-- Images upload --}}

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Image<span style="color:red;"></span></label>
                            <input type="file" name="image[]" multiple accept="image/*" class="form-control" style="padding:5px;">
                        </div>
                    </div>
                </div>

                {{-- end images upload features --}}

                {{-- displaying images --}}

                @if(!empty($product->getImage->count()))
                <div class="row" id="sortable">
                    @foreach($product->getImage as $image)
                        @if(!@empty($image->getLogo()))
                    <div class="col-md-1 sortable_image" id="{{ $image->id }}" style="text-align:center;">
                        <img src="{{ $image->getLogo() }}" style="width:100px; height:100px;" alt="">
                        <a href="{{ url('admin-adminv2/product/images-delete/'.$image->id)}}" onclick="return confirm('Are you sure you want to deleted this pictures?')" style="margin-top:10px;" class="btn btn-danger btn-sm">Delete</a>
                    </div>
                        @endif
                    @endforeach
                </div>
                @endif
                {{-- end images --}}
                </hr>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Short Description <span style="color:red;">*</label>
                                <textarea name="short_description" value="" class="form-control editor" id="" placeholder="Short Description Here" required>{{ $product->short_description }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Description <span style="color:red;">*</label>
                                <textarea name="description" class="form-control editor" value="" id="" cols="20" rows="10" placeholder="Description Here" required>{{ $product->Description }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Additional Information <span style="color:red;">*</label>
                                <textarea name="additional_information" class="form-control editor" id=""  placeholder="Description Here" required>{{ $product->additional_information }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Shipping Return <span style="color:red;">*</label>
                                <textarea name="shipping_returns" class="form-control editor" id=""  placeholder="Shipping Return" required>{{ $product->shipping_returns }}</textarea>
                            </div>
                        </div>
                    </div>

                <hr>

                    <div class="form-group">
                        <label>status <span style="color:red;">*</label>
                        <select class="form-control" name="status">
                            <option {{ ($product->status == 0 ) ? 'selected' : '' }} value="0">
                                active
                            </option>
                            <option {{ ($product->status == 1 ) ? 'selected' : '' }} value="1">
                                In-active
                            </option>
                        </select>
                      </div>
                </hr>
                    <div class="box-footer">
                      <button type="submit" class="btn btn-primary">Update Product</button>
                    </div>
                  </form>
                </div><!-- /.box -->
        </div><!-- /.row -->
      </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

  <!-- END EXTRACT -->
@endsection
@section('script')

{{-- script plugins --}}

<script src="{{ url('assets/dist/js/demo.js') }}" type="text/javascript"></script>

{{-- sortable plugins --}}
<script src=" {{ url('/sortable/jquery-ui.js') }}" type="text/javascript"></script>
{{-- end sortable --}}


{{-- summernote plugins --}}
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
{{-- summernote --}}



<script type="text/javascript">

// editors codes
$('.editor').summernote();

// end  editors

// sortable images
$(document).ready(function(){
     $( "#sortable" ).sortable({
        update : function(event, ui)
        {
            var photo_id = new Array();
            $('.sortable_image' ).each(function()
            {
                var id = $(this).attr('id');
                photo_id.push(id);
            });
            $.ajax({
                    type : "POST",
                    url : "{{ url('admin-adminv2/product_image_sortable') }}",
                    data : {
                        "photo_id" : photo_id,
                    "_token": "{{ csrf_token() }}"
                    },
                    dataType : "json",
                    success : function(browserhead) {
                    },
                    error: function(browserhead) {
                    }
            });
        }
     });
    });


var i = 101;
$('body').delegate('.Addsize', 'click', function(){
    var html = ' <tr id="DeleteSize'+i+'">\n\
                    <td>\n\
                        <input type="text" name="size['+i+'][name]" class="form-control" value="" placeholder="Size">\n\
                        </td>\n\
                        <td>\n\
                            <input type="text" name="size['+i+'][price]" class="form-control" value="" placeholder="Price 0000.00PHP">\n\
                        </td>\n\
                        <td>\n\
                            <button type="button" id="'+i+'" class="btn btn-danger DeleteSize">Delete</button>\n\
                        </td>\n\
                </tr> ';
                i++;
                $('#AppendSize').append(html);
});

$('body').delegate('.DeleteSize','click' ,function() {
    var id = $(this).attr('id');
    $('#DeleteSize'+id).remove();
});

$('body').delegate('#ChangeCategory','change', function(e) {
    var id = $(this).val();

    $.ajax({
        type : "POST",
        url : "{{ url('admin-adminv2/sub_category') }}",
        data : {
            "id" : id,
        "_token": "{{ csrf_token() }}"
        },
        dataType : "json",
        success : function(browserhead) {
            $('#getSubCategory').html(browserhead.html);
        },
        error: function(browserhead) {
        }
    });
});
</script>
@endsection
