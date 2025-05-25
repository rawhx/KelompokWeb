<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('components.head')
    <style>
        .selectable {
            cursor: pointer;
            transition: all 0.2s ease-in-out;
        }

        .selectable.border-primary {
            box-shadow: 0 0 10px rgba(13, 110, 253, 0.5);
        }

        .checkmark {
            pointer-events: none;
        }
    </style>
    <body>
        @include('components.notif')
        @include('components.header')
        <section class="d-flex flex-column gap-3">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="font-semibold heading-underline">Tambah Koleksi</h4>
            </div>
            <div class="d-flex justify-content-center">
                <div class="container position-sticky top-0 py-3" style="max-width: 50%;">
                    <!-- Grid Gambar -->
                    @php
                        $koleksiImages = $koleksi->data ?? [];
                    @endphp

                    <div class="bento-grid" style="column-count: 3">
                        @foreach (range(0, 2) as $i)
                            @php
                                $imagePath = isset($koleksiImages[$i]) ? $koleksiImages[$i]->image->path : null;
                            @endphp
                            <div class="bento-item">
                                <img
                                    src="{{ $imagePath ? asset('storage/images/' . $imagePath) : 'https://placehold.jp/300x300.png' }}"
                                    alt="Foto {{ $i + 1 }}"
                                    id="foto_{{ $i }}"
                                    class="img-fluid rounded shadow-sm"
                                    style="max-width: 15rem;"
                                >
                            </div>
                        @endforeach
                    </div>

                    <form action="{{route('koleksiUpdate', $koleksi->id)}}" method="POST" class="row g-3 mt-3" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        <div class="col-12">
                            <label class="form-label" for="judul">Judul</label>
                            <input type="text" name="judul" id="judul" class="form-control" placeholder="Judul Foto" value="{{$koleksi->koleksi_nama}}" />
                        </div>

                        <input type="hidden" name="id" value="{{ $koleksi->id }}">
                        <input type="hidden" name="selected_images" id="selectedImages">

                        <div class="col-12 d-flex gap-2">
                            <button type="button" class="btn btn-outline-primary"  type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Pilih Gambar</button>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </form>
                </div>
            </div>

        </section>

        <!-- Modal -->
        <div class="modal modal-lg fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Pilih Gambar</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body bento-grid">
                        @foreach ($images as $image)
                            <div class="bento-item selectable" data-image="{{ $image->id }}" data-path="{{ $image->path }}">
                                <div class="position-relative">
                                    <img src="{{ asset('storage/images/' . $image->path) }}" alt="Foto {{ $image->judul }}" class="img-fluid rounded" style="cursor: pointer;">
                                    <div class="overlay">
                                        <span class="image-title">{{ $image->judul }}</span>
                                    </div>
                                    <div class="checkmark position-absolute top-0 end-0 m-2 d-none" style="font-size: 1.5rem; color: green;">✔</div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

       @php
            $oldSelected = old('selected_images') 
                ? explode(',', old('selected_images')) 
                : $selectedImageIds;
        @endphp


        <script>
            $(document).ready(function () {
                const selectedImages = new Set({!! json_encode($oldSelected) !!});

                // Tampilkan gambar yang sudah terseleksi saat pertama kali
                selectedImages.forEach(imageId => {
                    const $item = $(`.selectable[data-image="${imageId}"]`);
                    const $checkmark = $item.find('.checkmark');
                    $item.addClass('border border-primary');
                    $checkmark.removeClass('d-none');
                });

                $('.selectable').on('click', function () {
                    const $item = $(this);
                    const imageId = $item.data('image');
                    const $checkmark = $item.find('.checkmark');

                    if (selectedImages.has(imageId)) {
                        selectedImages.delete(imageId);
                        $checkmark.addClass('d-none');
                        $item.removeClass('border border-primary');
                    } else {
                        if (selectedImages.size >= 3) {
                            alert("Maksimal 3 gambar yang bisa dipilih.");
                            return;
                        }
                        selectedImages.add(imageId);
                        $checkmark.removeClass('d-none');
                        $item.addClass('border border-primary');
                    }
                });

                $('.modal-footer .btn-primary').on('click', function () {
                    const selectedIds = Array.from(selectedImages);
                    $('#selectedImages').val(selectedIds.join(','));

                    for (let i = 0; i < 3; i++) {
                        const imageId = selectedIds[i];
                        if (imageId) {
                            const path = $(`.selectable[data-image="${imageId}"]`).data('path');
                            $(`#foto_${i}`).attr("src", `/storage/images/${path}`);
                        } else {
                            $(`#foto_${i}`).attr("src", "https://placehold.jp/300x300.png");
                        }
                    }

                    $('#staticBackdrop').modal('hide');
                });

                $('.btn-close, .btn-secondary').on('click', function () {
                    $('.selectable').each(function () {
                        const $item = $(this);
                        const imageId = $item.data('image');
                        const $checkmark = $item.find('.checkmark');

                        if (selectedImages.has(imageId)) {
                            $item.addClass('border border-primary');
                            $checkmark.removeClass('d-none');
                        } else {
                            $item.removeClass('border border-primary');
                            $checkmark.addClass('d-none');
                        }
                    });
                });
            });
        </script>

    </body>
</html>