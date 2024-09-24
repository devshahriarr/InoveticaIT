@extends('backend.master')
@section('admin')



<div class="container">
    <!-- Title and Top Buttons Start -->
    <div class="page-title-container">
        <div class="row">
            <!-- Title Start -->
            <div class="col-12 col-md-7">
                <h1 class="mb-0 pb-0 display-4" id="title">Product Category List</h1>
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
        </div>
    </div>
    <!-- Title and Top Buttons End -->
    <section class="scroll-section my-5" id="bootstrapServerSide">
        <h2 class="small-title">Add Product Category</h2>
        <div class="card">
            <div class="card-body">
                <form id="signupForm" class="data_category row"
                    enctype="multipart/form-data" class="row g-3">
                    <div class="col-12 pb-5">
                        <label for="validationServer01" class="form-label">Category name</label>
                        <input type="text" name="categoryName" onkeyup="errorRemove(this);" onblur="errorRemove(this);" class="form-control cat_name "
                            id="validationServer01" value="">
                        <!-- <span class="text-danger cat_name_error">this is a not valid </span> -->
                        <div class="valid-feedback error_msg">Looks good!</div>
                        <div id="validationServer01Feedback" class="invalid-feedback cat_name_error">Please provide a valid Name.
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-group mb-3">
                            <input type="file" name="categoryImage" class="form-control" id="inputGroupFile02">
                            <label class="input-group-text" for="inputGroupFile02">Upload</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary save_button" type="submit">Submit form</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- category Table -->
    <div class="row">
        <h2 class="small-title text-center">Product Category list</h2>
        <div class="col">
            <table class="table table-striped mt-3">
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
        </div>
    </div>


</div>

<script>
    // error remove
    function errorRemove(element) {
        if (element.value != '') {
            $(element).siblings('span').hide();
            $(element).css('border-color', 'green');
            // alert('d');
            $('.error_msg').show();
        }
    }
    $(document).ready(function() {
        // show error
        function showError(name, message) {
            // alert('hello');
            $(name).css('border-color', 'red'); // Highlight input with red border
            $(name).focus(); // Set focus to the input field
            $(`${name}_error`).show().text(message); // Show error message
        }
        // save category
        const savecat = document.querySelector('.save_button');
        savecat.addEventListener('click', function(e) {

            e.preventDefault();
            let formData = new FormData($('.data_category')[0]);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({

                url: 'category/store',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    if (res.status == 200) {
                        $('.data_category')[0].reset();
                        catView();
                        toastr.success(res.message);
                    } else {

                        console.log(res);
                        if (res.error.categoryName) {
                            showError('.cat_name', res.error.categoryName);
                        }
                    }
                }
            });
        })

        function catView() {
            $.ajax({
                url: '{{ route("product.category.view") }}',
                method: 'GET',
                success: function(res) {
                    // console.log(res);
                    if (res.status == 200) {
                        const categories = res.data;
                        console.log(res.data);
                        $('.showData').empty();
                        if (categories.length > 0) {
                            $.each(categories, function(index, category) {
                                // console.log(category.image);
                                const tr = `
                                        <tr>
                                            <td>${index + 1}</td>
                                            
                                            <td>${category.image ? `<img src="/uploads/store/product/categoryImage/${category.image}" alt="category Image" width="50">` : 'photo not found'}</td>
                                            <td>${category.categoryName ?? ""}</td>
                                            <td>
                                                <button id="catStatusBtn${category.id}" class="catStatusBtn badge text-uppercase ${category.status != 0 ? 'bg-danger' : 'bg-success' } categoryButton" data-id="${category.id}">${category.status != 0 ? 'Inactive' : 'Active'}</button>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-outline-primary btn-icon category_edit" data-id="${category.id}" data-bs-toggle="modal" data-bs-target="#addEditModal">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="acorn-icons acorn-icons-edit-square undefined"><path d="M11 2L5.5 2C4.09554 2 3.39331 2 2.88886 2.33706C2.67048 2.48298 2.48298 2.67048 2.33706 2.88886C2 3.39331 2 4.09554 2 5.5L2 14.5C2 15.9045 2 16.6067 2.33706 17.1111C2.48298 17.3295 2.67048 17.517 2.88886 17.6629C3.39331 18 4.09554 18 5.5 18L14.5 18C15.9045 18 16.6067 18 17.1111 17.6629C17.3295 17.517 17.517 17.3295 17.6629 17.1111C18 16.6067 18 15.9045 18 14.5L18 11"></path><path d="M15.4978 3.06224C15.7795 2.78052 16.1616 2.62225 16.56 2.62225C16.9585 2.62225 17.3405 2.78052 17.6223 3.06224C17.904 3.34396 18.0623 3.72605 18.0623 4.12446C18.0623 4.52288 17.904 4.90497 17.6223 5.18669L10.8949 11.9141L8.06226 12.6223L8.7704 9.78966L15.4978 3.06224Z"></path></svg>
                                                </a>
                                                <a href="#" class="btn btn-outline-danger btn-icon category_delete" data-id="${category.id}">
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
                                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEditModal">Add category Info <i data-feather="plus"></i></button>
                                        </td>
                                    </tr>`);
                        }
                    } else {
                        console.error("Failed to fetch category data:", res.message);
                        toastr.warning(res.message);
                    }
                },
                error: function(err) {
                    console.error("Error in fetching category data:", err);
                    toastr.error("An unexpected error occurred.");
                }
            });
        }
        // Initial load of category data
        catView();

        $('.showData').on('click', '.catStatusBtn', function() {
            var catId = $(this).data('id');
            // alert(catId);
            $.ajax({
                url: '/backend/product/category/status/' + catId,
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
                                button.removeClass('bg-success').addClass(
                                    'bg-danger').text('Inactive');
                            } else {
                                button.removeClass('bg-danger').addClass(
                                    'bg-success').text('Active');


                            }
                        } else {
                            button.removeClass('bg-success').addClass(
                                'bg-danger').text(
                                'Inactive');
                        }
                    }
                }
            });
        });

    });
</script>
@endsection