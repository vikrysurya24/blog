@extends('layouts.dashboard')

@section('title')
    {{ trans('posts.title.create') }}
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('add-post') }}    
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('posts.store') }}" method="POST" autocomplete="off">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row d-flex align-items-stretch">
                            <div class="col-md-6">
                                <!-- title -->
                                <div class="form-group">
                                    <label for="input_post_title" class="font-weight-bold">
                                        {{ trans('posts.form_control.input.title.label') }}
                                    </label>
                                    <input id="input_post_title" value="{{ old('title') }}" name="title" type="text" class="form-control @error('title') is-invalid @enderror"
                                        placeholder="{{ trans('posts.form_control.input.title.placeholder') }}" />
                                    @error('title')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- slug -->
                                <div class="form-group">
                                    <label for="input_post_slug" class="font-weight-bold">
                                        {{ trans('posts.form_control.input.slug.label') }}
                                    </label>
                                    <input id="input_post_slug" value="{{ old('slug') }}" name="slug" type="text" class="form-control @error('slug') is-invalid @enderror" placeholder="{{ trans('posts.form_control.input.slug.placeholder') }}"
                                        readonly />
                                    @error('slug')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <!-- catgeory -->
                                <div class="form-group">
                                    <label for="select_post_category" class="font-weight-bold">
                                        {{ trans('posts.form_control.select.category.label') }}
                                    </label>
                                        <!-- List category -->
                                        <select name="category[]" id="select_post_category" data-placeholder="{{ trans('posts.form_control.select.category.placeholder') }}" class="custom-select @error('category') is-invalid @enderror" multiple>
                                            @if (old('category'))
                                                @foreach (old('category') as $item)
                                                    <option value="{{ $item->id }}" selected>{{ $item->title }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('category')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- tag -->
                                <div class="form-group">
                                    <label for="select_post_tag" class="font-weight-bold">
                                        {{ trans('posts.form_control.select.tag.label') }}
                                    </label>
                                        <select id="select_post_tag" name="tag[]" data-placeholder="{{ trans('posts.form_control.select.tag.placeholder') }}" class="custom-select @error('tag') is-invalid @enderror"
                                            multiple>
                                            @if (old('tag'))
                                                @foreach (old('tag') as $item)
                                                    <option value="{{ $item->id }}" selected>{{ $item->title }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('tag')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <!-- thumbnail -->
                                <div class="form-group">
                                    <label for="input_post_thumbnail" class="font-weight-bold">
                                        {{ trans('posts.form_control.input.thumbnail.label') }}
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button id="button_post_thumbnail" data-input="input_post_thumbnail"
                                                class="btn btn-primary" type="button">
                                                {{ trans('posts.button.browse.value') }}
                                            </button>
                                        </div>
                                        <input id="input_post_thumbnail" name="thumbnail" value="{{ old('thumbnail') }}" type="text" class="form-control @error('thumbnail') is-invalid @enderror"
                                        placeholder="{{ trans('posts.form_control.input.thumbnail.placeholder') }}" readonly />
                                        @error('thumbnail')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- status -->
                                <div class="form-group">
                                    <label for="select_post_status" class="font-weight-bold">
                                        {{ trans('posts.form_control.select.status.label') }}
                                    </label>
                                    <select id="select_post_status" name="status" class="custom-select @error('status') is-invalid @enderror">
                                        @foreach ($statuses as $item => $value)
                                            <option value="{{ $item }}" {{ old('status') ==  $item ? "selected" : ""}}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <!-- description -->
                                <div class="form-group">
                                    <label for="input_post_description" class="font-weight-bold">
                                        {{ trans('posts.form_control.textarea.description.label') }}
                                    </label>
                                    <textarea id="input_post_description" name="description" placeholder="{{ trans('posts.form_control.textarea.description.placeholder') }}" class="form-control @error('description') is-invalid @enderror"
                                        rows="3">{{ old('description') }}</textarea>
                                        @error('description')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                </div>

                                <!-- content -->
                                <div class="form-group">
                                    <label for="input_post_content" class="font-weight-bold">
                                        {{ trans('posts.form_control.textarea.content.label') }}
                                    </label>
                                    <textarea id="input_post_content" name="content" placeholder="{{ trans('posts.form_control.textarea.content.placeholder') }}" class="form-control @error('content') is-invalid @enderror"
                                        rows="10">{{ old('content') }}</textarea>
                                        @error('content')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="float-right">
                                    <a class="btn btn-secondary px-4" href="{{ route('posts.index') }}">{{ trans('posts.button.back.value') }}</a>
                                    <button type="submit" class="btn btn-primary px-4">
                                        {{ trans('posts.button.save.value') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
    {{-- Select2 --}}
    <script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('vendor/select2/js/i18n/'. app()->getLocale() .'.js') }}"></script>

    {{-- File Manager --}}
    <script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>

    {{-- TinyMCE 5 --}}
    <script src="{{ asset('vendor/tinymce5/jquery.tinymce.min.js') }}"></script>
    <script src="{{ asset('vendor/tinymce5/tinymce.min.js') }}"></script>
    
    <script>
        $(document).ready(function () { 
            // Event:slug
            $("#input_post_title").change(function (event) {
                $("#input_post_slug").val(
                    event.target.value
                    .trim()
                    .toLowerCase()
                    .replace(/[^a-z\d-]/gi, "-")
                    .replace(/-+/g, "-")
                    .replace(/^-|-$/g, "")
                );
            });

            // Event:file manager
            $('#button_post_thumbnail').filemanager('image');

            // TinyMCE 5
            $("#input_post_content").tinymce({
                relative_urls: false,
                language: "en",
                plugins: [
                    "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars code fullscreen",
                    "insertdatetime media nonbreaking save table directionality",
                    "emoticons template paste textpattern",
                ],
                toolbar:
                    "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | preview fullscreen",
                    file_picker_callback: function(callback, value, meta) {
                        let x = window.innerWidth || document.documentElement.clientWidth || document
                            .getElementsByTagName('body')[0].clientWidth;
                        let y = window.innerHeight || document.documentElement.clientHeight || document
                            .getElementsByTagName('body')[0].clientHeight;

                        let cmsURL = '{{ route('unisharp.lfm.show') }}' + '?editor=' + meta.fieldname;
                        if (meta.filetype == 'image') {
                            cmsURL = cmsURL + "&type=Images";
                        } else {
                            cmsURL = cmsURL + "&type=Files";
                        }

                        tinyMCE.activeEditor.windowManager.openUrl({
                            url: cmsURL,
                            title: 'Filemanager',
                            width: x * 0.8,
                            height: y * 0.8,
                            resizable: "yes",
                            close_previous: "no",
                            onMessage: (api, message) => {
                                callback(message.content);
                            }
                        });
                    }
            });

            // Select2
            // Tag
            $('#select_post_tag').select2({
                theme: 'bootstrap4',
                language: "{{ app()->getLocale() }}",
                allowClear: true,
                ajax: {
                    url: "{{ route('tags.select') }}",
                    dataType: 'json',
                    delay: 250,
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
            
            // Category
            $('#select_post_category').select2({
                theme: 'bootstrap4',
                language: "{{ app()->getLocale() }}",
                allowClear: true,
                ajax: {
                    url: "{{ route('categories.select') }}",
                    dataType: 'json',
                    delay: 250,
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
         });
    </script>
@endpush