@include('layouts.header')
<link rel="stylesheet" href="{{ asset('public/assets')  }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet"
    href="{{ asset('public/assets')  }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('public/assets')  }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@include('layouts.sidebar')
<div class="content-wrapper">
<section class="content">
        <div class="container-fluid">
            <div class="row">


{{ Form::model($role, ['route' => ['role.update', $role->id], 'method' => 'PUT']) }}
<div class="modal-body">
    <div class="row">
        <div class="form-group">
            {{ Form::label('name', __('Name'), ['class' => 'form-label']) }}
            @if ($role->name == 'employee')
                <p class="form-control">{{ $role->name }}</p>
            @else
                <div class="form-icon-user">
                    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter Role Name')]) }}
                </div>
            @endif
            @error('name')
                <span class="invalid-name" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            @if (!empty($permissions))
                <h6 class="m-5">{{ __('Assign Permission to Roles') }} </h6>
                <table class="table table-bordered" id="dataTable-1">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" class="align-middle checkbox_middle form-check-input"
                                    name="checkall" id="checkall">
                            </th>
                            <th>{{ __('Module') }} </th>
                            <th>{{ __('Permissions') }} </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $modules = [
                                    'user',
                                    'role',
                                    'dashboard',
                                    'citytour',
                                    'attraction',
                                    'adventure',
                                    'viptransportation',
                                    'transportation',
                                    'transportationbooking',
                                    'citytourbooking',
                                    'attractionbooking',
                                    'adventurebooking',
                                    'viptransportationbooking',
                                    'setting',
                                    'flightdata',
                                    'bannersliders',
                                    'page',
                                    'reviews',
                                    'promocode',
                                    'adminData',
                                ];
                            if (Auth::user()->type == 'super admin') {
                                $modules[] = 'Language';
                            }
                        @endphp
                        @foreach ($modules as $module)
                            <tr>
                                <td><input type="checkbox" class="align-middle ischeck  form-check-input"
                                        name="checkall" data-id="{{ str_replace(' ', '', $module) }}"></td>
                                <td><label class="ischeck"
                                        data-id="{{ str_replace(' ', '', $module) }}">{{ ucfirst($module) }}</label>
                                </td>
                                <td>
                                    <div class="row">

                                        @if (in_array($module . ' digiList', (array) $permissions))
                                                @if ($key = array_search($module . ' digiList', $permissions))
                                                    <div class="col-md-3 custom-control custom-checkbox">
                                                        {{ Form::checkbox('permissions[]', $key, $role->permission, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'digiList', ['class' => 'form-label font-weight-500']) }}<br>
                                                    </div>
                                                @endif
                                        @endif
                                        @if (in_array($module . ' vecList', (array) $permissions))
                                                @if ($key = array_search($module . ' vecList', $permissions))
                                                    <div class="col-md-3 custom-control custom-checkbox">
                                                        {{ Form::checkbox('permissions[]', $key, $role->permission, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'vecList', ['class' => 'form-label font-weight-500']) }}<br>
                                                    </div>
                                                @endif
                                        @endif
                                        @if (in_array($module . ' list', (array) $permissions))
                                                @if ($key = array_search($module . ' list', $permissions))
                                                    <div class="col-md-3 custom-control custom-checkbox">
                                                        {{ Form::checkbox('permissions[]', $key, $role->permission, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'List', ['class' => 'form-label font-weight-500']) }}<br>
                                                    </div>
                                                @endif
                                        @endif

                                        @if (in_array($module . ' create', (array) $permissions))
                                                @if ($key = array_search($module . ' create', $permissions))
                                                    <div class="col-md-3 custom-control custom-checkbox">
                                                        {{ Form::checkbox('permissions[]', $key, $role->permission, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'create', ['class' => 'form-label font-weight-500']) }}<br>
                                                    </div>
                                                @endif
                                        @endif
                                        @if (in_array($module . ' edit', (array) $permissions))
                                                @if ($key = array_search($module . ' edit', $permissions))
                                                    <div class="col-md-3 custom-control custom-checkbox">
                                                        {{ Form::checkbox('permissions[]', $key, $role->permission, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'edit', ['class' => 'form-label font-weight-500']) }}<br>
                                                    </div>
                                                @endif
                                        @endif
                                        @if (in_array($module . ' show', (array) $permissions))
                                                @if ($key = array_search($module . ' show', $permissions))
                                                    <div class="col-md-3 custom-control custom-checkbox">
                                                        {{ Form::checkbox('permissions[]', $key, $role->permission, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'show', ['class' => 'form-label font-weight-500']) }}<br>
                                                    </div>
                                                @endif
                                        @endif
                                        @if (in_array($module . ' delete', (array) $permissions))
                                                @if ($key = array_search($module . ' delete', $permissions))
                                                    <div class="col-md-3 custom-control custom-checkbox">
                                                        {{ Form::checkbox('permissions[]', $key, $role->permission, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'delete', ['class' => 'form-label font-weight-500']) }}<br>
                                                    </div>
                                                @endif
                                        @endif
                                        @if (in_array($module . ' fileResend', (array) $permissions))
                                                @if ($key = array_search($module . ' fileResend', $permissions))
                                                    <div class="col-md-3 custom-control custom-checkbox">
                                                        {{ Form::checkbox('permissions[]', $key, $role->permission, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'fileResend', ['class' => 'form-label font-weight-500']) }}<br>
                                                    </div>
                                                @endif
                                        @endif
                                        @if (in_array($module . ' adminFilesAttachment', (array) $permissions))
                                                @if ($key = array_search($module . ' adminFilesAttachment', $permissions))
                                                    <div class="col-md-3 custom-control custom-checkbox">
                                                        {{ Form::checkbox('permissions[]', $key, $role->permission, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'adminFilesAttachment', ['class' => 'form-label font-weight-500']) }}<br>
                                                    </div>
                                                @endif
                                        @endif
                                        @if (in_array($module . ' allFilesUpload', (array) $permissions))
                                                @if ($key = array_search($module . ' allFilesUpload', $permissions))
                                                    <div class="col-md-3 custom-control custom-checkbox">
                                                        {{ Form::checkbox('permissions[]', $key, $role->permission, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'allFilesUpload', ['class' => 'form-label font-weight-500']) }}<br>
                                                    </div>
                                                @endif
                                        @endif
                                        @if (in_array($module . ' editOrder', (array) $permissions))
                                                @if ($key = array_search($module . ' editOrder', $permissions))
                                                    <div class="col-md-3 custom-control custom-checkbox">
                                                        {{ Form::checkbox('permissions[]', $key, $role->permission, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'editOrder', ['class' => 'form-label font-weight-500']) }}<br>
                                                    </div>
                                                @endif
                                        @endif
                                        @if (in_array($module . ' deleteSendFiles', (array) $permissions))
                                                @if ($key = array_search($module . ' deleteSendFiles', $permissions))
                                                    <div class="col-md-3 custom-control custom-checkbox">
                                                        {{ Form::checkbox('permissions[]', $key, $role->permission, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'deleteSendFiles', ['class' => 'form-label font-weight-500']) }}<br>
                                                    </div>
                                                @endif
                                        @endif
                                        @if (in_array($module . ' convert', (array) $permissions))
                                                @if ($key = array_search($module . ' convert', $permissions))
                                                    <div class="col-md-3 custom-control custom-checkbox">
                                                        {{ Form::checkbox('permissions[]', $key, $role->permission, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'convert', ['class' => 'form-label font-weight-500']) }}<br>
                                                    </div>
                                                @endif
                                        @endif
                                         @if (in_array($module . ' makeInvoive', (array) $permissions))
                                                @if ($key = array_search($module . ' makeInvoive', $permissions))
                                                    <div class="col-md-3 custom-control custom-checkbox">
                                                        {{ Form::checkbox('permissions[]', $key, $role->permission, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'makeInvoive', ['class' => 'form-label font-weight-500']) }}<br>
                                                    </div>
                                                @endif
                                        @endif
                                        @if (in_array($module . ' mainInvoice', (array) $permissions))
                                                @if ($key = array_search($module . ' mainInvoice', $permissions))
                                                    <div class="col-md-3 custom-control custom-checkbox">
                                                        {{ Form::checkbox('permissions[]', $key, $role->permission, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'mainInvoice', ['class' => 'form-label font-weight-500']) }}<br>
                                                    </div>
                                                @endif
                                        @endif
                                        @if (in_array($module . ' downloadFiles', (array) $permissions))
                                                @if ($key = array_search($module . ' downloadFiles', $permissions))
                                                    <div class="col-md-3 custom-control custom-checkbox">
                                                        {{ Form::checkbox('permissions[]', $key, $role->permission, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'downloadFiles', ['class' => 'form-label font-weight-500']) }}<br>
                                                    </div>
                                                @endif
                                        @endif
                                        @if (in_array($module . ' invoiceReport', (array) $permissions))
                                                @if ($key = array_search($module . ' invoiceReport', $permissions))
                                                    <div class="col-md-3 custom-control custom-checkbox">
                                                        {{ Form::checkbox('permissions[]', $key, $role->permission, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'invoiceReport', ['class' => 'form-label font-weight-500']) }}<br>
                                                    </div>
                                                @endif
                                        @endif
                                        @if (in_array($module . ' multiInvoice', (array) $permissions))
                                                @if ($key = array_search($module . ' multiInvoice', $permissions))
                                                    <div class="col-md-3 custom-control custom-checkbox">
                                                        {{ Form::checkbox('permissions[]', $key, $role->permission, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'multiInvoice', ['class' => 'form-label font-weight-500']) }}<br>
                                                    </div>
                                                @endif
                                        @endif
                                         @if (in_array($module . ' stripe', (array) $permissions))
                                                @if ($key = array_search($module . ' stripe', $permissions))
                                                    <div class="col-md-3 custom-control custom-checkbox">
                                                        {{ Form::checkbox('permissions[]', $key, $role->permission, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'stripe', ['class' => 'form-label font-weight-500']) }}<br>
                                                    </div>
                                                @endif
                                        @endif
                                        @if (in_array($module . ' stripeforMultiple', (array) $permissions))
                                                @if ($key = array_search($module . ' stripeforMultiple', $permissions))
                                                    <div class="col-md-3 custom-control custom-checkbox">
                                                        {{ Form::checkbox('permissions[]', $key, $role->permission, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'stripeforMultiple', ['class' => 'form-label font-weight-500']) }}<br>
                                                    </div>
                                                @endif
                                        @endif
                                        @if (in_array($module . ' paypal', (array) $permissions))
                                                @if ($key = array_search($module . ' paypal', $permissions))
                                                    <div class="col-md-3 custom-control custom-checkbox">
                                                        {{ Form::checkbox('permissions[]', $key, $role->permission, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'paypal', ['class' => 'form-label font-weight-500']) }}<br>
                                                    </div>
                                                @endif
                                        @endif
                                        @if (in_array($module . ' paypalforMultiple', (array) $permissions))
                                                @if ($key = array_search($module . ' paypalforMultiple', $permissions))
                                                    <div class="col-md-3 custom-control custom-checkbox">
                                                        {{ Form::checkbox('permissions[]', $key, $role->permission, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'paypalforMultiple', ['class' => 'form-label font-weight-500']) }}<br>
                                                    </div>
                                                @endif
                                        @endif
                                       @if (in_array($module . ' create_newDigitizing', (array) $permissions))
                                                @if ($key = array_search($module . ' create_newDigitizing', $permissions))
                                                    <div class="col-md-3 custom-control custom-checkbox">
                                                        {{ Form::checkbox('permissions[]', $key, $role->permission, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'create_newDigitizing', ['class' => 'form-label font-weight-500']) }}<br>
                                                    </div>
                                                @endif
                                        @endif
                                        @if (in_array($module . ' create_newVector', (array) $permissions))
                                                @if ($key = array_search($module . ' create_newVector', $permissions))
                                                    <div class="col-md-3 custom-control custom-checkbox">
                                                        {{ Form::checkbox('permissions[]', $key, $role->permission, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'create_newVector', ['class' => 'form-label font-weight-500']) }}<br>
                                                    </div>
                                                @endif
                                        @endif
                                        @if (in_array($module . ' newsellDigitizing', (array) $permissions))
                                                @if ($key = array_search($module . ' newsellDigitizing', $permissions))
                                                    <div class="col-md-3 custom-control custom-checkbox">
                                                        {{ Form::checkbox('permissions[]', $key, $role->permission, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'newsellDigitizing', ['class' => 'form-label font-weight-500']) }}<br>
                                                    </div>
                                                @endif
                                        @endif
                                        @if (in_array($module . ' newsellVector', (array) $permissions))
                                                @if ($key = array_search($module . ' newsellVector', $permissions))
                                                    <div class="col-md-3 custom-control custom-checkbox">
                                                        {{ Form::checkbox('permissions[]', $key, $role->permission, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'newsellVector', ['class' => 'form-label font-weight-500']) }}<br>
                                                    </div>
                                                @endif
                                        @endif
                                        @if (in_array($module . ' searchforAssignDigitizing', (array) $permissions))
                                                @if ($key = array_search($module . ' searchforAssignDigitizing', $permissions))
                                                    <div class="col-md-3 custom-control custom-checkbox">
                                                        {{ Form::checkbox('permissions[]', $key, $role->permission, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'searchforAssignDigitizing', ['class' => 'form-label font-weight-500']) }}<br>
                                                    </div>
                                                @endif
                                        @endif
                                        @if (in_array($module . ' searchforAssignVector', (array) $permissions))
                                                @if ($key = array_search($module . ' searchforAssignVector', $permissions))
                                                    <div class="col-md-3 custom-control custom-checkbox">
                                                        {{ Form::checkbox('permissions[]', $key, $role->permission, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'searchforAssignVector', ['class' => 'form-label font-weight-500']) }}<br>
                                                    </div>
                                                @endif
                                        @endif
                                        @if (in_array($module . ' pending', (array) $permissions))
                                                @if ($key = array_search($module . ' pending', $permissions))
                                                    <div class="col-md-3 custom-control custom-checkbox">
                                                        {{ Form::checkbox('permissions[]', $key, $role->permission, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'pending', ['class' => 'form-label font-weight-500']) }}<br>
                                                    </div>
                                                @endif
                                        @endif
                                        @if (in_array($module . ' complete', (array) $permissions))
                                                @if ($key = array_search($module . ' complete', $permissions))
                                                    <div class="col-md-3 custom-control custom-checkbox">
                                                        {{ Form::checkbox('permissions[]', $key, $role->permission, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'complete', ['class' => 'form-label font-weight-500']) }}<br>
                                                    </div>
                                                @endif
                                        @endif
                                        @if (in_array($module . ' saleReport', (array) $permissions))
                                                @if ($key = array_search($module . ' saleReport', $permissions))
                                                    <div class="col-md-3 custom-control custom-checkbox">
                                                        {{ Form::checkbox('permissions[]', $key, $role->permission, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'saleReport', ['class' => 'form-label font-weight-500']) }}<br>
                                                    </div>
                                                @endif
                                        @endif
                                        @if (in_array($module . ' searchsaleReport', (array) $permissions))
                                                @if ($key = array_search($module . ' searchsaleReport', $permissions))
                                                    <div class="col-md-3 custom-control custom-checkbox">
                                                        {{ Form::checkbox('permissions[]', $key, $role->permission, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'searchsaleReport', ['class' => 'form-label font-weight-500']) }}<br>
                                                    </div>
                                                @endif
                                        @endif
                                        @if (in_array($module . ' multiDigitizingOrder', (array) $permissions))
                                                @if ($key = array_search($module . ' multiDigitizingOrder', $permissions))
                                                    <div class="col-md-3 custom-control custom-checkbox">
                                                        {{ Form::checkbox('permissions[]', $key, $role->permission, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'multiDigitizingOrder', ['class' => 'form-label font-weight-500']) }}<br>
                                                    </div>
                                                @endif
                                        @endif
                                        @if (in_array($module . ' multiVectorOrder', (array) $permissions))
                                                @if ($key = array_search($module . ' multiVectorOrder', $permissions))
                                                    <div class="col-md-3 custom-control custom-checkbox">
                                                        {{ Form::checkbox('permissions[]', $key, $role->permission, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'multiVectorOrder', ['class' => 'form-label font-weight-500']) }}<br>
                                                    </div>
                                                @endif
                                        @endif
                                        @if (in_array($module . ' allOrderReport', (array) $permissions))
                                                @if ($key = array_search($module . ' allOrderReport', $permissions))
                                                    <div class="col-md-3 custom-control custom-checkbox">
                                                        {{ Form::checkbox('permissions[]', $key, $role->permission, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'allOrderReport', ['class' => 'form-label font-weight-500']) }}<br>
                                                    </div>
                                                @endif
                                        @endif
                                        @if (in_array($module . ' openSetting', (array) $permissions))
                                                @if ($key = array_search($module . ' openSetting', $permissions))
                                                    <div class="col-md-3 custom-control custom-checkbox">
                                                        {{ Form::checkbox('permissions[]', $key, $role->permission, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'openSetting', ['class' => 'form-label font-weight-500']) }}<br>
                                                    </div>
                                                @endif
                                        @endif
                                        @if (in_array($module . ' settingUpdate', (array) $permissions))
                                                @if ($key = array_search($module . ' settingUpdate', $permissions))
                                                    <div class="col-md-3 custom-control custom-checkbox">
                                                        {{ Form::checkbox('permissions[]', $key, $role->permission, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'settingUpdate', ['class' => 'form-label font-weight-500']) }}<br>
                                                    </div>
                                                @endif
                                        @endif
                                        @if (in_array($module . ' v_filters', (array) $permissions))
                                                @if ($key = array_search($module . ' v_filters', $permissions))
                                                    <div class="col-md-3 custom-control custom-checkbox">
                                                        {{ Form::checkbox('permissions[]', $key, $role->permission, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'v_filters', ['class' => 'form-label font-weight-500']) }}<br>
                                                    </div>
                                                @endif
                                        @endif
                                        @if (in_array($module . ' d_filters', (array) $permissions))
                                                @if ($key = array_search($module . ' d_filters', $permissions))
                                                    <div class="col-md-3 custom-control custom-checkbox">
                                                        {{ Form::checkbox('permissions[]', $key, $role->permission, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'd_filters', ['class' => 'form-label font-weight-500']) }}<br>
                                                    </div>
                                                @endif
                                        @endif
                                        @if (in_array($module . ' assignReveseV', (array) $permissions))
                                                @if ($key = array_search($module . ' assignReveseV', $permissions))
                                                    <div class="col-md-3 custom-control custom-checkbox">
                                                        {{ Form::checkbox('permissions[]', $key, $role->permission, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'assignReveseV', ['class' => 'form-label font-weight-500']) }}<br>
                                                    </div>
                                                @endif
                                        @endif
                                        @if (in_array($module . ' assignReveseD', (array) $permissions))
                                                @if ($key = array_search($module . ' assignReveseD', $permissions))
                                                    <div class="col-md-3 custom-control custom-checkbox">
                                                        {{ Form::checkbox('permissions[]', $key, $role->permission, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'assignReveseD', ['class' => 'form-label font-weight-500']) }}<br>
                                                    </div>
                                                @endif
                                        @endif
										@if (in_array($module . ' merge', (array) $permissions))
                                                @if ($key = array_search($module . ' merge', $permissions))
                                                    <div class="col-md-3 custom-control custom-checkbox">
                                                        {{ Form::checkbox('permissions[]', $key, $role->permission, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }}
                                                        {{ Form::label('permission' . $key, 'merge', ['class' => 'form-label font-weight-500']) }}<br>
                                                    </div>
                                                @endif
                                        @endif







                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-danger" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
    <input type="submit" value="{{ __('Update') }}" class="bbtn">
</div>
{{ Form::close() }}





</div>
</div>
</section>
</div>



@include('layouts.footer')
<script>
    $(document).ready(function() {
        $("#checkall").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
        $(".ischeck").click(function() {
            var ischeck = $(this).data('id');
            $('.isscheck_' + ischeck).prop('checked', this.checked);
        });
    });
</script>
