
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="/assets/css/reusables.css" />
    <link rel="stylesheet" href="/assets/css/dashboard.css" />
    <link rel="stylesheet" href="/assets/css/new-account.css" />
    <link rel="stylesheet" href="/assets/css/table.css" />
    <link rel="stylesheet" href="/assets/css/reassign.css" />
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
              <a href="{{route('hr/account')}}" class="no-underline user__name name__screen__sm flex flex__align__center gap__1">
                <ion-icon
                  class="sidebar__icon"
                  name="settings-outline"></ion-icon>Account Settings
              </a>
              <p class="user__name name__screen__sm flex flex__align__center gap__1">
                <ion-icon class="sidebar__icon" name="sunny-outline"></ion-icon>Mode
              </p>
              <hr />
              <a href="{{route('logout')}}" onclick="return confirm('Do you want to sign out?')" class="link__account flex flex__align__center gap__1"
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
          <li class="nav__item"><a href="{{route('hr/overview')}}" class="no-underline">Dashboard</a></li>
          <li class="nav__item">Payroll Management <ion-icon name="chevron-down-outline"></ion-icon>
            <ul class="dropdown">
              <li class="dropdown__item"><a href="{{route('hr/payroll')}}" class="no-underline">Payroll</a></li>
              <li class="dropdown__item"><a href="{{route('hr/payroll/attendance')}}" class="no-underline">Attendance</a></li>
              <li class="dropdown__item">Salary</li>
            </ul>
          </li>
          <li class="nav__item">Loans & Deduction <ion-icon name="chevron-down-outline"></ion-icon>
            <ul class="dropdown">
              <li class="dropdown__item"><a href="{{route('hr/loans')}}" class="no-underline">Loans</a></li>
              <li class="dropdown__item"><a href="{{route('hr/deductions')}}" class="no-underline">Deductions</a></li>
            </ul>
          </li>
          <li class="nav__item">Employee Management<ion-icon name="chevron-down-outline"></ion-icon>
            <ul class="dropdown">
              <li class="dropdown__item"><a href="{{route('hr/employee')}}" class="no-underline">Master File</a></li>
              <li class="dropdown__item"><a href="{{route('hr/employee/new')}}" class="no-underline">New Employee</a></li>
              <li class="dropdown__item"><a href="{{route('hr/employee/movement')}}" class="no-underline">Career Progression</a></li>
              <li class="dropdown__item"><a href="{{route('hr/employee/credits')}}" class="no-underline">Leave Credits</a></li>
              <li class="dropdown__item"><a href="{{route('hr/employee/documents')}}" class="no-underline">Other Documents</a></li>
              <li class="dropdown__item"><a href="{{route('hr/employee/directories')}}" class="no-underline">Directories</a></li>
            </ul>
          </li>
          <li class="nav__item">Memo<ion-icon name="chevron-down-outline"></ion-icon>
            <ul class="dropdown">
              <li class="dropdown__item"><a href="{{route('hr/memo')}}" class="no-underline">All Memo</a></li>
              <li class="dropdown__item"><a href="{{route('hr/memo/new')}}" class="no-underline">New Memo</a></li>
              <li class="dropdown__item"><a href="{{route('hr/memo/archive')}}" class="no-underline">Archives</a></li>
            </ul>
          </li>
          <li class="nav__item">
            Reports <ion-icon name="chevron-down-outline"></ion-icon>
            <ul class="dropdown">
              <li class="dropdown__item">Salary</li>
              <li class="dropdown__item">Salary</li>
              <li class="dropdown__item">Salary</li>
            </ul>
          </li>
          <?php if(session('role')=="ADMIN"||session('role')=="Admin"){ ?>
          <li class="nav__item">
            Maintenance<ion-icon name="chevron-down-outline"></ion-icon>
            <ul class="dropdown">
              <li class="dropdown__item"><a href="{{route('hr/recovery')}}" class="no-underline">Recovery</a></li>
              <li class="dropdown__item"><a href="{{route('hr/settings')}}" class="no-underline">System Settings</a></li>
              <li class="dropdown__item"><a href="{{route('hr/audit-trail')}}" class="no-underline">Audit Trail</a></li>
            </ul>
          </li>
          <?php } ?>
        </ul>
      </nav>
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
              >Create Memo</a
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
        </ul>
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
          <h1 class="heading__primary">Employee Reassignment</h1>
          <div class="breadcrumbs">
            <p class="pages">Employee | <span>{{$title}}</span></p>
          </div>
        </div>
        <div class="card_container">
          <div class="card">
            <div class="card-header">
              <p class="subheading">Employee Details</p>
              <div class="employee__details__box">
                <div class="employee__detail">
                  <p class="title__tag">Fullname: <span class="text__details">Tovvy Dumaplin</span></p>
                  <p class="title__tag">Designation: <span class="text__details">Junior Developer</span></p>
                </div>
                <div class="employee__detail">
                  <p class="title__tag">Job Level: <span class="text__details">Rank and File</span></p>
                  <p class="title__tag">Status: <span class="text__details">Probationary</span></p>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form method="POST" class="form__box" id="frmReAssign" action="">
              <p class="subheading">Reassign Employee</p>
                <div class="reassign__input__box">
                  <!-- 1 -->
                  <div class="input__box">
                    <ion-icon class="pos__abs input__chev__down" name="chevron-down-outline"></ion-icon>
                    <select class="information__input" name="office">
                      <option value="" disabled selected>
                        Select
                      </option>
                        <option value="">Head Office</option>
                        <option value="">Branch</option>
                    </select>
                    <span class="input__title">Office</span>
                    @if ($errors->has('designation'))
                      <p class="text-danger">{{$errors->first('designation')}}</p>
                    @endif
                  </div>
                  <!-- 2 -->
                  <div class="input__box">
                    <ion-icon class="pos__abs input__chev__down" name="chevron-down-outline"></ion-icon>
                    <select class="information__input" name="office-branch" placeholder="Enter job title">
                      <option value="" disabled selected>
                        Select
                      </option>
                    </select>
                    <span class="input__title">Head Office | Branch</span>
                    @if ($errors->has('designation'))
                      <p class="text-danger">{{$errors->first('designation')}}</p>
                    @endif
                  </div>
                  <!-- 3 -->
                  <div class="input__box">
                    <ion-icon class="pos__abs input__chev__down" name="chevron-down-outline"></ion-icon>
                    <select class="information__input" name="movement" id="movementSelect">
                      <option value="" disabled selected>Select</option>
                      <option value="promotion">Promotion</option>
                      <option value="demotion">Demotion</option>
                      <option value="assignment">Transfer of Assignment</option>
                      <option value="designation">Change of Designation</option>
                      <option value="job">Job Transfer</option>
                      <option value="salary">Salary Adjustment</option>
                    </select>
                    <span class="input__title">Movement Options</span>
                    @if ($errors->has('designation'))
                      <p class="text-danger">{{$errors->first('designation')}}</p>
                    @endif
                  </div>
                  <!-- 3 -->
                  <div class="input__box">
                      <input type="date" class="information__input" name="date_of_birth" value=""/>
                      <span class="input__title">Effectivity Date</span>
                      @if ($errors->has('date_of_birth'))
                        <p class="text-danger">{{$errors->first('date_of_birth')}}</p>
                      @endif
                    </div>
                </div>
                <p id="inputGroupTitle" class="subheading promotion__title">Promotion Information</p>
                <!-- Input group for promotion -->
                <div class="reassign__input__box promotion">
                  <!-- 1 -->
                  <div class="input__box col__span2">
                    <input
                      class="information__input" 
                      placeholder="Enter job title"
                    />
                    <span class="input__title">Job Title</span>
                  </div>
                  <!-- 1 -->
                  <div class="input__box area__1 text__area__reassign">
                    <textarea
                      class="information__input"
                      placeholder="Enter job description"
                    ></textarea>
                    <span class="input__title">Job Description</span>
                  </div>
                  <!-- 1 -->
                  <div class="input__box area__2 text__area__reassign">
                    <textarea
                      class="information__input" 
                      placeholder="Enter responsibilities"
                    ></textarea>  
                    <span class="input__title">Responsibilities</span>
                  </div>
                </div>
                <!-- Input group for demotion -->
                <div class="reassign__input__box demotion">
                  <!-- 1 -->
                  <div class="input__box col__span2">
                    <input
                      class="information__input" 
                      placeholder="Enter job title"
                    />
                    <span class="input__title">Job Title</span>
                  </div>
                  <!-- 1 -->
                  <div class="input__box area__1 text__area__reassign">
                    <textarea
                      class="information__input"
                      placeholder="Enter job description"
                    ></textarea>
                    <span class="input__title">Job Description</span>
                  </div>
                  <!-- 1 -->
                  <div class="input__box area__2 text__area__reassign">
                    <textarea
                      class="information__input" 
                      placeholder="Enter responsibilities"
                    ></textarea>  
                    <span class="input__title">Responsibilities</span>
                  </div>
                </div>
                <!-- Input group for transfer of assignment -->
                <div class="reassign__input__box assignment">
                  <!-- 1 -->
                  <div class="input__box">
                    <ion-icon class="pos__abs input__chev__down" name="chevron-down-outline"></ion-icon>
                    <select class="information__input" name="office">
                      <option value="" disabled selected>
                        Select
                      </option>
                        <option value="">Head Office</option>
                        <option value="">Branch</option>
                    </select>
                    <span class="input__title">Office</span>
                    @if ($errors->has('designation'))
                      <p class="text-danger">{{$errors->first('designation')}}</p>
                    @endif
                  </div>
                  <!-- 2 -->
                  <div class="input__box">
                    <ion-icon class="pos__abs input__chev__down" name="chevron-down-outline"></ion-icon>
                    <select class="information__input" name="office-branch" placeholder="Enter job title">
                      <option value="" disabled selected>
                        Select
                      </option>
                    </select>
                    <span class="input__title">Job Title</span>
                    @if ($errors->has('designation'))
                      <p class="text-danger">{{$errors->first('designation')}}</p>
                    @endif
                  </div>
                </div>
                <!-- Input group for transfer of designation -->
                <div class="reassign__input__box designation">
                  <!-- 1 -->
                  <div class="input__box">
                    <ion-icon class="pos__abs input__chev__down" name="chevron-down-outline"></ion-icon>
                    <select class="information__input" name="office-branch" placeholder="Enter job title">
                      <option value="" disabled selected>
                        Select
                      </option>
                    </select>
                    <span class="input__title">Job Title</span>
                    @if ($errors->has('designation'))
                      <p class="text-danger">{{$errors->first('designation')}}</p>
                    @endif
                  </div>
                </div>
                <!-- Input group for transfer of job transfer -->
                <div class="reassign__input__box job">
                  <!-- 1 -->
                  <div class="input__box">
                    <ion-icon class="pos__abs input__chev__down" name="chevron-down-outline"></ion-icon>
                    <select class="information__input" name="office">
                      <option value="" disabled selected>
                        Select
                      </option>
                        <option value="">Head Office</option>
                        <option value="">Branch</option>
                    </select>
                    <span class="input__title">Office</span>
                    @if ($errors->has('designation'))
                      <p class="text-danger">{{$errors->first('designation')}}</p>
                    @endif
                  </div>
                  <!-- 2 -->
                  <div class="input__box">
                    <ion-icon class="pos__abs input__chev__down" name="chevron-down-outline"></ion-icon>
                    <select class="information__input" name="office-branch" placeholder="Enter job title">
                      <option value="" disabled selected>
                        Select
                      </option>
                    </select>
                    <span class="input__title">Job Title</span>
                    @if ($errors->has('designation'))
                      <p class="text-danger">{{$errors->first('designation')}}</p>
                    @endif
                  </div>
                  <!-- 3 -->
                  <div class="input__box">
                    <ion-icon class="pos__abs input__chev__down" name="chevron-down-outline"></ion-icon>
                    <select class="information__input" name="office-branch" placeholder="Enter job title">
                      <option value="" disabled selected>
                        Select
                      </option>
                    </select>
                    <span class="input__title">Job Title</span>
                    @if ($errors->has('designation'))
                      <p class="text-danger">{{$errors->first('designation')}}</p>
                    @endif
                  </div>
                </div>
                <!-- Input group for salary adjustment -->
                <div class="reassign__input__box salary">
                  <!-- 1 -->
                  <div class="input__box">
                    <input
                      class="information__input" 
                      placeholder="Enter salary"
                    />
                    <span class="input__title">New Salary</span>
                  </div>
                </div>
                <!-- Input group for phone and assets update -->
                <div class="reassign__input__box phone">
                  <!-- 1 -->
                  <div class="input__box">
                    <input
                      class="information__input" 
                      placeholder="Enter company phone no."
                    />
                    <span class="input__title">Company Phone</span>
                  </div>
                </div>

                <!-- INPUT GROUP ENDS HERE -->
                <p class="subheading">Additional Information</p>
                <div class="checkbox__container">
                  <!-- 1 -->
                  <div class="check__box flex job__title__box">
                    <input
                      class="checkbox__input job__title"
                      type="checkbox"
                      name="checkbox"
                    />
                    <p class="option__text">Job Title and Description</p>
                  </div>
                  <!-- 1 -->
                  <div class="check__box flex salary__update__box">
                    <input
                      class="checkbox__input salary__update"
                      type="checkbox"
                      name="checkbox"
                    />
                    <p class="option__text">Update Compensation</p>
                  </div>
                  <!-- 1 -->
                  <div class="check__box flex">
                    <input
                      class="checkbox__input phone__update"
                      type="checkbox"
                      name="checkbox"
                    />
                    <p class="option__text">Company Phone and Assets</p>
                  </div>
                </div>
                <div class="btn__box">
                  <button class="btn__primary" type="submit">
                    <ion-icon class="icon__add" name="document-text-outline"></ion-icon> Reassign
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </main>
    <footer class="footer">
      <p class="copyright">&copy;{{isset($about['companyName']) ? $about['companyName'] : 'Company name is not available' }} <?php echo date('Y') ?>. All Rights Reserved.</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        // Handle checkbox changes
        $('.checkbox__input').on('change', function () {
          const $checkbox = $(this);
          const isChecked = $checkbox.prop('checked');
          let titleText = 'Additional Information';

          if ($checkbox.hasClass('job__title')) {
            $('.promotion').toggleClass('show', isChecked);
            titleText = 'Job Title and Description';
          } else if ($checkbox.hasClass('salary__update')) {
            $('.salary').toggleClass('show', isChecked);
            titleText = 'Update Compensation';
          } else if ($checkbox.hasClass('phone__update')) {
            $('.phone').toggleClass('show', isChecked);
            titleText = 'Company Phone and Assets';
          }
        });


        $('#movementSelect').on('change', function() {
            $('.reassign__input__box').removeClass('show'); 
            const selectedValue = $(this).val();
            const checkBoxInput = $('.checkbox__input');
            $('.checkbox__input').prop('checked', false);
            switch (selectedValue) {
              case 'promotion':
                $('.job__title__box').hide();
                $('.salary__update__box').show();
                break;
              case 'demotion':
                $('.job__title__box').hide();
                $('.salary__update__box').show();
                break;
              case 'salary':
                $('.salary__update__box').hide();
                $('.job__title__box').show();
                break;
              default:
              $('.salary__update__box').show();
              $('.job__title__box').show();
            }
            checkBoxInput.addClass('allowed');
            $(`.reassign__input__box.${selectedValue}`).addClass('show'); 
            $(`#${selectedValue}`).addClass('show'); 
            $('#inputGroupTitle').addClass('show'); 
            $('#inputGroupTitle').text(`${selectedValue} Information`);
            console.log('test');
        });

      
        $(document).on("click", ".btn__select", function () {
          const dropdown = $(".dropdown__select");
          const i = $(this).index(".btn__select");

          dropdown.removeClass("open");
          if (dropdown[i]) {
            $(dropdown[i]).toggleClass("open");
          }
        });

        $(document).on("click", function (event) {
          const dropDownAction = $(".dropdown__select");
          if (
            !$(event.target).closest(".dropdown__select").length &&
            !$(event.target).closest(".btn__select").length
          ) {
            dropDownAction.removeClass("open");
          }
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  </body>
</html>
