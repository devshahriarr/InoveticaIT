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
          <button type="button" class="btn btn-outline-primary btn-icon btn-icon-end w-100 w-sm-auto" id="dashboardTourButton">
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
                <form action="{{ Route('backend.service.store') }}" method="POST"
                    enctype="multipart/form-data" class="row g-3">
                    @csrf
                    <div class="col-12">
                        <label for="validationServer01" class="form-label">Service name</label>
                        <input type="text" name="service_name" class="form-control is-valid"
                            id="validationServer01" value="" required="">
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
                                        <option value="{{ $service_category->id }}">{{ $service_category->categoryName }}</option>
                                @endforeach
                                @else
                                    <option selected disabled>Please Add Sevice Category</option>
                                @endif
                            </select>
                            <br>
                            <select id="select2Basic" data-select2-id="select2Basic" tabindex="-1" class="select2-hidden-accessible" aria-hidden="true">
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

                            <span class="select2 select2-container select2-container--bootstrap4 select2-container--open select2-container--above select2-container--focus" dir="ltr" data-select2-id="1" style="width: 95px;">
                            <span class="selection">
                                <span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="true" tabindex="0" aria-disabled="false" aria-labelledby="select2-select2Basic-container" aria-owns="select2-select2Basic-results" aria-activedescendant="select2-select2Basic-result-6evn-Lefse">
                                    <span class="select2-selection__rendered" id="select2-select2Basic-container" role="textbox" aria-readonly="true">
                                        <span class="select2-selection__placeholder"></span>
                                    </span>
                                    <span class="select2-selection__arrow" role="presentation">
                                        <b role="presentation"></b>
                                    </span>
                                </span>
                            </span>
                            <span class="dropdown-wrapper" aria-hidden="true"></span>
                            </span>
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
                        
                        <div class="ql-toolbar ql-snow"><span class="ql-formats"><button type="button" class="ql-bold"><svg viewBox="0 0 18 18"> <path class="ql-stroke" d="M5,4H9.5A2.5,2.5,0,0,1,12,6.5v0A2.5,2.5,0,0,1,9.5,9H5A0,0,0,0,1,5,9V4A0,0,0,0,1,5,4Z"></path> <path class="ql-stroke" d="M5,9h5.5A2.5,2.5,0,0,1,13,11.5v0A2.5,2.5,0,0,1,10.5,14H5a0,0,0,0,1,0,0V9A0,0,0,0,1,5,9Z"></path> </svg></button><button type="button" class="ql-italic"><svg viewBox="0 0 18 18"> <line class="ql-stroke" x1="7" x2="13" y1="4" y2="4"></line> <line class="ql-stroke" x1="5" x2="11" y1="14" y2="14"></line> <line class="ql-stroke" x1="8" x2="10" y1="14" y2="4"></line> </svg></button><button type="button" class="ql-underline"><svg viewBox="0 0 18 18"> <path class="ql-stroke" d="M5,3V9a4.012,4.012,0,0,0,4,4H9a4.012,4.012,0,0,0,4-4V3"></path> <rect class="ql-fill" height="1" rx="0.5" ry="0.5" width="12" x="3" y="15"></rect> </svg></button><button type="button" class="ql-strike"><svg viewBox="0 0 18 18"> <line class="ql-stroke ql-thin" x1="15.5" x2="2.5" y1="8.5" y2="9.5"></line> <path class="ql-fill" d="M9.007,8C6.542,7.791,6,7.519,6,6.5,6,5.792,7.283,5,9,5c1.571,0,2.765.679,2.969,1.309a1,1,0,0,0,1.9-.617C13.356,4.106,11.354,3,9,3,6.2,3,4,4.538,4,6.5a3.2,3.2,0,0,0,.5,1.843Z"></path> <path class="ql-fill" d="M8.984,10C11.457,10.208,12,10.479,12,11.5c0,0.708-1.283,1.5-3,1.5-1.571,0-2.765-.679-2.969-1.309a1,1,0,1,0-1.9.617C4.644,13.894,6.646,15,9,15c2.8,0,5-1.538,5-3.5a3.2,3.2,0,0,0-.5-1.843Z"></path> </svg></button></span><span class="ql-formats"><button type="button" class="ql-blockquote"><svg viewBox="0 0 18 18"> <rect class="ql-fill ql-stroke" height="3" width="3" x="4" y="5"></rect> <rect class="ql-fill ql-stroke" height="3" width="3" x="11" y="5"></rect> <path class="ql-even ql-fill ql-stroke" d="M7,8c0,4.031-3,5-3,5"></path> <path class="ql-even ql-fill ql-stroke" d="M14,8c0,4.031-3,5-3,5"></path> </svg></button><button type="button" class="ql-code-block"><svg viewBox="0 0 18 18"> <polyline class="ql-even ql-stroke" points="5 7 3 9 5 11"></polyline> <polyline class="ql-even ql-stroke" points="13 7 15 9 13 11"></polyline> <line class="ql-stroke" x1="10" x2="8" y1="5" y2="13"></line> </svg></button></span><span class="ql-formats"><button type="button" class="ql-list" value="ordered"><svg viewBox="0 0 18 18"> <line class="ql-stroke" x1="7" x2="15" y1="4" y2="4"></line> <line class="ql-stroke" x1="7" x2="15" y1="9" y2="9"></line> <line class="ql-stroke" x1="7" x2="15" y1="14" y2="14"></line> <line class="ql-stroke ql-thin" x1="2.5" x2="4.5" y1="5.5" y2="5.5"></line> <path class="ql-fill" d="M3.5,6A0.5,0.5,0,0,1,3,5.5V3.085l-0.276.138A0.5,0.5,0,0,1,2.053,3c-0.124-.247-0.023-0.324.224-0.447l1-.5A0.5,0.5,0,0,1,4,2.5v3A0.5,0.5,0,0,1,3.5,6Z"></path> <path class="ql-stroke ql-thin" d="M4.5,10.5h-2c0-.234,1.85-1.076,1.85-2.234A0.959,0.959,0,0,0,2.5,8.156"></path> <path class="ql-stroke ql-thin" d="M2.5,14.846a0.959,0.959,0,0,0,1.85-.109A0.7,0.7,0,0,0,3.75,14a0.688,0.688,0,0,0,.6-0.736,0.959,0.959,0,0,0-1.85-.109"></path> </svg></button><button type="button" class="ql-list" value="bullet"><svg viewBox="0 0 18 18"> <line class="ql-stroke" x1="6" x2="15" y1="4" y2="4"></line> <line class="ql-stroke" x1="6" x2="15" y1="9" y2="9"></line> <line class="ql-stroke" x1="6" x2="15" y1="14" y2="14"></line> <line class="ql-stroke" x1="3" x2="3" y1="4" y2="4"></line> <line class="ql-stroke" x1="3" x2="3" y1="9" y2="9"></line> <line class="ql-stroke" x1="3" x2="3" y1="14" y2="14"></line> </svg></button></span><span class="ql-formats"><button type="button" class="ql-indent" value="-1"><svg viewBox="0 0 18 18"> <line class="ql-stroke" x1="3" x2="15" y1="14" y2="14"></line> <line class="ql-stroke" x1="3" x2="15" y1="4" y2="4"></line> <line class="ql-stroke" x1="9" x2="15" y1="9" y2="9"></line> <polyline class="ql-stroke" points="5 7 5 11 3 9 5 7"></polyline> </svg></button><button type="button" class="ql-indent" value="+1"><svg viewBox="0 0 18 18"> <line class="ql-stroke" x1="3" x2="15" y1="14" y2="14"></line> <line class="ql-stroke" x1="3" x2="15" y1="4" y2="4"></line> <line class="ql-stroke" x1="9" x2="15" y1="9" y2="9"></line> <polyline class="ql-fill ql-stroke" points="3 7 3 11 5 9 3 7"></polyline> </svg></button></span><span class="ql-formats"><span class="ql-size ql-picker"><span class="ql-picker-label" tabindex="0" role="button" aria-expanded="false" aria-controls="ql-picker-options-0"><svg viewBox="0 0 18 18"> <polygon class="ql-stroke" points="7 11 9 13 11 11 7 11"></polygon> <polygon class="ql-stroke" points="7 7 9 5 11 7 7 7"></polygon> </svg></span><span class="ql-picker-options" aria-hidden="true" tabindex="-1" id="ql-picker-options-0"><span tabindex="0" role="button" class="ql-picker-item" data-value="small"></span><span tabindex="0" role="button" class="ql-picker-item"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="large"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="huge"></span></span></span><select class="ql-size" style="display: none;"><option value="small"></option><option selected="selected"></option><option value="large"></option><option value="huge"></option></select></span><span class="ql-formats"><span class="ql-header ql-picker"><span class="ql-picker-label" tabindex="0" role="button" aria-expanded="false" aria-controls="ql-picker-options-1"><svg viewBox="0 0 18 18"> <polygon class="ql-stroke" points="7 11 9 13 11 11 7 11"></polygon> <polygon class="ql-stroke" points="7 7 9 5 11 7 7 7"></polygon> </svg></span><span class="ql-picker-options" aria-hidden="true" tabindex="-1" id="ql-picker-options-1"><span tabindex="0" role="button" class="ql-picker-item" data-value="1"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="2"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="3"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="4"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="5"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="6"></span><span tabindex="0" role="button" class="ql-picker-item"></span></span></span><select class="ql-header" style="display: none;"><option value="1"></option><option value="2"></option><option value="3"></option><option value="4"></option><option value="5"></option><option value="6"></option><option selected="selected"></option></select></span><span class="ql-formats"><span class="ql-font ql-picker"><span class="ql-picker-label" tabindex="0" role="button" aria-expanded="false" aria-controls="ql-picker-options-2"><svg viewBox="0 0 18 18"> <polygon class="ql-stroke" points="7 11 9 13 11 11 7 11"></polygon> <polygon class="ql-stroke" points="7 7 9 5 11 7 7 7"></polygon> </svg></span><span class="ql-picker-options" aria-hidden="true" tabindex="-1" id="ql-picker-options-2"><span tabindex="0" role="button" class="ql-picker-item"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="serif"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="monospace"></span></span></span><select class="ql-font" style="display: none;"><option selected="selected"></option><option value="serif"></option><option value="monospace"></option></select></span><span class="ql-formats"><span class="ql-align ql-picker ql-icon-picker"><span class="ql-picker-label" tabindex="0" role="button" aria-expanded="false" aria-controls="ql-picker-options-3"><svg viewBox="0 0 18 18"> <line class="ql-stroke" x1="3" x2="15" y1="9" y2="9"></line> <line class="ql-stroke" x1="3" x2="13" y1="14" y2="14"></line> <line class="ql-stroke" x1="3" x2="9" y1="4" y2="4"></line> </svg></span><span class="ql-picker-options" aria-hidden="true" tabindex="-1" id="ql-picker-options-3"><span tabindex="0" role="button" class="ql-picker-item"><svg viewBox="0 0 18 18"> <line class="ql-stroke" x1="3" x2="15" y1="9" y2="9"></line> <line class="ql-stroke" x1="3" x2="13" y1="14" y2="14"></line> <line class="ql-stroke" x1="3" x2="9" y1="4" y2="4"></line> </svg></span><span tabindex="0" role="button" class="ql-picker-item" data-value="center"><svg viewBox="0 0 18 18"> <line class="ql-stroke" x1="15" x2="3" y1="9" y2="9"></line> <line class="ql-stroke" x1="14" x2="4" y1="14" y2="14"></line> <line class="ql-stroke" x1="12" x2="6" y1="4" y2="4"></line> </svg></span><span tabindex="0" role="button" class="ql-picker-item" data-value="right"><svg viewBox="0 0 18 18"> <line class="ql-stroke" x1="15" x2="3" y1="9" y2="9"></line> <line class="ql-stroke" x1="15" x2="5" y1="14" y2="14"></line> <line class="ql-stroke" x1="15" x2="9" y1="4" y2="4"></line> </svg></span><span tabindex="0" role="button" class="ql-picker-item" data-value="justify"><svg viewBox="0 0 18 18"> <line class="ql-stroke" x1="15" x2="3" y1="9" y2="9"></line> <line class="ql-stroke" x1="15" x2="3" y1="14" y2="14"></line> <line class="ql-stroke" x1="15" x2="3" y1="4" y2="4"></line> </svg></span></span></span><select class="ql-align" style="display: none;"><option selected="selected"></option><option value="center"></option><option value="right"></option><option value="justify"></option></select></span><span class="ql-formats"><button type="button" class="ql-clean"><svg class="" viewBox="0 0 18 18"> <line class="ql-stroke" x1="5" x2="13" y1="3" y2="3"></line> <line class="ql-stroke" x1="6" x2="9.35" y1="12" y2="3"></line> <line class="ql-stroke" x1="11" x2="15" y1="11" y2="15"></line> <line class="ql-stroke" x1="15" x2="11" y1="11" y2="15"></line> <rect class="ql-fill" height="1" rx="0.5" ry="0.5" width="7" x="2" y="14"></rect> </svg></button></span></div><div class="html-editor sh-19 ql-container ql-snow" id="quillEditor"><div class="ql-editor ql-blank" data-gramm="false" contenteditable="true"><p><br></p></div><div class="ql-clipboard" contenteditable="true" tabindex="-1"></div><div class="ql-tooltip ql-hidden"><a class="ql-preview" target="_blank" href="about:blank"></a><input type="text" data-formula="e=mc^2" data-link="https://quilljs.com" data-video="Embed URL"><a class="ql-action"></a><a class="ql-remove"></a></div></div>
        
                        <input type="text" name="service_desc" class="form-control is-valid"
                            id="validationServer01" value="" required="">
                        <div class="valid-feedback">Looks good!</div>
                        <div id="validationServer01Feedback" class="invalid-feedback">Please provide a valid Name.
                        </div>
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
            <tag title="Dorayaki" contenteditable="false" spellcheck="false" tabindex="-1" class="tagify__tag tagify--noAnim" __isvalid="true" value="Dorayaki"><x title="" class="tagify__tag__removeBtn" role="button" aria-label="remove tag"></x><div><span class="tagify__tag-text">Dorayaki</span></div></tag><tag title="Roti" contenteditable="false" spellcheck="false" tabindex="-1" class="tagify__tag tagify--noAnim" __isvalid="true" value="Roti"><x title="" class="tagify__tag__removeBtn" role="button" aria-label="remove tag"></x><div><span class="tagify__tag-text">Roti</span></div></tag><tag title="Panbrioche" contenteditable="false" spellcheck="false" tabindex="-1" class="tagify__tag tagify--noAnim" __isvalid="true" value="Panbrioche"><x title="" class="tagify__tag__removeBtn" role="button" aria-label="remove tag"></x><div><span class="tagify__tag-text">Panbrioche</span></div></tag><tag title="Kifli" contenteditable="false" spellcheck="false" tabindex="-1" class="tagify__tag " __isvalid="true" value="Kifli"><x title="" class="tagify__tag__removeBtn" role="button" aria-label="remove tag"></x><div><span class="tagify__tag-text">Kifli</span></div></tag><tag title="Cholermüs" contenteditable="false" spellcheck="false" tabindex="-1" class="tagify__tag " __isvalid="true" value="Cholermüs"><x title="" class="tagify__tag__removeBtn" role="button" aria-label="remove tag"></x><div><span class="tagify__tag-text">Cholermüs</span></div></tag><tag title="Biscotti" contenteditable="false" spellcheck="false" tabindex="-1" class="tagify__tag " __isvalid="true" value="Biscotti"><x title="" class="tagify__tag__removeBtn" role="button" aria-label="remove tag"></x><div><span class="tagify__tag-text">Biscotti</span></div></tag><span contenteditable="" data-placeholder="Write Tags" aria-placeholder="Write Tags" class="tagify__input" role="textbox" aria-autocomplete="both" aria-multiline="false"></span>
        </tags><input id="tagsOutside" class="tagify--outside" value="Dorayaki, Roti, Panbrioche" placeholder="Write Tags">
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

    <!-- Page Specific Scripts End -->

@endsection
