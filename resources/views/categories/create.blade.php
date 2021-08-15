@extends('layouts.dashboard')

@section('title')
    {{ trans('categories.title.create') }}
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('add-category') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('categories.store') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <!-- title -->
                            <div class="form-group">
                                <label for="input_category_title" class="font-weight-bold">
                                    {{ trans('categories.form_control.input.title.label') }}
                                </label>
                                <input id="input_category_title" value="{{ old('title') }}" name="title" type="text" class="form-control @error('title') is-invalid @enderror" placeholder="{{ trans('categories.form_control.input.title.placeholder') }}"/>
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- slug -->
                            <div class="form-group">
                                <label for="input_category_slug" class="font-weight-bold">
                                    {{ trans('categories.form_control.input.slug.label') }}
                                </label>
                                <input id="input_category_slug" value="{{ old('slug') }}" name="slug" type="text" class="form-control @error('slug') is-invalid @enderror" placeholder="{{ trans('categories.form_control.input.slug.placeholder') }}" readonly />
                                @error('slug')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- parent_category -->
                            <div class="form-group">
                                <label for="select_category_parent" class="font-weight-bold">{{ trans('categories.form_control.select.parent_category.label') }}</label>
                                <select id="select_category_parent" name="parent_category" data-placeholder="{{ trans('categories.form_control.select.parent_category.placeholder') }}" class="custom-select">
                                    @if (old('parent_category'))
                                        <option value="{{ old('parent_category')->id }}" selected>{{ old('parent_category')->title }}</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- thumbnail -->
                            <div class="form-group">
                                <label for="input_category_thumbnail" class="font-weight-bold">
                                    {{ trans('categories.form_control.input.thumbnail.label') }}
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button id="button_category_thumbnail" data-preview="holder" data-input="input_category_thumbnail" class="btn btn-primary" type="button">
                                            {{ trans('categories.button.browse.value') }}
                                        </button>
                                    </div>
                                    <input id="input_category_thumbnail" name="thumbnail" value="{{ old('thumbnail') }}" type="text" class="form-control @error('thumbnail') is-invalid @enderror" placeholder="{{ trans('categories.form_control.input.thumbnail.placeholder') }}"
                                        readonly />
                                    @error('thumbnail')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div id="holder"></div>
                        </div>
                        <div class="col-md-12">
                            <!-- description -->
                            <div class="form-group">
                                <label for="input_category_description" class="font-weight-bold">
                                    {{ trans('categories.form_control.textarea.description.label') }}
                                </label>
                                <textarea id="input_category_description" name="description" class="form-control @error('description') is-invalid @enderror" rows="7" placeholder="{{ trans('categories.form_control.textarea.description.placeholder') }}">{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-secondary px-4" href="{{ route('categories.index') }}">{{ trans('categories.button.back.value') }}</a>
                        <button type="submit" class="btn btn-primary px-4">{{ trans('categories.button.save.value') }}</button>
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
@endpush

@push('js')
    <script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('vendor/select2/js/i18n/'. app()->getLocale() .'.js') }}"></script>
    <style type="text/css">
        .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice {
            background-color: #007bff;
            color: white;
        }
    </style>
    
    {{-- filemanager --}}
    <script src="{{ asset('/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>

    <script>
        $(function(){
            // Generate Slug
            function generateSlug(value){
                return value.trim()
                .toLowerCase()
                .replace(/[^a-z\d-]/gi, '-')
                .replace(/-+/g, '-').replace(/^-|-$/g, "");
            }

            // Select2
            $('#select_category_parent').select2({
                theme: 'bootstrap4',
                language: "{{ app()->getLocale() }}",
                allowClear: true,
                ajax: {
                    url: "{{ route('categories.select') }}",
                    dataType: 'json',
                    delay: 150,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                            return {
                                text: item.title,
                                id: item.id
                            }
                            })
                        };
                    }
                }
            });

            // Event:Title
            $('#input_category_title').change(function(){
                let title = $(this).val()
                let category = $('#select_category_parent').val() ?? ''
                $('#input_category_slug').val(generateSlug(title + ' ' + category))
            });

            // Event:select
            $('#select_category_parent').change(function(){
                let category = $(this).val()
                let title = $('#input_category_title').val() ?? ''
                $('#input_category_slug').val(generateSlug(title + ' ' + category))
            });

            // Thumbnail
            $('#button_category_thumbnail').filemanager('image');

        });
    </script>
@endpush