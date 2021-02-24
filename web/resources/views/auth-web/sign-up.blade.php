<form method="POST" action="{{ route('register') }}" class="sign-up-form">
  @csrf
  <img src="{{ asset('assets/kantah.png') }}" width="20%">
  <h2 class="title">Sign up </h2>
  <div align="center">
  <h3>e-MONAS <br> (Monitoring Anggaran Satker)</h3>
  </div>

  <!-- Validation Errors -->
  <font color="red"> 
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
  </font>
  <div class="input-field">
    <i class="fas fa-user"></i>
    <input type="text" placeholder="Nama" name="name" :value="old('name')"/>
  </div>
  <div class="input-field">
    <i class="fas fa-envelope"></i>
    <input type="email" placeholder="Email" name="email" :value="old('email')"/>
  </div>
  <div class="input-field">
    <i class="fas fa-lock"></i>
    <input type="password" placeholder="Password min 8 character" name="password"
                                required autocomplete="new-password"/>
  </div>
  <div class="input-field">
    <i class="fas fa-lock"></i>
    <input type="password" placeholder="Confirm Password" name="password_confirmation" required/>
  </div>
 
                <input type="submit" class="btn" value="Sign Up" />



  {{-- <p class="social-text">Or Sign up with social platforms</p>
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