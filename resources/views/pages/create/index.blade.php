<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('components.head')
    <style>
    </style>
    <body>
        @include('components.notif')
        @include('components.header')
        <section class="d-flex flex-column gap-3">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="font-semibold heading-underline">Tambah Postingan</h4>
            </div>
            <div class="d-flex justify-content-center">
                <div class="pb-3 gap-3 px-3 position-sticky row justify-content-center top-0" style="padding-top: 2.3em;width:50%">
                    <div id="imagePreview" 
                        class="col-12 position-relative overflow-hidden d-block  
                        style="border-radius: 20px; width: max-content; height: auto;">
                        <img src="https://media.istockphoto.com/id/1409329028/vector/no-picture-available-placeholder-thumbnail-icon-illustration-design.jpg?s=612x612&w=0&k=20&c=_zOuJu755g2eEUioiOUdz_mHKJQJn-tDgIAhQzyeKUQ=" 
                            id="previewImg" 
                            class="w-100"
                            style="height: auto; object-fit: contain; border-radius: inherit; max-height: 500px;"
                            alt="preview">
                    </div>
                    <form action="" method="POST" class="row col-12 gap-3 w-100" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-outline col-12">
                            <label class="form-label" for="judul">Judul</label>
                            <input type="text" name="judul" id="judul" class="form-control" placeholder="Judul Foto"/>
                        </div>
                        
                        <div class="form-outline col-12">
                            <label class="form-label" for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" placeholder="Deskripsi foto" name="deskripsi" id="deskripsi" style="height: 100px"></textarea>
                        </div>
    
                        <div class="d-flex gap-2">
                            <button class="btn btn-outline-primary px-3 py-2" for="path">Pilih Gambar</button>
                            <button type="submit" class="btn btn-primary px-3 py-2">Upload</button>                        
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </body>
</html>