@extends('userpanel.layout.master')

@section('title')
Blog- user Awaiting Blog
@endsection

@section('style')
@endsection

@section('content')
<h1 class="h3 mb-4 text-gray-800">usesr Awaiting Blog</h1>
<!-- Basic Card Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 ">
        <h6 class="m-0 font-weight-bold text-primary">user Awaiting Blog</h6>
       
    </div>
    <div class="card-body">
        <table class="table table-stripe table-bordered w-100" id="await">
          <thead>
              <tr>
                  <th scope="col">Image</th>
                  <th scope="col">User</th>
                  <th scope="col">Category</th>
                  <!-- <th scope="col">Tags</th> -->
                  <th scope="col">Title</th>
                  <th scope="col">Active</th>
                  <th scope="col">Short Description</th>
                  <th scope="col">Description</th>
                
                  <th scope="col">Delete</th>
               
              </tr>
          </thead>
        </table>
    </div>
</div>

@endsection

@section('scripts')

<script type="text/javascript" src="{{ asset('backend/partials/userapproved.js') }}"></script>
@endsection