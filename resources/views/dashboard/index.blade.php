@extends('layouts.dashboard')

@section('title')
    Dashboard
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('dashboard') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                Selamat Datang,&nbsp;<strong>{{ Auth::user()->name }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
        </div>
    </div>
@endsection