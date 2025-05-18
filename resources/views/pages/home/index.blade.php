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
        @include('components.header')
        <section class="d-flex flex-column gap-3">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="font-semibold heading-underline">Dashboard</h4>
                <button class="btn btn-outline-dark fw-semibold">Tambah Postingan</button>
            </div>
            <div class="bento-grid">
                @foreach (range(1, 200) as $item)
                    @php
                        $width = rand(150, 400);
                        $height = rand(150, 300);
                    @endphp
                    <div class="bento-item">
                        <img src="https://placehold.jp/{{ $width }}x{{ $height }}.png" alt="Foto {{ $item }}">
                    </div>
                @endforeach

            </div>
        </section>
    </body>
</html>