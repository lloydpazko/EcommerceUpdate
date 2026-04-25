<!-- EXTRACT DASHBOARD -->
@extends('admin.layouts.app')
@section('style')
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
                    <small>Account Information AdminPanel-Version 2.1</small>
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

      <!-- Main content -->
      <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-11">
                <!-- general form elements -->
                <div class="box box-primary">
                  <div class="box-header">
                    <h3 class="box-title">Create Brand</h3>
                  </div><!-- /.box-header -->
                  <!-- form start -->
                  <form action="{{ url('admin-adminv2/brand/post_brand') }}" method="post">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label>Brand Name <span style="color:red;">*</label>
                            <input type="text" class="form-control" value="{{ old('categoryname') }}" name="name" placeholder="Enter Brand Name">
                            {{-- <div style="color:red;">{{ $errors->first('storename') }}</div> --}}
                          </div>
                            <div class="form-group">
                                <label>slug <span style="color:red;">*</label>
                                <input type="text" class="form-control" value="{{ old('slug') }}" name="slug" placeholder="Enter slug Ex.url">
                                {{-- <div style="color:red;">{{ $errors->first('slug') }}</div> --}}
                              </div>
                      <div class="form-group">
                        <label>status <span style="color:red;">*</label>
                        <select class="form-control" name="status">
                            <option {{ (old('status') == 0 ) ? 'selected' : '' }} value="0">
                                active
                            </option>
                            <option {{ (old('status') == 1 ) ? 'selected' : '' }} value="1">
                                In-active
                            </option>
                        </select>
                      </div>
                      <hr>
                      <div class="form-group">
                        <label>Meta title<span style="color:red;">*</span></label>
                        <input type="text" class="form-control" value="{{ old('meta_title') }}" name="meta_title" placeholder="Enter slug Ex.url">
                        {{-- <div style="color:red;">{{ $errors->first('slug') }}</div> --}}
                      </div>

                      <div class="form-group">
                        <label>Meta Description</span></label>
                        <textarea class="form-control" name="meta_description" placeholder="Type Here What Description?">{{ old('meta_description') }}</textarea>
                        {{-- <div style="color:red;">{{ $errors->first('slug') }}</div> --}}
                      </div>

                      <div class="form-group">
                        <label>Meta keywords</span></label>
                        <input type="text" class="form-control" value="{{ old('meta_keywords') }}" name="meta_keywords" placeholder="Keywords">
                        {{-- <div style="color:red;">{{ $errors->first('slug') }}</div> --}}
                      </div>
                      {{-- <div class="form-group">
                        <label for="exampleInputFile">File input</label>
                        <input type="file" id="exampleInputFile">
                        <p class="help-block">Example block-level help text here.</p>
                      </div> --}}
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                      <button type="submit" class="btn btn-primary">Create Brand</button>
                    </div>
                  </form>
                </div><!-- /.box -->
        </div><!-- /.row -->
      </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

  <!-- END EXTRACT -->
@endsection
@section('script')
<script src="{{ url('assets/dist/js/demo.js') }}" type="text/javascript"></script>
@endsection
