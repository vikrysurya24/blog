@extends('layouts.dashboard')

@section('title')
    {{ trans('posts.title.detail') }}
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('detail-post', $post) }}
@endsection

@section('content')
    <!-- content -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <!-- thumbnail:true -->
                    @if (file_exists(public_path($post->thumbnail)))
                        <div class="post-thumbnail" style="background-image: url('{{ asset($post->thumbnail) }}'); ">
                        </div>
                    @else
                        <!-- thumbnail:false -->
                        <svg class="img-fluid" width="100%" height="400" xmlns="http://www.w3.org/2000/svg"
                        preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
                            <rect width="100%" height="100%" fill="#868e96"></rect>
                            <text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" fill="#dee2e6" dy=".3em"
                                font-size="24">
                            {{ $post->title }}
                            </text>
                        </svg>
                    @endif
                    <!-- title -->
                    <h2 class="my-3">
                        {{ $post->title }}
                    </h2>
                    <!-- description -->
                    <b>{{ trans('posts.form_control.textarea.description.label') }}</b>
                    <p class="text-justify">
                        {{ $post->description }}
                    </p>
                    <!-- categories -->
                    <b class="font-weight-bold">{{ trans('posts.form_control.select.category.label') }}</b>&nbsp;
                    @foreach ($categories as $item)
                        <span class="badge badge-primary">{{ $item->title }}</span>
                    @endforeach
                    <br>
                    <!-- tags  -->
                    <b class="font-weight-bold">{{ trans('posts.form_control.select.tag.label') }}</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    @foreach ($tags as $item)
                    <span class="badge badge-info">{{ $item->title }}</span>
                    @endforeach
                    <hr>
                    <!-- content -->
                    <div class="py-1">
                        {!! $post->content !!}
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('posts.index') }}" class="btn btn-secondary mx-1" role="button">
                        {{ trans('posts.button.back.value') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <!-- style -->
    <style>
        .post-thumbnail {
            width: 100%;
            height: 400px;
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
        }
    </style>
@endpush