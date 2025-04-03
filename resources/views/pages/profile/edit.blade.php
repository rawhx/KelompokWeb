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
                        <div class="bg-info position-relative overflow-hidden" style="border-radius: 50%; width: 50px; height: 50px; aspect-ratio: 1/1;">
                            <img src="{{ auth()->user()->foto_profil ? asset('storage/profile_pictures/' . auth()->user()->foto_profil) : 'https://via.placeholder.com/150' }}" class="w-100 h-100 position-absolute top-0 start-0" 
                            style="object-fit: cover; object-position: center;" 
                            alt="profil">
                        </div>
                    </div>
                </div>
        
                <div class="pb-3 pt-4 px-3 d-flex flex-column align-items-center">
                    <a id="imagePreview" class="bg-info position-relative overflow-hidden d-block" style="border-radius: 50%; width: 200px; height: 200px; aspect-ratio: 1/1;">
                        <img src="{{ auth()->user()->foto_profil ? asset('storage/profile_pictures/' . auth()->user()->foto_profil) : 'https://via.placeholder.com/150' }}" id="previewImg" class="w-100 h-100 position-absolute top-0 start-0" style="object-fit: cover; object-position: center;" alt="profil">
                    </a>
                    <form action="{{route('updateProfil')}}" method="POST" class="row gap-3 w-100" enctype="multipart/form-data">
                        @csrf
                        <!-- Email input -->
                        <div class="form-outline col-12">
                            <label class="form-label" for="email">Email address</label>
                            <input type="email" name="email" id="email" class="form-control form-control-lg" placeholder="Enter email address" value="{{auth()->user()->email}}" readonly/>
                        </div>

                        <!-- Username input -->
                        <div class="form-outline col-12">
                            <label class="form-label" for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control form-control-lg" placeholder="Enter username" value="{{auth()->user()->username}}" required/>
                        </div>

                        <div class="form-outline col-12">
                            <label class="form-label" for="username">Profil</label>
                            <input type="file" id="imageInput" name="foto_profil" class="form-control" accept="image/*">
                        </div>
            
                        <button type="submit" class="btn btn-primary btn-lg col-12">Update</button>                        
                    </form>
                </div>
            </div>
        </section>
    </body>
    <script>
        document.getElementById('imageInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const imgURL = URL.createObjectURL(file);
                document.getElementById('previewImg').src = imgURL;
            }
        });
    </script>
</html>