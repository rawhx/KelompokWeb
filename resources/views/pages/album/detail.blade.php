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
                <h4 class="font-semibold heading-underline text-capitalize">Detail {{ $album->album_nama }}</h4>
                @if ($album->id)
                   <div class="d-flex gap-2 w-full justify-content-end">
                        {{-- Tombol Edit --}}
                        <a href="{{ route('albumEdit', $album->id) }}" class="btn text-secondary p-0 text-decoration-none">Edit</a>

                        {{-- Tombol Hapus --}}    
                        <button onclick="deleteKoleksi({{ $album->id }})" type="submit" class="btn text-danger p-0 text-decoration-none">Hapus</button>
                    </div>
                @endif
            </div>
            <div class="bento-grid">
                @foreach ($album->data as $data)
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
        </section>

        <script>
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
                                detail: true,
                                id: id,
                                _method: "DELETE",
                                _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            success: function(response) {
                                window.location.href = '/album'
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