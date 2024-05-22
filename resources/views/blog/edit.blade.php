@extends('adminpanal.layout.app')

@section('content')

<style>
    #loader-wrapper{
    position: fixed;
    z-index: 9999;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.7);
    top: 0;
    left: 0;
    display: flex;
    justify-content: center;
    align-items: center;
}
.spinner-border{
    width: 3rem;
    height: 3rem;
}
</style>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-image"></i>
                </span> Edit Your Posted Blog
            </h3>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('blog.update', $blog->id) }}" method="post" id="blogForm" class="form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" id="title" class="form-control" placeholder="Blog Title" name="title" value="{{old('title', $blog->title)}}">
                        <p></p>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" id="image" name="image" class="form-control">
                        @if($blog->image)
                        <div class="mt-2">
                            <img src="{{asset('assets/images/' . $blog->image)}}" alt="">
                            <p>{{$blog->image}}</p>
                        </div>
                        @else
                        <p>No Image Uploaded</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label">Discription</label>
                        <textarea name="description" id="description" contenteditable="true" cols="30"
                            rows="10">{{old('description', $blog->description)}}</textarea>
                            <p></p>
                    </div>
                    <button type="submit" class="btn btn-primary my-3">Submit</button>
                    <a type="button" href="{{route('blog.index')}}" class="btn btn-primary my-3">Cancel</a>
                </form>
            </div>
            <div id="loader-wrapper" style="display: none;">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('customJS')
<script src="{{ asset('admin/ckeditor/ckeditor.js') }}"></script>

<script src="{{ asset('admin/ckfinder/ckfinder.js') }}"></script>
<script>
CKEDITOR.replace("description", {
    filebrowserUploadUrl: "{{route('blog.upload_image', ['_token' => csrf_token() ])}}",
    filebrowserUploadMethod: 'form'
});
</script>
<script>
CKFinder.setupCKEditor(CKEDITOR.instances.blogs, {
    basePath: '../ckfinder',
    rememberLastFolder: true
});
</script>

<script>
    $('#blogForm').submit(function(event) {
    event.preventDefault();
    $("button[type='submit']").prop('disabled', true);
    $("#loader-wrapper").show();
    
    CKEDITOR.instances.description.updateElement();

    var formData = new FormData(this);
    
    $.ajax({
        url: '{{ route("blog.update", $blog->id) }}',
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
            if (response.status == true) {
                window.location.href = "{{ route('blog.index') }}";
                $('#title').val('');
                $('#description').val('');
            } else {
                var errors = response.errors;
                if (errors['title']) {
                    $('#title').addClass('is-invalid').siblings('p').addClass('invalid-feedback')
                        .html(errors['title']);
                } else {
                    $('#title').removeClass('is-invalid').siblings('p').removeClass(
                        'invalid-feedback').html('');
                }
                if (errors['image']) {
                    $('#image').addClass('is-invalid').siblings('p').addClass('invalid-feedback')
                        .html(errors['image']);
                } else {
                    $('#image').removeClass('is-invalid').siblings('p').removeClass(
                        'invalid-feedback').html('');
                }
                if (errors['description']) {
                    $('#description').addClass('is-invalid').siblings('p').addClass('invalid-feedback')
                        .html(errors['description']);
                } else {
                    $('#description').removeClass('is-invalid').siblings('p').removeClass(
                        'invalid-feedback').html('');
                }
            }
        },
        error: function(jqXHR, exception) {
            console.log("Something went wrong");
        }
    });
});
</script>

@endsection
