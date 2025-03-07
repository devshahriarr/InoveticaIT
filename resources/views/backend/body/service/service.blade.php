@extends('backend.master')
@section('admin')

    <!-- Page Specific Styles Start -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/vendor/quill.bubble.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/css/vendor/quill.snow.css" />

    <link rel="stylesheet" href="{{ asset('assets') }}/css/vendor/tagify.css" />
    <!-- Page Specific Styles End -->

    <div class="container">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row">
                <!-- Title Start -->
                <div class="col-12 col-sm-6">
                    <h1 class="mb-0 pb-0 display-4" id="title">Service Section</h1>
                    <nav class="breadcrumb-container d-inline-block" aria-label="breadcrumb">
                        <ul class="breadcrumb pt-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
                        </ul>
                    </nav>
                </div>
                <!-- Title End -->


                @if ($services->count() > 0)
                    <table>
                        <thead>
                            </tr>
                            <th>SL No</th>
                            <th>service Name</th>
                            <th>slug</th>
                            <th>image</th>
                            <th>status</th>
                            <th>created_at</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($services as $key => $service)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $service->service_name }}</td>
                                    <td>{{ $service->service_cat_id }}</td>
                                    <td>{{ $service->service_img }}</td>
                                    <td>{{ $service->service_desc }}</td>
                                    <td>{{ $service->service_price }}</td>
                                    <td>{{ $service->service_tags }}</td>
                                    <td>{{ $service->status }}</td>
                                    <td>{{ $service->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

                <!-- Top Buttons Start -->
                <div class="col-12 col-sm-6 d-flex align-items-start justify-content-end">
                    <!-- Tour Button Start -->
                    <button type="button" class="btn btn-outline-primary btn-icon btn-icon-end w-100 w-sm-auto"
                        id="dashboardTourButton">
                        <span>Take a Tour</span>
                        <i data-acorn-icon="flag"></i>
                    </button>
                    <!-- Tour Button End -->
                </div>
                <!-- Top Buttons End -->
            </div>
        </div>
        <!-- Title and Top Buttons End -->
        <section class="scroll-section" id="bootstrapServerSide">
            <h2 class="small-title">Add Service Category</h2>
            <div class="card">
                <div class="card-body">
                    <form action="{{ Route('backend.service.store') }}" method="POST" enctype="multipart/form-data"
                        class="row g-3">
                        @csrf
                        <div class="col-12">
                            <label for="validationServer01" class="form-label">Service name</label>
                            <input type="text" name="service_name" class="form-control is-valid" id="validationServer01"
                                value="" required="">
                            <div class="valid-feedback">Looks good!</div>
                            <div id="validationServer01Feedback" class="invalid-feedback">Please provide a valid Name.
                            </div>
                        </div>
                        @php
                            $service_categories = App\Models\ServiceCategory::get();
                        @endphp


                        <div class="col-12 col-sm-6 col-xl-4" data-select2-id="19">
                            <div class="w-100" data-select2-id="18">
                                <label class="form-label">Service Category</label>
                                <br>
                                <select name="service_cat" id="service_cat">
                                    @if ($service_categories->count() > 0)
                                        @foreach ($service_categories as $key => $service_category)
                                            <option value="{{ $service_category->id }}">
                                                {{ $service_category->categoryName }}</option>
                                        @endforeach
                                    @else
                                        <option selected disabled>Please Add Sevice Category</option>
                                    @endif
                                </select>
                                <br>
                                <br>
                                <br>
                                <div class="scroll-section" id="basicSingle">
                                    <select id="select2Basic" data-select2-id="select2Basic" tabindex="-1"
                                        class="select2-hidden-accessible" aria-hidden="true">
                                        <option label="&nbsp;" data-select2-id="2"></option>
                                        <option value="Breadstick" data-select2-id="23">Breadstick</option>

                                        <option value="Biscotti" data-select2-id="24">Biscotti</option>
                                        <option value="Fougasse" data-select2-id="25">Fougasse</option>
                                        <option value="Lefse" data-select2-id="26">Lefse</option>
                                        <option value="Melonpan" data-select2-id="27">Melonpan</option>
                                        <option value="Naan" data-select2-id="28">Naan</option>
                                        <option value="Panbrioche" data-select2-id="29">Panbrioche</option>
                                        <option value="Rewena" data-select2-id="30">Rewena</option>
                                        <option value="Shirmal" data-select2-id="31">Shirmal</option>
                                        <option value="Tunnbröd" data-select2-id="32">Tunnbröd</option>
                                        <option value="Vánočka" data-select2-id="33">Vánočka</option>
                                        <option value="Zopf" data-select2-id="34">Zopf</option>
                                    </select>
                                </div>
                                {{-- <span
                                    class="select2 select2-container select2-container--bootstrap4 select2-container--open select2-container--above select2-container--focus"
                                    dir="ltr" data-select2-id="1" style="width: 95px;">
                                    <span class="selection">
                                        <span class="select2-selection select2-selection--single" role="combobox"
                                            aria-haspopup="true" aria-expanded="true" tabindex="0" aria-disabled="false"
                                            aria-labelledby="select2-select2Basic-container"
                                            aria-owns="select2-select2Basic-results"
                                            aria-activedescendant="select2-select2Basic-result-6evn-Lefse">
                                            <span class="select2-selection__rendered" id="select2-select2Basic-container"
                                                role="textbox" aria-readonly="true">
                                                <span class="select2-selection__placeholder"></span>
                                            </span>
                                            <span class="select2-selection__arrow" role="presentation">
                                                <b role="presentation"></b>
                                            </span>
                                        </span>
                                    </span>
                                    <span class="dropdown-wrapper" aria-hidden="true"></span>
                                </span> --}}
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Service Image</label>
                            <div class="input-group mb-3">
                                <input type="file" name="service_img" class="form-control" id="inputGroupFile02">
                                <label class="input-group-text" for="inputGroupFile02">Upload</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="validationServer01" class="form-label">Service Description</label>


                            <div class="html-editor sh-19 ql-container ql-snow" id="quillEditor">
                                <div class="ql-editor ql-blank" data-gramm="false" contenteditable="true">
                                    <p><br></p>
                                </div>
                                <div class="ql-clipboard" contenteditable="true" tabindex="-1"></div>
                                <div class="ql-tooltip ql-hidden"><a class="ql-preview" target="_blank"
                                        href="about:blank"></a><input type="text" name="service_desc"
                                        data-formula="e=mc^2" data-link="https://quilljs.com" data-video="Embed URL"><a
                                        class="ql-action"></a><a class="ql-remove"></a>
                                </div>
                            </div>

                            {{-- <input type="text" name="service_desc" class="form-control is-valid"
                                id="validationServer01" value="" required="">
                            <div class="valid-feedback">Looks good!</div>
                            <div id="validationServer01Feedback" class="invalid-feedback">Please provide a valid Name.
                            </div> --}}
                        </div>
                        <div class="col-12">
                            <label for="validationServer01" class="form-label">Service Price </label>
                            <input type="number" name="service_price" class="form-control is-valid"
                                id="validationServer01" value="" required="">
                            <div class="valid-feedback">Looks good!</div>
                            <div id="validationServer01Feedback" class="invalid-feedback">Please provide a valid Name.
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-xl-4" data-select2-id="64">
                            <div class="w-100" data-select2-id="63">
                                <label class="form-label">Service Tags</label>
                                <section class="scroll-section" id="outside">
                                    <h2 class="small-title">Outside</h2>
                                    <div class="card mb-5">
                                        <div class="card-body">
                                            <label class="d-block form-label">Breads</label>
                                            <tags class="tagify tagify--outside" tabindex="-1" aria-expanded="false">
                                                <tag title="Dorayaki" contenteditable="false" spellcheck="false"
                                                    tabindex="-1" class="tagify__tag tagify--noAnim" __isvalid="true"
                                                    value="Dorayaki">
                                                    <x title="" class="tagify__tag__removeBtn" role="button"
                                                        aria-label="remove tag"></x>
                                                    <div><span class="tagify__tag-text">Dorayaki</span></div>
                                                </tag>
                                                <tag title="Roti" contenteditable="false" spellcheck="false"
                                                    tabindex="-1" class="tagify__tag tagify--noAnim" __isvalid="true"
                                                    value="Roti">
                                                    <x title="" class="tagify__tag__removeBtn" role="button"
                                                        aria-label="remove tag"></x>
                                                    <div><span class="tagify__tag-text">Roti</span></div>
                                                </tag>
                                                <tag title="Panbrioche" contenteditable="false" spellcheck="false"
                                                    tabindex="-1" class="tagify__tag tagify--noAnim" __isvalid="true"
                                                    value="Panbrioche">
                                                    <x title="" class="tagify__tag__removeBtn" role="button"
                                                        aria-label="remove tag"></x>
                                                    <div><span class="tagify__tag-text">Panbrioche</span></div>
                                                </tag>
                                                <tag title="Kifli" contenteditable="false" spellcheck="false"
                                                    tabindex="-1" class="tagify__tag " __isvalid="true" value="Kifli">
                                                    <x title="" class="tagify__tag__removeBtn" role="button"
                                                        aria-label="remove tag"></x>
                                                    <div><span class="tagify__tag-text">Kifli</span></div>
                                                </tag>
                                                <tag title="Cholermüs" contenteditable="false" spellcheck="false"
                                                    tabindex="-1" class="tagify__tag " __isvalid="true"
                                                    value="Cholermüs">
                                                    <x title="" class="tagify__tag__removeBtn" role="button"
                                                        aria-label="remove tag"></x>
                                                    <div><span class="tagify__tag-text">Cholermüs</span></div>
                                                </tag>
                                                <tag title="Biscotti" contenteditable="false" spellcheck="false"
                                                    tabindex="-1" class="tagify__tag " __isvalid="true"
                                                    value="Biscotti">
                                                    <x title="" class="tagify__tag__removeBtn" role="button"
                                                        aria-label="remove tag"></x>
                                                    <div><span class="tagify__tag-text">Biscotti</span></div>
                                                </tag><span contenteditable="" data-placeholder="Write Tags"
                                                    aria-placeholder="Write Tags" class="tagify__input" role="textbox"
                                                    aria-autocomplete="both" aria-multiline="false"></span>
                                            </tags>
                                            <input id="tagsOutside" class="tagify--outside"
                                                value="Dorayaki, Roti, Panbrioche" placeholder="Write Tags">
                                        </div>
                                    </div>
                                </section>
                                {{-- <select name="service_tags" id="service_tags">
                                @if ($service_categories->count() > 0)
                                    @foreach ($service_categories as $key => $service_category)
                                        <option value="{{ $service_category->id }}">{{ $service_category->categoryName }}</option>
                                @endforeach
                                @else
                                    <option selected disabled>Please Add Sevice Category</option>
                                @endif
                            </select> --}}
                                <!-- <select multiple="" name="service_tags" id="select2Tags" data-select2-id="select2Tags" tabindex="-1" class="select2-hidden-accessible" aria-hidden="true">
                                                                <option value="Breadstick" data-select2-id="65">Breadstick</option>
                                                                <option value="Biscotti" data-select2-id="66">Biscotti</option>
                                                                <option value="Fougasse" data-select2-id="67">Fougasse</option>
                                                                <option value="Lefse" data-select2-id="68">Lefse</option>
                                                                <option value="Melonpan" data-select2-id="69">Melonpan</option>
                                                                <option value="Naan" data-select2-id="70">Naan</option>
                                                                <option value="Panbrioche" data-select2-id="71">Panbrioche</option>
                                                                <option value="Rewena" data-select2-id="72">Rewena</option>
                                                                <option value="Shirmal" data-select2-id="73">Shirmal</option>
                                                                <option value="Tunnbröd" data-select2-id="74">Tunnbröd</option>
                                                                <option value="Vánočka" data-select2-id="75">Vánočka</option>
                                                                <option value="Zopf" data-select2-id="76">Zopf</option>
                                                            </select><span class="select2 select2-container select2-container--bootstrap4 select2-container--above" dir="ltr" data-select2-id="4" style="width: 93.8281px;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-disabled="false"><ul class="select2-selection__rendered"><li class="select2-selection__choice" title="Fougasse" data-select2-id="78"><span class="select2-selection__choice__remove" role="presentation">×</span>Fougasse</li><li class="select2-search select2-search--inline"><input class="select2-search__field" type="search" tabindex="0" autocomplete="off" autocorrect="off" autocapitalize="none" spellcheck="false" role="searchbox" aria-autocomplete="list" placeholder="" style="width: 2.25em;"></li></ul></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span> -->
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Submit form</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

    </div>

    <!-- Page Specific Scripts Start -->

    <script src="{{ asset('assets') }}/js/vendor/quill.min.js"></script>

    <script src="{{ asset('assets') }}/js/vendor/quill.active.js"></script>

    <script src="{{ asset('assets') }}/js/forms/controls.editor.js"></script>

    <script src="{{ asset('assets') }}/js/forms/controls.tag.js"></script>

    <script src="{{ asset('assets') }}/js/forms/controls.select2.js"></script>

    <!-- Page Specific Scripts End -->

@endsection
