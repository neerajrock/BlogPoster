@extends('layout.app')
@section('content')
<section class="container my-5">
    @foreach($blogs as $blog)
        <div class="card shadow-sm mb-4">
            <a
                href="{{ route('blog.detals', ['blogid' => $blog->encript]) }}">
                <div class="card-header p-0">
                    <img src="{{ asset('blogs/' . $blog->image) }}"
                        alt="a brand new sports car" class="img-fluid w-100" />
                </div>

                <div class="card-body">
                    <h2 class="mt-3">{{ $blog->blogtitle }}</h2>
                    <p class="card-subtitle mb-3 text-muted">{{ $blog->blogdescription }}</p>
                    <div class="d-flex align-items-center mb-3">
                        <img src="https://images.unsplash.com/photo-1542362567-b07e54358753?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80"
                            alt="author avatar" class="rounded-circle" width="40" height="40" />
                        <div class="ms-3">
                            <p class="mb-0">{{ $blog->username }}</p>
                            <p class="text-muted mb-0">2h ago</p>
                        </div>
                    </div>

                </div>
            </a>
            <div class="d-flex align-items-center">
                @auth
                    <button class="btn btn-link like-button" data-blog-id="{{ $blog->id }}">
                        <i class="fas fa-heart"></i>
                    </button>
                @else
                    <button class="btn btn-link login">
                        <i class="fas fa-heart"></i>
                    </button>
                @endauth
            </div>
        </div>
    @endforeach
</section>
<div class="card-footer clearfix paginationclass">
    {{ $blogs->links() }}
</div>
@endsection

@push('customJS')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const likeButtons = document.querySelectorAll('.like-button');

            likeButtons.forEach(button => {
                button.addEventListener('click', function (event) {
                    event.preventDefault();

                    const heartIcon = this.querySelector('.fas');
                    if (this.classList.contains('liked')) {
                        heartIcon.classList.remove('fa-heart');
                        heartIcon.classList.add('fa-heart');
                        heartIcon.style.color = '';
                        this.classList.remove('liked');
                        this.classList.add('like-button');
                    } else {
                        heartIcon.classList.remove('fa-heart-o');
                        heartIcon.classList.add('fa-heart');
                        heartIcon.style.color = 'red';
                        this.classList.remove('like-button');
                        this.classList.add('liked');
                    }
                });
            });
        });

        $(document).on('click', '.login', function (e) {
            e.preventDefault();
            $("#loginRegisterModal").modal('show');
        });

    </script>
@endpush
