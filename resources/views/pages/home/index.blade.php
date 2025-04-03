<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('components.head')
    <style>
    </style>
    <body>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show position-absolute" style="top: 20px;right: 30px;" role="alert">
                <strong>Success!</strong>  {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <section class="d-flex">
            @include('components.sidebar')
            <div>
                <div class="shadow-sm pb-3 px-3 position-sticky bg-white top-0" style="padding-top: 2.3em">
                    <div class="px-3 d-flex gap-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search..." >
                        </div>
                        <a href="{{route('profil')}}" class="bg-info position-relative overflow-hidden" style="border-radius: 50%; width: 50px; height: 50px; aspect-ratio: 1/1;">
                            <img src="{{ auth()->user()->foto_profil ? asset('storage/profile_pictures/' . auth()->user()->foto_profil) : 'https://via.placeholder.com/150' }}" class="w-100 h-100 position-absolute top-0 start-0" 
                            style="object-fit: cover; object-position: center;" 
                            alt="profil">
                        </a>
                    </div>
                </div>
        
                <div class="pb-3 pt-4 px-3 d-flex flex-column gap-3">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Minima sint amet quod doloribus quidem eos, velit temporibus suscipit sapiente molestiae provident ducimus cupiditate repellendus est incidunt, magni a earum reprehenderit!
                </div>
            </div>
        </section>
    </body>
</html>