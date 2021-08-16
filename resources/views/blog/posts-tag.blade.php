@extends('layouts.blog')

@section('title')
    {{ trans('blog.title.tag', ['title' => $tag->title]) }}
@endsection

@section('content')
    <!-- Title -->
    <h2 class="mt-4 mb-3">
        {{ trans('blog.title.tag', ['title' => $tag->title]) }}
    </h2>
    
    <!-- Breadcrumb:start -->
    {{ Breadcrumbs::render('blog-posts-tags', $tag->title) }}
    <!-- Breadcrumb:end -->
    <div class="row">
        <div class="col-lg-8">
        <!-- Post list:start -->
        @forelse ($posts as $item)
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <!-- thumbnail:start -->
                            @if (file_exists(public_path($item->thumbnail)))
                                <!-- true -->
                                <img class="card-img-top" src="{{ asset($item->thumbnail) }}" alt="{{ $item->title }}">         
                            @else
                                <!-- false -->
                                <svg class="img-fluid" width="700" height="400" xmlns="http://www.w3.org/2000/svg"
                                preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
                                    <rect width="700" height="400" fill="#868e96"></rect>
                                    <text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" fill="#dee2e6" dy=".3em"
                                        font-size="24">
                                    {{ $item->title }}
                                    </text>
                                </svg>    
                            @endif
                            <!-- thumbnail:end -->                   
                        </div>
                        <div class="col-lg-6">
                            <h2 class="card-title">{{ $item->title }}</h2>
                            <p class="card-text">{{ $item->description }}</p>
                            <a href="{{ route('blog.detail-posts', ['slug' => $item->slug]) }}" class="btn btn-primary">
                                {{ trans('blog.button.read_more.value') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
        @empty
            <!-- empty -->
            <h3 class="text-center text-danger">
                {{ trans('blog.no_data.posts') }}
            </h3>
        @endforelse
        <!-- Post list:end -->
        </div>
        <div class="col-md-4">
            <!-- Tag list:start -->
            <div class="card mb-1">
                <h5 class="card-header">
                    {{ trans('blog.widget.tags') }}
                </h5>
                <div class="card-body">
                    @foreach ($tags as $item)
                        <a href="{{ route('blog.posts-tag', ['slug' => $item->slug]) }}" class="badge badge-info py-2 px-4 my-1">#{{ $item->title }}</a>
                    @endforeach
                </div>
            </div>
            <!-- Tag list:end -->
        </div>
    </div>

    @if ($posts->hasPages())
        <div class="row">
            <div class="col">
                {{ $posts->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    @endif
@endsection