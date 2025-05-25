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
                <h4 class="font-semibold heading-underline">Dashboard</h4>
                <a href="{{ route('createPage') }}" class="btn btn-outline-dark fw-semibold">Tambah Postingan</a>
            </div>
            <div class="bento-grid">
                @foreach ($images as $image)
                    <div class="bento-item">
                        <a href="{{ route('detailPost', $image->id) }}">
                            <img src="{{ asset('storage/images/' . $image->path) }}" alt="Foto {{ $image->judul }}">

                            <div class="overlay">
                                <span class="image-title">{{ $image->judul }}</span>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
    </body>
</html>