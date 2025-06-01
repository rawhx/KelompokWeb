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
                <div onclick="detailAlbum()" class="px-3 py-3 cursor-pointer" style="border: 1px solid black; border-radius: 15px;">
                    <div>
                        <h6>Default</h6>
                    </div>
                    @if ($images && count($images) > 0)
                        <div class="custom-grid">
                            @foreach ($images as $image)
                                <div class="rounded d-flex justify-content-center align-items-center" style="background-color: whitesmoke; height: 10rem;">
                                    <img src="{{ asset('storage/images/' . $image->path) }}" alt="gambar" style="width: 100%; height: 100%; object-fit: contain; border-radius: 8px;">
                                </div>
                            @endforeach
                        </div>
                    @else
                        <h6 class="font-bold text-center">Tidak ada gambar</h6>
                    @endif

                </div>
                @foreach ($albums as $item)
                    <div class="px-3 py-3 cursor-pointer" style="border: 1px solid black; border-radius: 15px;">
                        <div class="d-flex justify-content-between">
                            <h6 onclick="detailAlbum({{$item->id}})" class="text-capitalize">{{ $item->album_nama }}</h6>
                            <div class="d-flex gap-2 w-full justify-content-end">
                                {{-- Tombol Edit --}}
                                <a href="{{ route('albumEdit', $item->id) }}" class="btn text-secondary p-0 text-decoration-none">Edit</a>

                                {{-- Tombol Hapus --}}    
                                <button onclick="deleteKoleksi({{ $item->id }})" type="submit" class="btn text-danger p-0 text-decoration-none">Hapus</button>
                            </div>
                        </div>
                        <div onclick="detailAlbum({{$item->id}})" class="custom-grid">
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
        <script>
            function detailAlbum(id) {
                if (id) {
                    window.location.href = '/album/detail/' + id;
                } else {
                    window.location.href = '/album/detail/';
                }
            }

            function deleteKoleksi(id) {
                Swal.fire({
                    title: "Hapus album",
                    text: "Apakah Anda yakin ingin menghapus album ini?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, hapus!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/album`,
                            type: "POST",
                            data: {
                                id: id,
                                detail: false,
                                _method: "DELETE",
                                _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            success: function(response) {
                                Swal.fire("Berhasil!", "Album telah dihapus.", "success").then(() => {
                                    window.location.reload(); 
                                });
                            },
                            error: function(xhr) {
                                Swal.fire("Gagal", "Gagal menghapus album.", "error");
                            }
                        });
                    }
                });
            }
        </script>
    </body>
</html>