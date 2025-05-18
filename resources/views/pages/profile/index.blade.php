<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('components.head')
    <style>
        .tab-button.active {
            font-weight: bold;
            color: #000;
        }
    </style>
    
    <body>
        @include('components.notif')
        @include('components.header')
        <section class="d-flex flex-column flex-grow-1">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="font-semibold heading-underline">Profile</h4>
                <button class="btn btn-outline-dark fw-semibold" data-bs-toggle="modal" data-bs-target="#editProfile">Edit Profile</button>
            </div>
            <div class="d-flex flex-column gap-3 justify-content-center align-items-center">
                <div class="d-inline-block bg-primary position-relative overflow-hidden rounded-circle" style="width: 200px; height: 200px;">
                    <img src="{{ auth()->user()->foto_profil 
                                ? asset('storage/profile_pictures/' . auth()->user()->foto_profil) 
                                : 'https://sussexunipharmacy.co.uk/wp-content/uploads/2024/02/no-profile-img.jpg' }}" 
                        class="w-100 h-100 position-absolute top-0 start-0" 
                        style="object-fit: cover; object-position: center;" 
                        alt="Profil">  
                </div>
                <div class="d-flex flex-column align-items-center">
                    <h3 class="fw-bold">{{auth()->user()->username}}</h3>
                    <h5 class="fw-semibold">{{auth()->user()->email}}</h5>
                </div>  
                <div class="d-flex gap-2">
                    <button class="px-5 btn btn-outline-danger" onclick="logout()">Logout</button>
                    <button class="px-5 btn btn-danger">Hapus Akun</button>
                </div>
            </div>
        </section>
        <div class="modal fade" id="editProfile" data-bs-backdrop="static" tabindex="-1" aria-labelledby="editProfileLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editProfileLabel">Edit Profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3">
                        <div class="col-12">
                          <label class="visually">Email</label>
                          <input type="text" readonly class="form-control" value="{{auth()->user()->email}}">
                        </div>
                        <div class="col-12">
                          <label class="visually">Username</label>
                          <input type="text" name="username" class="form-control" value="{{auth()->user()->username}}">
                        </div>
                        <div class="col-12">
                            <label for="foto_profil" class="form-label">Profile</label>
                            <input class="form-control" type="file" id="foto_profil" accept="image/*">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary">Simpan</button>
                </div>
                </div>
            </div>
        </div>

        @include('components.footer')
    </body>
    <script>
        function logout() { 
            window.location.href = "/logout";
        }

        const tabs = document.querySelectorAll('.tab-button');
        const sections = document.querySelectorAll('.tab-section');
    
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const targetId = tab.getAttribute('data-target');
    
                // Reset semua section
                sections.forEach(section => section.style.display = 'none');
    
                // Tampilkan yang dipilih
                document.getElementById(targetId).style.display = 'block';
    
                // Update active tab
                tabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
            });
        });
    </script>    
    
</html>