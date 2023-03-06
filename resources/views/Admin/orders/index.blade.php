@extends('layout.layout')
@php
    $route = 'orders';
@endphp
@section('title',__('lang.orders'))
@section('header')
    <!--begin::Heading-->
    <h1 class="text-dark fw-bolder my-0 fs-2">{{trans('lang.'.$route)}} </h1>
    <!--end::Heading-->
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb fw-bold fs-base my-1">
        <li class="breadcrumb-item">
            <a href="{{url('/')}}" class="text-muted">
                {{trans('lang.Dashboard')}} </a>
        </li>
        <li class="breadcrumb-item">
            {{trans('lang.'.$route)}}
        </li>
    </ul>
    <!--end::Breadcrumb-->
@endsection

@section('content')

    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
        <!--begin::Post-->

        <div class="content flex-row-fluid" id="kt_content">
            <!--begin::Card-->

            <div class="card">
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    {{--                    <a href="{{route('orders.create')}}" class="btn btn-light-primary me-3">--}}
                    {{--                        <i class="bi bi-plus-circle-fill fs-2x"></i>--}}
                    {{--                    </a>--}}

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label><strong>type :</strong></label>
                                        <select id='type' name='type' class="form-control" style="width: 200px">
                                            <option value="">--Select type--</option>
                                            <option value="import">import</option>
                                            <option value="export">export</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label><strong>day :</strong></label>
                                        <select id='day' name='day' class="form-control" style="width: 200px">
                                            <option value="">--Select day--</option>
                                            <option value="saturday">saturday</option>
                                            <option value="sunday">sunday</option>
                                            <option value="monday">monday</option>
                                            <option value="tuesday">tuesday</option>
                                            <option value="wednsday">wednsday</option>
                                            <option value="thursday">thursday</option>
                                            <option value="friday">friday</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label><strong>car :</strong></label>
                                        <select id='car_id' name='car_id' class="form-control" style="width: 200px">
                                            <option value="">--Select car--</option>
                                            @foreach(\App\Models\Car::get() as $car)
                                                <option value="{{$car->id}}">@if(Session::get('lang')=='en')
                                                        {{$car->name_en}}
                                                    @else
                                                        {{$car->name_ar}}
                                                    @endif</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label><strong>city :</strong></label>
                                        <select id='city_id' name='city_id' class="form-control" style="width: 200px">
                                            <option value="">--Select city--</option>
                                            @foreach(\App\Models\City::get() as $city)
                                                <option value="{{$city->id}}">@if(Session::get('lang')=='en')
                                                        {{$city->name_en}}
                                                    @else
                                                        {{$city->name_ar}}
                                                    @endif</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label><strong>admin :</strong></label>
                                        <select id='admin_id' name='admin_id' class="form-control" style="width: 200px">
                                            <option value="">--Select admin--</option>
                                            @foreach(\App\Models\Admin::get() as $admin)
                                                <option value="{{$admin->id}}">{{$admin->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card" style="margin-top: 45px;">
                                <button type="button" id="filter"
                                        class="btn btn-light btn-active-light-primary me-2">{{trans('lang.search')}}</button>
                            </div>
                        </div>
                    </div>
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-4 gy-5" id="users_table">
                        <!--begin::Table head-->
                        <thead>
                        <!--begin::Table row-->

                        <tr class="text-start text-muted fw-bolder fs-5 text-uppercase gs-0">
                            <th class="w-10px pe-2">
                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                    <input class="form-check-input" type="checkbox" data-kt-check="true"
                                           data-kt-check-target="#users_table .form-check-input" value="1"/>
                                </div>
                            </th>
                            <th class="min-w-125px">{{__('lang.client')}}</th>
                            <th class="min-w-125px">{{__('lang.category')}}</th>
                            <th class="min-w-125px">{{__('lang.order_type')}}</th>
                            <th class="min-w-125px">{{__('lang.Actions')}}</th>
                        </tr>
                        <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->


                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Post-->
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>

    <script type="text/javascript">
        load_data();

        function load_data(type = '', day = '') {
            const table = $('#users_table').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                responsive: true,
                aaSorting: [],
                "dom": "<'card-header border-0 p-0 pt-6'<'card-title' <'d-flex align-items-center position-relative my-1'f> r> <'card-toolbar' <'d-flex justify-content-end add_button'B> r>>  <'row'l r> <''t><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable
                lengthMenu: [[10, 25, 50, 100, 250, -1], [10, 25, 50, 100, 250, "All"]],
                "language": {
                    search: '<i class="fa fa-eye" aria-hidden="true"></i>',
                    searchPlaceholder: 'Search',
                    "url": "{{ url('admin/assets/ar.json') }}"
                },
                buttons: [
                    {
                        extend: 'print',
                        className: 'btn btn-light-primary me-3',
                        text: '<i class="bi bi-printer-fill fs-2x"></i>'
                    },
                    // {extend: 'pdf', className: 'btn btn-raised btn-danger', text: 'PDF'},
                    {
                        extend: 'excel',
                        className: 'btn btn-light-primary me-3',
                        text: '<i class="bi bi-file-earmark-spreadsheet-fill fs-2x"></i>'
                    },
                    // {extend: 'colvis', className: 'btn secondary', text: 'إظهار / إخفاء الأعمدة '}
                ],
                ajax: {
                    url: '{{ route($route.'.datatable') }}',
                    data: {type: type, day: day}
                },
                columns: [
                    {data: 'checkbox', name: 'checkbox', "searchable": false, "orderable": false},
                    {data: 'client_id', name: 'client_id', "searchable": true, "orderable": true},
                    {data: 'category_id', name: 'category_id', "searchable": true, "orderable": true},
                    {data: 'type', name: 'type', "searchable": true, "orderable": true},
                    {data: 'actions', name: 'actions', "searchable": false, "orderable": false},
                ]
            });

            $.ajax({
                url: "{{ URL::to($route.'/add-button')}}",
                success: function (data) {
                    $('.add_button').append(data);
                },
                dataType: 'html'
            });
        }

        $('#filter').click(function () {
            var type = $('#type').val();
            var day = $('#day').val();
            if (type !== '' || day !== '') {
                $('#users_table').DataTable().destroy();
                load_data(type, day);
            } else {
                alert('من فضلك حدد البحث');
            }
        });

    </script>
    <?php
    $message = session()->get("message");
    ?>
    @if( session()->has("message"))
        <script>
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-bottom-right",
                "preventDuplicates": false,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            toastr.success("{{$message}}", "نجاح");
        </script>

    @endif

@endsection

