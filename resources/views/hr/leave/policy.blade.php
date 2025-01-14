
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
    <link rel="stylesheet" href="/assets/css/leave-policy.css" />
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
              <p class="pages"><a href="{{route('hr/overview')}}" class="link__breadcrumbs">Dashboard</a><ion-icon name="chevron-forward-outline"></ion-icon><span class="breadcrumbs__right__text">Leave Types and Policy</span></p>
          </div>
        </div>
        <div class="card__container">
          <div class="input__box__items">
          <p class="subheading margin__bottom__3">Policy</p>
            <div class="pos__rel">
              <div class="button__box pos__abs">
                <a href="javascript:void(0);" class="link add__btn newPolicy">
                  <ion-icon class="icon" name="add-outline"></ion-icon>Create
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
        
                  <tr>
                    <td>1</td>
                    <td>2</td>
                    <td>3</td>
                    <td>4</td>
                    <td>5</td>
                    <td><button class="select__item form__button text-dark edit__policy"><ion-icon class="chev__down__employee select__icon" name="repeat-outline"></ion-icon>Edit</button></td>
                  </tr>
         
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="input__box__items">
            <div class="heading__container__leave">
              <p class="subheading margin__bottom__3">Type of Leave</p>
              <div class="button__box">
                <a href="javascript:void(0);" class="link add__btn newTypeOfLeave">
                  <ion-icon class="icon" name="add-outline"></ion-icon>Create
                </a>
              </div>
            </div>
            <div class="scroll__box">
              <div class="recent__employees">
                <div class="link__employee__container">
                  <div class="employee__box">
                    <div class="employee__name__title">
                      <p class="employee__name">Emergency Leave</p>
                      <p class="employee__role">13 Jan 2025</p>
                    </div>
                    <!-- <ion-icon class="chev__down__employee md hydrated" name="chevron-forward-outline" role="img"></ion-icon> -->
                    <button type="button" class="select__item form__button text-dark edit__type__leave"><ion-icon class="chev__down__employee select__icon" name="repeat-outline"></ion-icon>Edit</button>
                  </div>
                  <a class="no-underline"></a>
                </div>
                <div class="link__employee__container">
                  <div class="employee__box">
                    <div class="employee__name__title">
                      <p class="employee__name">Vacation Leave</p>
                      <p class="employee__role">13 Jan 2025</p>
                    </div>
                    <button type="button" class="select__item form__button text-dark edit_job edit__type__leave"><ion-icon class="chev__down__employee select__icon" name="repeat-outline"></ion-icon>Edit</button>
                  </div>
                  <a class="no-underline"></a>
                </>
              </div>
            </div>
          </div>
         </div>
      </div>
      <!-- NEW POLICY MODAL -->
      <div class="modal-overlay" id="newPolicyModal">
          <div class="modal">
            <div class="modal__heading">
              <div class="heading__modal__box">
                <h2 class="heading__modal">Create Leave Policy</h2>
                <p class="subheading__modal">New Policy</p>
              </div>
              <div class="close__box"><ion-icon onclick="closePolicyModal()" class="icon__modal" name="close-outline"></ion-icon></div>
              </div>
              <form method="POST" class="form__modal" id="">
                @csrf
                <div class="input__box">
                  <input
                    class="information__input"
                    placeholder="Enter title"
                    name="" value=""
                  />
                  <span class="input__title">Policy Title</span>
                </div>
                <!-- 1 -->
                <input type="hidden" name="" id=""/>
                <div class="input__form__modal__box">
                  <div class="input__box">
                    <select class="information__input" name="">
                      <option value="" disabled selected>
                        Select Gender
                      </option>
                      <option value="">
                        Male
                      </option>
                      <option value="">
                        Female
                      </option>
                      <option value="">
                        All
                      </option>
                    </select>
                    <span class="input__title">Gender</span>
                    <div id="designation-error" class="error-message text-danger"></div>
                  </div>
                </div>
                <!-- 2 -->
                <input type="hidden" name="" id=""/>
                <div class="input__form__modal__box">
                  <div class="input__box">
                    <select class="information__input" name="">
                      <option value="" disabled selected>
                        Select Civil Status
                      </option>
                      <option value="">
                        Single
                      </option>
                      <option value="">
                        Married
                      </option>
                      <option value="">
                        Divorced
                      </option>
                      <option value="">
                        All
                      </option>
                    </select>
                    <span class="input__title">Civil Status</span>
                    <div id="designation-error" class="error-message text-danger"></div>
                  </div>
                </div>
                <!-- 3 -->
                <input type="hidden" name="" id=""/>
                <div class="input__form__modal__box">
                  <div class="input__box">
                    <select class="information__input" name="">
                      <option value="" disabled selected>
                        Select Status
                      </option>
                      <option value="">
                        Probationary
                      </option>
                      <option value="">
                        Regulary
                      </option>
                      <option value="">
                        Permanent
                      </option>
                      <option value="">
                        All
                      </option>
                    </select>
                    <span class="input__title">Employment Status</span>
                    <div id="designation-error" class="error-message text-danger"></div>
                  </div>
                </div>
                <button type="submit" class="btn__submit__modal"><ion-icon class="icon" name="paper-plane-outline"></ion-icon>Submit</button>
              </form>
          </div>
      </div>
      <!-- EDIT POLICY MODAL -->
      <div class="modal-overlay" id="editPolicyModal">
          <div class="modal">
            <div class="modal__heading">
              <div class="heading__modal__box">
                <h2 class="heading__modal">Update Leave Policy</h2>
                <p class="subheading__modal">Edit Policy</p>
              </div>
              <div class="close__box"><ion-icon onclick="closeEditPolicyModal()" class="icon__modal" name="close-outline"></ion-icon></div>
              </div>
              <form method="POST" class="form__modal" id="">
                @csrf
                <div class="input__box">
                  <input
                    class="information__input"
                    placeholder="Enter title"
                    name="" value=""
                  />
                  <span class="input__title">Policy Title</span>
                </div>
                <!-- 1 -->
                <input type="hidden" name="" id=""/>
                <div class="input__form__modal__box">
                  <div class="input__box">
                    <select class="information__input" name="">
                      <option value="" disabled selected>
                        Select Gender
                      </option>
                      <option value="">
                        Male
                      </option>
                      <option value="">
                        Female
                      </option>
                      <option value="">
                        All
                      </option>
                    </select>
                    <span class="input__title">Gender</span>
                    <div id="designation-error" class="error-message text-danger"></div>
                  </div>
                </div>
                <!-- 2 -->
                <input type="hidden" name="" id=""/>
                <div class="input__form__modal__box">
                  <div class="input__box">
                    <select class="information__input" name="">
                      <option value="" disabled selected>
                        Select Civil Status
                      </option>
                      <option value="">
                        Single
                      </option>
                      <option value="">
                        Married
                      </option>
                      <option value="">
                        Divorced
                      </option>
                      <option value="">
                        All
                      </option>
                    </select>
                    <span class="input__title">Civil Status</span>
                    <div id="designation-error" class="error-message text-danger"></div>
                  </div>
                </div>
                <!-- 3 -->
                <input type="hidden" name="" id=""/>
                <div class="input__form__modal__box">
                  <div class="input__box">
                    <select class="information__input" name="">
                      <option value="" disabled selected>
                        Select Status
                      </option>
                      <option value="">
                        Probationary
                      </option>
                      <option value="">
                        Regulary
                      </option>
                      <option value="">
                        Permanent
                      </option>
                      <option value="">
                        All
                      </option>
                    </select>
                    <span class="input__title">Employment Status</span>
                    <div id="designation-error" class="error-message text-danger"></div>
                  </div>
                </div>
                <button type="submit" class="btn__submit__modal"><ion-icon class="icon" name="paper-plane-outline"></ion-icon>Submit</button>
              </form>
          </div>
      </div>
      <!-- NEW TYPE OF LEAVE MODAL -->
      <div class="modal-overlay" id="newTypeOfLeave">
          <div class="modal">
            <div class="modal__heading">
              <div class="heading__modal__box">
                <h2 class="heading__modal">Create Type of Leave</h2>
                <p class="subheading__modal">New Type of Leave</p>
              </div>
              <div class="close__box"><ion-icon onclick="closeTypeOfLeave()" class="icon__modal" name="close-outline"></ion-icon></div>
              </div>
              <form method="POST" class="form__modal" id="">
                @csrf
                <div class="input__box">
                  <input
                    class="information__input"
                    placeholder="Enter title"
                    name="" value=""
                  />
                  <span class="input__title">Leave Title</span>
                </div>
                <button type="submit" class="btn__submit__modal margin__top__3"><ion-icon class="icon" name="paper-plane-outline"></ion-icon>Submit</button>
            </form>
          </div>
        </div>
      <!-- EDIT TYPE OF LEAVE MODAL -->
      <div class="modal-overlay" id="editTypeOfLeave">
          <div class="modal">
            <div class="modal__heading">
              <div class="heading__modal__box">
                <h2 class="heading__modal">Update Type of Leave</h2>
                <p class="subheading__modal">Edit Type of Leave</p>
              </div>
              <div class="close__box"><ion-icon onclick="closeEditTypeOfLeave()" class="icon__modal" name="close-outline"></ion-icon></div>
              </div>
              <form method="POST" class="form__modal" id="">
                @csrf
                <div class="input__box">
                  <input
                    class="information__input"
                    placeholder="Enter title"
                    name="" value=""
                  />
                  <span class="input__title">Leave Title</span>
                </div>
                <button type="submit" class="btn__submit__modal margin__top__3"><ion-icon class="icon" name="paper-plane-outline"></ion-icon>Submit</button>
            </form>
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
    <script src="/assets/js/master-file.js"></script>
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
