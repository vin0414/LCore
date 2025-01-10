
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
    <title>{{isset($about['companyName']) ? $about['companyName'] : 'Company name is not available' }}</title>
    <link rel="icon" sizes="180x180" href="/assets/images/{{isset($about['companyLogo']) ? $about['companyLogo'] : 'No Logo' }}"/>
  </head>
  <body>
    <header class="header pos__rel">
      <div class="notification__container">
        <div class="notification__heading">
          <p class="subheading">Notifications</p>
          <span class="notif__text__description"
            >You have 5 unread messages</span
          >
        </div>
        <div class="pending__box">
          <!-- 1 -->
          <div class="pending__notif">
            <div class="green__circle"></div>
            <div class="notif__title">
              <p class="notif__heading">You have a pending approval.</p>
              <span class="text__description">1 hour ago</span>
            </div>
          </div>
          <!-- 2 -->
          <div class="pending__notif">
            <div class="green__circle"></div>
            <div class="notif__title">
              <p class="notif__heading">You have a pending approval.</p>
              <span class="text__description">1 hour ago</span>
            </div>
          </div>
          <!-- 3 -->
          <div class="pending__notif">
            <div class="green__circle"></div>
            <div class="notif__title">
              <p class="notif__heading">You have a pending approval.</p>
              <span class="text__description">1 hour ago</span>
            </div>
          </div>
          <!-- 4 -->
          <div class="pending__notif">
            <div class="green__circle"></div>
            <div class="notif__title">
              <p class="notif__heading">You have a pending approval.</p>
              <span class="text__description">1 hour ago</span>
            </div>
          </div>
          <!-- 5 -->
          <div class="pending__notif">
            <div class="green__circle"></div>
            <div class="notif__title">
              <p class="notif__heading">You have a pending approval.</p>
              <span class="text__description">1 hour ago</span>
            </div>
          </div>
          <!-- 6 -->
          <div class="pending__notif">
            <div class="green__circle"></div>
            <div class="notif__title">
              <p class="notif__heading">You have a pending approval.</p>
              <span class="text__description">1 hour ago</span>
            </div>
          </div>
          <!-- 7 -->
          <div class="pending__notif">
            <div class="green__circle"></div>
            <div class="notif__title">
              <p class="notif__heading">You have a pending approval.</p>
              <span class="text__description">1 hour ago</span>
            </div>
          </div>
        </div>
        <button class="btn__read">Mark all as read</button>
      </div>
      <div class="header__box flex flex__align__center">
        <div class="logo__box">
          <img class="logo" src="/assets/images/{{isset($about['companyLogo']) ? $about['companyLogo'] : '' }}" />
        </div>
        <div class="cta__box flex flex__align__center">
          <div class="settings__icons flex flex__align__center">
            <div class="notif__box pos__rel">
              <p class="notification__count">34</p>
              <ion-icon
                class="header__icon icon__notification"
                name="notifications-outline"
              ></ion-icon>
            </div>
          </div>
          <div class="user__images flex flex__align__center">
            <img
              src="/assets/images/user.png"
              alt="Image of the user" height="40"
              class="user__image"
            />
            <p id="userName" class="user__name name__screen__lg"><?php echo session('fullname') ?></p>
            <div class="account__dropdown">
              <a href="javascript:void(0);" class="no-underline user__name name__screen__sm flex flex__align__center gap__1">
                <ion-icon name="person-outline"></ion-icon><?php echo session('fullname') ?>
              </a>
              <a href="" class="no-underline user__name name__screen__sm flex flex__align__center gap__1">
                <ion-icon
                  class="sidebar__icon"
                  name="settings-outline"></ion-icon>Account Settings
              </a>
              <p class="user__name name__screen__sm flex flex__align__center gap__1">
                <ion-icon class="sidebar__icon" name="sunny-outline"></ion-icon>Mode
              </p>
              <hr />
              <a href="{{route('signout')}}" onclick="return confirm('Do you want to sign out?')" class="link__account flex flex__align__center gap__1"
                ><ion-icon name="log-out-outline"></ion-icon>Logout</a
              >
            </div>
          </div>
        </div>
      </div>
    </header>
    <main>
      <nav class="navigation">
        <ion-icon id="menuButton" class="menu" name="menu-outline"></ion-icon>
        <ul id="headerNav" class="nav__items flex flex__align__center">
          <li class="nav__item"><a href="{{route('employee/overview')}}" class="no-underline">Dashboard</a></li>
          <li class="nav__item">Payroll <ion-icon name="chevron-down-outline"></ion-icon>
            <ul class="dropdown">
              <li class="dropdown__item"><a href="" class="no-underline">Payslip</a></li>
              <li class="dropdown__item"><a href="" class="no-underline">Deductions</a></li>
              <li class="dropdown__item"><a href="" class="no-underline">Benefits</a></li>
            </ul>
          </li>
          <li class="nav__item">Time & Attendance<ion-icon name="chevron-down-outline"></ion-icon>
            <ul class="dropdown">
              <li class="dropdown__item"><a href="" class="no-underline">Attendance</a></li>
              <li class="dropdown__item"><a href="" class="no-underline"></a></li>
            </ul>
          </li>
          <li class="nav__item">Leave <ion-icon name="chevron-down-outline"></ion-icon>
            <ul class="dropdown">
              <li class="dropdown__item"><a href="" class="no-underline">Calendar & Request</a></li>
              <li class="dropdown__item"><a href="" class="no-underline">Balances</a></li>
              <li class="dropdown__item"><a href="" class="no-underline">Types & Policies</a></li>
              <li class="dropdown__item"><a href="" class="no-underline">Approval Workflow</a></li>
            </ul>
          </li>
          <li class="nav__item">Memos & Broadcast<ion-icon name="chevron-down-outline"></ion-icon>
            <ul class="dropdown">
              <li class="dropdown__item"><a href="{{route('hr/memo')}}" class="no-underline">Overview</a></li>
              <li class="dropdown__item"><a href="{{route('hr/memo/new')}}" class="no-underline">Post Memo</a></li>
              <li class="dropdown__item"><a href="{{route('hr/memo/new-announcement')}}" class="no-underline">New Broadcast</a></li>
            </ul>
          </li>
        </ul>
      </nav>
      <aside class="sidebar__nav">
        <p class="side_heading">Quick Links</p>
        <ul class="sidebar__items">
          <li>
            <a href="" class="nav__links"
              ><ion-icon
                class="sidebar__icon"
                name="document-text-outline"
              ></ion-icon
              >File Leave</a
            >
          </li>
          <li>
            <a href="" class="nav__links"
              ><ion-icon
                class="sidebar__icon"
                name="file-tray-full-outline"
              ></ion-icon
              >View Leave(s)</a
            >
          </li>
        </ul>
        <p class="side_heading">Others</p>
        <ul class="sidebar__items">
          <li>
            <a href="{{route('hr/settings')}}" class="nav__links"
              ><ion-icon
                class="sidebar__icon"
                name="settings-outline"
              ></ion-icon
              >My Account</a
            >
          </li>
        </ul>
      </aside>
      <div class="container">
        <div class="heading__box flex flex__align__center">
          <h1 class="heading__primary">{{$title}}</h1>
          <div class="breadcrumbs">
            <p class="pages">{{isset($about['companyName']) ? $about['companyName'] : 'Company name is not available' }} | <span>{{$title}}</span></p>
          </div>
        </div>
        <div class="cards grid grid__4__cols">
          <!-- 1 -->
          <div class="card">
            <div class="text__icon__box">
              <div class="text__items">
                <p class="subheading">Regular</p>
                <p class="text__description">Regular Employees</p>
              </div>
              <ion-icon class="card__icon" name="people-outline"></ion-icon>
            </div>
            <div class="count__box">
              <p class="count"></p>
              <p class="text__description">Members</p>
            </div>
          </div>
          <!-- 2 -->
          <div class="card">
            <div class="text__icon__box">
              <div class="text__items">
                <p class="subheading">Newly Hired</p>
                <p class="text__description">Probationary and Trainees</p>
              </div>
              <ion-icon class="card__icon" name="people-outline"></ion-icon>
            </div>
            <div class="count__box">
              <p class="count"></p>
              <p class="text__description">Members</p>
            </div>
          </div>
          <!-- 3 -->
          <div class="card">
            <div class="text__icon__box">
              <div class="text__items">
                <p class="subheading">Total Employees</p>
                <p class="text__description">Onboard Employees</p>
              </div>
              <ion-icon class="card__icon" name="people-outline"></ion-icon>
            </div>
            <div class="count__box">
              <p class="count"></p>
              <p class="text__description">Members</p>
            </div>
          </div>
          <!-- 4 -->
          <div class="card">
            <div class="text__icon__box">
              <div class="text__items">
                <p class="subheading">Resigned</p>
                <p class="text__description">Others</p>
              </div>
              <ion-icon class="card__icon" name="people-outline"></ion-icon>
            </div>
            <div class="count__box">
              <p class="count"></p>
              <p class="text__description">Members</p>
            </div>
          </div>
        </div>
        <div class="row grid second__row">
          <div class="chart" id="chart"></div>
          <!-- 1 -->
          <div class="card recent__employee__card">
            <p class="subheading margin__bottom__3">Recent Employees</p>
            <div class="scroll__box">
            </div>
          </div>
          <!-- 2 -->
          <form class="card announcement__card">
            <div class="text__items margin__bottom__3">
              <p class="subheading">Announcement</p>
            </div>
            <div class="input__box">
              <textarea class="text__area" placeholder="Write something here.."></textarea>
            </div>
            <div class="compose__box">
              <a class="compose" href="#"><ion-icon class="compose__icon" name="reader-outline"></ion-icon>Compose</a>
            </div>
          </form>
        </div>
      </div>
    </main>
    <footer class="footer">
      <p class="copyright">&copy;{{isset($about['companyName']) ? $about['companyName'] : 'Company name is not available' }} <?php echo date('Y') ?>. All Rights Reserved.</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
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

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
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
