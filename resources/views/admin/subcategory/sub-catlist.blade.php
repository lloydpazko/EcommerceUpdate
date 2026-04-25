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
                    <small>Category Items AdminPanel-Version 2.1</small>
                </h1>
                </div>
                    <div class="col-sm-12" style="text-align:right;">
                        <ol class="breadcrumb">
                            <li><a href="{{ url('admin-adminv2/sub-category/create') }}" class="btn btn-primary"><i class="fa fa-list-alt"></i>Sub-category</a></li>
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
                <h3 class="box-title">List of Sub-category</h3>
              </div><!-- /.box-header -->
              <div class="box-body no-padding">
                <table class="table table-striped">
                  <tr>
                    <th>#</th>
                    <th>Category Name</th>
                    <th>Sub-category Name</th>
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
                        @foreach($getRecord as $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->category_name }}</td>
                            <td>{{ $value->slug }}</td>
                            <td>{{ $value->meta_title }}</td>
                            <td>{{ $value->meta_description}}</td>
                            <td>{{ $value->meta_keywords }}</td>
                            <td>{{ $value->created_by_name }}</td>
                            <td>{{ ($value->status == 0) ? 'Active' : 'InActive' }}</td>
                            <td>{{ date('d-m-y', strtotime($value->created_at)) }}</td>
                            <td>
                            <a href="{{ url('admin-adminv2/subcat-edit/'. $value->id) }}" class="btn btn-primary"> edit</a>
                            <a href="{{ url('admin-adminv2/delete-subcategory/'. $value->id) }}" onclick="return confirm('Are you sure you want to delete this Sub-Cateogry?')" class="btn btn-danger"> delete</a>
                            </td>
                        </tr>
                    </tbody>
                        @endforeach
                    {{-- @endforeach --}}
                </table>
                <div style="padding:10px; float: right;">
                    {!! $getRecord->appends(Illuminate\Support\Facades\Request::Except('page'))->Links() !!}
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
