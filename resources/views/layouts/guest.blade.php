<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/24.4.0/build/js/intlTelInput.min.js" integrity="sha512-Lh0SK6Q4/QLdjeN3PR39x3WYPErRDSR/uUELVP7MHYaJYKWLHIfUZkc4LIrOI4Pw4QyTPlNwWTbw/Es0BLbBzg==" 
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/24.4.0/build/css/intlTelInput.min.css" integrity="sha512-X3pJz9m4oT4uHCYS6UjxVdWk1yxSJJIJOJMIkf7TjPpb1BzugjiFyHu7WsXQvMMMZTnGUA9Q/GyxxCWNDZpdHA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            .input_phone{
              width:400px;
             
            }
            .input_lab{
                margin-top:10px;
            }
          </style>
    </head>
    <body class="font-sans text-gray-900 antialiased ">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-red-500">
            <div class="text-green ">
                <a class="navbar-brand" href="{{route('index.view')}}">
                    <img src="{{asset('img/gallery/logo.png')}}" width="118" alt="logo" />
               
                  </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4  shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
