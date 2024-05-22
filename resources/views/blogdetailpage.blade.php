@extends('layout.app')
@section('content')
<section class="Unified-sectionn">
    <div class="blog-content py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card blogs-card p-4 mb-4">
                        <h3 class="fw-bold">Blog Title</h3>
                        <br>
                        <h1>{{ $blogs->blogtitle }}</h1>
                        <div class="blog-image my-3">
                            <img src="{{ asset('blogs/' . $blogs->image) }}" class="img-fluid" alt="Blog Image">
                        </div>
                        <div class="description">
                            <p>{{ $blogs->content }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card recent-blog blogs-card p-4">
                        <div class="card-title fw-bold fs-5 text-muted">
                            Recent Posts
                        </div>
                        @foreach($bloglist as $blog)
                        <div class="media mb-3">
                            <a href="{{ route('blog.detals', ['blogid' => $blog->encript]) }}">
                                <img src="{{ asset('blogs/' . $blog->image) }}" class="mr-3 img-thumbnail" alt="" style="max-width: 100px;">
                            </a>
                            <div class="media-body">
                                <li class="mt-0">
                                    <a href="{{ route('blog.detals', ['blogid' => $blog->encript]) }}">{{ $blog->title }}</a>
                                </li>
                                <span class="text-muted">{{ $blog->published_at }}</span>
                            </div>
                        </div>
                        <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('style')
<style>
/* General Styling */
body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
}

/* Blog Content */
.blog-content {
    padding-top: 5rem;
    padding-bottom: 5rem;
}

.blogs-card {
    background-color: #fff;
    border-radius: 0.25rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.blogs-card h3 {
    color: #333;
}

.blogs-card .text-muted {
    display: flex;
    align-items: center;
}

.blog-image img {
    border-radius: 0.25rem;
    width: 100%;
    height: auto;
}

.description p {
    color: #555;
    line-height: 1.6;
}

/* Recent Posts */
.recent-blog .card-title {
    border-bottom: 1px solid #ddd;
    padding-bottom: 0.5rem;
    margin-bottom: 1rem;
}

.recent-blog .media {
    display: flex;
    align-items: flex-start;
}

.recent-blog .media img {
    border-radius: 0.25rem;
    margin-right: 1rem;
}

.recent-blog .media-body {
    display: flex;
    flex-direction: column;
}

.recent-blog .media-body li a {
    color: #007bff;
    text-decoration: none;
    transition: color 0.3s;
}

.recent-blog .media-body li a:hover {
    color: #0056b3;
}

.recent-blog hr {
    margin-top: 1rem;
    margin-bottom: 1rem;
}

/* Responsive Styling */
@media (max-width: 768px) {
    .blog-content {
        padding-top: 3rem;
        padding-bottom: 3rem;
    }

    .recent-blog .media img {
        max-width: 80px;
    }
}
</style>
@endpush
