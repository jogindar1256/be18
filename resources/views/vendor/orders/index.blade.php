@extends('vendor.layouts.app')
@section('page_title', __('Orders'))
@section('css')
    <link rel="stylesheet" href="{{ asset('public/dist/css/vendor-responsiveness.min.css') }}">
@endsection
@section('content')

    <!-- Main content -->
    <div class="list-container" id="vendor-order-list-container">
        <div class="card">
            <div class="card-header d-md-flex justify-content-between align-items-center">
                <h5><a href="{{ route('vendorOrder.index') }}">{{ __('Orders') }}</a></h5>
                <div>
                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#batchDelete" class="btn btn-outline-primary mb-0 custom-btn-small d-none">
                        <span class="feather icon-trash-2 ltr:me-1 rtl:ms-1"></span>
                        {{ __('Batch Delete') }} (<span class="batch-delete-count">0</span>)
                    </a>
                    <button class="btn btn-outline-primary custom-btn-small collapsed filterbtn mb-0 me-0" type="button" data-bs-toggle="collapse" data-bs-target="#filterPanel" aria-expanded="true" aria-controls="filterPanel"><span class="fas fa-filter">&nbsp;</span>{{ __('Filter')}}</button>
                </div>
            </div>
            <div class="card-header p-0 collapse" id="filterPanel">
                <div class="row mx-2 my-2">
                    <div class="col-md-3">
                        <div class="input-group">
                            <button type="button" class="form-control d-flex justify-content-between align-items-center date-drop-down" id="daterange-btn">
                                <span><i class="fa fa-calendar"></i> {{ __('Date range picker') }}</span>
                                <i class="fa fa-caret-down pt-1"></i>
                            </button>
                        </div>
                    </div>
                    <input class="form-control" id="startfrom" type="hidden" name="from">
                    <input class="form-control" id="endto" type="hidden" name="to">
                    <div class="col-md-3">
                        <select class="filter select2-hide-search" name="order_status_id" id="order_status_id">
                            <option value="">{{ __('All :x', ['x' => __('Order Status')]) }}</option>
                            @foreach ($statuses as $allStatus)
                                <option value="{{ $allStatus->id }}">{{ $allStatus->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <select class="filter display-none" name="start_date" id="start_date"></select>

                    <select class="filter display-none" name="end_date" id="end_date"></select>

                    <div class="col-md-3">
                        <select class="select2-hide-search filter" name="payment_status" id="payment_status">
                            <option value="">{{ __('All :x', ['x' => __('Payment Status')]) }}</option>
                            <option value="Paid">{{ __('Paid') }}</option>
                            <option value="Unpaid">{{ __('Unpaid') }}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body p-0 table-field order-table-button">
                <div class="card-block pt-2 px-4">
                    <div class="col-sm-12">
                        @include('vendor.layouts.includes.yajra-data-table')
                    </div>
                </div>
            </div>
            @include('vendor.layouts.includes.delete-modal')
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('public/dist/js/moment.min.js') }}"></script>
    <script src="{{ asset('public/dist/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}"></script>
    <script type="text/javascript">
        'use strict';
        var pdf = "{{ (in_array('App\Http\Controllers\Vendor\OrderController@pdf', $prms)) ? '1' : '0' }}";
        var csv = "{{ (in_array('App\Http\Controllers\Vendor\OrderController@csv', $prms)) ? '1' : '0' }}";
        var startDate = "{!! isset($from) ? $from : 'undefined' !!}";
        var endDate   = "{!! isset($to) ? $to : 'undefined' !!}";
    </script>
    <script src="{{ asset('public/dist/js/custom/order.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/permission.min.js') }}"></script>
@endsection
