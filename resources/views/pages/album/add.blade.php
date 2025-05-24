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
                <h4 class="font-semibold heading-underline">Tambah Album</h4>
            </div>
            <form method="POST" action="{{ route('albumPage') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-6 col-md-3">
                        <div class="form-check">
                            <input class="form-check-input d-none" type="checkbox" name="photos[]" value=" " id="photo">
                            <label class="form-check-label" for="photo">
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul" required>
                </div>

                <div class="d-flex gap-2 mt-3">
                    <a href="/" class="btn btn-outline-primary">Pilih Gambar</a>
                    <button type="submit" class="btn btn-primary">Selesai</button>
                </div>
            </form>
        </section>
    </body>
</html>
