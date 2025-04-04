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
                    <div class="px-3 d-flex justify-content-between align-items-center gap-3">
                        <h5>Upload Foto</h5>
                        <a href="{{route('profil')}}" class="bg-info position-relative overflow-hidden" style="border-radius: 50%; width: 50px; height: 50px; aspect-ratio: 1/1;">
                            <img src="{{ auth()->user()->foto_profil ? asset('storage/profile_pictures/' . auth()->user()->foto_profil) : 'https://via.placeholder.com/150' }}" class="w-100 h-100 position-absolute top-0 start-0" 
                            style="object-fit: cover; object-position: center;" 
                            alt="profil">
                        </a>
                    </div>
                </div>
        
                <div class="pb-3 pt-4 px-3 d-flex gap-5 align-items-start">
                    <div id="imagePreview" 
                        class="position-relative overflow-hidden d-block bg-danger" 
                        style="border-radius: 20px; width: max-content; max-width: 300px; height: auto;">
                        <img src="https://media.istockphoto.com/id/1409329028/vector/no-picture-available-placeholder-thumbnail-icon-illustration-design.jpg?s=612x612&w=0&k=20&c=_zOuJu755g2eEUioiOUdz_mHKJQJn-tDgIAhQzyeKUQ=" 
                            id="previewImg" 
                            class="w-100"
                            style="height: auto; object-fit: contain; border-radius: inherit; max-height: 500px;"
                            alt="profil">
                    </div>

               
                    <form action="{{route('updateProfil')}}" method="POST" class="row gap-3 w-100" enctype="multipart/form-data">
                        @csrf
                       
                        <div class="form-outline col-12">
                            <label class="form-label" for="email">Judul Foto</label>
                            <input type="email" name="email" id="email" class="form-control form-control" placeholder="Judul Foto"/>
                        </div>
                        
                        <div class="form-outline col-12">
                            <label class="form-label" for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" placeholder="Deskripsi foto" id="deskripsi" style="height: 100px"></textarea>
                        </div>

                        <div class="form-outline col-12">
                            <label class="form-label" for="username">Foto</label>
                            <input type="file" id="imageInput" name="foto_profil" class="form-control" accept="image/*">
                        </div>
            
                        <button type="submit" class="btn btn-primary btn-lg col-12">Upload</button>                        
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