@extends('adminpanal.layout.app')

@section('content')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-image"></i>
                </span> Your Blog Posts
            </h3>
            <nav>
                <ul class="buttonList">
                    <li class="active" aria-current="page">
                        <a href="{{route('blog.create')}}" class="btn text-light" style="background-color: #a861ff">Post Blog</a>
                    </li>
                </ul>
            </nav>
        </div>

        @foreach ($blogs->reverse() as $blog)
        <div class="card mb-3">
            <div class="card-header">
                <h4><strong>{{ ucfirst($blog->title) }}</strong></h4>
            </div>
            <div class="card-body table-responsive p-3">
                <span class="text-muted mb-2" style="font-size: 12px;">Published on
                    {{ date("F d, Y", strtotime($blog->created_at)) }}</span>
                <div class="image">
                    <img src="{{ asset('images/' . $blog->image) }}" class="list-image" alt="Image">
                </div>
                <p class="my-3">{!! Str::limit(htmlspecialchars_decode($blog->description), 170, '...') !!}</p>
                <br>
                <a class="btn btn-sm btn-success edit-btn" href="{{ route('blog.edit', ['blogId' => $blog->id]) }}">
                    <i class="fa fa-edit"></i> Edit
                </a>
                <button type="submit" class="btn btn-sm btn-danger delete-btn" data-blog-id="{{ $blog->id }}"><i
                        class="fa fa-trash"></i> Delete</button>
            </div>
        </div>
        @endforeach
        
    </div>
</div>
@endsection

@section('customJS')

<script>
$(document).ready(function() {
    $('.delete-btn').click(function() {
        var blogId = $(this).data('blog-id');

        if (confirm("Are you sure you want to delete this blog?")) {
            $.ajax({
                url: '{{ route("blog.delete", ":blog") }}'.replace(':blog', blogId),
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    location.reload(); // Reload the page
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    })
})
</script>

@endsection