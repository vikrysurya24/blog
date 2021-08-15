@extends('layouts.dashboard')

@section('title')
    {{ trans('users.title.create') }}
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('add-user') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('users.store') }}" method="POST" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <!-- name -->
                                <div class="form-group">
                                    <label for="input_user_name" class="font-weight-bold">
                                        {{ trans('users.label.name') }}
                                    </label>
                                    <input id="input_user_name" value="{{ old('name') }}" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="{{ trans('users.form_control.input.name.placeholder') }}" />
                                    <!-- error message -->
                                    @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- email -->
                                <div class="form-group">
                                    <label for="input_user_email" class="font-weight-bold">
                                        {{ trans('users.label.email') }}
                                    </label>
                                    <input id="input_user_email" value="{{ old('email') }}" name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ trans('users.form_control.input.email.placeholder') }}" />
                                    <!-- error message -->
                                    @error('email')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- password -->
                                <div class="form-group">
                                    <label for="password" class="font-weight-bold">
                                        {{ trans('users.form_control.input.password.label') }}
                                    </label>
                                    <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ trans('users.form_control.input.password.placeholder') }}" value="{{ old('password') }}"/>
                                    <!-- error message -->
                                    @error('password')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- password_confirmation -->
                                <div class="form-group">
                                    <label for="password_confirmation" class="font-weight-bold">
                                        {{ trans('users.form_control.input.password_confirmation.label') }}
                                    </label>
                                    <input id="password_confirmation" name="password_confirmation" type="password"
                                        class="form-control" placeholder="{{ trans('users.form_control.input.password_confirmation.placeholder') }}" value="{{ old('password_confirmation') }}"/>
                                    <!-- error message -->
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- role -->
                                <div class="form-group">
                                    <label for="select_user_role" class="font-weight-bold">
                                        {{ trans('users.form_control.select.role.label') }}
                                    </label>
                                    <select id="select_user_role" name="role" data-placeholder="{{ trans('users.form_control.select.role.placeholder') }}" class="custom-select w-100 @error('role') is-invalid @enderror">
                                        @if (old('role'))
                                            <option value="{{ old('role')->id }}" selected="selected">{{ old('role')->name }}</option>
                                        @endif
                                    </select>
                                    <!-- error message -->
                                    @error('role')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group text-muted">
                                    <input type="checkbox" id="showPassword">&nbsp;<small>{{ trans('users.label.show_password.label') }}</small>
                                </div>
                            </div>
                        </div>

                        <div class="float-right">
                            <a class="btn btn-secondary px-4 mx-2" href="{{ route('users.index') }}">
                                {{ trans('users.button.back.value') }}
                            </a>
                            <button type="submit" class="btn btn-primary float-right px-4">
                                {{ trans('users.button.save.value') }}
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

        //Show Password
        $(document).ready(function () {
            $('#showPassword').click(function () {
                if ($(this).is(':checked')) {
                    $('#password').attr('type', 'text');
                    $('#password_confirmation').attr('type', 'text');
                } else {
                    $('#password').attr('type', 'password');
                    $('#password_confirmation').attr('type', 'password');
                }
            })
        })
    </script>
@endpush