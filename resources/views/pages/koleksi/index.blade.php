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
                <h4 class="font-semibold heading-underline">Koleksi</h4>
                <a href="{{ route('koleksiAddPage') }}" class="btn btn-outline-dark fw-semibold">Tambah Koleksi</a>
            </div>
            <div>
                <div>

                </div>
            </div>
        </section>
    </body>
</html>
