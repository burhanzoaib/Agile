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
                <a href="{{ route('role.create') }}" class="bbtn mb-3">
                    <i class="fa fa-plus"></i> {{ __('Create New Role') }}
                </a>



                <div class="col-12">
                    <div class="card">
                        <div class="card-header card-body table-border-style">
                            {{-- <h5></h5> --}}
                            <div class="table-responsive">
                                <table class="table" id="pc-dt-simple">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Role') }}</th>
                                            <th>{{ __('Permissions') }}</th>
                                            <th width="200px">{{ __('Action') }}</th>
                                        </tr>
                                    </thead>



                                    <tbody>
                                        @foreach ($roles as $role)
                                        <tr>
                                            <td>{{ $role->name }}</td>
                                            <td style="white-space: inherit">
                                                @foreach ($role->permissions()->pluck('name') as $permission)
                                                <span class="badge rounded p-2 m-1 px-3 bbtn">
                                                    <a href="#" style="font-family: monospace;font-weight: 500; color:#000">{{ $permission }}</a>
                                                </span>
                                                @endforeach
                                            </td>
                                            <td class="Action">

                                                    @can('role edit')

                                                    <a href="{{ URL::to('role/' . $role->id . '/edit')}}" class="mx-3 btn btn-warning " ><i class="fa fa-pencil text-white"></i></a>

                                                     @endcan

                                                    @can('role delete')

                                                        {!! Form::open(['method' => 'DELETE', 'route' =>
                                                        ['role.destroy', $role->id], 'id' => 'delete-form-' .
                                                        $role->id]) !!}
                                                            <a href="#" class="mx-3 btn btn-danger " ><i class="fa fa-trash text-white text-white"></i></a>
                                                        </form>

                                                    @endcan

                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>

@include('layouts.footer')
