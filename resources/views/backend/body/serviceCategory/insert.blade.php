@extends('backend.master')
@section('admin')
    <div class="container">
        <section class="scroll-section" id="floatingLabel">
            <h2 class="small-title">Add Category</h2>
            <div class="card mb-5">
                <div class="card-body">
                    <form id="validationFloatingLabel" class="tooltip-end-top" novalidate="novalidate">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="Category Name" name="name"
                                required="">
                            <label>Category Name</label>
                        </div>

                        <div class="input-group mb-3">
                            <input type="file" class="form-control" id="inputGroupFile02">
                            <label class="input-group-text" for="inputGroupFile02">Upload</label>
                        </div>

                        <div class="form-floating mb-3">
                            <tags class="tagify tagify--noTags tagify--empty" required="" tabindex="-1">
                                <span contenteditable="" data-placeholder="&ZeroWidthSpace;" aria-placeholder=""
                                    class="tagify__input" role="textbox" aria-autocomplete="both"
                                    aria-multiline="false"></span>
                            </tags><input id="tagsFloatingLabel" name="tagsFloatingLabel" required="">
                            <label>Tags</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="date-picker form-control" placeholder="Date"
                                id="datePickerFloatingLabel" name="datePickerFloatingLabel" required="">
                            <label>Date</label>
                        </div>
                        <div class="form-floating mb-3 w-100">
                            <select id="select2FloatingLabel" name="select2FloatingLabel" required=""
                                data-select2-id="select2FloatingLabel" tabindex="-1" class="select2-hidden-accessible"
                                aria-hidden="true">
                                <option label="&nbsp;" data-select2-id="6"></option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                                <option value="Maybe">Maybe</option>
                            </select><span class="select2 select2-container select2-container--bootstrap4" dir="ltr"
                                data-select2-id="5" style="width: 66.5px;"><span class="selection"><span
                                        class="select2-selection select2-selection--single" role="combobox"
                                        aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false"
                                        aria-labelledby="select2-select2FloatingLabel-container"><span
                                            class="select2-selection__rendered" id="select2-select2FloatingLabel-container"
                                            role="textbox" aria-readonly="true"><span
                                                class="select2-selection__placeholder"></span></span><span
                                            class="select2-selection__arrow" role="presentation"><b
                                                role="presentation"></b></span></span></span><span class="dropdown-wrapper"
                                    aria-hidden="true"></span></span>
                            <label>Bread</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" placeholder="Address" rows="3" name="addressFloatingLabel" required=""></textarea>
                            <label>Address</label>
                        </div>
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
