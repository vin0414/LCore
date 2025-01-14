
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="/assets/css/reusables.css" />
    <link rel="stylesheet" href="/assets/css/dashboard.css" />
    <link rel="stylesheet" href="/assets/css/table.css" />
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
            <!-- <p class="pages">{{isset($about['companyName']) ? $about['companyName'] : 'Company name is not available' }} | <span>{{$title}}</span></p>
              -->
              <p class="pages"><a href="{{route('hr/overview')}}" class="link__breadcrumbs">Dashboard</a><ion-icon name="chevron-forward-outline"></ion-icon><span class="breadcrumbs__right__text">Leave Types and Policy</span></p>
          </div>
        </div>
        <div class="card__container">
          <div class="input__box__items">
            <div class="pos__rel">
              <div class="button__box pos__abs">
                <a href="javascript:void(0);" class="link add__btn newPolicy">
                  <ion-icon class="icon" name="add-outline"></ion-icon>New
                </a>
              </div>
              <div class="dataWrapper">
                <table id="dataTable" class="display">
                  <thead>
                      <th>#</th>
                      <th class="w-100">Type of Leave</th>
                      <th class="w-100">Gender</th>
                      <th class="w-100">Civil Status</th>
                      <th>Employment Status</th>
                      <th class="w-50">Action</th>
                  </thead>
                  <tbody>
                  @foreach($leave as $row)
                  <tr>
                    <td>{{$row['leaveID']}}</td>
                    <td>{{$row['leaveName']}}</td>
                    <td>{{$row['gender']}}</td>
                    <td>{{$row['civilStatus']}}</td>
                    <td>{{$row['employmentStatus']}}</td>
                    <td></td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="input__box__items">
            <p class="subheading margin__bottom__3">Type of Leave</p>
            <div class="scroll__box">
              <div class="recent__employees">
                <a class="link__employee__container" href="">
                  <div class="employee__box">
                    <div class="employee__name__title">
                      <p class="employee__name">Emergency Leave</p>
                      <p class="employee__role">13 Jan 2025</p>
                    </div>
                    <ion-icon class="chev__down__employee" name="chevron-forward-outline"></ion-icon>
                  </div>
                  <a class="no-underline"></a>
                </a>
                <a class="link__employee__container" href="">
                  <div class="employee__box">
                    <div class="employee__name__title">
                      <p class="employee__name">Vacation Leave</p>
                      <p class="employee__role">13 Jan 2025</p>
                    </div>
                    <ion-icon class="chev__down__employee" name="chevron-forward-outline"></ion-icon>
                  </div>
                  <a class="no-underline"></a>
                </a>
              </div>
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
        $("#dataTable").DataTable({
          dom:
            "<'row'<'col-sm-6'f>>" + // Search box on top in the same row
            "<'row'<'col-sm-12'tr>>" + // Table
            "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'p>>", // Bottom (length + pagination)

          oLanguage: { sSearch: "" },
          initComplete: function () {
            $("#dataTable_filter input").attr(
              "placeholder",
              "Search by name , etc."
            );
          },
        });
            // Select nav then add bg
      const $nav = $('.navigation');
        
        if ($nav.length) {

          const $targetNavItem = $nav.find('.nav__item').eq(4);
          $targetNavItem.addClass('selected');
          
          const $dropdown = $targetNavItem.find('.dropdown');
          if ($dropdown.length) {
            const $secondDropdownItem = $dropdown.find('.dropdown__item').eq(1); // Second item (index 1)
            $secondDropdownItem.addClass('highlight');
          }
        }
        // Nav select ends here
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
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  </body>
</html>
