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
                    <small>Brand Items AdminPanel-Version 2.1</small>
                </h1>
                </div>
                    <div class="col-sm-12" style="text-align:right;">
                        <ol class="breadcrumb">
                            <li><a href="{{ url('admin-adminv2/brand/create-brand') }}" class="btn btn-primary"><i class="fa fa-list-alt"></i>New Brand</a></li>
                          </ol>
                    </div>
            </div>
        </div>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-12">

        <!-- import responce messages -->
        @include('admin.layouts._messages')
        <!-- end responce messages -->

            <div class="box">
              <div class="box-header">
                <h3 class="box-title">List of Brand</h3>
              </div><!-- /.box-header -->
              <div class="box-body no-padding">
                <table class="table table-striped">
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>slug</th>
                    <th>Meta title</th>
                    <th>Meta Description</th>
                    <th>Metal Keywords</th>
                    <th>Created by.</th>
                    <th>Status</th>
                    <th>Created Date</th>
                    <th>action</th>
                  </tr>
                <thead>
                    <tbody>
                        @foreach($getrecord as $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->slug }}</td>
                            <td>{{ $value->meta_title }}</td>
                            <td>{{ $value->meta_description}}</td>
                            <td>{{ $value->meta_keywords }}</td>
                            <td>{{ $value->created_by_name }}</td>
                            <td>{{ ($value->status == 0) ? 'Active' : 'InActive' }}</td>
                            <td>{{ date('d-m-y', strtotime($value->created_at)) }}</td>
                            <td>
                            <a href="{{ url('admin-adminv2/brand/brand-edit/'. $value->id) }}" class="btn btn-primary"> edit</a>
                            <a href="{{ url('admin-adminv2/brand/brand-delete/'. $value->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this Brand?')"> delete</a>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
                <div style="padding:10px; float: right;">
                    {!! $getrecord->appends(Illuminate\Support\Facades\Request::Except('page'))->Links() !!}
                </div>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

  <!-- END EXTRACT -->
@endsection
@section('script')
<script src="{{ url('assets/dist/js/demo.js') }}" type="text/javascript"></script>
@endsection
