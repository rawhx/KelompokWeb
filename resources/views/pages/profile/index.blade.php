<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('components.head')
    <style>
    </style>
    <body>
        @include('components.notif')
        <section class="d-flex">
            @include('components.sidebar')
            <div class="vw-100">
                <div class="shadow-sm pb-3 px-3 position-sticky bg-white top-0" style="padding-top: 2.3em">
                    <div class="px-3 d-flex justify-content-end gap-3">
                        <a href="{{route('profil')}}" class="bg-info position-relative overflow-hidden" style="border-radius: 50%; width: 50px; height: 50px; aspect-ratio: 1/1;">
                            <img src="{{ auth()->user()->foto_profil ? asset('storage/profile_pictures/' . auth()->user()->foto_profil) : 'https://via.placeholder.com/150' }}" class="w-100 h-100 position-absolute top-0 start-0" 
                            style="object-fit: cover; object-position: center;" 
                            alt="profil">
                        </a>
                    </div>
                </div>
        
                <div class="pb-3 pt-4 px-3 d-flex gap-3 align-items-start">
                    <div class="d-flex gap-3 align-items-center position-sticky" style="top: 8em;">
                        <div class="bg-info position-relative overflow-hidden" style="border-radius: 50%; width: 8em; height: 8em; aspect-ratio: 1/1;">
                            <img src="{{ auth()->user()->foto_profil ? asset('storage/profile_pictures/' . auth()->user()->foto_profil) : 'https://via.placeholder.com/150' }}" class="w-100 h-100 position-absolute top-0 start-0" 
                            style="object-fit: cover; object-position: center;" 
                            alt="profil">
                        </div>
                        <div class="d-flex flex-column gap-2">
                            <h1 class="m-0 fw-bold text-capitalize">{{auth()->user()->username}} </h1>
                            <p class="m-0">{{auth()->user()->email}}</p>
                        </div>
                        <a href="{{route('editProfil')}}" class="text-dark">
                            <i class="bi bi-pencil-square fs-2"></i>
                        </a>
                    </div>
                    <div class="bg-danger w-100 vh-100"></div>
                </div>
            </div>
        </section>
    </body>
</html>