@extends('backend.master')
@section('admin')



    <div class="container">

    <section class="scroll-section" id="bootstrapServerSide">
        <h2 class="small-title">Add Product Category</h2>
        <div class="card">
            <div class="card-body">
                <form id="signupForm" class="data_category row"
                    enctype="multipart/form-data" class="row g-3">
                    <div class="col-12">
                        <label for="validationServer01" class="form-label">Category name</label>
                        <input type="text" name="categoryName" onkeyup="errorRemove(this);" onblur="errorRemove(this);" class="form-control cat_name "
                            id="validationServer01" value="" >
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

        @if ($product_categories->count() > 0)
        {{-- @dd($categories); --}}
        {{-- @dd($category) --}}
            <table>
                <thead>
                    </tr>
                        <th>SL No</th>
                        <th>category Name</th>
                        <th>slug</th>
                        <th>image</th>
                        <th>status</th>
                        <th>created_at</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($product_categories as $key => $category)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $category->categoryName }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>{{ $category->image }}</td>
                            <td>{{ $category->status }}</td>
                            <td>{{ $category->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        
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
                            // catView();
                            // toastr.success(res.message);
                        } else {
                            
                            console.log(res);
                            if (res.error.categoryName) {
                                showError('.cat_name', res.error.categoryName);
                            }
                        }
                    }
                });
            })
        });
    </script>
@endsection
