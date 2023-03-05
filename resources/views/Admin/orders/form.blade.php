  {{--  @push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
<!--begin::Input group-->
<div class="fv-row mb-7">
    <!--begin::Label-->
    <label class="required fw-bold fs-6 mb-2">{{__('lang.car')}}</label>
    <!--end::Label-->
    <!--begin::Input-->
    <select name="car_id" class="form-control form-control-lg form-control-solid" required>
        @foreach (\App\Models\Car::get() as $car)
        <option value="{{$car->id}}" @if(isset($data->car_id))@if($data->car_id==$car->id)selected @endif @endif>@if(Session::get('lang')=='ar'){{ $car->name_ar }}@else{{ $car->name_en }}@endif</option>
        @endforeach
    </select>
    <!--end::Input-->
</div>
<!--end::Input group-->  <!--begin::Input group-->
<div class="fv-row mb-7">
    <!--begin::Label-->
    <label class="required fw-bold fs-6 mb-2">{{__('lang.first_amenities')}}</label>
    <!--end::Label-->
    <!--begin::Input-->
    <input type="text" name="first_amenities"
           class="form-control form-control-solid mb-3 mb-lg-0"
           placeholder="" value="{{old('first_amenities',$data->first_amenities ?? '')}}" required/>
    <!--end::Input-->
</div>

<div class="fv-row mb-7">
    <!--begin::Label-->
    <label class="required fw-bold fs-6 mb-2">{{__('lang.second_amenities')}}</label>
    <!--end::Label-->
    <!--begin::Input-->
    <input type="text" name="second_amenities"
           class="form-control form-control-solid mb-3 mb-lg-0"
           placeholder="" value="{{old('second_amenities',$data->second_amenities ?? '')}}" required/>
    <!--end::Input-->
</div>


<div class="fv-row mb-7">
    <!--begin::Label-->
    <label class="required fw-bold fs-6 mb-2">{{__('lang.third_amenities')}}</label>
    <!--end::Label-->
    <!--begin::Input-->
    <input type="text" name="third_amenities"
           class="form-control form-control-solid mb-3 mb-lg-0"
           placeholder="" value="{{old('third_amenities',$data->third_amenities ?? '')}}" required/>
    <!--end::Input-->
</div>
<div class="fv-row mb-7">
    <!--begin::Label-->
    <label class="required fw-bold fs-6 mb-2">{{__('lang.type')}}</label>
    <!--end::Label-->
    <!--begin::Input-->
    <select name="day" class="form-control form-control-lg form-control-solid">
        <option value="saturday">saturday</option>
        <option value="sunday">sunday</option>
        <option value="monday">monday</option>
        <option value="tuesday">tuesday</option>
        <option value="wednesday">wednesday</option>
        <option value="thursday">thursday</option>
        <option value="friday">friday</option>
    </select>
    <!--end::Input-->
</div>

<div class="fv-row mb-7">
    <!--begin::Label-->
    <label class="required fw-bold fs-6 mb-2">{{__('lang.period')}}</label>
    <!--end::Label-->
    <!--begin::Input-->
    <select name="period" class="form-control form-control-lg form-control-solid">
        <option value="am">Am</option>
        <option value="pm">Pm</option>
    </select>
    <!--end::Input-->
</div>

<div class="fv-row mb-7">
    <!--begin::Label-->
    <label class="required fw-bold fs-6 mb-2">{{__('lang.city')}}</label>
    <!--end::Label-->
    <!--begin::Input-->
    <select name="city_id" class="form-control form-control-lg form-control-solid" required>
        @foreach (\App\Models\City::get() as $city)
        <option value="{{$city->id}}" @if(isset($data->city_id))@if($data->city_id==$city->id)selected @endif @endif>@if(Session::get('lang')=='ar'){{ $city->name_ar }}@else{{ $city->name_en }}@endif</option>
        @endforeach
    </select>
    <!--end::Input-->
</div>

<div class="fv-row mb-7">
    <!--begin::Label-->
    <label class="required fw-bold fs-6 mb-2">{{__('lang.address')}}</label>
    <!--end::Label-->
    <!--begin::Input-->
    <input type="text" name="address"
           class="form-control form-control-solid mb-3 mb-lg-0"
           placeholder="" value="{{old('address',$data->address ?? '')}}" required/>
    <!--end::Input-->
</div>

<div class="fv-row mb-7">
    <!--begin::Label-->
    <label class="required fw-bold fs-6 mb-2">{{__('lang.phone')}}</label>
    <!--end::Label-->
    <!--begin::Input-->
    <input type="text" name="phone"
           class="form-control form-control-solid mb-3 mb-lg-0"
           placeholder="" value="{{old('phone',$data->phone ?? '')}}" required/>
    <!--end::Input-->
</div>





  --}}










@extends('layout.layout')

@php
    $route = 'orders';
@endphp

@section('style')
    <style>
        @media (min-width: 992px) {
            .aside-me .content {
                padding-right: 30px;
            }
        }
    </style>
@endsection
@section('header')
    <!--begin::Heading-->
    <h1 class="text-dark fw-bolder my-0 fs-2"> {{trans('lang.edit')}}</h1>
    <!--end::Heading-->
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb fw-bold fs-base my-1">
        <li class="breadcrumb-item">
            <a href="{{url('/')}}" class="text-muted">
                {{trans('lang.Dashboard')}} </a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route($route.'.index')}}" class="text-muted">
                {{trans('lang.'.$route)}} </a>
        </li>
        <li class="breadcrumb-item">
            {{trans('lang.create')}}
        </li>
    </ul>
    <!--end::Breadcrumb-->
@endsection


@section('content')
    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
        <!--begin::Post-->

        <div class="content flex-row-fluid" id="kt_content">

            <!--begin::Basic info-->
            <div class="card mb-5 mb-xl-10">
                <!--begin::Card header-->
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                     data-bs-target="#kt_account_profile_details" aria-expanded="true"
                     aria-controls="kt_account_profile_details">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{__('lang.Orders_Create')}}</h3>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--begin::Card header-->
                <!--begin::Content-->
                <div id="kt_account_settings_profile_details" class="collapse show">
                    <!--begin::Form-->
                    <form id="kt_account_profile_details_form" action="{{url($route.'/store')}}"
                          class="form"
                          method="post">
                    @csrf
                    <!--begin::Card body-->
                        <div class="card-body border-top p-9">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-2">{{__('lang.car')}}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <select name="car_id" class="form-control form-control-lg form-control-solid" required>
                                    @foreach ($cars as $car)
                                    <option value="{{$car->id}}" @if(isset($data->car_id))@if($data->car_id==$car->id)selected @endif @endif>@if(Session::get('lang')=='ar'){{ $car->name_ar }}@else{{ $car->name_en }}@endif</option>
                                    @endforeach
                                </select>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->  <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-2">{{__('lang.first_amenities')}}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="first_amenities"
                                       class="form-control form-control-solid mb-3 mb-lg-0"
                                       placeholder="" value="{{old('first_amenities',$data->first_amenities ?? '')}}"/>
                                <!--end::Input-->
                            </div>

                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-2">{{__('lang.second_amenities')}}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="second_amenities"
                                       class="form-control form-control-solid mb-3 mb-lg-0"
                                       placeholder="" value="{{old('second_amenities',$data->second_amenities ?? '')}}"/>
                                <!--end::Input-->
                            </div>


                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-2">{{__('lang.third_amenities')}}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="third_amenities"
                                       class="form-control form-control-solid mb-3 mb-lg-0"
                                       placeholder="" value="{{old('third_amenities',$data->third_amenities ?? '')}}"/>
                                <!--end::Input-->
                            </div>
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-2">{{__('lang.day')}}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <select name="day" class="form-control form-control-lg form-control-solid">
                                    <option value="saturday">saturday</option>
                                    <option value="sunday">sunday</option>
                                    <option value="monday">monday</option>
                                    <option value="tuesday">tuesday</option>
                                    <option value="wednesday">wednesday</option>
                                    <option value="thursday">thursday</option>
                                    <option value="friday">friday</option>
                                </select>
                                <!--end::Input-->
                            </div>

                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-2">{{__('lang.period')}}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <select name="period" class="form-control form-control-lg form-control-solid">
                                    <option value="am">Am</option>
                                    <option value="pm">Pm</option>
                                </select>
                                <!--end::Input-->
                            </div>

                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-2">{{__('lang.city')}}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <select name="city_id" class="form-control form-control-lg form-control-solid" required>
                                    @foreach ($cities as $city)
                                    <option value="{{$city->id}}" @if(isset($data->city_id))@if($data->city_id==$city->id)selected @endif @endif>@if(Session::get('lang')=='ar'){{ $city->name_ar }}@else{{ $city->name_en }}@endif</option>
                                    @endforeach
                                </select>
                                <!--end::Input-->
                            </div>
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-2">{{__('lang.client')}}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <select name="client_id" class="form-control form-control-lg form-control-solid" required>
                                    @foreach ($clients as $client)
                                    <option value="{{$client->id}}" @if(isset($data->client_id))@if($data->client_id==$client->id)selected @endif @endif>{{ $client->name }}</option>
                                    @endforeach
                                </select>
                                <!--end::Input-->
                            </div>
{{--  
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-2">{{__('lang.address')}}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="address"
                                       class="form-control form-control-solid mb-3 mb-lg-0"
                                       placeholder="" value="{{old('address',$data->address ?? '')}}" required/>
                                <!--end::Input-->
                            </div>

                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-2">{{__('lang.phone')}}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="phone"
                                       class="form-control form-control-solid mb-3 mb-lg-0"
                                       placeholder="" value="{{old('phone',$data->phone ?? '')}}" required/>
                                <!--end::Input-->
                            </div>  --}}
                            <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-bold fs-6 mb-2">{{__('lang.type')}}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select name="type" class="form-control form-control-lg form-control-solid">
                                <option value="export">export</option>
                                <option value="import">import</option>
                            </select>
                            <!--end::Input-->
                        </div>
                          <div class="row">
                            <div class="col-md-4">
                                <div class="fv-row mb-7">
                                <label class="form-label">categories</label>
                                <select name="category_id[]" class="form-control form-control-lg form-control-solid" id="category_id" onclick="myFunction3(this)" required>
                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}">@if(Session::get('lang')=='ar'){{ $category->name_ar }}@else{{ $category->name_en }}@endif</option>
                                    @endforeach
                                </select>
                            </div></div>
                            <div class="col-md-4"><div class="fv-row mb-7">
                                <label class="form-label">subcategories</label>
                                <select name="subcategory_id[]" class="form-control form-control-lg form-control-solid" id="subcategory_id" required>
                                    @foreach ($subcategories as $subcategory)
                                    <option value="{{$subcategory->id}}">@if(Session::get('lang')=='ar'){{ $subcategory->name_ar }}@else{{ $subcategory->name_en }}@endif</option>
                                    @endforeach
                                </select>
                            </div></div>
                            <div class="col-md-4"> <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-2">{{__('lang.number')}}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="number" name="number[]"
                                       class="form-control form-control-solid mb-3 mb-lg-0"
                                       placeholder="" value="{{old('number',$data->number ?? '')}}" required/>
                                <!--end::Input-->
                            </div></div>
                          </div>






                            {{-- <div class="input-group-append">
                                <button id="removeRow" type="button" class="btn btn-danger">Remove</button>
                            </div>
                            <br> --}}
                            <div id="newRow">
                                <input type="hidden" id="countValue" value="0" />
                            </div>
                            <button id="addRow" type="button" class="btn btn-info">Add new</button>
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
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Basic info-->

        </div>
        <!--end::Post-->
    </div>
@endsection




