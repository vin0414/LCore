
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
    <link rel="stylesheet" href="/assets/css/new-account.css" />
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
              >Upload Files</a>
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
          <?php } ?>
        </ul>
      </aside>
      <div class="container">
        <div class="heading__box flex flex__align__center">
          <h1 class="heading__primary">{{$title}}</h1>
          <div class="breadcrumbs">
            <p class="pages">Memo | <span>{{$title}}</span></p>
          </div>
        </div>
        <div class="card_container">
          <div class="card">
            <div class="card-header">
              <div class="subheading">Edit Broadcast</div>
            </div>
            <div class="card-body">
              @if($announcement)
              <form method="POST" id="frmBroadcast" enctype="multipart/form-data" action="{{route('edit-broadcast')}}">
                @csrf
                <input type="hidden" name="announcementID" value="{{$announcement['announcementID']}}"/>
                <div class="input__boxes grid single__row">
                  <div class="input__box">
                    <input
                      class="information__input" value="{{ $announcement['Title'] }}"
                      placeholder="Enter Title" name="title"
                    />
                    <span class="input__title">Broadcast Title</span>
                    @if ($errors->has('title'))
                      <p class="text-danger">{{$errors->first('title')}}</p>
                    @endif
                  </div>
                </div>
                <div class="input__boxes grid second__row_v3">
                  <div class="input__box">
                    <input type="date"
                      class="information__input" value="{{ $announcement['dateEffective'] }}"
                      placeholder="Enter effective date" name="date_effective"
                    />
                    <span class="input__title">Effective Date</span>
                    @if ($errors->has('date_effective'))
                      <p class="text-danger">{{$errors->first('date_effective')}}</p>
                    @endif
                  </div>
                  <div class="input__box">
                    <input type="date"
                      class="information__input" value="{{ $announcement['dateExpired'] }}"
                      placeholder="Enter effective date" name="date_expired"
                    />
                    <span class="input__title">Expired Date</span>
                    @if ($errors->has('date_expired'))
                      <p class="text-danger">{{$errors->first('date_expired')}}</p>
                    @endif
                  </div>
                  <div class="input__box">
                    <ion-icon class="pos__abs input__chev__down" name="chevron-down-outline"></ion-icon>
                    <select
                        class="information__input" name="priority_level" placeholder="Select">
                        <option value="" disabled selected>
                          Select
                        </option>
                        <option value="Urgent" {{ $announcement['priorityLevel'] == "Urgent" ? 'selected' : '' }}>Urgent</option>
                        <option value="Immediate" {{ $announcement['priorityLevel'] == "Immediate" ? 'selected' : '' }}>Immediate</option>
                        <option value="Standard" {{ $announcement['priorityLevel'] == "Standard" ? 'selected' : '' }}>Standard</option>
                    </select>
                    <span class="input__title">Priority Level</span>
                    @if ($errors->has('priority_level'))
                      <p class="text-danger">{{$errors->first('priority_level')}}</p>
                    @endif
                  </div>
                  <div class="input__box">
                    <ion-icon class="pos__abs input__chev__down" name="chevron-down-outline"></ion-icon>
                    <select
                        class="information__input" name="recipient" placeholder="Select">
                        <option value="" disabled selected>
                          Select
                        </option>
                        <option value="All Employees" {{ $announcement['Recipient'] == "All Employees" ? 'selected' : '' }}>All Employees</option>
                        <option value="All HO Managers" {{ $announcement['Recipient'] == "All HO Managers" ? 'selected' : '' }}>All HO Managers</option>
                        <option value="All Branch Managers" {{ $announcement['Recipient'] == "All Branch Managers" ? 'selected' : '' }}>All Branch Managers</option>
                        <option value="All Managers" {{ $announcement['Recipient'] == "All Managers" ? 'selected' : '' }}>All Managers</option>
                    </select>
                    <span class="input__title">Recipients</span>
                    @if ($errors->has('recipient'))
                      <p class="text-danger">{{$errors->first('recipient')}}</p>
                    @endif
                  </div>
                </div>
                <div class="input__boxes grid single__row">
                  <div class="input__box">
                    <textarea
                      class="information__input"
                      placeholder="Enter details" name="details" style="height:200px;"
                    >{{ $announcement['Details'] }}</textarea>
                    <span class="input__title">Details</span>
                    @if ($errors->has('details'))
                      <p class="text-danger">{{$errors->first('details')}}</p>
                    @endif
                  </div>
                </div>
                <div class="input__boxes grid single__row">
                  <div class="input__box">
                    <input type="file"
                      class="information__input" value="{{ old('file') }}"
                      placeholder="Attach file" name="file"
                    />
                    <span class="input__title">File</span>
                    @if ($errors->has('file'))
                      <p class="text-danger">{{$errors->first('file')}}</p>
                    @endif
                  </div>
                </div>
                <div class="btn__box">
                  <a href="{{route('hr/memo')}}" class="btn__return">
                    <ion-icon class="icon__add" name="arrow-back-outline"></ion-icon> Return
                  </a>
                  <button class="btn__primary" type="submit">
                    <ion-icon class="icon__add" name="save-outline"></ion-icon> Save Changes
                  </button>
                </div>
              </form>
              @endif
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
