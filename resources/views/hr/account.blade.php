
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="/assets/css/reusables.css" />
    <link rel="stylesheet" href="/assets/css/dashboard.css" />
    <link rel="stylesheet" href="/assets/css/accountPage.css" />
    <title>{{isset($about['companyName']) ? $about['companyName'] : 'Company name is not available' }}</title>
    <link rel="icon" sizes="180x180" href="/assets/images/{{isset($about['companyLogo']) ? $about['companyLogo'] : 'No Logo' }}"/>
  </head>
  <body>
    @include('hr.templates.header')
    <main>
      @include('hr.templates.nav')
      <aside class="sidebar__nav">
        <p class="side_heading">Quick Links</p>
        <ul class="sidebar__items">
          <li>
            <a href="{{route('hr/employee/documents')}}" class="nav__links"
              ><ion-icon
                class="sidebar__icon"
                name="cloud-upload-outline"
              ></ion-icon
              >Upload Files</a
            >
          </li>
          <li>
            <a href="{{route('hr/memo/new')}}" class="nav__links"
              ><ion-icon
                class="sidebar__icon"
                name="document-text-outline"
              ></ion-icon
              >Post Memo</a
            >
          </li>
          <li>
            <a href="{{route('hr/memo')}}" class="nav__links"
              ><ion-icon
                class="sidebar__icon"
                name="file-tray-full-outline"
              ></ion-icon
              >All Memos</a
            >
          </li>
          <li>
            <a href="{{route('hr/employee/new')}}" class="nav__links"
              ><ion-icon
                class="sidebar__icon"
                name="person-add-outline"
              ></ion-icon
              >New Employee</a
            >
          </li>
          <li>
            <a href="{{route('hr/employee')}}" class="nav__links"
              ><ion-icon class="sidebar__icon" name="people-outline"></ion-icon
              >All Employees</a
            >
          </li>
        <?php if(session('role')=="ADMIN"||session('role')=="Admin"){ ?>
        <p class="side_heading">Maintenance</p>
        <ul class="sidebar__items">
          <li>
            <a href="{{route('hr/settings')}}" class="nav__links"
              ><ion-icon
                class="sidebar__icon"
                name="settings-outline"
              ></ion-icon
              >System Settings</a
            >
          </li>
          <li>
            <a href="{{route('hr/audit-trail')}}" class="nav__links"
              ><ion-icon name="clipboard-outline"></ion-icon>Audit Trail</a
            >
          </li>
        </ul>
        <?php } ?>
      </aside>
      <div class="container">
        <div class="heading__box flex flex__align__center">
          <h1 class="heading__primary">{{$title}}</h1>
          <div class="breadcrumbs">
            <p class="pages">{{isset($about['companyName']) ? $about['companyName'] : 'Company name is not available' }} | <span>{{$title}}</span></p>
          </div>
        </div>
        @if(\Session::has('success'))
            <div class="alert alert-success">
                {{\Session::get('success')}}
            </div>
        @endif
         <div class="card__container">
          @if($account)
          <form class="input__box__items" id="frmAccount" method="POST">
            @csrf
            <p class="account__information__title">Account Information</p>
            <!-- 1 -->
            <div class="input__box">
              <input
                class="information__input"
                name="fullname" value="{{$account['Fullname']}}"
              />
              <span class="input__title">Fullname</span>
              <div id="fullname-error" class="error-messages text-danger"></div>
            </div>
            <div class="input__group__items">
              <!-- 2 -->
              <div class="input__box">
                <input
                  class="information__input"
                  name="username" value="{{$account['Username']}}"
                />
                <span class="input__title">Username</span>
                <div id="username-error" class="error-messages text-danger"></div>
              </div>
              <!-- 3 -->
              <div class="input__box">
                <input
                  class="information__input"
                  name="role" value="{{$account['Role']}}"
                />
                <span class="input__title">System Role</span>
                <div id="role-error" class="error-messages text-danger"></div>
              </div>
            </div>
            <!-- 4 -->
            <div class="input__box">
              <input type="email"
                class="information__input"
                name="email" value="{{$account['Email']}}"/>
              <span class="input__title">Email</span>
              <div id="email-error" class="error-messages text-danger"></div>
            </div>
            <div class="btn__box">
              <button type="submit" class="btn__submit"><ion-icon name="document-text-outline" class="icon__account"></ion-icon>Save Changes</button>
            </div>
          </form>
          @endif
          <form class="input__box__items" action="{{route('change-password')}}" method="POST">
            @csrf
            <p class="account__information__title">Change Password</p>
              <!-- 1 -->
              <div class="input__box pos__rel">
                <input class="information__input password__field" name="old_password" type="password" value="{{old('old_password')}}" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"/>
                <span class="input__title">Old Password</span>
                <ion-icon name="eye-outline" class="icon__account eye__icon toggle__visibility"></ion-icon>
                @if ($errors->has('old_password'))
                  <p class="text-danger">{{$errors->first('old_password')}}</p>
                @endif
              </div>
              <!-- 2 -->
              <div class="input__box pos__rel">
                <input class="information__input password__field" name="new_password" type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"/>
                <span class="input__title">New Password</span>
                <ion-icon name="eye-outline" class="icon__account eye__icon toggle__visibility"></ion-icon>
                @if ($errors->has('new_password'))
                  <p class="text-danger">{{$errors->first('new_password')}}</p>
                @endif
              </div>
              <!-- 2 -->
              <div class="input__box pos__rel">
                <input class="information__input password__field" name="confirm_password" type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"/>
                <span class="input__title">Confirm Password</span>
                <ion-icon name="eye-outline" class="icon__account eye__icon toggle__visibility"></ion-icon>
                @if ($errors->has('confirm_password'))
                  <p class="text-danger">{{$errors->first('confirm_password')}}</p>
                @endif
              </div>
              <div class="btn__box">
                <button type="submit" class="btn__submit"><ion-icon name="document-text-outline" class="icon__account"></ion-icon>Save Password</button>
              </div>
          </form>
         </div>
         <div class="card__container"></div>
      </div>
    </main>
    <footer class="footer">
      <p class="copyright">&copy;{{isset($about['companyName']) ? $about['companyName'] : 'Company name is not available' }} <?php echo date('Y') ?>. All Rights Reserved.</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
      document.addEventListener("DOMContentLoaded", function () {

      $(".toggle__visibility").on("click", function () {
        // Get the closest input field
        const $passwordInput = $(this).closest(".input__box").find(".password__field");
        const isPassword = $passwordInput.attr("type") === "password";

        // Toggle input type
        $passwordInput.attr("type", isPassword ? "text" : "password");

        // Toggle icon
        $(this).attr("name", isPassword ? "eye-off-outline" : "eye-outline");
      });


        $("#menuButton").on("click", function (e) {
          e.stopPropagation();
          showSideBar();
        });

        $(".user__images").on("click", function (e) {
          e.stopPropagation();
          showAccountMenu();
        });

        $(".notif__box").on("click", function (e) {
          e.stopPropagation(); // Prevent triggering the document click listener
          showNotification();
        });
        $(document).on("click", function () {
          hideAllMenus();
        });
      });

      function showNotification() {
        let notifContainer = $(".notification__container");
        notifContainer.toggleClass("show");
      }

      function showAccountMenu() {
        let accountDropdown = $(".account__dropdown");
        accountDropdown.toggleClass("show");
      }
      function showSideBar() {
        let menuButton = $("#menuButton");
        let headerNav = $("#headerNav");

        headerNav.toggle("open");
      }
      function hideAllMenus() {
        $(".notification__container").removeClass("show");
        $(".account__dropdown").removeClass("show");
        $("#headerNav").removeClass("open");
      }
    </script>
    <script
      type="module"
      src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
      nomodule
      src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"
    ></script>
  </body>
</html>
