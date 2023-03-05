<div class="card">
    <!--begin::Card body-->
    <div class="card-body pt-0">

        <!--begin::Table-->
        <table class="table align-middle table-row-dashed fs-4 gy-5" id="users_table">
            <!--begin::Table head-->
            <thead>
            <!--begin::Table row-->

            <tr class="text-start text-muted fw-bolder fs-5 text-uppercase gs-0">
                <th class="min-w-125px text-center">{{__('lang.provider')}}</th>
                <th class="min-w-125px text-center">{{__('lang.comment')}}</th>
                <th class="min-w-125px text-center">{{__('lang.rate')}}</th>
                <th class="min-w-125px text-center">{{__('lang.created_at')}}</th>
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
@push('scripts')
    <script src="{{ URL::asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>

    <script type="text/javascript">
        $(function () {
            var table = $('#users_table').DataTable({
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
                    url: '{{ route('users.rates.datatable',$data->id) }}',
                    data: {}
                },
                columns: [

                    {data: 'provider_name', name: 'provider_name', "searchable": true, "orderable": true},
                    {data: 'comment', name: 'comment', "searchable": true, "orderable": true},
                    {data: 'rate', name: 'rate', "searchable": true, "orderable": true},
                    {data: 'created_at', name: 'created_at', "searchable": true, "orderable": true},
                ]
            });
        });
    </script>
    @if( session()->has("message"))
        <script>
            $( document ).ready(function() {
                toastr.options = {
                    "progressBar": true,
                    "positionClass": "toast-bottom-left",
                };
            });
        </script>
        <script>
            toastr.success("{{session()->get('message')}}");
        </script>
    @endif
@endpush
