@extends('layouts.blog')

@section('title')
    {{ request()->get('keyword') }}
@endsection

@section('content')
    <!-- page title -->
    <h2 class="my-3">
        {{ trans('blog.title.search', ['keyword' => request()->get('keyword')]) }}
    </h2>
    <!-- Breadcrumbs:start -->
        {{ Breadcrumbs::render('blog-search', request()->get('keyword')) }}
    <!-- Breadcrumbs:end -->
    
    <div class="row">
        <div class="col">
            <!-- Post list:start -->
            @forelse ($posts as $item)
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <!-- thumbnail:start -->
                                @if (file_exists(public_path($item->thumbnail)))
                                    <img class="card-img-top" src="{{ asset($item->thumbnail) }}" alt="{{ $item->title }}">
                                    <!-- true -->
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
                <!-- Post list:end -->
            @empty
                <!-- empty -->
                <h3 class="text-center text-danger">
                    {{ trans('blog.no_data.search_posts') }}
                </h3>
            @endforelse
            </div>
        </div>
    <!-- pagination:start -->
    @if ($posts->hasPages())
        <div class="row">
            <div class="col">
                {{ $posts->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    @endif
    <!-- pagination:end -->
@endsection