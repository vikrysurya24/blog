@extends('layouts.blog')

@section('title')
    {{ trans('blog.title.categories') }}
@endsection

@section('content')
    <h2 class="my-3">
        {{ trans('blog.title.categories') }}
    </h2>
    <!-- Breadcrumb:start -->
    {{ Breadcrumbs::render('blog-categories') }}
    <!-- Breadcrumb:end -->
    
    <!-- List category -->
    <div class="row">
        @forelse ($categories as $item)
            <!-- true -->
            <div class="col-lg-4 col-sm-6 portfolio-item">
                <div class="card h-100">
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
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="{{ route('blog.posts-categories', ['slug' => $item->slug]) }}">
                            {{ $item->title }}
                            </a>
                        </h4>
                        <p class="card-text">
                            {{ $item->description }}
                        </p>
                    </div>
                </div>
            </div>
        @empty
            <!-- false -->
            <h3 class="text-center text-danger">
                {{ trans('blog.no_data.categories') }}
            </h3>
        @endforelse
    </div>
    <!-- List category -->
    
    <!-- pagination:start -->
    @if ($categories->hasPages())
        <div class="row">
            <div class="col">
                {{ $categories->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    @endif
    <!-- pagination:end -->
@endsection