@extends('layout.app')
@section('content')
<section class="container my-5">
    @foreach($blogs as $blog)
    <div class="card shadow-sm">
        <div class="card-header p-0">
        <img src="{{ asset('blogs/' . $blog->image) }}" 
                 alt="a brand new sports car" class="img-fluid w-100" />
        </div>
        <div class="card-body">
            <h1 class="mt-3">{{$blog->blogtitle}}</h1>
            <p class="card-subtitle mb-3 text-muted">
               {{$blog->blogdescription}}
            </p>
            <div class="d-flex align-items-center">
                <img src="https://images.unsplash.com/photo-1542362567-b07e54358753?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" 
                     alt="author avatar" class="rounded-circle" width="40" height="40" />
                <div class="ms-3">
                    <p class="mb-0">{{$blog->username}}</p>
                    <p class="text-muted mb-0">2h ago</p>
                </div>
            </div>
        </div>
    </div>
    @endforeach
   
</section>
<div class="card-footer clearfix paginationclass">
        {{$blogs->links()}}
    </div>
@endsection
