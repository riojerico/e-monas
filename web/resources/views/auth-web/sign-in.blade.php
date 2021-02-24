<form action="{{ route('login') }}" method="POST" class="sign-in-form">
  @csrf
  <img src="{{ asset('assets/kantah.png') }}" width="20%">
  <h2 class="title">Sign in </h2>
  <div align="center">
  <h3>e-MONAS <br> (Monitoring Anggaran Satker)</h3>
  </div>

  <!-- Session Status -->
  <font color="red">  <x-auth-session-status class="mb-4" :status="session('status')" />

  <!-- Validation Errors -->
  <x-auth-validation-errors class="mb-4" :errors="$errors" />
  </font>


  <div class="input-field">
    <i class="fas fa-user"></i>
    <input type="email" name="email" :value="old('email')" required autofocus placeholder="Email" />
  </div>
  <div class="input-field">
    <i class="fas fa-lock"></i>
    <input type="password" placeholder="Password" 
                                name="password"
                                required autocomplete="current-password"/>
  </div>
  <!-- Remember Me -->
  <div class="block mt-4">
      <label for="remember_me" class="inline-flex items-center">
          <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
          <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
      </label>
  </div>

  <div class="flex items-center justify-end mt-4">
      @if (Route::has('password.request'))
          <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
              {{ __('Forgot your password?') }}
          </a>
      @endif

  </div>
  <input type="submit" value="Login" class="btn solid" />
 {{--  <p class="social-text">Or Sign in with social platforms</p>
  <div class="social-media">
    <a href="#" class="social-icon">
      <i class="fab fa-facebook-f"></i>
    </a>
    <a href="#" class="social-icon">
      <i class="fab fa-twitter"></i>
    </a>
    <a href="#" class="social-icon">
      <i class="fab fa-google"></i>
    </a>
    <a href="#" class="social-icon">
      <i class="fab fa-linkedin-in"></i>
    </a>
  </div> --}}
</form>