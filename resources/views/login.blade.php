<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="{{isset($about['companyDetails']) ? $about['companyDetails'] : 'No Available Details' }}">
    <meta name="keywords" content="{{isset($about['companyTag']) ? $about['companyTag'] : 'No Available keywords' }}">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="assets/css/styles.css" />
    <link rel="stylesheet" href="assets/css/index-responsive.css" />
    <title>{{isset($about['companyName']) ? $about['companyName'] : 'Company name is not available' }}</title>
    <!-- Site favicon -->
		<link rel="icon" sizes="180x180" href="assets/images/{{isset($about['companyLogo']) ? $about['companyLogo'] : 'No Logo' }}"/>
    <style>
        ::-webkit-scrollbar-track {
            background: #f1f1f1; 
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #888; 
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555; 
        }
        ::-webkit-scrollbar {
            height: 4px;              /* height of horizontal scrollbar ← You're missing this */
            width: 4px;               /* width of vertical scrollbar */
            border: 1px solid #d5d5d5;
            }
    </style>
  </head>
  <body>
    <header class="header">
      <div class="header__box">
        <div class="logo__box">
          <img class="logo" src="assets/images/{{isset($about['companyLogo']) ? $about['companyLogo'] : '' }}" />
        </div>
        <div class="settings__box">
          <ion-icon class="icon" name="settings-outline"></ion-icon>
        </div>
      </div>
    </header>
 
    <main>
      <section class="section__login">
        <div class="container">
          <div class="login__card grid grid__2__cols">
            <div class="card__image pos__rel">
              <p class="floating__text pos__abs">
                Outstanding tasks are ready for you!
              </p>

              <img
                src="assets/images/person.png"
                class="image__person"
                alt="image of a person"
              />
            </div>
            <div class="card__login">
              <p class="login__heading">Sign into your account</p>
              @if(\Session::has('message'))
                <div class="alert alert-danger">
                    {{\Session::get('message')}}
                </div>
              @endif
              @if(Auth::guard('user')->check())
              <p>You are already logged in. <a href="{{ route('hr/overview') }}">Go to Dashboard</a></p>
              @else
              <form class="form__login" id="formLogin" method="POST" action="{{route('login')}}">
                @csrf
                <div class="input__container flex">
                  <input type="text"
                    class="login__input"
                    id="username"
                    name="username"
                    placeholder="Username"
                    value="{{ old('username') }}"
                  />
                  @if ($errors->has('username'))
                    <p class="text-danger">{{$errors->first('username')}}</p>
                  @endif
                  <div class="pos__rel">
                    <input
                      class="login__input pos__rel"
                      id="password"
                      name="password"
                      placeholder="password"
                      type="password"
                    /><ion-icon
                      class="pos__abs eye__icon"
                      name="eye-outline" onclick="showPassword()"
                    ></ion-icon>
                  </div>
                  @if ($errors->has('password'))
                    <p class="text-danger">{{$errors->first('password')}}</p>
                  @endif
                </div>
                <div class="check__box flex">
                  <input
                    class="checkbox__input"
                    type="checkbox"
                    id="checkbox"
                    name="checkbox"
                  />
                  <p class="remember">Remember me</p>
                </div>
                <button class='btn__primary' type="submit">Login</button>
              </form>
              @endif
            </div>
          </div>
        </div>
      </section>
      <footer class="footer">
        <div class="container">
          <p class="copyright">&copy; {{isset($about['companyName']) ? $about['companyName'] : 'Company name is not available' }} <?php echo date('Y') ?>. All Rights Reserved.</p>
        </div>
      </footer>
    </main>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script>
    function showPassword() { var x = document.getElementById("password");if (x.type === "password") {x.type = "text";} else {x.type = "password";}}
  </script>
  </body>
</html>
