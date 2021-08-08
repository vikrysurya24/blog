<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
   <meta charset="utf-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
   <title>{{ config('app.name') }} | @yield('title')</title>
   
   <!--css/script -->
   <link rel="stylesheet" href="{{ asset('vendor/auth/css/auth.css') }}">
   {{-- Quicksand Font --}}
   <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
   {{-- Icons Bootstrap --}}
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body class="bg-primary">
   <div id="layoutAuthentication">
      <div id="layoutAuthentication_content">
         <main>
            <div class="container">
               <div class="row justify-content-center">
                  <div class="col-lg-5">
                     <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <div class="card-header">
                           <h3 class="text-center font-weight-light my-4">
                              <!--show content title-->
                              @yield('title')
                           </h3>
                        </div>
                        <div class="card-body">
                           <!--show main content -->
                           @yield('content')
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </main>
      </div>
      <div id="layoutAuthentication_footer">
         <!--show footer -->
         @include('layouts.auth.footer')
      </div>
   </div>
   <!--script -->
   <script src="{{ asset('vendor/jQuery/jquery-3.6.0.min.js') }}"></script>
   <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
   <script src="{{ asset('vendor/auth/js/auth.js') }}"></script>

   <script>
        //Show Password
       $(document).ready(function () {
            $('#showPassword').click(function () {
                if ($(this).is(':checked')) {
                    $('#input_login_password').attr('type', 'text');
                } else {
                    $('#input_login_password').attr('type', 'password');
                }
            })
        })
   </script>
</body>

</html>