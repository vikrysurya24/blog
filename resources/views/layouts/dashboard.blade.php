<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
   <meta charset="utf-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
   <title>
      {{ config('app.name') }} | @yield('title')
   </title>
   <!-- dashboard -->
   <link rel="stylesheet" href="{{ asset('vendor/dashboard/css/dashboard.css') }}">
   <!-- icon flag -->
   <link rel="stylesheet" href="{{ asset('vendor/flag-icon-css/css/flag-icon.min.css') }}">
   {{-- Quicksand Font --}}
   <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
   {{-- Icons Bootstrap --}}
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body>
   <!-- begin:navbar -->
   @include('layouts.dashboard.navbar')
   <!-- end:navbar -->
   <div id="layoutSidenav">
      <div id="layoutSidenav_nav">
        <!-- begin:sidebar -->
        @include('layouts.dashboard.sidebar')
        <!-- end:sidebar -->
      </div>
      <div id="layoutSidenav_content">
         <main>
            <div class="container-fluid">
               <h2 class="mt-2">
                  <!-- title -->
                  @yield('title')
               </h2>
               <!-- begin:breadcrumbs -->         
               @yield('breadcrumbs')
               <!-- end:breadcrumbs -->               

               <!-- begin:content -->        
               @yield('content') 
               <!-- end:content -->               
            </div>
         </main>
         <!-- begin:footer -->         
         @include('layouts.dashboard.footer')
         <!-- end:footer -->   
      </div>
   </div>
   <!-- scripts -->
   <!-- fontawesome -->
   <script src="{{ asset('vendor/fontawesome-free/js/all.min.js') }}"></script>
   <!-- jquery -->
   <script src="{{ asset('vendor/jQuery/jquery-3.6.0.min.js') }}"></script>
   <!-- bootstrap bundle -->
   <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
   <!-- my-dashboard -->
   <script src="{{ asset('vendor/dashboard/js/dashboard.js') }}"></script>
</body>

</html>