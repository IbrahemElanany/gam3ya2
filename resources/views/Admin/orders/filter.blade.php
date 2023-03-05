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
                @if (Auth::guard('admin')->user()->type==0|| Auth::guard('admin')->user()->type==1)
{{--  <a href="{{route('orders.create')}}" class="btn btn-light-primary me-3">--}}
{{--        <i class="bi bi-plus-circle-fill fs-2x"></i>--}}
{{--    </a>--}}
    @endif
 
    <!--begin::Table-->
    <div class="table-responsive">
        <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
        data-page-length="100"
        style="text-align: center">
                    <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('lang.car')}}</th>
                    <th>{{__('lang.USER')}}</th>
                    <th>{{__('lang.city')}}</th>
                    <th>{{__('lang.day')}}</th>
                </tr>
            </thead>
          
            <tbody>
                
                @foreach ($orders as $order)
                <tr>
                    <td>
                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$order->id}}</span>

                    </td>
                    <td>
                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">@if(Session::get('lang')=='en') {{$order->car->getNameEnAttribute()}} @else {{$order->car->getNameArAttribute()}} @endif</span>
                     </td>
                    <td>
                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$order->admin->name }}</span>
                     </td>
                    <td>
                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg"> @if(Session::get('lang')=='en'){{$order->city->getNameEnAttribute()}}  @else {{$order->city->getNameArAttribute()}}  @endif</span>
                     </td>
                    <td>
                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$order->day}}</span>
                    </td>
                   
                </tr>
                @endforeach
            </tbody>
            
        
        </table>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        } );
    </script>
    {{--  <script src="{{ URL::asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>  --}}

@endsection

