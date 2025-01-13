
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
              <p class="count">{{$regular}}</p>
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
              <p class="count">{{$new}}</p>
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
              <p class="count">{{$total}}</p>
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
              <p class="count">{{$resign}}</p>
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
              <?php foreach($recent as $row): ?>
              <div class="recent__employees">
                <!-- 1 -->
                 <a class="link__employee__container" href="{{route('hr/employee/view',['companyID'=>$row['companyID']])}}">
                  <div class="employee__box">
                    <div class="employee__name__title">
                      <p class="employee__name"><?php echo $row['surName'] ?>, <?php echo $row['firstName'] ?> <?php echo $row['middleName'] ?></p>
                      <p class="employee__role"><?php echo $row['designation'] ?></p>
                    </div>
                    <ion-icon class="chev__down__employee" name="chevron-forward-outline"></ion-icon>
                  </div>
                  <a class="no-underline"></a>
                </a>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
          <!-- 2 -->
          <form class="card recent__employee__card">
            <p class="subheading margin__bottom__3">Announcement</p>
            <div class="scroll__box">
              <?php foreach($announcement as $row): ?>
              <?php
              $dateObj = new DateTime($row['dateEffective']);
              $formattedDate = $dateObj->format('d M Y'); 
              ?>
              <div class="recent__employees">
                 <a class="link__employee__container" href="/memo/{{$row['File']}}" target="_BLANK">
                  <div class="employee__box">
                    <div class="employee__name__title">
                      <p class="employee__name">{{substr($row['Title'],0,30)}}..</p>
                      <p class="employee__role">Date : <?php echo $formattedDate ?></p>
                    </div>
                    <ion-icon class="chev__down__employee" name="chevron-forward-outline"></ion-icon>
                  </div>
                  <a class="no-underline"></a>
                </a>
              </div>
              <?php endforeach; ?>
            </div>
            <div class="compose__box">
              <a class="compose" href="{{route('hr/memo')}}"><ion-icon class="compose__icon" name="book-outline"></ion-icon>More...</a>
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
        // Select nav then add bg
        const $nav = $('.navigation');
        
        if ($nav.length) {

          const $targetNavItem = $nav.find('.nav__item').eq(0);
          $targetNavItem.addClass('selected');
          
          const $dropdown = $targetNavItem.find('.dropdown');
          if ($dropdown.length) {
            const $secondDropdownItem = $dropdown.find('.dropdown__item').eq(1); // Second item (index 1)
            $secondDropdownItem.addClass('highlight');
          }
        }
        // Nav select ends here
        generateChart();
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
      function generateChart() {
        $.ajax({
            url: "{{route('chart-data')}}", // Endpoint for employee data
            method: "GET",
            success: function(data) {
                // Step 2: Prepare the data for ApexCharts
                const dates = data.map(item => item.dateHired);
                const counts = data.map(item => item.total);

                // Step 3: Initialize ApexCharts
                var options = {
                    chart: {
                        type: 'area',
                        height: 350
                    },
                    series: [{
                        name: 'Employee Count',
                        data: counts
                    }],
                    xaxis: {
                        categories: dates,
                        title: {
                            text: 'Date Hired'
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Total Employees',
                            style: {
                            fontFamily: 'Poppins, sans-serif',  
                            fontSize: '15px',
                            fontWeight: '600' 
                          }
                        }
                    },
                    title: {
                        text: 'Employee Count Over Date',
                        align: 'center',  
                        style: {
                          fontFamily: 'Poppins, sans-serif',  
                          fontSize: '15px',
                          fontWeight: '600' 
                        }
                      }
                };

                var chart = new ApexCharts(document.querySelector("#chart"), options);
                chart.render();
            },
            error: function(xhr, status, error) {
                console.error("There was an error with the AJAX request:", error);
            }
        });
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
