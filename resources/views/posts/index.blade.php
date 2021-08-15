@extends('layouts.dashboard')

@section('title')
    {{ trans('posts.title.index') }}
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('posts') }}
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
       <div class="card">
          <div class="card-header">
             <div class="row">
                <div class="col-md-6">
                   <form action="" method="GET" class="form-inline form-row" autocomplete="off">
                      {{--status  --}}
                     <div class="col-md">
                         <div class="input-group mx-1">
                            <label class="font-weight-bold mr-2">{{ trans('posts.form_control.select.status.label') }}</label>
                            <select name="status" class="custom-select">
                               @foreach ($statuses as $value => $item)
                                   <option value="{{ $value }}" {{ $status == $value ? "selected" : "" }}>{{ $item }}</option>
                               @endforeach
                            </select>
                            <div class="input-group-append">
                               <button class="btn btn-primary" type="submit">{{ trans('posts.button.apply.value') }}</button>
                            </div>
                         </div>
                      </div>
                      <div class="col-md">
                         <div class="input-group mx-1">
                            <input name="keyword" type="search" class="form-control" placeholder="{{ trans('posts.form_control.input.search.placeholder') }}" value="{{ request()->get('keyword') }}">
                            <div class="input-group-append">
                               <button class="btn btn-primary" type="submit">
                                  <i class="fas fa-search"></i>
                               </button>
                            </div>
                         </div>
                      </div>
                   </form>
                </div>
                <div class="col-md-6">
                   @can('post_create')
                     <a href="{{ route('posts.create') }}" class="btn btn-primary float-right" role="button">
                        {{ trans('posts.title.create') }}
                        <i class="fas fa-plus-square"></i>
                     </a>
                   @endcan
                </div>
             </div>
          </div>
          <div class="card-body">
             <ul class="list-group list-group-flush">
                <!-- list post -->
                @forelse ($posts as $item)
                <div class="card">
                    <div class="card-body">
                        {{-- title --}}
                       <h3>{{ $item->title }}</h3>
                       <p>
                          {{-- Description --}}
                          {{ $item->description }}
                       </p>
                       <div class="float-right">
                           @can('post_detail')
                              <!-- detail -->
                              <a href="{{ route('posts.show', ['post' => $item]) }}" class="btn btn-sm btn-primary" role="button">
                                 <i class="fas fa-eye"></i>
                              </a> 
                           @endcan
                           @can('post_update')
                                 <!-- edit -->
                                 <a class="btn btn-sm btn-info" role="button" href="{{ route('posts.edit', ['post' => $item]) }}">
                                    <i class="fas fa-edit"></i>
                                 </a>
                           @endcan
                           @can('post_delete')
                              <!-- delete -->
                              <form class="d-inline" action="{{ route('posts.destroy', ['post' => $item]) }}" alert-text="{{ trans('posts.alert.delete.message.confirm', ['title' => $item->title]) }}" method="POST" role="alert">
                              @csrf
                              @method('DELETE')
                                 <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                 </button>
                              </form>
                           @endcan
                       </div>
                    </div>
                 </div>
                @empty
                    <strong class="text-danger text-center">
                       @if (request()->get('keyword'))
                        {{ trans('posts.label.no_data.search', ['keyword' => request()->get('keyword')]) }}
                       @else
                        {{ trans('posts.label.no_data.fetch') }}
                       @endif
                     </strong>
                @endforelse
             </ul>
          </div>
          @if ($posts->hasPages())
              <div class="card-footer">
                 {{ $posts->links('vendor.pagination.bootstrap-4') }}
              </div>
          @endif
       </div>
    </div>
  </div>
@endsection

@push('js')
    <script>
        $(document).ready(function(){
            // Evnet:delete
            $("form[role='alert']").submit(function(event){
                event.preventDefault();
                Swal.fire({
                    title: "{{ trans('posts.alert.delete.title') }}",
                    text: $(this).attr('alert-text'),
                    icon: 'warning',
                    allowOutsideClick: false,
                    showCancelButton: true,
                    cancelButtonText: "{{ trans('posts.button.cancel.value') }}",
                    reverseButtons: true,
                    confirmButtonText: "{{ trans('posts.button.delete.value') }}",
                    }).then((result) => {
                    if (result.isConfirmed) {
                        // todo: process of deleting categories
                        event.target.submit();
                    }
                });
            });
        });
    </script>
@endpush