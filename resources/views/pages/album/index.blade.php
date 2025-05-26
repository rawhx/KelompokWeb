<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('components.head')
    <style>
        .custom-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.5rem;
        }
        .grid-3 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
        }
    </style>
    <body>
        @include('components.notif')
        @include('components.header')
        <section class="d-flex flex-column gap-3">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="font-semibold heading-underline">Album</h4>
                <a href="{{ route('albumAddPage') }}" class="btn btn-outline-dark fw-semibold">Tambah Album</a>
            </div>
            <div class="grid-3">
                <div class="px-3 py-3" style="border: 1px solid black; border-radius: 15px;">
                    <div>
                        <h6>Default</h6>
                    </div>
                    <div class="custom-grid">
                        @foreach ($images as $image)
                            <div class="rounded d-flex justify-content-center align-items-center" style="background-color: whitesmoke; height: 10rem;">
                                <img src="{{ asset('storage/images/' . $image->path) }}" alt="gambar" style="width: 100%; height: 100%; object-fit: contain; border-radius: 8px;">
                            </div>
                        @endforeach
                    </div>
                </div>
                @foreach ($albums as $item)
                    <div class="px-3 py-3" style="border: 1px solid black; border-radius: 15px;">
                        <div class="d-flex justify-content-between">
                            <h6 class="text-capitalize">{{ $item->album_nama }}</h6>
                            <div class="d-flex gap-2 w-full justify-content-end">
                                {{-- Tombol Edit --}}
                                <a href="{{ route('albumEdit', $item->id) }}" class="btn text-secondary p-0 text-decoration-none">Edit</a>

                                {{-- Tombol Hapus --}}
                                <form action="{{ route('albumDelete') }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus album ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                    <button type="submit" class="btn text-danger p-0 text-decoration-none">Hapus</button>
                                </form>
                            </div>
                        </div>
                        <div class="custom-grid">
                            @foreach ($item->data as $data)
                                <div class="rounded d-flex justify-content-center align-items-center" style="background-color: whitesmoke; height: 10rem;">
                                    <img src="{{ asset('storage/images/' . $data->image->path) }}" alt="gambar" style="width: 100%; height: 100%; object-fit: contain; border-radius: 8px;">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </body>
</html>