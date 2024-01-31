@extends('layouts.app', ['title' => __('User Profile')])

@section('head')
    <link href="{{ asset('assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <!-- Header -->
    <div class="header bg-primary pb-6 pt-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Карусель</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i
                                            class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Карусель</li>
                            </ol>
                        </nav>
                    </div>
                    @can('carousel.create')
                        <div class="col-lg-6 col-5 text-right">
                            <a href="{{ route('carousel.create') }}" class="btn btn-sm btn-neutral">
                                <span class="fas fa-plus-circle"></span>
                                @lang('global.add')
                            </a>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>

    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="table-responsive py-4">
                        <table class="table align-items-center table-flush table-striped table-hover" id="example">
                            <thead class="thead-light">
                            <tr>
                                <th>@lang('cruds.user.fields.id')</th>
                                <th>@lang('cruds.user.fields.name')</th>
                                <th>Status</th>
                                <th>@lang('global.actions')</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>@lang('cruds.user.fields.id')</th>
                                <th>@lang('cruds.user.fields.name')</th>
                                <th>Status</th>
                                <th>@lang('global.actions')</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($carousels as $carousel)
                                <tr>
                                    <th>{{ $carousel->id }}</th>
                                    <th scope="row">
                                        <div class="media align-items-center">
                                            <a href="#" class="mr-3">
                                                <img alt="Image placeholder" src="{{asset('uploads/carousel/'.$carousel->image)}}"
                                                     style="width: 200px;border: 1px solid #ccc;border-radius: 5px;">
                                            </a>
                                            <div class="media-body">
                                                <span class="name mb-0 text-sm">{{ $carousel->title }}</span><br>
                                                <span class="text-sm font-weight-light">{{ $carousel->description }}</span>
                                            </div>
                                        </div>
                                    </th>
                                    <td>
										<span class="badge badge-dot mr-4">
                                            <i class="bg-{{ $carousel->status ? 'success' : 'warning' }}"></i>
                                            <span class="status">{{ $carousel->status ? 'active' : 'in_active' }}</span>
                                        </span>
                                    </td>
                                    <td class="table-actions text-center">
                                        @can('carousel.destroy')
                                            <form action="{{ route('carousel.destroy', $carousel->id) }}" method="post">
                                                @csrf
                                                @method("DELETE")
                                                <div class="btn-group">
                                                    @can('carousel.edit')
                                                        <a href="{{ route('carousel.edit', $carousel->id) }}"
                                                           class="table-action" data-toggle="tooltip"
                                                           data-original-title="Изменить Карусель">
                                                            <i class="fas fa-user-edit pr-1"> </i>
                                                        </a>
                                                    @endcan
                                                    <button type="button" class="p-0 table-action table-action-delete"
                                                            data-toggle="tooltip"
                                                            data-original-title="Удалить Карусель"
                                                            onclick="if (confirm('Вы уверены?')) { this.form.submit() } "
                                                            style="border: none;color:#5e72e4;cursor:pointer;:hover{border:none;color:#525f7f}">
                                                        <i class="fas fa-trash"> </i>
                                                    </button>
                                                </div>
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

    @push('js')
        <script src="{{ asset('assets/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script>
            $(document).ready(function () {
                var table = $('#example').DataTable({
                    lengthChange: true,
                    language: {
                        url: "{{ asset('assets/any/datatable-ru.json') }}",
                    },
                    order: [[0, 'desc']]
                });

                table.buttons().container()
                    .appendTo('#example_wrapper .col-md-6:eq(0)');
            });
        </script>
    @endpush
@endsection
