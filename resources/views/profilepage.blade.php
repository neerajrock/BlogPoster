@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 sidebar bg-light">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="#" onclick="showContent('add-blogs')">Add Blogs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="showContent('my-blogs')">My Blogs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="showContent('profile-settings')">Profile Settings</a>
                </li>
            </ul>
        </nav>

        <main class="col-md-10 content">
            <div id="add-blogs" class="content-section">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">
                            <span class="page-title-icon bg-gradient-primary text-white me-2">
                                <i class="mdi mdi-image"></i>
                            </span> Post Your Blog
                        </h3>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form action="javascript:void(0)" id="blogForm" class="form" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" id="title" name="title" class="form-control" placeholder="Blog Title"
                                        name="title">
                                    <p></p>
                                </div>
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" id="image" name="image" class="form-control">
                                    <p></p>
                                </div>
                               
                                <div class="form-group">
                                    <label for="description" class="form-label">Discription</label>
                                    <textarea name="description" id="description" contenteditable="true" cols="30"
                                        rows="10"></textarea>
                                    <p></p>
                                </div>
                                <button type="submit" class="btn my-3 text-light"
                                    style="background-color: #a861ff">Submit</button>
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
            <div id="my-blogs" class="content-section d-none">
                <h1>My Blogs</h1>
                <p>Here you can view your blogs.</p>
            </div>
            <div id="profile-settings" class="content-section d-none">
                <h1>Profile Settings</h1>
                <p>Here you can change your profile settings.</p>
            </div>
        </main>
    </div>
</div>
@endsection

@push('customJS')
    <script>
        function showContent(sectionId) {
            // Hide all sections
            document.querySelectorAll('.content-section').forEach(function (section) {
                section.classList.add('d-none');
            });

            // Show the selected section
            document.getElementById(sectionId).classList.remove('d-none');
        }

    </script>
    <script>
        $(document).ready(function () {
            $("#blogForm").validate({
                rules: {
                    title: {
                        required: true,
                    },
                    image: {
                        required: true,
                    }
                },
                messages: {
                    title: {
                        required: "Please add title",
                    },
                    image: {
                        required: "Please add image",
                    }
                },
                errorElement: "p",
                errorPlacement: function (error, element) {
                    if (element.prop("tagName").toLowerCase() === "select") {
                        error.insertAfter(element.closest(".form-group").find(".select2"));
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function (form) {
                    $("#blogForm").prop("disabled", true);
                    var formData = new FormData(form);
                    axios.post("{{route('add.blog.poter')}}",formData).then((response)=>{
                        if(response.data.status == "success"){
                            alert('Blog post Succesfully');
                            location.reload();
                        }else{
                            $("#blogForm").prop("disabled", true);
                            alert(response.data.message);
                        }
                    });
                        
                }
            });
        });

    </script>
@endpush
