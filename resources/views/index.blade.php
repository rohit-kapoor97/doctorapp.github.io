<!DOCTYPE html>
<html lang="en-US" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>Doctor App</title>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('img/favicons/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('img/favicons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('img/favicons/favicon-16x16.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('img/favicons/favicon.ico')}}">
    <link rel="manifest" href="{{asset('img/favicons/manifest.json')}}">
    <meta name="msapplication-TileImage" content="{{asset('img/favicons/mstile-150x150.png')}}">
    <meta name="theme-color" content="#ffffff">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="{{asset('css/theme.css')}}" rel="stylesheet" />

  </head>


  <body>
  <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->

    <main class="main" id="top">
      <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 d-block" data-navbar-on-scroll="data-navbar-on-scroll">
        <div class="container"><a class="navbar-brand" href="{{route('index.view')}}">
          <img src="{{asset('img/gallery/logo.png')}}" width="118" alt="logo" />
     
        </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"> </span></button>
          <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto pt-2 pt-lg-0 font-base">
              <li class="nav-item px-2"><a class="nav-link" aria-current="page" href="#about">About Us</a></li>
              <li class="nav-item px-2"><a class="nav-link" href="#departments">Departments</a></li>
              <li class="nav-item px-2"><a class="nav-link" href="#findUs">Membership</a></li>
              <li class="nav-item px-2"><a class="nav-link" href="#findUs">Help </a></li>
              <li class="nav-item px-2"><a class="nav-link" href="#findUs">Contact</a></li>
            
          
              @if(Auth::user())
              <nav x-data="{ open: false }">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            {{-- <div class="shrink-0 flex items-center">
                                <a href="{{ route('dashboard') }}">
                                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                                </a>
                            </div> --}}
            
                            <!-- Navigation Links -->
                            {{-- <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                                    {{ __('Dashboard') }}
                                </x-nav-link>
                            </div> --}}
                        </div>
            
                        <!-- Settings Dropdown -->
                        <div class="hidden sm:flex sm:items-center sm:ms-4">
                            <x-dropdown align="left" width="48">
                                <x-slot name="trigger">
                                 
                                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        <div>{{ Auth::user()->name }}</div>
            
                                        <div class="ms-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>
            
                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>
                                    @if(Gate::allows('is_admin'))
                                 
                                      <x-dropdown-link :href="route('admin.view')">
                                          {{ __('Admin') }}
                                         
                                      </x-dropdown-link>
                                      @endif
            
                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
            
                                        <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
            
                        <!-- Hamburger -->
                        <div class="-me-2 flex items-center sm:hidden">
                            <button @click="open = ! open" class="inline-flex items-center justify-center p-1 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            
                <!-- Responsive Navigation Menu -->
                <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
                    {{-- <div class="pt-2 pb-3 space-y-1">
                        <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-responsive-nav-link>
                    </div> --}}
            
                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        {{-- <div class="px-4">
                            <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                        </div> --}}
            
                        <div class="mt-3 space-y-1">
                            <x-responsive-nav-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-responsive-nav-link>
            
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
            
                                <x-responsive-nav-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-responsive-nav-link>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
            
            @else
            </ul><a class="btn btn-sm btn-outline-primary rounded-pill order-1 order-lg-0 ms-lg-4" href="{{route('register')}}">Sign In</a>
            <a class="btn btn-sm btn-outline-primary rounded-pill order-1 order-lg-0 ms-lg-4" href="{{route('login')}}">Login</a>
            @endif
          </div>
        </div>
      </nav>
  
      <section class="py-xxl-10 pb-0" id="home">
        <div class="bg-holder bg-size" style="background-image:url({{asset('img/gallery/hero-bg.png')}});background-position:top center;background-size:cover;">
        </div>
        <!--/.bg-holder-->

        <div class="container">
             
      @if (Session::has('success'))
      <div class="col-md-6 offset-md-3 text-center h5 alert alert-success"> {{ Session::get('success') }} </div>
      @endif

      @if(Session::has('message'))
      <div class="col-md-6 offset-md-3 text-center h5 alert alert-success"> {{ Session::get('message') }} </div>
      @endif

          <div class="row min-vh-xl-100 min-vh-xxl-25">
            <div class="col-md-5 col-xl-6 col-xxl-7 order-0 order-md-1 text-end"><img class="pt-7 pt-md-0 w-100" src="{{asset('img/gallery/hero.png')}}" alt="hero-header" /></div>
            <div class="col-md-75 col-xl-6 col-xxl-5 text-md-start text-center py-6">
              <h1 class="fw-light font-base fs-6 fs-xxl-7">We're <strong>determined </strong>for<br />your&nbsp;<strong>better life.</strong></h1>
              <p class="fs-1 mb-5">You can get the care you need 24/7 – be it online or in <br />person. You will be treated by caring specialist doctors. </p><a class="btn btn-lg btn-primary rounded-pill" href="#appointment" role="button">Make an Appointment</a>
            </div>
          </div>
        </div>
      </section>


      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="py-5" id="departments">

        <div class="container">
          <div class="row">
            <div class="col-12 py-3">
              <div class="bg-holder bg-size" style="background-image:url({{asset('img/gallery/bg-departments.png')}});background-position:top center;background-size:contain;">
              </div>
              <!--/.bg-holder-->

              <h1 class="text-center">OUR DEPARTMENTS</h1>
            </div>
          </div>
        </div>
        <!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->




      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="py-0">

        <div class="container">
          <div class="py-5 align-items-center justify-content-center justify-content-lg-evenly">
            <div class="col-auto col-md-4 col-lg-auto">
              <div class="d-flex align-items-center">
                @foreach ( $dept as $depart )
           
                <div class="icon-box w-full align-text-center">
                  
                  <img class="mb-3" src="{{asset('department/'.$depart->dep_img)}}" width="60px" height="60px" />
                
                    <p class="fs-1 fs-xxl-2 mt-3">{{strtoupper($depart->dep_name)}}</p>
                
                
                </div>
                @endforeach
               </div>
                     
            
            </div>
          </div>
           
      
        <!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->


      <section class="bg-secondary">
        <div class="bg-holder" style="background-image:url({{asset('img/gallery/bg-eye-care.png')}});background-position:center;background-size:contain;">
        </div>
        <!--/.bg-holder-->

        <div class="container">
          <div class="row align-items-center">
            <div class="col-md-5 col-xxl-6"><img class="img-fluid" src="{{asset('img/gallery/eye-care.png')}}" alt="..." /></div>
            <div class="col-md-7 col-xxl-6 text-center text-md-start">
              <h2 class="fw-bold text-light mb-4 mt-4 mt-lg-0">Eye Care with Top Professionals<br class="d-none d-sm-block" />and In Budget.</h2>
              <p class="text-light">We've built a healthcare system that puts your needs first.<br class="d-none d-sm-block" />For us, there is nothing more important than the health of <br class="d-none d-sm-block" />you and your loved ones. </p>
              <div class="py-3"><a class="btn btn-lg btn-light rounded-pill" href="#!" role="button">Learn more </a></div>
            </div>
          </div>
        </div>
      </section>


      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="pb-0" id="about">

        <div class="container">
          <div class="row">
            <div class="col-12 py-3">
              <div class="bg-holder bg-size" style="background-image:url({{asset('img/gallery/about-us.png')}});background-position:top center;background-size:contain;">
              </div>
              <!--/.bg-holder-->

              <h1 class="text-center">ABOUT US</h1>
            </div>
          </div>
        </div>
        <!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->


      <section class="py-5">
        <div class="bg-holder bg-size" style="background-image:url({{asset('img/gallery/about-bg.png')}});background-position:top center;background-size:contain;">
        </div>
        <!--/.bg-holder-->

        <div class="container">
          <div class="row align-items-center">
            <div class="col-md-6 order-lg-1 mb-5 mb-lg-0"><img class="fit-cover rounded-circle w-100" src="{{asset('img/gallery/health-care.png')}}" alt="..." /></div>
            <div class="col-md-6 text-center text-md-start">
              <h2 class="fw-bold mb-4">We are developing a healthcare <br class="d-none d-sm-block" />system around you</h2>
              <p>We think that everyone should have easy access to excellent <br class="d-none d-sm-block" />healthcare. Our aim is to make the procedure as simple as <br class="d-none d-sm-block" />possible for our patients and to offer treatment no matter<br class="d-none d-sm-block" />where they are — in person or at their convenience. </p>
              <div class="py-3">
                <button class="btn btn-lg btn-outline-primary rounded-pill" type="submit">Learn more </button>
              </div>
            </div>
          </div>
        </div>
      </section>


      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="pb-0">

        <div class="container">
          <div class="row">
            <div class="col-12 py-3">
              <div class="bg-holder bg-size" style="background-image:url({{asset('img/gallery/doctors-us.png')}});background-position:top center;background-size:contain;">
              </div>
              <!--/.bg-holder-->

              <h1 class="text-center">OUR DOCTORS</h1>
            </div>
          </div>
        </div>
        <!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->


      <section class="py-5">
        <div class="bg-holder bg-size" style="background-image:url({{asset('img/gallery/doctors-bg.png')}});background-position:top center;background-size:contain;">
        </div>
        <!--/.bg-holder-->

        <div class="container">
          <div class="row flex-center">
            <div class="col-xl-10 px-0">
              <div class="carousel slide" id="carouselExampleDark" data-bs-ride="carousel"><a class="carousel-control-prev carousel-icon z-index-2" href="#carouselExampleDark" role="button" data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></a><a class="carousel-control-next carousel-icon z-index-2" href="#carouselExampleDark" role="button" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next</span></a>
                <div class="carousel-inner">
                  <div class="carousel-item active" data-bs-interval="10000">
                    <div class="row h-100 m-lg-7 mx-3 mt-6 mx-md-4 my-md-7">
                      <div class="col-md-4 mb-8 mb-md-0">
                        <div class="card card-span h-100 shadow">
                          <div class="card-body d-flex flex-column flex-center py-5"><img src="{{asset('img/gallery/anita.png')}}" width="128" alt="..." />
                            <h5 class="mt-3">Anita Deshai</h5>
                            <p class="mb-0 fs-xxl-1">Pediatrics, Gochi Medicine</p>
                            <p class="text-600 mb-0">Florida, United States</p>
                            <p class="text-600 mb-4">10 years experience</p>
                            <div class="text-center">
                              <button class="btn btn-outline-secondary rounded-pill" type="submit">View Profile</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4 mb-8 mb-md-0">
                        <div class="card card-span h-100 shadow">
                          <div class="card-body d-flex flex-column flex-center py-5"><img src="{{asset('img/gallery/jane.png')}}" width="128" alt="..." />
                            <h5 class="mt-3">Jane Flakis</h5>
                            <p class="mb-0 fs-xxl-1">Gynaecology, Abenka Care</p>
                            <p class="text-600 mb-0">Melbourne, Australia</p>
                            <p class="text-600 mb-4">12 years experience</p>
                            <div class="text-center">
                              <button class="btn btn-outline-secondary rounded-pill" type="submit">View Profile</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4 mb-8 mb-md-0">
                        <div class="card card-span h-100 shadow">
                          <div class="card-body d-flex flex-column flex-center py-5"><img src="{{asset('img/gallery/leo-mario.png')}}" width="128" alt="..." />
                            <h5 class="mt-3">Leo Mario</h5>
                            <p class="mb-0 fs-xxl-1">Physiotherapy, FitCare</p>
                            <p class="text-600 mb-0">London, England</p>
                            <p class="text-600 mb-4">25 years experience</p>
                            <div class="text-center">
                              <button class="btn btn-secondary hover-top rounded-pill border-0" type="submit">View Profile</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="carousel-item" data-bs-interval="2000">
                    <div class="row h-100 m-lg-7 mx-3 mt-6 mx-md-4 my-md-7">
                      <div class="col-md-4 mb-8 mb-md-0">
                        <div class="card card-span h-100 shadow">
                          <div class="card-body d-flex flex-column flex-center py-5"><img src="{{asset('img/gallery/anita.png')}}" width="128" alt="..." />
                            <h5 class="mt-3">Anita Deshai</h5>
                            <p class="mb-0 fs-xxl-1">Pediatrics, Gochi Medicine</p>
                            <p class="text-600 mb-0">Florida, United States</p>
                            <p class="text-600 mb-4">10 years experience</p>
                            <div class="text-center">
                              <button class="btn btn-outline-secondary rounded-pill" type="submit">View Profile</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4 mb-8 mb-md-0">
                        <div class="card card-span h-100 shadow">
                          <div class="card-body d-flex flex-column flex-center py-5"><img src="{{asset('img/gallery/jane.png')}}" width="128" alt="..." />
                            <h5 class="mt-3">Jane Flakis</h5>
                            <p class="mb-0 fs-xxl-1">Gynaecology, Abenka Care</p>
                            <p class="text-600 mb-0">Melbourne, Australia</p>
                            <p class="text-600 mb-4">12 years experience</p>
                            <div class="text-center">
                              <button class="btn btn-outline-secondary rounded-pill" type="submit">View Profile</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4 mb-8 mb-md-0">
                        <div class="card card-span h-100 shadow">
                          <div class="card-body d-flex flex-column flex-center py-5"><img src="{{asset('img/gallery/leo-mario.png')}}" width="128" alt="..." />
                            <h5 class="mt-3">Leo Mario</h5>
                            <p class="mb-0 fs-xxl-1">Physiotherapy, FitCare</p>
                            <p class="text-600 mb-0">London, England</p>
                            <p class="text-600 mb-4">25 years experience</p>
                            <div class="text-center">
                              <button class="btn btn-secondary hover-top rounded-pill border-0" type="submit">View Profile</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <div class="row h-100 m-lg-7 mx-3 mt-6 mx-md-4 my-md-7">
                      <div class="col-md-4 mb-8 mb-md-0">
                        <div class="card card-span h-100 shadow">
                          <div class="card-body d-flex flex-column flex-center py-5"><img src="{{asset('img/gallery/anita.png')}}" width="128" alt="..." />
                            <h5 class="mt-3">Anita Deshai</h5>
                            <p class="mb-0 fs-xxl-1">Pediatrics, Gochi Medicine</p>
                            <p class="text-600 mb-0">Florida, United States</p>
                            <p class="text-600 mb-4">10 years experience</p>
                            <div class="text-center">
                              <button class="btn btn-outline-secondary rounded-pill" type="submit">View Profile</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4 mb-8 mb-md-0">
                        <div class="card card-span h-100 shadow">
                          <div class="card-body d-flex flex-column flex-center py-5"><img src="{{asset('img/gallery/jane.png')}}" width="128" alt="..." />
                            <h5 class="mt-3">Jane Flakis</h5>
                            <p class="mb-0 fs-xxl-1">Gynaecology, Abenka Care</p>
                            <p class="text-600 mb-0">Melbourne, Australia</p>
                            <p class="text-600 mb-4">12 years experience</p>
                            <div class="text-center">
                              <button class="btn btn-outline-secondary rounded-pill" type="submit">View Profile</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4 mb-8 mb-md-0">
                        <div class="card card-span h-100 shadow">
                          <div class="card-body d-flex flex-column flex-center py-5"><img src="{{asset('img/gallery/leo-mario.png')}}" width="128" alt="..." />
                            <h5 class="mt-3">Leo Mario</h5>
                            <p class="mb-0 fs-xxl-1">Physiotherapy, FitCare</p>
                            <p class="text-600 mb-0">London, England</p>
                            <p class="text-600 mb-4">25 years experience</p>
                            <div class="text-center">
                              <button class="btn btn-secondary hover-top rounded-pill border-0" type="submit">View Profile</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>


      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="py-5">

        <div class="container">
          <div class="row">
            <div class="col-12 py-3">
              <div class="bg-holder bg-size" style="background-image:url({{asset('img/gallery/people.png')}});background-position:top center;background-size:contain;">
              </div>
              <!--/.bg-holder-->

              <h1 class="text-center">PEOPLE WHO LOVE US</h1>
            </div>
          </div>
        </div>
        <!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->


      <section class="py-8">
        <div class="bg-holder bg-size" style="background-image:url({{asset('img/gallery/people-bg-1.png')}});background-position:center;background-size:cover;">
        </div>
        <!--/.bg-holder-->

        <div class="container">
          <div class="row align-items-center offset-sm-1">
            <div class="carousel slide" id="carouselPeople" data-bs-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="10000">
                  <div class="row h-100">
                    <div class="col-sm-3 text-center"><img src="{{asset('img/gallery/people-who-loves.png')}}" width="100" alt="" />
                      <h5 class="mt-3 fw-medium text-secondary">Edward Newgate</h5>
                      <p class="fw-normal mb-0">Founder Circle</p>
                    </div>
                    <div class="col-sm-9 text-center text-sm-start pt-3 pt-sm-0">
                      <h2>Fantastic Response!</h2>
                      <div class="my-2"><i class="fas fa-star me-2"></i><i class="fas fa-star me-2"></i><i class="fas fa-star me-2"></i><i class="fas fa-star-half-alt me-2"></i><i class="far fa-star"></i></div>
                      <p>This medical and health care facility distinguishes itself from the competition by providing technologically advanced medical and health care. A mobile app and a website are available via which you can easily schedule appointments, get online consultations, and see physicians, who will assist you through the whole procedure. And all of the prescriptions, medications, and other services they offer are 100% genuine, medically verified, and proved. I believe that the Doctor App staff is doing an outstanding job. Highly recommended their health care services.</p>
                    </div>
                  </div>
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                  <div class="row h-100">
                    <div class="col-sm-3 text-center"><img src="{{asset('img/gallery/people-who-loves.png')}}" width="100" alt="" />
                      <h5 class="mt-3 fw-medium text-secondary">Jhon Doe</h5>
                      <p class="fw-normal mb-0">UI/UX Designer</p>
                    </div>
                    <div class="col-sm-9 text-center text-sm-start pt-3 pt-sm-0">
                      <h2>Fantastic Response!</h2>
                      <div class="my-2"><i class="fas fa-star me-2"></i><i class="fas fa-star me-2"></i><i class="fas fa-star me-2"></i><i class="fas fa-star-half-alt me-2"></i><i class="far fa-star"></i></div>
                      <p>This medical and health care facility distinguishes itself from the competition by providing technologically advanced medical and health care. A mobile app and a website are available via which you can easily schedule appointments, get online consultations, and see physicians, who will assist you through the whole procedure. And all of the prescriptions, medications, and other services they offer are 100% genuine, medically verified, and proved. I believe that the Doctor App staff is doing an outstanding job. Highly recommended their health care services.</p>
                    </div>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="row h-100">
                    <div class="col-sm-3 text-center"><img src="{{asset('img/gallery/people-who-loves.png')}}" width="100" alt="" />
                      <h5 class="mt-3 fw-medium text-secondary">Jeny Doe</h5>
                      <p class="fw-normal mb-0">Web Designer</p>
                    </div>
                    <div class="col-sm-9 text-center text-sm-start pt-3 pt-sm-0">
                      <h2>Fantastic Response!</h2>
                      <div class="my-2"><i class="fas fa-star me-2"></i><i class="fas fa-star me-2"></i><i class="fas fa-star me-2"></i><i class="fas fa-star-half-alt me-2"></i><i class="far fa-star"></i></div>
                      <p>This medical and health care facility distinguishes itself from the competition by providing technologically advanced medical and health care. A mobile app and a website are available via which you can easily schedule appointments, get online consultations, and see physicians, who will assist you through the whole procedure. And all of the prescriptions, medications, and other services they offer are 100% genuine, medically verified, and proved. I believe that the Doctor App staff is doing an outstanding job. Highly recommended their health care services.</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="position-relative z-index-2 mt-5">
                  <ol class="carousel-indicators">
                    <li class="active" data-bs-target="#carouselPeople" data-bs-slide-to="0"></li>
                    <li data-bs-target="#carouselPeople" data-bs-slide-to="1"></li>
                    <li data-bs-target="#carouselPeople" data-bs-slide-to="2"> </li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>


      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="py-5" id="appointment">

        <div class="container">
          <div class="row">
            <div class="col-12 py-3">
              <div class="bg-holder bg-size" style="background-image:url({{asset('img/gallery/people.png')}});background-position:top center;background-size:contain;">
              </div>
              <!--/.bg-holder-->

              <h1 class="text-center">APPOINTMENT</h1>
            </div>
          </div>
        </div>
        <!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->


      <section class="py-8">
        <div class="container">
          @if(!auth()->user())
          <div class="col-md-4 offset-md-4 text-center px-2 py-3 border-5 border-info">
           <h2>you have to <a href="{{route('register')}}"> Sign In</a> first!</h2>
          </div>
          @else
          <div class="row">
            <div class="bg-holder bg-size" style="background-image:url({{asset('img/gallery/dot-bg.png')}});background-position:bottom right;background-size:auto;">
            </div>
            <!--/.bg-holder-->
           
            <div class="col-lg-6 z-index-2 mb-5"><img class="w-100" src="{{asset('img/gallery/appointment.png')}}" alt="..." /></div>
            <div class="col-lg-6 z-index-2">
              <form action="{{route('book.app')}}" method="post" class="row g-3">
            
                @csrf
                <div class="col-md-6">
                  <label class="visually-hidden" for="inputName">Name</label>
                  <input class="form-control form-Doctor App-control" id="inputName" name="pname" type="text" placeholder="Enter Your Name" />
                 <span>
                  @error('pname')
                  <div class="alert alert-info mt-1 text-center">
                      {{$message}}
                    </div>
                  @enderror
                </span>
                </div>
                <div class="col-md-6">
                  <label class="visually-hidden" for="inputPhone">Phone</label>
                  <input class="form-control form-Doctor App-control" id="inputPhone" name="phone" type="text" placeholder="Enter Your Moblie No." />
                  <span>
                    @error('phone')
                    <div class="alert alert-info mt-1 text-center">
                        {{$message}}
                      </div>
                    @enderror
                  </span>
                </div>
                <div class="col-md-6">
                  <label class="form-label visually-hidden" for="inputCategory">Department</label>
                  <select class="form-select" id="inputCategory" name="pdepart" >
                    <option selected="selected">Department</option>
                    @foreach ($dept as $dep )
                    <option> {{$dep->dep_name}} </option>
                    @endforeach
                 </select>
                 <span>
                  @error('pdepart')
                  <div class="alert alert-info mt-1 text-center">
                      {{$message}}
                    </div>
                  @enderror
                </span>
                </div>
                <div class="col-md-6">
                  <label class="form-label visually-hidden" for="inputEmail">Email</label> 
                  <input class="form-control form-Doctor App-control" id="inputEmail" type="email" name="pemail" placeholder="Enter Your Email" />
                  <span>
                    @error('pemail')
                    <div class="alert alert-info mt-1 text-center">
                        {{$message}}
                      </div>
                    @enderror
                  </span>
                </div>
                <div class="col-md-12">
                  <label class="form-label visually-hidden" for="validationTextarea">Date</label>
                  <input class="form-control form-Doctor App-control" id="validationTextarea" type="date" name="pdes" placeholder="Message"  required="required"/>
                  <span>
                    @error('pdes')
                    <div class="alert alert-info mt-1 text-center">
                        {{$message}}
                      </div>
                    @enderror
                  </span>
                </div>
                <div class="col-12">
                  <div class="d-grid">
                    <button class="btn btn-primary rounded-pill" type="submit">Book Appointment</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        @endif
      </section>


      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="py-5">

        <div class="container">
          <div class="row">
            <div class="col-12 py-3">
              <div class="bg-holder bg-size" style="background-image:url({{asset('img/gallery/blog-post.png')}});background-position:top center;background-size:contain;">
              </div>
              <!--/.bg-holder-->

              <h1 class="text-center">RECENT BLOGPOSTS</h1>
            </div>
          </div>
        </div>
        <!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->


      <section>
        <div class="bg-holder bg-size" style="background-image:url({{asset('img/gallery/dot-bg.png')}});background-position:top left;background-size:auto;">
        </div>
        <!--/.bg-holder-->

        <div class="container">
          <div class="row">
            <div class="col-sm-6 col-lg-3 mb-4">
              <div class="card h-100 shadow card-span rounded-3"><img class="card-img-top rounded-top-3" src="{{asset('img/gallery/covid-19.png')}}" alt="news" />
                <div class="card-body"><span class="fs--1 text-primary me-3">Health</span>
                  <svg class="bi bi-calendar2 me-2" xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z"></path>
                    <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z"> </path>
                  </svg><span class="fs--1 text-900">Nov 21, 2021</span><span class="fs--1"></span>
                  <h5 class="font-base fs-lg-0 fs-xl-1 my-3">COVID-19: The Most Up-to-Date Information</h5><a class="stretched-link" href="#!">read full article</a>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3 mb-4">
              <div class="card h-100 shadow card-span rounded-3"><img class="card-img-top rounded-top-3" src="{{asset('img/gallery/laboratories.png')}}" alt="news" />
                <div class="card-body"><span class="fs--1 text-primary me-3">Lifestyle</span>
                  <svg class="bi bi-calendar2 me-2" xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z"></path>
                    <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z"> </path>
                  </svg><span class="fs--1 text-900">Nov 25, 2021</span><span class="fs--1"></span>
                  <h5 class="font-base fs-lg-0 fs-xl-1 my-3">Importance of Accreditation for Laboratories</h5><a class="stretched-link" href="#!">read full article</a>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3 mb-4">
              <div class="card h-100 shadow card-span rounded-3"><img class="card-img-top rounded-top-3" src="{{asset('img/gallery/nicotine.png')}}" alt="news" />
                <div class="card-body"><span class="fs--1 text-primary me-3">Health</span>
                  <svg class="bi bi-calendar2 me-2" xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z"></path>
                    <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z"> </path>
                  </svg><span class="fs--1 text-900">Nov 28, 2021</span><span class="fs--1"></span>
                  <h5 class="font-base fs-lg-0 fs-xl-1 my-3">The dangers of nicotine are addressed in depth</h5><a class="stretched-link" href="#!">read full article</a>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3 mb-4">
              <div class="card h-100 shadow card-span rounded-3"><img class="card-img-top rounded-top-3" src="{{asset('img/gallery/treatment.png')}}" alt="news" />
                <div class="card-body"><span class="fs--1 text-primary me-3">Health</span>
                  <svg class="bi bi-calendar2 me-2" xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z"></path>
                    <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z"> </path>
                  </svg><span class="fs--1 text-900">Nov 30, 2021</span><span class="fs--1"></span>
                  <h5 class="font-base fs-lg-0 fs-xl-1 my-3">Treatment of patients with diabetes during COVID-19</h5><a class="stretched-link" href="#!">read full article</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="bg-primary">
        <div class="bg-holder bg-size" style="background-image:url({{asset('img/gallery/cta-bg.png')}});background-position:center right;margin-top:-8.125rem;background-size:contain;">
        </div>
        <!--/.bg-holder-->

        <div class="container">
          <div class="row">
            <div class="col-lg-6">
              <h2 class="fw-bold text-light">Get an update every week</h2>
              <p class="text-soft-primary">Doctor App was created in order to improve the patient experience. <br />Providing world-class tests, and a wide range of other services.</p>
            </div>
            <div class="col-lg-6">
              <h5 class="mb-3 text-soft-primary">SUBSCRIBE TO NEWSLETTER </h5>
              <form class="row gx-2 gy-2 align-items-center">
                <div class="col">
                  <div class="input-group-icon">
                    <label class="visually-hidden" for="inputEmailCta">Address</label>
                    <input class="form-control form-Doctor App-control form-cta-control text-soft-primary" id="inputEmailCta" type="email" placeholder="Email" />
                  </div>
                </div>
                <div class="d-grid gap-3 col-sm-auto">
                  <button class="btn btn-lg btn-light rounded-3 px-5 py-3" type="submit">Subscribe</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
      <section class="py-0 bg-secondary">
        <div class="bg-holder opacity-25" style="background-image:url({{asset('img/gallery/dot-bg.png')}});background-position:top left;margin-top:-3.125rem;background-size:auto;">
        </div>
        <!--/.bg-holder-->

        <div class="container">
          <div class="row py-8">
            <div class="col-12 col-sm-12 col-lg-6 mb-4 order-0 order-sm-0"><a class="text-decoration-none" href="#"><img src="{{asset('img/gallery/footer-logo.png')}}" height="51" alt="" /></a>
              <p class="text-light my-4">The world's most trusted <br />telehealth company.</p>
            </div>
            <div class="col-6 col-sm-4 col-lg-2 mb-3 order-2 order-sm-1">
              <h5 class="lh-lg fw-bold mb-4 text-light font-sans-serif">Departments</h5>
              <ul class="list-unstyled mb-md-4 mb-lg-0">
                <li class="lh-lg"><a class="footer-link" href="#!">Eye care</a></li>
                <li class="lh-lg"><a class="footer-link" href="#!">Cardiac are</a></li>
                <li class="lh-lg"><a class="footer-link" href="#!">Heart care</a></li>
              </ul>
            </div>
            <div class="col-6 col-sm-4 col-lg-2 mb-3 order-3 order-sm-2">
              <h5 class="lh-lg fw-bold text-light mb-4 font-sans-serif">Membership</h5>
              <ul class="list-unstyled mb-md-4 mb-lg-0">
                <li class="lh-lg"><a class="footer-link" href="#!">Free trial</a></li>
                <li class="lh-lg"><a class="footer-link" href="#!">Silver</a></li>
                <li class="lh-lg"><a class="footer-link" href="#!">Premium</a></li>
              </ul>
            </div>
            <div class="col-6 col-sm-4 col-lg-2 mb-3 order-3 order-sm-2">
              <h5 class="lh-lg fw-bold text-light mb-4 font-sans-serif"> Customer Care</h5>
              <ul class="list-unstyled mb-md-4 mb-lg-0">
                <li class="lh-lg"><a class="footer-link" href="#!">About Us</a></li>
                <li class="lh-lg"><a class="footer-link" href="#!">Contact US</a></li>
                <li class="lh-lg"><a class="footer-link" href="#!">Get Update</a></li>
              </ul>
            </div>
          </div>
        </div>


        <!-- ============================================-->
        <!-- <section> begin ============================-->
        <section class="py-0 bg-primary">

          <div class="container">
            <div class="row justify-content-md-between justify-content-evenly py-4">
              <div class="col-12 col-sm-8 col-md-6 col-lg-auto text-center text-md-start">
                <p class="fs--1 my-2 fw-bold text-200">All rights Reserved &copy; Your Company, 2021</p>
              </div>
              <div class="col-12 col-sm-8 col-md-6">
                <p class="fs--1 my-2 text-center text-md-end text-200"> Made with&nbsp;
                  <svg class="bi bi-suit-heart-fill" xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="#F95C19" viewBox="0 0 16 16">
                    <path d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1z"></path>
                  </svg>&nbsp;by&nbsp;<a class="fw-bold text-info" href="https://themewagon.com/" target="_blank">ThemeWagon </a>
                </p>
              </div>
            </div>
          </div>
          <!-- end of .container-->

        </section>
        <!-- <section> close ============================-->
        <!-- ============================================-->


      </section>
    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->



    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="{{asset('vendors/@popperjs/popper.min.js')}}"></script>
    <script src="{{asset('vendors/bootstrap/bootstrap.min.js')}}"></script>
    <script src="{{asset('vendors/is/is.min.js')}}"></script>
    <script src="https://scripts.sirv.com/sirvjs/v3/sirv.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="{{asset('vendors/fontawesome/all.min.js')}}"></script>
    <script src="{{asset('js/theme.js')}}"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&amp;family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100&amp;display=swap" rel="stylesheet">
  </body>

</html>