
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
        <h1 class="heading__primary">{{$title}}</h1>
        <div class="breadcrumbs">
          <p class="pages">Maintenance | <span>{{$title}}</span></p>
        </div>
      </div>
      <div class="card_container">
        <div class="card">
          <div class="card-header">
            <div class="card-title">Edit Account</div>
          </div>
          <div class="card-body">
            <?php if($account): ?>
            <form method="POST" id="frmAccount" action="{{route('save-account')}}">
              @csrf
              <input type="hidden" name="token" value="{{$account['Token']}}"/>
              <div class="input__boxes grid single__row">
                <div class="input__box">
                  <input
                    class="information__input" value="{{ $account['Fullname'] }}"
                    placeholder="Enter fullname" name="fullname"
                  />
                  <span class="input__title">Fullname</span>
                  @if ($errors->has('fullname'))
                    <p class="text-danger">{{$errors->first('fullname')}}</p>
                  @endif
                </div>
              </div>
              <div class="input__boxes grid two_half__row">
                <!-- 1 -->
                <div class="input__box">
                  <input
                    class="information__input" value="{{ $account['Username'] }}"
                    placeholder="Enter username" name="username"
                  />
                  <span class="input__title">Username</span>
                  @if ($errors->has('username'))
                    <p class="text-danger">{{$errors->first('username')}}</p>
                  @endif
                </div>
                <!-- 2 -->
                <div class="input__box">
                  <input
                  type="email"
                    class="information__input" value="{{ $account['Email'] }}"
                    placeholder="Enter email" name="email_address"
                  />
                  <span class="input__title">Email</span>
                  @if ($errors->has('email_address'))
                    <p class="text-danger">{{$errors->first('email_address')}}</p>
                  @endif
                </div>
                <!-- 3 -->
                <div class="input__box">
                  <ion-icon class="pos__abs input__chev__down" name="chevron-down-outline"></ion-icon>
                  <select class="information__input" name="status"
                    placeholder="Enter status">
                    <option value="" disabled selected>
                        Select
                    </option>
                    <option value="1" {{ $account['Status'] == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ $account['Status'] == 0 ? 'selected' : '' }}>Inactive</option>
                  </select>
                  <span class="input__title">Status</span>
                  @if ($errors->has('status'))
                    <p class="text-danger">{{$errors->first('status')}}</p>
                  @endif
                </div>
              </div>
              <div class="input__boxes grid single__row">
                <p class="text-small">System Role</p>
                <div class="radio-group">
                  <label>
                    <?php if($account['Role']=="Admin"){ ?>
                    <input type="radio" name="role" value="Admin" checked> Administrator
                    <?php }else { ?>
                    <input type="radio" name="role" value="Admin"> Administrator
                    <?php } ?>
                  </label>
                  <label>
                    <?php if($account['Role']=="Manager"){ ?>
                    <input type="radio" name="role" value="Manager" checked> Manager
                    <?php }else { ?>
                    <input type="radio" name="role" value="Manager"> Manager
                    <?php } ?>
                  </label>
                  <label>
                  <label>
                    <?php if($account['Role']=="Standard-user"){ ?>
                    <input type="radio" name="role" value="Standard-user" checked> Standard User
                    <?php }else { ?>
                    <input type="radio" name="role" value="Standard-user"> Standard User
                    <?php } ?>
                  </label>
                  </label>
                </div>
                  @if ($errors->has('role'))
                    <p class="text-danger">{{$errors->first('role')}}</p>
                  @endif
              </div>
              <div class="btn__box">
                <a href="{{route('hr/settings')}}" class="btn__return">
                  <ion-icon class="icon__add" name="arrow-back-outline"></ion-icon> Return
                </a>
                <button class="btn__primary" type="submit">
                  <ion-icon class="icon__add" name="save-outline"></ion-icon> Save Changes
                </button>
              </div>
            </form>
            <?php endif; ?>
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
        // Uploading picture Starts here ~
        // Trigger file input click when the image icon is clicked
        $("#uploadButton").on("click", function () {
          $("#fileInput").click();
        });

        // Image selection
        $("#fileInput").on("change", function () {
          const file = this.files[0];

          if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
              $("#profileImage").attr("src", e.target.result);
            };

            reader.readAsDataURL(file);
          } else {
            alert("No file selected!");
          }
        });
        // Clear image source when trash button is clicked
        $("#cancelButton").on("click", function () {
          $("#profileImage").attr("src", "/assets/images/default_image.png");
          $("#fileInput").val("");
        });
        // Uploading picture ends here ~

        // Data Tables script
        $("#dataTable").DataTable();
        // Data tables ends here ~

        // Event Listeners
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
