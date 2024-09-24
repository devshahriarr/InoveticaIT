@extends('backend.master')
@section('admin')
<!-- Page Specific Styles Start -->
<link rel="stylesheet" href="{{ asset('assets') }}/css/vendor/quill.bubble.css" />
<link rel="stylesheet" href="{{ asset('assets') }}/css/vendor/quill.snow.css" />

<link rel="stylesheet" href="{{ asset('assets') }}/css/vendor/tagify.css" />
<!-- Page Specific Styles End -->
<div class="container">
    <div class="row">
        <div class="col">
            <div class="page-title-container">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <h1 class="mb-0 pb-0 display-4" id="title">Team Section</h1>
                        <nav class="breadcrumb-container d-inline-block" aria-label="breadcrumb">
                            <ul class="breadcrumb pt-0">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-12 col-md-5 d-flex align-items-start justify-content-end">
                        <button type="button" class="btn btn-outline-primary btn-icon btn-icon-start w-100 w-md-auto add-datatable" data-bs-toggle="modal" data-bs-target="#addEditModal" id="addNewButton">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="acorn-icons acorn-icons-plus undefined">
                                <path d="M10 17 10 3M3 10 17 10"></path>
                            </svg>
                            <span>Add New</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form id="productAddForm"
                        enctype="multipart/form-data" class="productForm row g-3">
                        @csrf
                        <div class="col-12 col-sm-6 col-md-6 col-xl-4">
                            <label for="" class="form-label">Product name</label>
                            <input type="text" name="name" class="form-control"
                                id="" value="" required="">
                            <div class="valid-feedback">Looks good!</div>
                            <div id="Feedback" class="invalid-feedback">Please provide a valid Name.
                            </div>
                        </div>
                        @php
                            $Product_categories = App\Models\ProductCategory::get();
                        @endphp

                        <div class="col-12 col-sm-6 col-md-6 col-xl-4">
                            <div class="w-100">
                                <label class="form-label">Product Category</label>
                                <select id="select2Basic" name="Product_cat">
                                    <option label="&nbsp;"></option>
                                    @if ($Product_categories->count() > 0)
                                        @foreach ($Product_categories as $key => $Product_category)
                                            <option value="{{ $Product_category->id }}">{{ $Product_category->categoryName }}</option>
                                        @endforeach
                                    @else
                                        <option selected disabled>Please Add Sevice Category</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-xl-4">
                            <label class="form-label">Product Image</label>
                            <div class="input-group mb-3">
                                <input type="file" name="img" class="form-control" id="inputGroupFile02">
                                <label class="input-group-text" for="inputGroupFile02">Upload</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Product Description</label>
                            <div class="html-editor sh-19 mb-3" id="quillEditor" name="desc"></div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6">
                            <label for="" class="form-label">Product Price </label>
                            <input type="number" name="price" class="form-control"
                                id="" value="" required="">
                           
                        </div>
                        <div class="col-12 col-sm-6 col-md-6">
                            <label for="" class="form-label">Product URL</label>
                            <input type="text" name="pr_link" class="form-control"
                                id="" value="" required="">
                            <div class="valid-feedback">Looks good!</div>
                            <div id="Feedback" class="invalid-feedback">Please provide a valid Name.
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="d-block form-label">Product Tags</label>
                            <input id="tagsOutside" name="pr_tags" class="tagify--outside my-5" value="Dorayaki, Roti, Panbrioche" placeholder="Write Tags" />
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary save_product" type="submit">Submit form</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Team Table -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="showData">
                    <!-- Data will be inserted here by AJAX -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Page Specific Scripts Start -->

    <script src="{{ asset('assets') }}/js/vendor/quill.min.js"></script>

    <script src="{{ asset('assets') }}/js/vendor/quill.active.js"></script>

    <script src="{{ asset('assets') }}/js/forms/controls.editor.js"></script>

    <script src="{{ asset('assets') }}/js/forms/controls.tag.js"></script>
    <script src="{{ asset('assets') }}/js/forms/controls.select2.js"></script>
    <script src="{{ asset('assets') }}/js/vendor/tagify.min.js"></script>

<!-- Page Specific Scripts End -->
<!-- Page Specific Custom Scripts Start -->

    <script>
var input = document.querySelector('#tagsOutside');
var tagify = new Tagify(input);

tagify.on('add', function(e) {
    console.log('New tag added:', e.detail.data.value);
    // You can add your custom functionality here
});

function validateForm() {
    let isValid = true;

    // Clear previous error messages
    $('.text-danger').text('');
    $('input, select').css('border-color', '');

    // Get form values
    let name = $('input[name="name"]').val().trim();
    let productCategory = $('select[name="Product_cat"]').val();
    let image = $('input[name="img"]').val();
    let description = $('#quillEditor').text().trim();
    let price = $('input[name="price"]').val().trim();
    let url = $('input[name="pr_link"]').val().trim();
    let tags = $('input[name="pr_tags"]').val().trim();

    // Validate product name
    if (name === '') {
        showError('input[name="name"]', 'Product name is required.');
        isValid = false;
    } else if (name.length > 100) {
        showError('input[name="name"]', 'Product name cannot exceed 100 characters.');
        isValid = false;
    }

    // Validate product category
    if (!productCategory) {
        showError('select[name="Product_cat"]', 'Please select a product category.');
        isValid = false;
    }

    // Validate product image (optional, only if provided)
    if (image) {
        let fileExtension = image.split('.').pop().toLowerCase();
        let validExtensions = ['jpeg', 'jpg', 'png', 'gif', 'webp'];
        if (!validExtensions.includes(fileExtension)) {
            showError('input[name="img"]', 'Invalid image format. Allowed formats: jpeg, jpg, png, gif, webp.');
            isValid = false;
        }
    }

    // Validate product description
    if (description === '') {
        showError('#quillEditor', 'Product description is required.');
        isValid = false;
    }

    // Validate product price
    if (price === '') {
        showError('input[name="price"]', 'Product price is required.');
        isValid = false;
    } else if (isNaN(price) || parseFloat(price) <= 0) {
        showError('input[name="price"]', 'Please enter a valid price.');
        isValid = false;
    }

    // Validate product URL
    let urlPattern = /^(https?:\/\/)?([\da-z.-]+)\.([a-z.]{2,6})([/\w .-]*)*\/?$/;
    if (url === '') {
        showError('input[name="pr_link"]', 'Product URL is required.');
        isValid = false;
    } else if (!urlPattern.test(url)) {
        showError('input[name="pr_link"]', 'Please provide a valid URL.');
        isValid = false;
    }

    // Validate product tags (optional, only if provided)
    if (tags && tags.split(',').length > 5) {
        showError('input[name="pr_tags"]', 'You can only enter up to 5 tags.');
        isValid = false;
    }

    return isValid;
}

function showError(selector, message) {
    $(selector).css('border-color', 'red');
    $(selector).next('.invalid-feedback').text(message).show();
}

        $(document).ready(function() {
            
            // Function to show ajax validation error
            // function showError(name, message) {
            //     $(name).addClass('is-invalid');
            //     $(name).focus();
            //     $(`${name}_error`).show().text(message);
            // }

            // Function to handle form submission
            function handleFormSubmission(url, type, formData) {
                if (!validateForm()) {
                    return; // If the form is invalid, do not proceed with the AJAX request
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: url,
                    type: type,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        if (res.status == 200) {
                            $('.productForm')[0].reset();
                            toastr.success(res.message);
                            productView(); // Refresh the table data
                        } 
                    },
                    error: function(err) {
                        if (err.status === 422) { // Validation error
                            var errors = err.responseJSON.errors;
                            if (errors.name) {
                                showError('#name', errors.name);
                            }
                            // Handle other validation errors similarly
                        } else {
                            console.error("Error in AJAX request:", err);
                            toastr.error("An unexpected error occurred.");
                        }
                    }
                });
            }

            // Event listener for save button
            $('.save_product').on('click', function(e) {
                e.preventDefault();
                let formData = new FormData($('.productForm')[0]);
                let id = $('#product_id').val();

                if (id) {
                    handleFormSubmission(`/backend/product/update/${id}`, 'POST', formData);
                } else {
                    handleFormSubmission('{{ route("backend.product.add") }}', 'POST', formData);
                }
            });

            // Function to refresh the team data table
            function productView() {
                $.ajax({
                    url: '{{ route("backend.product.data") }}',
                    method: 'GET',
                    success: function(res) {
                        if (res.status == 200) {
                            const teams = res.data;
                            // console.log(res.data);
                            $('.showData').empty();
                            if (teams.length > 0) {
                                $.each(teams, function(index, team) {
                                    const tr = `
                                        <tr>
                                            <td>${index + 1}</td>
                                            
                                            <td>${team.image ? `<img src="/uploads/product/${team.image}" alt="Team Image" width="50">` : 'photo not found'}</td>
                                            <td>${team.name ?? ""}</td>
                                            <td>${team.position ?? ""}</td>
                                            <td>
                                                <a href="#" class="btn btn-outline-primary btn-icon team_edit" data-id="${team.id}" data-bs-toggle="modal" data-bs-target="#addEditModal">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="acorn-icons acorn-icons-edit-square undefined"><path d="M11 2L5.5 2C4.09554 2 3.39331 2 2.88886 2.33706C2.67048 2.48298 2.48298 2.67048 2.33706 2.88886C2 3.39331 2 4.09554 2 5.5L2 14.5C2 15.9045 2 16.6067 2.33706 17.1111C2.48298 17.3295 2.67048 17.517 2.88886 17.6629C3.39331 18 4.09554 18 5.5 18L14.5 18C15.9045 18 16.6067 18 17.1111 17.6629C17.3295 17.517 17.517 17.3295 17.6629 17.1111C18 16.6067 18 15.9045 18 14.5L18 11"></path><path d="M15.4978 3.06224C15.7795 2.78052 16.1616 2.62225 16.56 2.62225C16.9585 2.62225 17.3405 2.78052 17.6223 3.06224C17.904 3.34396 18.0623 3.72605 18.0623 4.12446C18.0623 4.52288 17.904 4.90497 17.6223 5.18669L10.8949 11.9141L8.06226 12.6223L8.7704 9.78966L15.4978 3.06224Z"></path></svg>
                                                </a>
                                                <a href="#" class="btn btn-outline-danger btn-icon team_delete" data-id="${team.id}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="acorn-icons acorn-icons-bin undefined"><path d="M4 5V14.5C4 15.9045 4 16.6067 4.33706 17.1111C4.48298 17.3295 4.67048 17.517 4.88886 17.6629C5.39331 18 6.09554 18 7.5 18H12.5C13.9045 18 14.6067 18 15.1111 17.6629C15.3295 17.517 15.517 17.3295 15.6629 17.1111C16 16.6067 16 15.9045 16 14.5V5"></path><path d="M14 5L13.9424 4.74074C13.6934 3.62043 13.569 3.06028 13.225 2.67266C13.0751 2.50368 12.8977 2.36133 12.7002 2.25164C12.2472 2 11.6734 2 10.5257 2L9.47427 2C8.32663 2 7.75281 2 7.29981 2.25164C7.10234 2.36133 6.92488 2.50368 6.77496 2.67266C6.43105 3.06028 6.30657 3.62044 6.05761 4.74074L6 5"></path><path d="M2 5H18M12 9V13M8 9V13"></path></svg>
                                                </a>
                                            </td>
                                        </tr>`;
                                    $('.showData').append(tr);
                                });
                            } else {
                                $('.showData').html(`
                                    <tr>
                                        <td colspan="6" class="text-center text-warning mb-2">Data Not Found</td>
                                        <td class="text-center">
                                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEditModal">Add Team Info <i data-feather="plus"></i></button>
                                        </td>
                                    </tr>`);
                            }
                        } else {
                            console.error("Failed to fetch team data:", res.message);
                            toastr.warning(res.message);
                        }
                    },
                    error: function(err) {
                        console.error("Error in fetching team data:", err);
                        toastr.error("An unexpected error occurred.");
                    }
                });
            }

            // Initial load of team data
            productView();

            // Event listener for add new button
            // $('#addNewButton').click(function() {
            //     $('#modalTitle').text('Add New');
            //     $('#product_id').val('');
            //     $('#name').val('');
            //     $('#position').val('');
            //     $('#showEditImage').attr('src', '');
            //     $('#addEditConfirmButton').text('Add');
            // });

            // Event listener for edit button
            $(document).on('click', '.team_edit', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                // alert(id);
                $.ajax({
                    url: `/backend/team/edit/${id}`,
                    type: 'GET',
                    success: function(data) {
                        // console.log(data);
                        if (data.status === 200) {
                            // alert("hello world");
                            const team = data.data;
                            $('#modalTitle').text('Edit Team Member');
                            $('#product_id').val(team.id);
                            $('#name').val(team.name);
                            $('#position').val(team.position);
                            $('#showEditImage').attr('src', team.photo_url ? `/uploads/team/${team.photo_url}` : '');
                            $('#addEditConfirmButton').text('Update');
                        } else {
                            toastr.warning(res.message);
                        }
                    },
                    error: function(err) {
                        console.error("Error in fetching team data:", err);
                        toastr.error("An unexpected error occurred.");
                    }
                });
            });
            // Event listener for delete button
            $(document).on('click', '.team_delete', function(e) {
                e.preventDefault();
                let id = this.getAttribute('data-id');
                // alert(id);
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to delete this team member!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: `/backend/team/destroy/${id}`,
                            type: 'GET',
                            success: function(res) {
                                // console.log(res);
                                if (res.status == 200) {
                                    toastr.success(res.message);
                                    productView();
                                } else {
                                    toastr.warning(res.message);
                                    toastr.warning(res.message);
                                }
                            },
                            error: function(err) {
                                // console.log(err);
                                console.error("Error in deleting team member:", err);
                                toastr.error("An unexpected error occurred.");
                                // toastr.warning("Error in deleting team member:", err);
                            }
                        });
                    }
                });
            });

        });

    </script>
<!-- Page Specific Custom Scripts End -->
@endsection