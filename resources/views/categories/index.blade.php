@extends('layouts.dashboard')

@section('title')
    {{ trans('categories.title.index') }}
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('categories') }}
@endsection

@section('content')
    <!-- section:content -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            {{-- Search --}}
                            <form action="{{ route('categories.index') }}" method="GET">
                                <div class="input-group">
                                    <input name="keyword" type="search" class="form-control" placeholder="{{ trans('categories.form_control.input.search.placeholder') }}" value="{{ request()->get('keyword') }}" autocomplete="off">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('categories.create') }}" class="btn btn-primary float-right" role="button">
                                {{ trans('categories.button.create.value') }}
                                <i class="fas fa-plus-square"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <!-- list category -->
                        @if (count($categories))
                            @include('categories.category-list', [
                                'categories' => $categories,
                                'count' => 0
                            ])
                        @else
                            @if (request()->get('keyword'))
                                <strong class="text-center text-danger">{{ trans('categories.label.no_data.search', ['keyword' => request()->get('keyword')]) }}</strong>
                            @else
                                <strong class="text-center text-danger">{{ trans('categories.label.no_data.fetch') }}</strong>
                            @endif
                        @endif
                    </ul>
                </div>
                @if ($categories->hasPages())
                    <div class="card-footer">
                        {{ $categories->links('vendor.pagination.bootstrap-4') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function(){
            // Delete
            $("form[role='alert']").submit(function(event){
                event.preventDefault();
                Swal.fire({
                    title: $(this).attr('alert-title'),
                    text: $(this).attr('alert-text'),
                    icon: 'warning',
                    allowOutsideClick: false,
                    showCancelButton: true,
                    cancelButtonText: $(this).attr('alert-cancel'),
                    reverseButtons: true,
                    confirmButtonText: $(this).attr('alert-yes'),
                    }).then((result) => {
                    if (result.isConfirmed) {
                        // todo: process of deleting categories
                        event.target.submit();
                    }
                });
            })
        });
    </script>
@endpush