@extends('layouts.blog')

@section('title')
    {{ trans('blog.title.tags') }}
@endsection

@section('content')
    <h2 class="my-3">
        {{ trans('blog.title.tags') }}
    </h2>
    <!-- Breadcrumb:start -->
    {{ Breadcrumbs::render('blog-tags') }}
    <!-- Breadcrumb:end -->
    
    <!-- List tag -->
        <div class="row">
            <div class="col">
            @forelse ($tags as $item)
                <!-- true -->
                <a href="{{ route('blog.posts-tag', ['slug' => $item->slug]) }}" class="badge badge-info py-3 px-5 my-1">#{{ $item->title }}</a>
            @empty
                <!-- false -->
                <h3 class="text-center text-danger">
                    {{ trans('blog.no_data.tags') }}
                </h3>
            @endforelse
            </div>
        </div>
    <!-- List tag -->
    
    <!-- pagination:start -->
    @if ($tags->hasPages())
        <div class="row">
            <div class="col">
                {{ $tags->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    @endif
    <!-- pagination:end -->
@endsection