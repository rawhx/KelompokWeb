<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('components.head', ['title' => 'Register'])
    <body>
        @include('components.notif')
        <section class="vh-100 d-flex mx-4">
            <div class="container-fluid">
              <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-6 col-xl-5">
                    <img src="https://img.freepik.com/free-vector/electronic-voting-abstract-concept-illustration_335657-3763.jpg?ga=GA1.1.185465092.1737781406&semt=ais_hybrid" 
                         class="img-fluid w-100" 
                         alt="Sample image">
                </div>                  
                <div class="col-lg-6 col-xl-4 offset-xl-1">
                    <h2 class="mb-5 fw-bold">Sign Up</h3>
                    
                    <form action="{{route('register')}}" method="POST">
                        @csrf
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="email">Email address</label>
                            <input type="email" name="email" id="email" class="form-control form-control-lg"
                                placeholder="Enter email address" />
                        </div>

                        <!-- Username input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control form-control-lg"
                                placeholder="Enter username" />
                        </div>
            
                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control form-control-lg"
                                placeholder="Enter password" />
                        </div>

                        <!-- Konfirmasi Password input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="confirmPassword">Confirm Password</label>
                            <input type="password" name="confirmpassword" id="confirmPassword" class="form-control form-control-lg"
                                placeholder="Enter confirm password" />
                        </div>
            
                        <button type="submit" class="btn btn-primary btn-lg w-100 mb-4">Sign Up</button>

                        <p class="text-center mb-0 mb-lg-5">
                            Have an account? <a class="fw-bold text-red text-decoration-none" href="/login">Sign In</a>
                        </p>                          
                    </form>
                </div>
              </div>
            </div>
        </section>
    </body>
</html>