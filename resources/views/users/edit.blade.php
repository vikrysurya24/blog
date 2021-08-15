@extends('layouts.dashboard')

@section('title')
    {{ trans('users.title.edit') }}
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('edit-user', $user) }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('users.update', ['user' => $user]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4">
                                <!-- name -->
                                <div class="form-group">
                                    <label for="input_user_name" class="font-weight-bold">
                                        {{ trans('users.label.name') }}
                                    </label>
                                    <input id="input_user_name" value="{{ $user->name }}" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="{{ trans('users.form_control.input.name.placeholder') }}" readonly/>
                                    <!-- error message -->
                                    @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!-- email -->
                                <div class="form-group">
                                    <label for="input_user_email" class="font-weight-bold">
                                        {{ trans('users.label.email') }}
                                    </label>
                                    <input id="input_user_email" value="{{ $user->email }}" name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ trans('users.form_control.input.email.placeholder') }}"
                                        autocomplete="email" readonly/>
                                    <!-- error message -->
                                    @error('email')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!-- role -->
                                <div class="form-group">
                                    <label for="select_user_role" class="font-weight-bold">
                                        {{ trans('users.form_control.select.role.label') }}
                                    </label>
                                    <select id="select_user_role" name="role" data-placeholder="{{ trans('users.form_control.select.role.placeholder') }}" class="custom-select w-100 @error('role') is-invalid @enderror">
                                        @if (old('role', $selected))
                                            <option value="{{ old('role', $selected)->id }}" selected="selected">{{ old('role', $selected)->name }}</option>
                                        @endif
                                    </select>
                                    <!-- error message -->
                                    @error('role')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                </div>
                            </div>
                        </div>

                        <div class="float-right">
                            <a class="btn btn-secondary px-4 mx-2" href="{{ route('users.index') }}">
                                {{ trans('users.button.back.value') }}
                            </a>
                            <button type="submit" class="btn btn-warning float-right px-4">
                                {{ trans('users.button.edit.value') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2-bootstrap4.min.css') }}">
    <style type="text/css">
        .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice {
            background-color: #007bff;
            color: white;
        }
    </style>
@endpush

@push('js')
    <script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('vendor/select2/js/i18n/'. app()->getLocale() .'.js') }}"></script>
    
    <script>
        $(function(){
            // Select2
            $('#select_user_role').select2({
                theme: 'bootstrap4',
                language: "{{ app()->getLocale() }}",
                allowClear: true,
                ajax: {
                    url: "{{ route('roles.select') }}",
                    dataType: 'json',
                    delay: 150,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                            })
                        };
                    }
                }
            });
        });
    </script>
@endpush