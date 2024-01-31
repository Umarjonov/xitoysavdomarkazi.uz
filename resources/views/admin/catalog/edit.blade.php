@extends('layouts.app', ['title' => __('User Edit')])
@section('head')

@endsection
@section('content')
    <!-- Header -->
    <div class="header bg-primary pb-6 pt-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col">
                        <h6 class="h2 text-white d-inline-block mb-0">Изменить каталог</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i
                                            class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page"><a href="{{ route('catalog.index') }}"> Каталог </a></li>
                                <li class="breadcrumb-item active" aria-current="page">Изменить</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Изменить</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <form action="{{ route('catalog.update',$catalog->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>@lang('cruds.permission.fields.name')</label>
                                <input type="text" name="name" class="form-control {{ $errors->has('name') ? "is-invalid":"" }}" value="{{ old('name',$catalog->name) }}" required>
                                @if($errors->has('name'))
                                    <span class="error invalid-feedback">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="parent_id">Суб каталог</label>
                                {{--                                not selected --}}
                                <select class="form-control {{ $errors->has('parent_id') ? "is-invalid":"" }}" name="parent_id" id="parent_id" data-placeholder="@lang('pleaseSelect')">
                                    <option value="0">Корневой каталог</option>
                                    @foreach($catalogs as $cat)
                                        <option value="{{ $cat->id }}" {{ $cat->id==$catalog->parent_id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('parent_id'))
                                    <span class="error invalid-feedback d-flex">{{ $errors->first('parent_id') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="is_active">Статус</label>
                                <select class="form-control" name="is_active" id="is_active" data-placeholder="@lang('pleaseSelect')" required>
                                    <option value="1" {{ $catalog->is_active ? 'selected':'' }}>active</option>
                                    <option value="0" {{$catalog->is_active?'':'selected'}}>in_active</option>
                                </select>
                                @if($errors->has('is_active'))
                                    <span class="error invalid-feedback">{{ $errors->first('is_active') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Логотип</label>
                                <div class="input-group">
                                    <img src="{{asset('uploads/catalogs/'.$catalog->image)}}" alt="Preview Uploaded Image"
                                         class="mr-2 " style="height: 48px;border: 1px solid #ccc !important;width: 48px;border-radius: 50%;" id="file-preview">
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input" id="image">
                                        <label class="custom-file-label" for="image">логотип каталога</label>
                                    </div>
                                </div>
                                @if($errors->has('image'))
                                    <span class="error invalid-feedback">{{ $errors->first('image') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success float-right">@lang('global.save')</button>
                                <a href="{{ route('catalog.index') }}" class="btn btn-default float-left">@lang('global.cancel')</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth')

    @push('js')
        <script>

            const input = document.getElementById('image');
            const previewPhoto = () => {
                const file = input.files;
                if (file) {
                    const fileReader = new FileReader();
                    const preview = document.getElementById('file-preview');
                    fileReader.onload = function (event) {
                        preview.setAttribute('src', event.target.result);
                    }
                    fileReader.readAsDataURL(file[0]);
                }
            }
            input.addEventListener("change", previewPhoto);
        </script>

    @endpush
@endsection
