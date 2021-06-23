@extends('admin.admin-master')
@section('products') active show-sub @endsection
@section('manage-products') active @endsection
@section('admin_content')


<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Admin</a>
        <span class="breadcrumb-item active">Manage product</span>
      </nav>

      <div class="sl-pagebody">
      <div class="row row-sm">
        <div class="col-md-12">
          

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">product list</h6>
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">Image</th>
                  <th class="wd-15p">product_name</th>
                  <th class="wd-15p">product_quantity</th>
                  <th class="wd-20p">Category</th>
                  <th class="wd-20p">Status</th>
                  <th class="wd-15p">Action</th>
                  
                </tr>
              </thead>
              <tbody>

              @php
              $i = 1;
              @endphp

              @foreach ($products as $row)

                <tr>
                 <td>
                 <img src="{{ asset($row->image_one) }}" width="50px;" height="50px;" alt="">
                 
                 </td>
                  <td>{{ $row->product_name }}</td>
                  <td>{{ $row->product_quantity }}</td>
                  <td>{{ $row->category->category_name }}</td>
                  <td> 
                  @if($row->status == 1)
                  <span class="badge badge-success">Active</span>
                  @else
                  <span class="badge badge-danger">InActive</span>
                  @endif
                 </td>
                  <td>
                  <a href="{{ url('admin/products/edit/'.$row->id) }}" class="btn btn-success">
                  <i class="fa fa-pencil"></i></a>
                  <a href="{{ url('admin/products/delete/'.$row->id) }}" class="btn btn-danger">
                  <i class="fa fa-trash"></i></a>

    
                  </td>
                </tr>

                @endforeach
               
              </tbody>
            </table>
          </div><!-- table-wrapper -->
        </div><!-- card -->
           
 
          
      
    </div>
    </div>

@endsection

