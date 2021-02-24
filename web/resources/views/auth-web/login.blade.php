<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="{!! asset('assets-login/fontawesomekits.js') !!}"
      crossorigin="anonymous"
    ></script>
      <link rel="shortcut icon" href="{{ asset('assets-admin/images/favicon.png') }}" />
    <link rel="stylesheet" href="{!! asset('assets-login/style.css') !!}" />
    <title>e-MONAS - Sign in & Sign up Form </title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">


          @include('auth-web.sign-in')


          @include('auth-web.sign-up')

        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>New here ?</h3>
            <p>
              Silahkan daftarkan akun Anda disini!
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Sign up
            </button>
          </div>
          <img src="{!! asset('assets-login/img/log.svg') !!}" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>One of us ?</h3>
            <p>
              Jika telah memiliki akun, silahkan lanjutkan proses login disini!
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Sign in
            </button>
          </div>
          <img src="{!! asset('assets-login/img/register.svg') !!}" class="image" alt="" />
        </div>
      </div>
    </div>

    <script src="{!! asset('assets-login/app.js') !!}"></script>
  </body>
</html>
