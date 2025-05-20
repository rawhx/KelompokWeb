<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('components.head')
    <style>
    </style>
    <body>
        @include('components.notif')
        <section class="d-flex">
            {{-- @include('components.sidebar') --}}
            <div class="vw-100">
                
        
                <div class="pb-3 pt-4 px-3 d-flex gap-5 align-items-start">
                    <div id="imagePreview" 
                        class="position-relative overflow-hidden d-block bg-danger" 
                        style="border-radius: 20px; width: max-content; max-width: 300px; height: auto;">
                        <img src="https://media.istockphoto.com/id/1409329028/vector/no-picture-available-placeholder-thumbnail-icon-illustration-design.jpg?s=612x612&w=0&k=20&c=_zOuJu755g2eEUioiOUdz_mHKJQJn-tDgIAhQzyeKUQ=" 
                            id="previewImg" 
                            class="w-100"
                            style="height: auto; object-fit: contain; border-radius: inherit; max-height: 500px;"
                            alt="preview">
                    </div>

               
                    <form action="" method="POST" class="row gap-3 w-100" enctype="multipart/form-data">
                        @csrf
                       
                        <div class="form-outline col-12">
                            <label class="form-label" for="judul">Judul Foto</label>
                            <input type="text" name="judul" id="judul" class="form-control" placeholder="Judul Foto"/>
                        </div>
                        
                        <div class="form-outline col-12">
                            <label class="form-label" for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" placeholder="Deskripsi foto" name="deskripsi" id="deskripsi" style="height: 100px"></textarea>
                        </div>

                        <div class="form-outline col-12">
                            <label class="form-label" for="path">Foto</label>
                            <input type="file" id="path" name="path" class="form-control" accept="image/*">
                        </div>
            
                        <button type="submit" class="btn btn-primary btn-lg col-12">Upload</button>                        
                    </form>
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </body>
    <script>
        document.getElementById('path').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const imgURL = URL.createObjectURL(file);
                document.getElementById('previewImg').src = imgURL;
            }
        });
    </script>
</html>