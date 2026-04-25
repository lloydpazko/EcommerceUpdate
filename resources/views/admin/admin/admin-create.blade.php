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
                    <h3 class="box-title">Create Admin</h3>
                  </div><!-- /.box-header -->
                  <!-- form start -->
                  <form action="{{ url('admin-adminv2/get-admin-info') }}" method="post">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label >Store Name</label>
                            <input type="text" class="form-control" value="{{ old('storename') }}" name="storename" placeholder="Enter Your Store Name">
                            {{-- <div style="color:red;">{{ $errors->first('storename') }}</div> --}}
                          </div>
                          <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" value="{{ old('name') }}" name="name" placeholder="Enter Your Store Name">
                            {{-- <div style="color:red;">{{ $errors->first('name') }}</div> --}}
                          </div>
                      <div class="form-group">
                        <label>Email address</label>
                        <input type="email" class="form-control" value="{{ old('email') }}" name="email" placeholder="Enter email">
                        <div style="color:red;">{{ $errors->first('email') }}</div>
                      </div>
                      <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                      </div>
                      <div class="form-group">
                        <label>status</label>
                        <select class="form-control" name="status">
                            <option {{ (old('status') == 0 ) ? 'selected' : '' }} value="0">
                                active
                            </option>
                            <option {{ (old('status') == 1 ) ? 'selected' : '' }} value="1">
                                In-active
                            </option>
                        </select>
                      </div>
                      {{-- <div class="form-group">
                        <label for="exampleInputFile">File input</label>
                        <input type="file" id="exampleInputFile">
                        <p class="help-block">Example block-level help text here.</p>
                      </div> --}}
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
                </div><!-- /.box -->
        </div><!-- /.row -->
      </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

  <!-- END EXTRACT -->
@endsection
@section('script')
{{-- <script src="{{ asset('assets/dist/js/demo.js') }}" type="text/javascript"></script> --}}
@endsection
