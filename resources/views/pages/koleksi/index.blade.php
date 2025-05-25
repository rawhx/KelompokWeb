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
                @foreach ($koleksis as $koleksi)
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <h5>{{ $koleksi->koleksi_nama }}</h5>

                        <div class="d-flex gap-2 w-full justify-content-end">
                            {{-- Tombol Edit --}}
                            <a href="{{ route('koleksiEdit', $koleksi->id) }}" class="btn text-secondary p-0 text-decoration-none">Edit</a>

                            {{-- Tombol Hapus --}}
                            <form action="{{ route('koleksiDelete') }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus koleksi ini?')">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $koleksi->id }}">
                                <button type="submit" class="btn text-danger p-0 text-decoration-none">Hapus</button>
                            </form>
                        </div>
                    </div>

                    <div class="bento-grid">
                        @foreach ($koleksi->data as $data)
                            @if ($data->image)
                                <div class="bento-item">
                                    <a href="{{ route('detailPost', $data->image->id) }}">
                                        <img src="{{ asset('storage/images/' . $data->image->path) }}" alt="Foto {{ $data->image->judul }}">

                                        <div class="overlay">
                                            <span class="image-title">{{ $data->image->judul }}</span>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endforeach

            </div>
        </section>
    </body>
</html>