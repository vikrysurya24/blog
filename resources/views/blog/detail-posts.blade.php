@extends('layouts.blog')

@section('title')
    {{ $post->title }}
@endsection

@section('description')
    {{ $post->description }}
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
             <!-- Breadcrumb:Start -->
                 {{ Breadcrumbs::render('blog-post', $post->title) }}
             <!-- Breadcrumb:end -->
             <div class="row">
                 <!-- Post Content Column:start -->
                 <div class="col-md-8">
                     <!-- Title:start -->
                    <h2 class="mb-2 text-center">
                        {{ $post->title }}
                    </h2>
                    <!-- Title:end -->
                     <!-- thumbnail:start -->
                     @if (file_exists(public_path($post->thumbnail)))
                         <img class="card-img-top" src="{{ asset($post->thumbnail) }}" alt="{{ $post->title }}">
                         <!-- true -->
                     @else
                         <!-- false -->
                             <svg class="img-fluid" width="700" height="400" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
                                 <rect width="700" height="400" fill="#868e96"></rect>
                                 <text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" fill="#dee2e6" dy=".3em" font-size="24">
                                     {{ $post->title }}
                                 </text>
                             </svg>
                     @endif
                     <!-- thumbnail:end -->
                     <hr>
                     <!-- Post Content:start -->
                     <div class="text-justify">
                         {!! $post->content !!}
                     </div>
                     <!-- Post Content:end -->
                     <hr>
                 </div>
            
                 <!-- Sidebar Widgets Column:start -->
                 <div class="col-md-4">
                     <!-- Categories Widget -->
                     <div class="card mb-3">
                         <h5 class="card-header">
                             {{ trans('blog.widget.categories') }}
                         </h5>
                     <div class="card-body">
                         <!-- category list:start -->
                         @foreach ($post->categories as $item)
                             <a href="{{ route('blog.posts-categories', ['slug' => $item->slug]) }}" class="badge badge-primary py-2 px-4 my-1">
                                 {{ $item->title }}
                             </a>
                         @endforeach
                         <!-- category list:end -->
                     </div>
                 </div>
            
                 <!-- Side Widget tags:start -->
                 <div class="card mb-3">
                     <h5 class="card-header">
                         {{ trans('blog.widget.tags') }}
                     </h5>
                     <div class="card-body">
                         <!-- tag list:start -->
                         @foreach ($post->tags as $item)
                             <a href="{{ route('blog.posts-tag', ['slug' => $item->slug]) }}" class="badge badge-info py-2 px-4 my-1">
                                 #{{ $item->title }}
                             </a>
                         @endforeach
                         <!-- tag list:end -->
                     </div>
                 </div>
                 <!-- Side Widget tags:start -->
                 </div>
                 <!-- Sidebar Widgets Column:end -->
             </div>
            </div>
        </div>
    </div>
</div>
@endsection