<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('components.head', ['title' => 'Login'])
    <style>
    </style>
    <body>
        @include('components.notif')
        <section class="vh-100 d-flex mx-4">
            <div class="container-fluid">
              <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-6 col-xl-5">
                    <img src="https://img.freepik.com/premium-vector/global-data-security-concept-illustration_86047-617.jpg?ga=GA1.1.185465092.1737781406&semt=ais_hybrid" 
                         class="img-fluid w-100" 
                         alt="Sample image">
                </div>                  
                <div class="col-lg-6 col-xl-4 offset-xl-1">
                    <h2 class="mb-5 fw-bold">Sign In</h3>

                    <form action="{{route('login')}}" method="POST">
                        @csrf
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="email">Email address</label>
                            <input type="email" name="email" id="email" class="form-control form-control-lg"
                                placeholder="Enter email address" />
                        </div>
            
                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control form-control-lg"
                                placeholder="Enter password" />
                        </div>
            
                        <button type="submit" class="btn btn-primary btn-lg w-100 mb-4">Sign In</button>

                        <p class="text-center mb-0 mb-lg-5">
                            Don't have an account? <a class="fw-bold text-red text-decoration-none" href="/register">Register</a>
                        </p>                          
                    </form>
                </div>
              </div>
            </div>
        </section>
    </body>
</html>