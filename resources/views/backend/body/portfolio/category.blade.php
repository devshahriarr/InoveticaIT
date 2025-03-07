@extends('backend.master')
@section('admin')



<div class="container">
    <div class="row">
        <div class="col">
            <!-- Title and Top Buttons Start -->
            <div class="page-title-container">
                <div class="row">
                    <!-- Title Start -->
                    <div class="col-12 col-md-7">
                        <h1 class="mb-0 pb-0 display-4" id="title">Portfolio Category List</h1>
                        <nav class="breadcrumb-container d-inline-block" aria-label="breadcrumb">
                            <ul class="breadcrumb pt-0">
                                <li class="breadcrumb-item"><a href="Dashboards.Default.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="Interface.html">Interface</a></li>
                                <li class="breadcrumb-item"><a href="Interface.Plugins.html">Plugins</a></li>
                                <li class="breadcrumb-item"><a href="Interface.Plugins.Datatables.html">Datatables</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <!-- Title End -->

                    <!-- Top Buttons Start -->
                    <div class="col-12 col-md-5 d-flex align-items-start justify-content-end">
                        <!-- Add New Button Start -->
                        <button type="button"
                            class="btn btn-outline-primary btn-icon btn-icon-start w-100 w-md-auto add-datatable" data-bs-toggle="modal" data-bs-target="#addEditModal" id="addNewButton">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                                fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" class="acorn-icons acorn-icons-plus undefined">
                                <path d="M10 17 10 3M3 10 17 10"></path>
                            </svg>
                            <span>Add New</span>
                        </button>
                        <!-- Add New Button End -->

                        <!-- Check Button Start -->
                        <div class="btn-group ms-1 check-all-container">
                            <div class="btn btn-outline-primary btn-custom-control p-0 ps-3 pe-2"
                                id="datatableCheckAllButton">
                                <span class="form-check float-end">
                                    <input type="checkbox" class="form-check-input" id="datatableCheckAll">
                                </span>
                            </div>
                            <button type="button" class="btn btn-outline-primary dropdown-toggle dropdown-toggle-split"
                                data-bs-offset="0,3" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" data-submenu=""></button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <div class="dropdown dropstart dropdown-submenu">
                                    <button class="dropdown-item dropdown-toggle tag-datatable caret-absolute disabled"
                                        type="button">Tag</button>
                                    <div class="dropdown-menu">
                                        <button class="dropdown-item tag-done" type="button">Done</button>
                                        <button class="dropdown-item tag-new" type="button">New</button>
                                        <button class="dropdown-item tag-sale" type="button">Sale</button>
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>
                                <button class="dropdown-item disabled delete-datatable" type="button">Delete</button>
                            </div>
                        </div>
                        <!-- Check Button End -->
                    </div>
                    <!-- Top Buttons End -->
                </div>
            </div>
            <!-- Title and Top Buttons End -->

            <!-- Add Edit Modal Start -->
            <div class="modal modal-right fade" id="addEditModal" tabindex="-1" role="dialog"
                aria-labelledby="modalTitle" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTitle">Add New</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="PortfolioCatForm" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" id="catId" name="id">
                                <div class="mb-3">
                                    <label for="validationServer01" class="form-label">Category name</label>
                                    <input type="text" name="categoryName" class="form-control"
                                        id="cat_name" value="" required="">
                                        <span class="text-danger" id="cat_name_error"></span>
                                    <div class="valid-feedback">Looks good!</div>
                                    <!-- <div id="cat_name_error" class="invalid-feedback">Please provide a valid Name.
                                    </div> -->
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" class="form-control" name="categoryImage" id="cat_image">
                                    <span class="text-danger" id="cat_image_error"></span>
                                    <!-- <img id="showEditImage" src="" alt="" width="50"> -->
                                </div>
                                
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary save_Portfolio_cat" id="addEditConfirmButton">Add</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add Edit Modal End -->

            <!-- Portfolio Category Table Start-->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="showData">
                    <!-- Data will be inserted here by AJAX -->
                </tbody>
            </table>
            <!-- Portfolio Category Table End-->
        </div>
    </div>
</div>


<script>
    function validateForm() {
        let isValid = true;

        // Clear previous error messages
        $('.text-danger').text('');
        $('input').css('border-color', '');

        // Get form values
        let name = $('#cat_name').val().trim();
        let image = $('#cat_image').val();

        // Validate name
        if (name === '') {
            showError('#cat_name', 'Name is required.');
            isValid = false;
        } else if (name.length > 100) {
            showError('#cat_name', 'Name cannot be longer than 100 characters.');
            isValid = false;
        }

        // Validate image (if needed)
        if (image) {
            let fileExtension = image.split('.').pop().toLowerCase();
            let validExtensions = ['jpeg', 'jpg', 'png', 'gif', 'webp'];
            if (!validExtensions.includes(fileExtension)) {
                showError('#cat_image', 'Invalid image format. Allowed formats: jpeg, jpg, png, gif, webp.');
                isValid = false;
            }
        }

        return isValid;
    }

    $(document).ready(function() {

        // Function to show Ajax Validation error
        function showError(name, message) {
            $(name).addClass('is-invalid');
            $(name).focus();
            $(`${name}_error`).text(message);
        }

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
                        $('#addEditModal').modal('hide');
                        $('.PortfolioCatForm')[0].reset();
                        toastr.success(res.message);
                        PortfolioCatView(); // Refresh the table data
                    } 
                    else {
                        // Handle validation errors
                        if (res.errors) {
                            for (let [field, messages] of Object.entries(res.errors)) {
                                showError(`#${field}`, messages[0]);
                            }
                        }
                    }
                },
                error: function(err) {
                    // alert(err.responseJSON.errors);
                    if (err.status === 422) { // Validation error
                        var errors = err.responseJSON.errors;
                        if (errors.categoryName ) {
                            showError('#cat_name', errors.categoryName );
                        }
                        if (errors.categoryImage ) {
                            showError('#cat_image', errors.categoryImage );
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
        $('.save_Portfolio_cat').on('click', function(e) {
            e.preventDefault();
            let formData = new FormData($('.PortfolioCatForm')[0]);
            let id = $('#catId').val();

            if (!validateForm()) {
                return; // Prevent submission if validation fails
            }

            if (id) {
                handleFormSubmission(`/backend/portfolios/category/update/${id}`, 'POST', formData);
            } else {
                handleFormSubmission('{{ route("backend.portfolio.category.add") }}', 'POST', formData);
            }
        });

        // Function to refresh the team data table
        function PortfolioCatView() {
            $.ajax({
                url: '{{ route("backend.portfolio.category.data") }}',
                method: 'GET',
                success: function(res) {
                    if (res.status == 200) {
                        const categories = res.data;
                        $('.showData').empty();
                        if (categories.length > 0) {
                            $.each(categories, function(index, cat) {
                                const tr = `
                                    <tr>
                                        <td>${index + 1}</td>
                                        
                                        <td>${cat.image ? `<img src="/uploads/Portfolio/category/${cat.image}" alt="cat Image" width="50">` : 'photo not found'}</td>
                                        <td>${cat.categoryName ?? ""}</td>
                                        <td>
                                            <button id="catStatusBtn${cat.id}" class="catStatusBtn badge text-uppercase ${cat.status != 0 ? 'bg-success' : 'bg-danger' } categoryButton" data-id="${cat.id}">${cat.status != 0 ? 'Active' : 'Inactive'}</button>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-outline-primary btn-icon cat_edit" data-id="${cat.id}" data-bs-toggle="modal" data-bs-target="#addEditModal">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="acorn-icons acorn-icons-edit-square undefined"><path d="M11 2L5.5 2C4.09554 2 3.39331 2 2.88886 2.33706C2.67048 2.48298 2.48298 2.67048 2.33706 2.88886C2 3.39331 2 4.09554 2 5.5L2 14.5C2 15.9045 2 16.6067 2.33706 17.1111C2.48298 17.3295 2.67048 17.517 2.88886 17.6629C3.39331 18 4.09554 18 5.5 18L14.5 18C15.9045 18 16.6067 18 17.1111 17.6629C17.3295 17.517 17.517 17.3295 17.6629 17.1111C18 16.6067 18 15.9045 18 14.5L18 11"></path><path d="M15.4978 3.06224C15.7795 2.78052 16.1616 2.62225 16.56 2.62225C16.9585 2.62225 17.3405 2.78052 17.6223 3.06224C17.904 3.34396 18.0623 3.72605 18.0623 4.12446C18.0623 4.52288 17.904 4.90497 17.6223 5.18669L10.8949 11.9141L8.06226 12.6223L8.7704 9.78966L15.4978 3.06224Z"></path></svg>
                                            </a>
                                            <a href="#" class="btn btn-outline-danger btn-icon cat_delete" data-id="${cat.id}">
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
        PortfolioCatView();

        // Event listener for add new button
        $('#addNewButton').click(function() {
            $('#modalTitle').text('Add New');
            $('#catId').val('');
            $('#cat_name').val('');
            $('#cat_image').attr('src', '');
            $('#addEditConfirmButton').text('Add');
        });

        // Event listener for edit button
        $(document).on('click', '.cat_edit', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            // alert(id);
            $.ajax({
                url: `/backend/portfolios/category/edit/${id}`,
                type: 'GET',
                success: function(res) {
                    if (res.status === 200) {
                        const data = res.data;
                        $('#modalTitle').text('Edit Portfolio Category');
                        $('#catId').val(data.id);
                        $('#cat_name').val(data.categoryName);
                        $('#cat_image').attr('src', data.image ? `/uploads/Portfolio/category/${data.image}` : '');
                        $('#addEditConfirmButton').text('Update');
                    } else {
                        toastr.warning(res.message);
                    }
                },
                error: function(err) {
                    console.error("Error in fetching Portfolio Category data:", err);
                    toastr.error("An unexpected error occurred.");
                }
            });
        });
        // Event listener for delete button
        $(document).on('click', '.cat_delete', function(e) {
            e.preventDefault();
            let id = this.getAttribute('data-id');
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
                        url: `/backend/portfolios/category/delete/${id}`,
                        type: 'GET',
                        success: function(res) {
                            if (res.status == 200) {
                                toastr.success(res.message);
                                PortfolioCatView();
                            } else {
                                toastr.warning(res.message);
                                toastr.warning(res.message);
                            }
                        },
                        error: function(err) {
                            console.error("Error in deleting team member:", err);
                            toastr.error("An unexpected error occurred.");
                            // toastr.warning("Error in deleting team member:", err);
                        }
                    });
                }
            });
        });

        $('.showData').on('click', '.catStatusBtn', function() {
            var catId = $(this).data('id');
            // alert(catId);
            $.ajax({
                url: '/backend/portfolios/category/status/' + catId,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status == 200) {
                        // var button = $('#categoryButton_' + categoryId);
                        if (response.status == 200) {
                            var button = $('#catStatusBtn' +
                                catId);
                            if (response.newStatus == 1) {
                                button.removeClass('bg-danger').addClass('bg-success').text('Active');
                            } else {
                                button.removeClass('bg-success').addClass('bg-danger').text('Inactive');
                            }
                        } else {
                            button.removeClass('bg-success').addClass('bg-danger').text('Inactive');
                        }
                    }
                }
            });
        });

    });
</script>
@endsection