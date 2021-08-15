@extends('layouts.dashboard')

@section('title')
    {{ trans('users.title.index') }}
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('users') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                        <form action="{{ route('users.index') }}" method="GET" autocomplete="off">
                            <div class="input-group">
                                <input name="keyword" value="{{ request()->get('keyword') }}" type="search" class="form-control" placeholder="{{ trans('users.form_control.input.search.placeholder') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        </div>
                        <div class="col-md-6">
                            @can('user_create')
                                <a href="{{ route('users.create') }}" class="btn btn-primary float-right" role="button">
                                    {{ trans('users.button.create.value') }}
                                    <i class="fas fa-plus-square"></i>
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- list users -->
                        @forelse ($users as $item)
                            <div class="col-md-6">
                                <div class="card my-1">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <i class="fas fa-user fa-5x"></i>
                                            </div>
                                            <div class="col-md-10">
                                                <table>
                                                <tr>
                                                    <th>
                                                        {{ trans('users.form_control.input.name.label') }}
                                                    </th>
                                                    <td>&nbsp;:&nbsp;</td>
                                                    <td>
                                                        <!-- show user name -->
                                                        {{ $item->name }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        {{ trans('users.form_control.input.email.label') }}
                                                    </th>
                                                    <td>&nbsp;:&nbsp;</td>
                                                    <td>
                                                        <!-- show user email -->
                                                        {{ $item->email }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        {{ trans('users.form_control.select.role.label') }}
                                                    </th>
                                                    <td>&nbsp;:&nbsp;</td>
                                                    <td>
                                                        <!-- Show user roles -->
                                                        {{ $item->roles->first()->name }}
                                                    </td>
                                                </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="float-right">
                                            <!-- edit -->
                                            @can('user_update')
                                                <a href="{{ route('users.edit', ['user' => $item]) }}" class="btn btn-sm btn-info" role="button">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endcan
                                            <!-- delete -->
                                            @can('user_delete')
                                                <form class="d-inline" action="{{ route('users.destroy', ['user' => $item]) }}" alert-text="{{ trans('users.alert.delete.message.confirm', ['name' => $item->name]) }}" method="POST" role="alert">
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
                            </div>
                        @empty
                            <strong class="text-center text-danger">
                                @if (request()->get('keyword'))
                                {{ trans('users.label.no_data.search', ['keyword' => request()->get('keyword')]) }}
                                @else
                                {{ trans('users.label.no_data.fetch') }}
                                @endif
                            </strong>
                        @endforelse
                    </div>
                </div>
                @if ($users->hasPages())
                    <div class="card-footer">
                        <!-- Todo:paginate -->
                        {{ $users->links('vendor.pagination.bootstrap-4') }}
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
                    title: "{{ trans('users.alert.delete.title') }}",
                    text: $(this).attr('alert-text'),
                    icon: 'warning',
                    allowOutsideClick: false,
                    showCancelButton: true,
                    cancelButtonText: "{{ trans('users.button.cancel.value') }}",
                    reverseButtons: true,
                    confirmButtonText: "{{ trans('users.button.delete.value') }}",
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