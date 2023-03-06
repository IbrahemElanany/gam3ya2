<div class="card-body border-top p-9">
    <div class="fv-row mb-7">
        <!--begin::Label-->
        <label class="required fw-bold fs-6 mb-2">{{__('lang.client')}}</label>
        <!--end::Label-->
        <!--begin::Input-->
        <select name="client_id" class="form-control form-control-lg " required>
            @foreach ($clients as $client)
                <option value="{{$client->id}}"
                        @if(isset($data->client_id))@if($data->client_id==$client->id)selected @endif @endif>{{ $client->name }}</option>
            @endforeach
        </select>
        <!--end::Input-->
    </div>
    <div class="fv-row mb-12">
        <label class="required fw-bold fs-6 mb-2">{{__('lang.order_type')}}</label>

        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-1 row-cols-xl-3 g-9" data-kt-buttons="true"
             data-kt-buttons-target="[data-kt-button='true']">

            <!--begin::Col-->
            <div class="col-md-6" style="width: 229px;">
                <!--begin::Option-->
                <label class="btn btn-outline btn-outline-dashed btn-outline-default d-flex text-start p-6
                @if(request()->segment(3) == 'edit')
                @if($data->type == 'export' ) active @endif
                @else
                    active
                @endif
                    "
                       data-kt-button="true">
                    <!--begin::Radio-->
                    <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                <input class="form-check-input" type="radio" name="type"
                       @if(request()->segment(3) == 'edit')
                       @if($data->type == 'export' ) checked="checked" @endif
                       @else
                       checked="checked"
                       @endif
                       value="export">
            </span>
                    <!--end::Radio-->
                    <!--begin::Info-->
                    <span class="ms-5">
                <span class="fs-4 fw-bolder text-gray-800 d-block">{{__('lang.export')}}</span>
            </span>
                    <!--end::Info-->
                </label>
                <!--end::Option-->
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-6" style="width: 229px;">
                <!--begin::Option-->
                <label class="btn btn-outline btn-outline-dashed btn-outline-default d-flex text-start p-6
                @if(request()->segment(3) == 'edit')
                @if($data->type == 'import' ) active @endif
                @endif
                    "
                       style="width: 229px;"
                       data-kt-button="true">
                    <!--begin::Radio-->
                    <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                <input class="form-check-input" type="radio" name="type"
                       @if(request()->segment(3) == 'edit')
                       @if($data->type == 'import' ) checked="checked" @endif
                       @endif
                       value="import">
            </span>
                    <!--end::Radio-->
                    <!--begin::Info-->
                    <span class="ms-5">
                <span class="fs-4 fw-bolder text-gray-800 d-block">{{__('lang.import')}}</span>
            </span>
                    <!--end::Info-->
                </label>
                <!--end::Option-->
            </div>
            <!--end::Col-->
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="fv-row mb-7">
                <label class="form-label">{{__('lang.category')}}</label>
                <select name="category_id" class="form-control form-control-lg " id="category_id"
                        onclick="myFunction3(this)" required>
                    @foreach ($categories as $category)
                        <option
                            value="{{$category->id}}">@if(Session::get('lang')=='ar'){{ $category->name_ar }}@else{{ $category->name_en }}@endif</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>


    {{-- <div class="input-group-append">
        <button id="removeRow" type="button" class="btn btn-danger">Remove</button>
    </div>
    <br> --}}

    <button id="addRow" type="button" class="btn btn-info"><i class="fa fa-plus"></i> {{__('lang.add_new')}}
    </button>
    <br> <br>
    <div id="newRow">
        <input type="hidden" id="countValue" value="{{$data->details->count() ?? 0 }}"/>

        @if(request()->segment(2) == 'edit')
            @foreach($data->details as $count_value => $row)
                <div id="inputFormRow">
                    <div class="row">
                        <div class="col-md-4"><label class="form-label">{{trans('lang.product')}}</label>
                            <select name="details[{{$count_value}}][subcategory_id]"
                                    class="form-control form-control-lg " id="subcategory_id_{{$count_value}}"
                                    required>
                                @foreach($subcategories as $subcategory)
                                    <option value="{{$subcategory->id}}"
                                            @if($row->subcategory_id == $subcategory->id ) selected @endif>
                                        @if(Session::get('lang')=='ar'){{ $subcategory->name_ar }}@else{{ $subcategory->name_en }}@endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="required fw-bold fs-6 mb-2">{{__('lang.number')}}</label>
                            <input type="number" name="details[{{$count_value}}][number]"
                                   class="form-control  mb-3 mb-lg-0" placeholder=""
                                   value="{{old('number',$row->number)}}" required/>
                        </div>
                        <div class="col-md-2">
                            <label class=" fw-bold fs-6 mb-2">{{__('lang.delete')}}</label>
                            <br>
                            <button id="removeRow" type="button"
                                    class="btn btn-danger mb-3 mb-lg-0"><i class="fa fa-trash"></i></button>
                        </div>
                    </div>
                </div>

            @endforeach
        @endif
    </div>
    <br> <br> <br>


</div>
<!--end::Scroll-->
<!--begin::Actions-->

<div class="card-footer d-flex justify-content-end py-6 px-9">
    <button type="submit" class="btn btn-primary"
            id="kt_account_profile_details_submit">{{__('lang.save')}}
    </button>
</div>
<!--end::Actions-->
