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
                            <h1 class="mb-0 pb-0 display-4" id="title">Service Category List</h1>
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
                                class="btn btn-outline-primary btn-icon btn-icon-start w-100 w-md-auto add-datatable">
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

                <br>
                @if ($categories->count() > 0)
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

                            @foreach ($categories as $key => $category)
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
            <br>
            <br>
                <!-- Content Start -->
                <div class="data-table-boxed">
                    <!-- Controls Start -->
                    <div class="row mb-2">
                        <!-- Search Start -->
                        <div class="col-sm-12 col-md-5 col-lg-3 col-xxl-2 mb-1">
                            <div
                                class="d-inline-block float-md-start me-1 mb-1 search-input-container w-100 shadow bg-foreground">
                                <input class="form-control datatable-search" placeholder="Search"
                                    data-datatable="#datatableBoxed">
                                <span class="search-magnifier-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="acorn-icons acorn-icons-search undefined">
                                        <circle cx="9" cy="9" r="7"></circle>
                                        <path d="M14 14L17.5 17.5"></path>
                                    </svg>
                                </span>
                                <span class="search-delete-icon d-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="acorn-icons acorn-icons-close undefined">
                                        <path d="M5 5 15 15M15 5 5 15"></path>
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <!-- Search End -->

                        <div class="col-sm-12 col-md-7 col-lg-9 col-xxl-10 text-end mb-1">
                            <div class="d-inline-block me-0 me-sm-3 float-start float-md-none">
                                <!-- Add Button Start -->
                                <button class="btn btn-icon btn-icon-only btn-foreground-alternate shadow add-datatable"
                                    data-bs-delay="0" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                    type="button" data-bs-original-title="Add">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="acorn-icons acorn-icons-plus undefined">
                                        <path d="M10 17 10 3M3 10 17 10"></path>
                                    </svg>
                                </button>
                                <!-- Add Button End -->

                                <!-- Edit Button Start -->
                                <button
                                    class="btn btn-icon btn-icon-only btn-foreground-alternate shadow edit-datatable disabled"
                                    data-bs-delay="0" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                    type="button" data-bs-original-title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="acorn-icons acorn-icons-edit undefined">
                                        <path
                                            d="M14.6264 2.54528C15.0872 2.08442 15.6782 1.79143 16.2693 1.73077C16.8604 1.67011 17.4032 1.84674 17.7783 2.22181C18.1533 2.59689 18.33 3.13967 18.2693 3.73077C18.2087 4.32186 17.9157 4.91284 17.4548 5.3737L6.53226 16.2962L2.22192 17.7782L3.70384 13.4678L14.6264 2.54528Z">
                                        </path>
                                    </svg>
                                </button>
                                <!-- Edit Button End -->

                                <!-- Delete Button Start -->
                                <button
                                    class="btn btn-icon btn-icon-only btn-foreground-alternate shadow disabled delete-datatable"
                                    data-bs-delay="0" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                    type="button" data-bs-original-title="Delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="acorn-icons acorn-icons-bin undefined">
                                        <path
                                            d="M4 5V14.5C4 15.9045 4 16.6067 4.33706 17.1111C4.48298 17.3295 4.67048 17.517 4.88886 17.6629C5.39331 18 6.09554 18 7.5 18H12.5C13.9045 18 14.6067 18 15.1111 17.6629C15.3295 17.517 15.517 17.3295 15.6629 17.1111C16 16.6067 16 15.9045 16 14.5V5">
                                        </path>
                                        <path
                                            d="M14 5L13.9424 4.74074C13.6934 3.62043 13.569 3.06028 13.225 2.67266C13.0751 2.50368 12.8977 2.36133 12.7002 2.25164C12.2472 2 11.6734 2 10.5257 2L9.47427 2C8.32663 2 7.75281 2 7.29981 2.25164C7.10234 2.36133 6.92488 2.50368 6.77496 2.67266C6.43105 3.06028 6.30657 3.62044 6.05761 4.74074L6 5">
                                        </path>
                                        <path d="M2 5H18M12 9V13M8 9V13"></path>
                                    </svg>
                                </button>
                                <!-- Delete Button End -->
                            </div>
                            <div class="d-inline-block">
                                <!-- Print Button Start -->
                                <button class="btn btn-icon btn-icon-only btn-foreground-alternate shadow datatable-print"
                                    data-bs-delay="0" data-datatable="#datatableBoxed" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="" type="button"
                                    data-bs-original-title="Print">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="acorn-icons acorn-icons-print undefined">
                                        <path
                                            d="M6.44444 15 5.52949 15C4.13332 15 3.43524 15 2.9322 14.6657 2.71437 14.5209 2.52706 14.3348 2.38087 14.1179 2.04325 13.6171 2.03869 12.919 2.02956 11.5229L2.02302 10.5229C2.01379 9.1101 2.00917 8.40371 2.34565 7.89566 2.49128 7.67577 2.67897 7.48685 2.8979 7.33979 3.40374 7 4.11015 7 5.52295 7L14.477 7C15.8899 7 16.5963 7 17.1021 7.33979 17.321 7.48685 17.5087 7.67577 17.6543 7.89566 17.9908 8.40371 17.9862 9.1101 17.977 10.5229L17.9704 11.5229C17.9613 12.919 17.9568 13.6171 17.6191 14.1179 17.4729 14.3348 17.2856 14.5209 17.0678 14.6657 16.5648 15 15.8667 15 14.4705 15L13.5556 15M15 7 15 3.75C15 3.04777 15 2.69665 14.8315 2.44443 14.7585 2.33524 14.6648 2.24149 14.5556 2.16853 14.3033 2 13.9522 2 13.25 2L6.75 2C6.04777 2 5.69665 2 5.44443 2.16853 5.33524 2.24149 5.24149 2.33524 5.16853 2.44443 5 2.69665 5 3.04777 5 3.75L5 7">
                                        </path>
                                        <path
                                            d="M12.25 13C12.9522 13 13.3033 13 13.5556 13.1685C13.6648 13.2415 13.7585 13.3352 13.8315 13.4444C14 13.6967 14 14.0478 14 14.75L14 16.25C14 16.9522 14 17.3033 13.8315 17.5556C13.7585 17.6648 13.6648 17.7585 13.5556 17.8315C13.3033 18 12.9522 18 12.25 18L7.75 18C7.04777 18 6.69665 18 6.44443 17.8315C6.33524 17.7585 6.24149 17.6648 6.16853 17.5556C6 17.3033 6 16.9522 6 16.25L6 14.75C6 14.0478 6 13.6967 6.16853 13.4444C6.24149 13.3352 6.33524 13.2415 6.44443 13.1685C6.69665 13 7.04777 13 7.75 13L12.25 13Z">
                                        </path>
                                        <path d="M7 10H6H5"></path>
                                    </svg>
                                </button>
                                <!-- Print Button End -->

                                <!-- Export Dropdown Start -->
                                <div class="d-inline-block datatable-export" data-datatable="#datatableBoxed">
                                    <button class="btn p-0" data-bs-toggle="dropdown" type="button"
                                        data-bs-offset="0,3">
                                        <span class="btn btn-icon btn-icon-only btn-foreground-alternate shadow dropdown"
                                            data-bs-delay="0" data-bs-placement="top" data-bs-toggle="tooltip"
                                            title="" data-bs-original-title="Export">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 20 20" fill="none" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                class="acorn-icons acorn-icons-download undefined">
                                                <path
                                                    d="M2 14V14.5C2 15.9045 2 16.6067 2.33706 17.1111C2.48298 17.3295 2.67048 17.517 2.88886 17.6629C3.39331 18 4.09554 18 5.5 18H14.5C15.9045 18 16.6067 18 17.1111 17.6629C17.3295 17.517 17.517 17.3295 17.6629 17.1111C18 16.6067 18 15.9045 18 14.5V14">
                                                </path>
                                                <path
                                                    d="M14 10 10.7071 13.2929C10.3166 13.6834 9.68342 13.6834 9.29289 13.2929L6 10M10 2 10 13">
                                                </path>
                                            </svg>
                                        </span>
                                    </button>
                                    <div class="dropdown-menu shadow dropdown-menu-end">
                                        <button class="dropdown-item export-copy" type="button">Copy</button>
                                        <button class="dropdown-item export-excel" type="button">Excel</button>
                                        <button class="dropdown-item export-cvs" type="button">Cvs</button>
                                    </div>
                                </div>
                                <!-- Export Dropdown End -->

                                <!-- Length Start -->
                                <div class="dropdown-as-select d-inline-block datatable-length"
                                    data-datatable="#datatableBoxed" data-childselector="span">
                                    <button class="btn p-0 shadow" type="button" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false" data-bs-offset="0,3">
                                        <span class="btn btn-foreground-alternate dropdown-toggle"
                                            data-bs-toggle="tooltip" data-bs-placement="top" data-bs-delay="0"
                                            title="" data-bs-original-title="Item Count">15 Items</span>
                                    </button>
                                    <div class="dropdown-menu shadow dropdown-menu-end">
                                        <a class="dropdown-item" href="#">10 Items</a>
                                        <a class="dropdown-item active" href="#">15 Items</a>
                                        <a class="dropdown-item" href="#">20 Items</a>
                                    </div>
                                </div>
                                <!-- Length End -->
                            </div>
                        </div>
                    </div>
                    <!-- Controls End -->

                    <!-- Table Start -->
                    <div>
                        <div id="datatableBoxed_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-container">
                                        <div class="card" style="height: 710px;">
                                            <div class="card-body half-padding">
                                                <table id="datatableBoxed"
                                                    class="data-table nowrap hover dataTable no-footer dtr-inline"
                                                    role="grid" style="width: 1155px;">
                                                    <thead>
                                                        <tr role="row">
                                                            <th class="text-muted text-small text-uppercase sorting"
                                                                tabindex="0" aria-controls="datatableBoxed"
                                                                rowspan="1" colspan="1" style="width: 283px;"
                                                                aria-label="Name: activate to sort column ascending">Name
                                                            </th>
                                                            <th class="text-muted text-small text-uppercase sorting"
                                                                tabindex="0" aria-controls="datatableBoxed"
                                                                rowspan="1" colspan="1" style="width: 143px;"
                                                                aria-label="Sales: activate to sort column ascending">Sales
                                                            </th>
                                                            <th class="text-muted text-small text-uppercase sorting"
                                                                tabindex="0" aria-controls="datatableBoxed"
                                                                rowspan="1" colspan="1" style="width: 148px;"
                                                                aria-label="Stock: activate to sort column ascending">Stock
                                                            </th>
                                                            <th class="text-muted text-small text-uppercase sorting"
                                                                tabindex="0" aria-controls="datatableBoxed"
                                                                rowspan="1" colspan="1" style="width: 197px;"
                                                                aria-label="Category: activate to sort column ascending">
                                                                Category</th>
                                                            <th class="text-muted text-small text-uppercase sorting"
                                                                tabindex="0" aria-controls="datatableBoxed"
                                                                rowspan="1" colspan="1" style="width: 114px;"
                                                                aria-label="Tag: activate to sort column ascending">Tag
                                                            </th>
                                                            <th class="empty all sorting" tabindex="0"
                                                                aria-controls="datatableBoxed" rowspan="1"
                                                                colspan="1" style="width: 83px;"
                                                                aria-label="&amp;nbsp;: activate to sort column ascending">
                                                                &nbsp;</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr role="row" class="odd">
                                                            <td class="dtr-control">
                                                                <a class="list-item-heading body"
                                                                    href="#">Barmbrack</a>
                                                            </td>
                                                            <td>854</td>
                                                            <td>13</td>
                                                            <td>Sourdough</td>
                                                            <td><span class="badge bg-outline-primary"></span></td>
                                                            <td>
                                                                <div class="form-check float-end mt-1"><input
                                                                        type="checkbox" class="form-check-input"></div>
                                                            </td>
                                                        </tr>
                                                        <tr role="row" class="even">
                                                            <td class="dtr-control">
                                                                <a class="list-item-heading body"
                                                                    href="#">Dorayaki</a>
                                                            </td>
                                                            <td>459</td>
                                                            <td>90</td>
                                                            <td>Whole Wheat</td>
                                                            <td>
                                                                <span class="badge bg-outline-primary"></span>
                                                            </td>
                                                            <td>
                                                                <div class="form-check float-end mt-1"><input
                                                                        type="checkbox" class="form-check-input"></div>
                                                            </td>
                                                        </tr>
                                                        <tr role="row" class="odd">
                                                            <td class="dtr-control"><a class="list-item-heading body"
                                                                    href="#">Buccellato di Lucca</a></td>
                                                            <td>1298</td>
                                                            <td>212</td>
                                                            <td>Multigrain</td>
                                                            <td><span class="badge bg-outline-primary"></span></td>
                                                            <td>
                                                                <div class="form-check float-end mt-1"><input
                                                                        type="checkbox" class="form-check-input"></div>
                                                            </td>
                                                        </tr>
                                                        <tr role="row" class="even">
                                                            <td class="dtr-control"><a class="list-item-heading body"
                                                                    href="#">Toast Bread</a></td>
                                                            <td>2156</td>
                                                            <td>732</td>
                                                            <td>Multigrain</td>
                                                            <td><span class="badge bg-outline-primary"></span></td>
                                                            <td>
                                                                <div class="form-check float-end mt-1"><input
                                                                        type="checkbox" class="form-check-input"></div>
                                                            </td>
                                                        </tr>
                                                        <tr role="row" class="odd">
                                                            <td class="dtr-control"><a class="list-item-heading body"
                                                                    href="#">Cheesymite Scroll</a></td>
                                                            <td>452</td>
                                                            <td>24</td>
                                                            <td>Sourdough</td>
                                                            <td><span class="badge bg-outline-primary"></span></td>
                                                            <td>
                                                                <div class="form-check float-end mt-1"><input
                                                                        type="checkbox" class="form-check-input"></div>
                                                            </td>
                                                        </tr>
                                                        <tr role="row" class="even">
                                                            <td class="dtr-control"><a class="list-item-heading body"
                                                                    href="#">Baguette</a></td>
                                                            <td>456</td>
                                                            <td>33</td>
                                                            <td>Sourdough</td>
                                                            <td><span class="badge bg-outline-primary"></span></td>
                                                            <td>
                                                                <div class="form-check float-end mt-1"><input
                                                                        type="checkbox" class="form-check-input"></div>
                                                            </td>
                                                        </tr>
                                                        <tr role="row" class="odd">
                                                            <td class="dtr-control"><a class="list-item-heading body"
                                                                    href="#">Guernsey Gâche</a></td>
                                                            <td>1958</td>
                                                            <td>221</td>
                                                            <td>Multigrain</td>
                                                            <td><span class="badge bg-outline-primary"></span></td>
                                                            <td>
                                                                <div class="form-check float-end mt-1"><input
                                                                        type="checkbox" class="form-check-input"></div>
                                                            </td>
                                                        </tr>
                                                        <tr role="row" class="even">
                                                            <td class="dtr-control"><a class="list-item-heading body"
                                                                    href="#">Bazlama</a></td>
                                                            <td>858</td>
                                                            <td>34</td>
                                                            <td>Whole Wheat</td>
                                                            <td><span class="badge bg-outline-primary"></span></td>
                                                            <td>
                                                                <div class="form-check float-end mt-1"><input
                                                                        type="checkbox" class="form-check-input"></div>
                                                            </td>
                                                        </tr>
                                                        <tr role="row" class="odd">
                                                            <td class="dtr-control"><a class="list-item-heading body"
                                                                    href="#">Bolillo</a></td>
                                                            <td>333</td>
                                                            <td>24</td>
                                                            <td>Whole Wheat</td>
                                                            <td><span class="badge bg-outline-primary"></span></td>
                                                            <td>
                                                                <div class="form-check float-end mt-1"><input
                                                                        type="checkbox" class="form-check-input"></div>
                                                            </td>
                                                        </tr>
                                                        <tr role="row" class="even">
                                                            <td class="dtr-control"><a class="list-item-heading body"
                                                                    href="#">Chapati</a></td>
                                                            <td>513</td>
                                                            <td>72</td>
                                                            <td>Sourdough</td>
                                                            <td><span class="badge bg-outline-primary">Done</span></td>
                                                            <td>
                                                                <div class="form-check float-end mt-1"><input
                                                                        type="checkbox" class="form-check-input"></div>
                                                            </td>
                                                        </tr>
                                                        <tr role="row" class="odd">
                                                            <td class="dtr-control"><a class="list-item-heading body"
                                                                    href="#">Eggette</a></td>
                                                            <td>802</td>
                                                            <td>234</td>
                                                            <td>Whole Wheat</td>
                                                            <td><span class="badge bg-outline-primary"></span></td>
                                                            <td>
                                                                <div class="form-check float-end mt-1"><input
                                                                        type="checkbox" class="form-check-input"></div>
                                                            </td>
                                                        </tr>
                                                        <tr role="row" class="even">
                                                            <td class="dtr-control"><a class="list-item-heading body"
                                                                    href="#">Bauernbrot</a></td>
                                                            <td>633</td>
                                                            <td>97</td>
                                                            <td>Multigrain</td>
                                                            <td><span class="badge bg-outline-primary">Done</span></td>
                                                            <td>
                                                                <div class="form-check float-end mt-1"><input
                                                                        type="checkbox" class="form-check-input"></div>
                                                            </td>
                                                        </tr>
                                                        <tr role="row" class="odd">
                                                            <td class="dtr-control"><a class="list-item-heading body"
                                                                    href="#">Flatbread</a></td>
                                                            <td>945</td>
                                                            <td>12</td>
                                                            <td>Multigrain</td>
                                                            <td><span class="badge bg-outline-primary"></span></td>
                                                            <td>
                                                                <div class="form-check float-end mt-1"><input
                                                                        type="checkbox" class="form-check-input"></div>
                                                            </td>
                                                        </tr>
                                                        <tr role="row" class="even">
                                                            <td class="dtr-control"><a class="list-item-heading body"
                                                                    href="#">Hallulla</a></td>
                                                            <td>534</td>
                                                            <td>65</td>
                                                            <td>Sourdough</td>
                                                            <td><span class="badge bg-outline-primary"></span></td>
                                                            <td>
                                                                <div class="form-check float-end mt-1"><input
                                                                        type="checkbox" class="form-check-input"></div>
                                                            </td>
                                                        </tr>
                                                        <tr role="row" class="odd">
                                                            <td class="dtr-control"><a class="list-item-heading body"
                                                                    href="#">Cozonac</a></td>
                                                            <td>98</td>
                                                            <td>7</td>
                                                            <td>Whole Wheat</td>
                                                            <td><span class="badge bg-outline-primary"></span></td>
                                                            <td>
                                                                <div class="form-check float-end mt-1"><input
                                                                        type="checkbox" class="form-check-input"></div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mt-3">
                                    <div class="dataTables_paginate paging_simple_numbers" id="datatableBoxed_paginate">
                                        <ul class="pagination">
                                            <li class="paginate_button page-item previous" id="datatableBoxed_previous"><a
                                                    href="#" aria-controls="datatableBoxed" data-dt-idx="0"
                                                    tabindex="0" class="page-link"><i class="cs-chevron-left"></i></a>
                                            </li>
                                            <li class="paginate_button page-item "><a href="#"
                                                    aria-controls="datatableBoxed" data-dt-idx="1" tabindex="0"
                                                    class="page-link">1</a></li>
                                            <li class="paginate_button page-item active"><a href="#"
                                                    aria-controls="datatableBoxed" data-dt-idx="2" tabindex="0"
                                                    class="page-link">2</a></li>
                                            <li class="paginate_button page-item next disabled" id="datatableBoxed_next">
                                                <a href="#" aria-controls="datatableBoxed" data-dt-idx="3"
                                                    tabindex="0" class="page-link"><i class="cs-chevron-right"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Table End -->
                </div>

                <!-- Content End -->

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
                                <form>
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input name="Name" type="text" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Image</label>
                                        <input name="Image" type="number" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Stock</label>
                                        <input name="Stock" type="number" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Category</label>
                                        <div class="form-check">
                                            <input type="radio" id="category1" name="Category" value="Whole Wheat"
                                                class="form-check-input">
                                            <label class="form-check-label" for="category1">Whole Wheat</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" id="category2" name="Category" value="Sourdough"
                                                class="form-check-input">
                                            <label class="form-check-label" for="category2">Sourdough</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" id="category3" name="Category" value="Multigrain"
                                                class="form-check-input">
                                            <label class="form-check-label" for="category3">Multigrain</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tag</label>
                                        <div class="form-check">
                                            <input type="radio" id="tag1" name="Tag" value="New"
                                                class="form-check-input">
                                            <label class="form-check-label" for="tag1">New</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" id="tag2" name="Tag" value="Sale"
                                                class="form-check-input">
                                            <label class="form-check-label" for="tag2">Sale</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" id="tag3" name="Tag" value="Done"
                                                class="form-check-input">
                                            <label class="form-check-label" for="tag3">Done</label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-primary"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary" id="addEditConfirmButton">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Add Edit Modal End -->
            </div>
        </div>


        <section class="scroll-section" id="bootstrapServerSide">
            <h2 class="small-title">Add Service Category</h2>
            <div class="card">
                <div class="card-body">
                    <form action="{{ Route('backend.service.category.store') }}" method="POST"
                        enctype="multipart/form-data" class="row g-3">
                        @csrf
                        <div class="col-12">
                            <label for="validationServer01" class="form-label">Category name</label>
                            <input type="text" name="categoryName" class="form-control is-valid"
                                id="validationServer01" value="" required="">
                            <div class="valid-feedback">Looks good!</div>
                            <div id="validationServer01Feedback" class="invalid-feedback">Please provide a valid Name.
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group mb-3">
                                <input type="file" name="categoryImage" class="form-control" id="inputGroupFile02">
                                <label class="input-group-text" for="inputGroupFile02">Upload</label>
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
@endsection
