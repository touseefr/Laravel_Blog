@extends('backend.layout.master')

@section('title')
Blog-Tags
@endsection

@section('style')
@endsection
@section('tselect','active')
@section('content')
<h1 class="h3 mb-4 text-gray-800">TAgs</h1>
<!-- Basic Card Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 ">
        <h6 class="m-0 font-weight-bold text-primary">Tags</h6>
        <a href="" class="float-right btn btn-success" data-toggle="modal" data-target="#addtagmodal">Add Category</a>
    </div>
    <div class="card-body">
        <table class="table table-stripe table-bordered w-100" id="tags">
          <thead>
              <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Created At</th>
                  <th scope="col">Updated At</th>
                  <th scope="col">Edit</th>
                  <th scope="col">Delete</th>
              </tr>
          </thead>
        </table>
    </div>
</div>
@include('backend.partials.tagmodal')
@endsection

@section('scripts')

<script type="text/javascript" src="{{ asset('backend/partials/tag.js') }}"></script>
@endsection