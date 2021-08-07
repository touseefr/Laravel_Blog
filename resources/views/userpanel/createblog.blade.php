@extends('userpanel.layout.master')

@section('title')
Blog-create blogs
@endsection

@section('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style type="text/css" rel="stylesheet">
    .ck-editor__editable_inline {
        height: 330px;
    }
</style>
@endsection

@section('content')
<h1 class="h3 mb-4 text-gray-800">Create Blogs </h1>


@if(count($errors) != 0)
  @if(count($errors) == 1)
   <div class="alert alert-danger">There is only 1 error.</div>
  
  @else
    <div class="alert alert-danger">There are {{ count($errors)}} are present</div>
  @endelse
  @endif
@endif

<div class="row">
    <div class="col-xl-12 col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ url('/user/create') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-row">
                        <div class="form-group col-lg-6 col-md-6">
                            <label for="title">Blog Title</label>
                            <input type="text" name="title" id="title" class="form-control " placeholder="enter title" value="{{old('title')}}">
                        </div>

                    </div>
                    @error('title')
                    <div class="text-danger " style="margin-top: -13px;">{{ $message }}</div>
                    @enderror

                    <div class="form-row">
                        <div class="form-group col-lg-6 col-md-6">
                            <label for="url">Url</label>
                            <input type="text" name="url" id="url" class="form-control" placeholder="enter title" value="">
                        </div>
                        <small class="text-danger"></small>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-lg-6 col-md-6">
                            <label for="category">Select Category</label>
                            <select class="form-control" name="category" id="category">
                                <option value="">Selete Category</option>
                                @foreach($categories as $category)
                                <option  {{ old('category') == $category->id ? 'selected': ''}}
                                value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <small class="text-danger"></small>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-lg-6 col-md-6">
                            <label for="tags">Select Tags</label>
                            <select class="tags form-control" multiple="multiple" name="tags[]" id="tags[]">
                                @foreach($tags as $tag)
                                <option
                                 @if(old('tags')) {{in_array($tag->id, old('tags')) ? 'selected' : ""}}
                               @endif  value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <small class="text-danger"></small>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-lg-6 col-md-6">
                            <label for="image">upload image</label>
                            <input type="file" name="image" id="image" class="form-control-file">
                        </div>
                        <small class="text-danger"></small>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-lg-6 col-md-6">
                            <label for="image_alt">Image Alt Text</label>
                            <input type="text" name="image_alt" id="image_alt" class="form-control" placeholder="home image" value="">
                        </div>
                        <small class="text-danger"></small>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-lg-12 col-md-12">
                            <label for="meta">Meta</label>
                            <input type="text" name="meta" id="meta" class="form-control">
                        </div>
                        <small class="text-danger"></small>

                        <div class="form-group col-lg-12 col-md-12">
                            <label for="short_description">Short Description</label>
                            <textarea class="form-control" class="short_description" name="short_description">
                            </textarea>
                        </div>
                        <small class="text-danger"></small>

                        <div class="form-group col-lg-12 col-md-12">
                            <label for="description">Description</label>
                            <textarea class="form-control" class="description" id="description" name="descriprtion">
                            </textarea>
                        </div>
                        <small class="text-danger"></small>

                    </div>

                    <button type="submit" class="btn btn-success">Create</button>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
<script type="text/javascript">
    $(".tags").select2({
        placeholder: "Select Tags",
        allowClear: true
    });
    ClassicEditor
        .create(document.querySelector('#description'))
        .then(editor => {
            console.log(editor);
        })
        .catch(error => {
            console.error(error);
        });
        //success swal
        var success="{{ session('success') ?? '' }}"
        if(success !== "")
        {
            Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'data has been added',
                })
        }
</script>
  

<!-- <script type="text/javascript" src="{{ asset('backend/partials/blog.js') }}"></script> -->
@endsection