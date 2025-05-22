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
                <h4 class="font-semibold heading-underline">Edit Postingan</h4>
            </div>
            <div class="d-flex justify-content-center">
                <div class="pb-3 gap-3 px-3 position-sticky row justify-content-center top-0" style="padding-top: 2.3em;width:50%">
                    <div id="imagePreview" 
                        class="col-12 position-relative overflow-hidden d-block  
                        style="border-radius: 20px; width: max-content; height: auto;">
                        <img src="{{ asset('storage/images/' . $image->path) }}" 
                            id="previewImg"
                            class="w-100"
                            style="height: auto; object-fit: contain; border-radius: 20px; max-height: 500px;"
                            alt="preview">
                    </div>
                    <form action="{{ route('UpdateImage', $image->id) }}" method="POST" class="row col-12 gap-3 w-100" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-outline col-12">
                            <label class="form-label" for="judul">Judul</label>
                            <input type="text" name="judul" id="judul" class="form-control" placeholder="Judul Foto" value="{{ $image->judul }}"/>
                        </div>
                        
                        <div class="form-outline col-12">
                            <label class="form-label" for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" placeholder="Deskripsi foto" name="deskripsi" id="deskripsi" style="height: 100px">{{ $image->deskripsi }}</textarea>
                        </div>
    
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-3 py-2">Update</button>                        
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </body>
</html>