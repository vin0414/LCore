
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="/assets/css/reusables.css" />
    <link rel="stylesheet" href="/assets/css/dashboard.css" />
    <link rel="stylesheet" href="/assets/css/employee.css" />
    <link rel="stylesheet" href="/assets/css/simple-table.css" />
    <link rel="stylesheet" href="/assets/css/table.css" />
    <link rel="stylesheet" href="/assets/css/view-employee.css" />
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
      <!-- Modal for certificates  -->
    <div class="modal-overlay" id="modalOverlay">
        <div class="modal">
          <div class="modal__heading">
            <div class="heading__modal__box">
              <h2 class="heading__modal">Add Certificate TEST</h2>
              <p class="subheading__modal">Apply new certificates</p>
            </div>
            <div class="close__box"><ion-icon onclick="closeModal()" class="icon__modal" name="close-outline"></ion-icon></div>
            </div>
            <form method="POST" class="form__modal" id="frmCertificate">
              @csrf
              <input type="hidden" name="employeeID" id="employeeCertificateID"/>
              <div class="input__form__modal__box">
                <div class="input__box">
                  <input
                    class="information__input"
                    placeholder="Enter title"
                    name="title"
                  />
                  <span class="input__title">Title</span>
                  <div id="title-error" class="error-messages text-danger"></div>
                </div>
                <div class="input__box">
                  <input
                    class="information__input"
                    placeholder="Enter venue"
                    name="venue"
                  />
                  <span class="input__title">Venue</span>
                  <div id="venue-error" class="error-messages text-danger"></div>
                </div>
                <div class="input__box">
                  <input
                    type="date"
                    class="information__input"
                    placeholder="Enter date"
                    name="from_date"
                  />
                  <span class="input__title">From</span>
                  <div id="from_date-error" class="error-messages text-danger"></div>
                </div>
                <div class="input__box">
                  <input
                    type="date"
                    class="information__input"
                    placeholder="Enter date"
                    name="to_date"
                  />
                  <span class="input__title">To</span>
                  <div id="to_date-error" class="error-messages text-danger"></div>
                </div>
              </div>
              <button class="btn__submit__modal" type="submit"><ion-icon class="icon" name="paper-plane-outline"></ion-icon>Submit</button>
            </form>
        </div>
    </div>
      <!-- Modal Edit for certificates  -->
    <div class="modal-overlay" id="modalOverlay4">
        <div class="modal">
          <div class="modal__heading">
            <div class="heading__modal__box">
              <h2 class="heading__modal">Edit Certificate</h2>
              <p class="subheading__modal">Edit employee's certificates</p>
            </div>
            <div class="close__box"><ion-icon onclick="closeModalEditCertOverlay()" class="icon__modal" name="close-outline"></ion-icon></div>
            </div>
            <div id="certificateResult"></div>
        </div>
    </div>
    <!-- Modal for work history  -->
    <div class="modal-overlay" id="modalOverlay2">
        <div class="modal">
          <div class="modal__heading">
            <div class="heading__modal__box">
              <h2 class="heading__modal">Add Work History</h2>
              <p class="subheading__modal">Save employee work history</p>
            </div>
            <div class="close__box"><ion-icon onclick="closeWorkModal()" class="icon__modal" name="close-outline"></ion-icon></div>
            </div>
            <form type="submit" method="POST" class="form__modal" id="frmEmployment">
              @csrf
              <input type="hidden" name="employeeID" id="employeeWorkID"/>
              <div class="input__form__modal__box">
                <div class="input__box">
                  <input
                    class="information__input"
                    placeholder="Enter designation"
                    name="designation"
                  />
                  <span class="input__title">Designation</span>
                  <div id="designation-error" class="error-message text-danger"></div>
                </div>
                <div class="input__box">
                  <input
                    class="information__input"
                    placeholder="Enter company"
                    name="company"
                  />
                  <span class="input__title">Company/Institution</span>
                  <div id="company-error" class="error-message text-danger"></div>
                </div>
                <div class="input__box">
                  <textarea
                    class="information__input"
                    placeholder="Enter address"
                    name="address"></textarea>
                  <span class="input__title">Company Address</span>
                  <div id="address-error" class="error-message text-danger"></div>
                </div>
                <div class="input__box">
                  <input
                    type="date"
                    class="information__input"
                    placeholder="Enter date"
                    name="from"
                  />
                  <span class="input__title">From</span>
                  <div id="from-error" class="error-message text-danger"></div>
                </div>
                <div class="input__box">
                  <input
                    type="date"
                    class="information__input"
                    placeholder="Enter date"
                    name="to"
                  />
                  <span class="input__title">To</span>
                  <div id="to-error" class="error-message text-danger"></div>
                </div>
              </div>
              <button type="submit" class="btn__submit__modal"><ion-icon class="icon" name="paper-plane-outline"></ion-icon>Submit</button>
            </form>
        </div>
    </div>
    <!-- Modal for edit history  -->
    <div class="modal-overlay" id="modalOverlay3">
        <div class="modal">
          <div class="modal__heading">
            <div class="heading__modal__box">
              <h2 class="heading__modal">Edit Work History</h2>
              <p class="subheading__modal">Edit this employee's data</p>
            </div>
            <div class="close__box"><ion-icon onclick="closeModalEditOverlay()" class="icon__modal" name="close-outline"></ion-icon></div>
            </div>
            <div id="workResult"></div>
        </div>
    </div>
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
          <h1 class="heading__primary">{{$title}}</h1>
          <div class="breadcrumbs">
            <p class="pages">Employee | <span>{{$title}}</span></p>
          </div>
        </div>
        <div class="employee__card">
          <form class="form__container" method="POST">
            <?php if($employee): ?>
            <?php 
            // Example hire date (YYYY-MM-DD format)
            $hire_date = $employee['dateHired'];
            
            // Create DateTime objects for the hire date and current date
            $hireDate = new DateTime($hire_date);
            $currentDate = new DateTime();
            
            // Calculate the difference between the current date and the hire date
            $interval = $hireDate->diff($currentDate);
            
            // Get the difference in years, months, and days
            $years = $interval->y;
            $months = $interval->m;
            $days = $interval->d;

            //compute the age
            $dobDate = new DateTime($employee['dob']);
            $today = new DateTime('today');
            $age = $dobDate->diff($today)->y;
            ?>
            <input type="hidden" id="employeeID" value="{{$employee['employeeID']}}"/>
            <div class="first__row grid">
              <div class="profile__picture">
                <p class="profile__heading">Profile Picture</p>
                <div class="picture__box pos__rel">
                  <img
                    class="profile__image"
                    src="/profile/{{$employee['Image']}}"
                    id="profileImage"
                  />
                  <input
                    type="file"
                    id="fileInput"
                    accept="image/*" name="image"
                    style="display: none"
                  />
                </div>
                <p class="text__description bg__color__td">
                  <span class="note">Note:</span> Only .png, .jpg and .jpeg
                  image files are accepted
                </p>
              </div>
              <div class="general__information">
                <div class="info__heading__box">
                  <p class="profile__heading">General Information</p>
                  <div class="button__box__view pos__rel">
                    <div class="dropdown__options">
                      <a href="{{route('hr/employee/edit',['companyID'=>$employee['companyID']])}}" class="btn__primary no-underline">
                        <ion-icon
                          name="create-outline"
                          class="icon__view__emp"
                        ></ion-icon
                        >Edit Profile
                      </a>
                      <a class="btn__primary no-underline" onclick="openModal()">
                        <ion-icon
                          name="document-outline"
                          class="icon__view__emp"
                        ></ion-icon
                        >Add Certificates
                      </a>
                      <a class="btn__primary no-underline" onclick="openWorkModal()">
                        <ion-icon
                          name="reader-outline"
                          class="icon__view__emp"
                        ></ion-icon
                        >Add Work History
                      </a>
                    </div>
                    <a href="{{route('hr/employee')}}" class="btn__return no-underline">
                      <ion-icon
                        name="arrow-back-outline"
                        class="icon__view__emp"
                      ></ion-icon
                      >Back
                    </a>
                    <a id="showDropdownOptions" class="btn__primary no-underline">More <ion-icon
                          name="chevron-down-outline"
                          class="icon__view__emp"></ion-icon>
                    </a>
                  </div>
                </div>
                <div class="input__boxes">
                  <!-- 1 -->
                  <div class="input__row grid__4cols__modified">
                    <div class="input__box">
                      <input
                        class="information__input"
                        placeholder="Enter Surname"
                        name="surname" value="{{$employee['surName']}}"
                      />
                      <span class="input__title">Surname</span>
                    </div>
                    <div class="input__box">
                      <input
                        class="information__input"
                        placeholder="Enter firstname"
                        name="firstname" value="{{$employee['firstName']}}"
                      />
                      <span class="input__title">Firstname</span>
                    </div>
                    <div class="input__box">
                      <input
                        class="information__input"
                        placeholder="Enter middle name"
                        name="middlename" value="{{$employee['middleName']}}"
                      />
                      <span class="input__title">Middle Name</span>
                    </div>
                    <div class="input__box">
                      <input
                        class="information__input"
                        placeholder="Enter suffix"
                        name="suffix" value="{{$employee['suffix']}}"
                      />
                      <span class="input__title">Suffix</span>
                    </div>
                  </div>
                  <!-- 2 -->
                  <div class="input__row grid__6cols__modified">
                    <div class="input__box">
                      <ion-icon
                        class="pos__abs input__chev__down"
                        name="chevron-down-outline"
                      ></ion-icon>
                      <select class="information__input" name="gender">
                        <option value="" disabled selected>
                          Select gender
                        </option>
                        <option value="Male" {{ $employee['gender'] == "Male" ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ $employee['gender'] == "Female" ? 'selected' : '' }}>Female</option>
                      </select>
                      <span class="input__title">Gender</span>
                    </div>
                    <div class="input__box">
                      <ion-icon
                        class="pos__abs input__chev__down"
                        name="chevron-down-outline"
                      ></ion-icon>
                      <select
                        class="information__input" name="civil_status"
                        placeholder="Enter civil status"
                      >
                        <option value="" disabled selected>
                          Select
                        </option>
                        <option {{ $employee['civilStatus'] == "Single" ? 'selected' : '' }}>Single</option>
                        <option {{ $employee['civilStatus'] == "Married" ? 'selected' : '' }}>Married</option>
                        <option {{ $employee['civilStatus'] == "Widowed" ? 'selected' : '' }}>Widowed</option>
                        <option {{ $employee['civilStatus'] == "Separated" ? 'selected' : '' }}>Separated</option>
                        <option {{ $employee['civilStatus'] == "Divorced" ? 'selected' : '' }}>Divorced</option>
                        <option {{ $employee['civilStatus'] == "Single with Children" ? 'selected' : '' }}>Single with Children</option>
                        <option {{ $employee['civilStatus'] == "With Live-In Partner" ? 'selected' : '' }}>With Live-In Partner</option>
                      </select>

                      <span class="input__title">Civil Status</span>
                    </div>
                    <div class="input__box">
                      <input
                        type="text"
                        class="information__input" name="date_of_birth"
                        placeholder="Enter date of birth" value="{{$employee['dob']}}"
                      />
                      <span class="input__title">Date of Birth</span>
                    </div>
                    <div class="input__box">
                      <input
                        type="text"
                        class="information__input" name="age"
                        placeholder="Age" value="<?php echo $age; ?>"
                      />
                      <span class="input__title">Age</span>
                    </div>
                    <div class="input__box">
                      <input
                        class="information__input" name="religion"
                        placeholder="Enter religion" value="{{ $employee['religion'] }}"
                      />
                      <span class="input__title">Religion</span>
                    </div>
                    <div class="input__box">
                      <input
                        type="phone"
                        class="information__input" name="contact_number"
                        placeholder="Enter contact no." value="{{ $employee['contactNumber'] }}"
                        maxlength="11" minlength="11" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                      />
                      <span class="input__title">Contact Number</span>
                    </div>
                  </div>
                  <!-- 3 -->
                  <div class="input__row grid__3cols__modified">
                    <div class="input__box">
                      <input
                        type="email"
                        class="information__input" name="email_address"
                        placeholder="Enter email address" value="{{ $employee['emailAddress'] }}"
                      />
                      <span class="input__title">Email Address</span>
                    </div>
                    <div class="input__box">
                      <input
                        class="information__input" name="address"
                        placeholder="Enter address" value="{{ $employee['address'] }}"
                      />
                      <span class="input__title">Permanent Address</span>
                    </div>
                    <div class="input__box grid__column__mod">
                      <input
                        class="information__input" name="education" value="{{ $employee['education'] }}"
                        placeholder="Enter educational attainment"
                      />
                      <span class="input__title">Educational Attainment</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="second__row">
              <p class="profile__heading work__information">Work Information</p>
              <div class="input__boxes">
                <!-- 1 -->
                <div class="input__row grid__5cols__modified">
                  <div class="input__box">
                    <input
                      type="text"
                      class="information__input"
                      placeholder="Enter date" name="date_hired" value="{{ $employee['dateHired'] }}"
                    />
                    <span class="input__title">Date Hired</span>
                  </div>
                  <div class="input__box">
                    <input
                      class="information__input" name="designation"
                      placeholder="Enter designation" value="{{ $employee['designation'] }}"
                    />
                    <span class="input__title">Designation</span>
                  </div>
                  <div class="input__box">
                    <input
                      type="phone"
                      class="information__input" maxlength="11" minlength="11" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                      placeholder="Enter contact no." name="company_phone" value="{{ $employee['companyPhone'] }}"
                    />
                    <span class="input__title">Company Contact No.</span>
                  </div>
                  <div class="input__box">
                    <ion-icon
                      class="pos__abs input__chev__down"
                      name="chevron-down-outline"
                    ></ion-icon>
                    <select class="information__input" id="office-select" name="office" placeholder="Enter office">
                      <option value="" disabled selected>Select office</option>
                      <?php foreach($office as $row): ?>
                        <option value="<?php echo $row['officeID'] ?>"  {{ $employee['officeID'] == $row['officeID'] ? 'selected' : '' }}><?php echo $row['officeName'] ?></option>
                      <?php endforeach; ?>
                    </select>
                    <span class="input__title">Office</span>
                  </div>

                  <div class="input__box">
                    <ion-icon
                      class="pos__abs input__chev__down"
                      name="chevron-down-outline"
                    ></ion-icon>
                    <select
                      class="information__input"
                      id="department-select" name="department">
                      <option value="">Select one</option>
                      <?php foreach($department as $row): ?>
                        <option value="{{ $row['departmentID'] }}" {{ $employee['departmentID'] == $row['departmentID'] ? 'selected' : '' }}>{{ $row['departmentName'] }}</option>
                      <?php endforeach; ?>
                    </select>
                    <span id="officeTitle" class="input__title"
                      >Department | Branch</span
                    >
                  </div>
                </div>
                <!-- 2 -->
                <div class="input__row grid__5cols__modified">
                  <div class="input__box">
                    <ion-icon
                      class="pos__abs input__chev__down"
                      name="chevron-down-outline"
                    ></ion-icon>
                    <select class="information__input" name="job_level">
                      <option value="" disabled selected>
                        Select job level
                      </option>
                      <option value="Rank and File" {{ $employee['jobLevel'] == "Rank and File" ? 'selected' : '' }}>Rank and File</option>
                      <option value="Specialist" {{ $employee['jobLevel'] == "Specialist" ? 'selected' : '' }}>Specialist</option>
                      <option value="Officer" {{ $employee['jobLevel'] == "Officer" ? 'selected' : '' }}>Officer</option>
                      <option value="Supervisor" {{ $employee['jobLevel'] == "Supervisor" ? 'selected' : '' }}>Supervisor</option>
                      <option value="Managerial" {{ $employee['jobLevel'] == "Managerial" ? 'selected' : '' }}>Managerial</option>
                      <option value="Executive" {{ $employee['jobLevel'] == "Executive" ? 'selected' : '' }}>Executive</option>
                    </select>
                    <span class="input__title">Job Level</span>
                  </div>
                  <div class="input__box">
                    <ion-icon
                      class="pos__abs input__chev__down"
                      name="chevron-down-outline"
                    ></ion-icon>
                    <select class="information__input" name="employment_status">
                      <option value="" disabled selected>Select status</option>
                      <option {{ $employee['employmentStatus'] == "Probationary" ? 'selected' : '' }}>Probationary</option>
                      <option {{ $employee['employmentStatus'] == "Regular" ? 'selected' : '' }}>Regular</option>
                      <option {{ $employee['employmentStatus'] == "Contractual" ? 'selected' : '' }}>Contractual</option>
                      <option {{ $employee['employmentStatus'] == "Trainee" ? 'selected' : '' }}>Trainee</option>
                    </select>
                    <span class="input__title">Employment Status</span>
                  </div>
                  <div class="input__box">
                    <input
                      type="text"
                      class="information__input" value="{{ $employee['regularizationDate'] }}"
                      placeholder="Enter date" name="regularization_date"
                    />
                    <span class="input__title">Regularization Date</span>
                  </div>
                  <div class="input__box">
                    <input
                      type="text"
                      class="information__input" value="<?php echo "Years: $years, Months: $months, Days: $days"; ?>"
                      placeholder="Enter date" name="regularization_date"
                    />
                    <span class="input__title">Length of Service</span>
                  </div>
                  <div class="input__box">
                    <input
                      type="number"
                      class="information__input" name="payroll_payment"
                      placeholder="Enter payment" value="{{ $employee['payMethod'] }}"
                    />
                    <span class="input__title">Payroll Payment</span>
                  </div>
                </div>
                <!-- 3 -->
                <p class="profile__heading government__details">
                  Government Records
                </p>
                <div class="input__row grid__4cols__modified">
                  <div class="input__box">
                    <input
                      type="number"
                      class="information__input" value="{{ $employee['sssNo'] }}"
                      placeholder="Enter SSS number" name="sss_no"
                    />
                    <span class="input__title">SSS Number</span>
                  </div>
                  <div class="input__box">
                    <input
                      type="number"
                      class="information__input" value="{{ $employee['philhealthNo'] }}"
                      placeholder="Enter philhealth no." name="ph_no"
                    />
                    <span class="input__title">Philhealth Number</span>
                  </div>
                  <div class="input__box">
                    <input
                      type="number"
                      class="information__input" value="{{ $employee['hdmfNo'] }}"
                      placeholder="Enter pag-ibig no." name="hdmf_no"
                    />
                    <span class="input__title">Pag-IBIG Number</span>
                  </div>
                  <div class="input__box">
                    <input
                      type="number"
                      class="information__input" name="tin"
                      placeholder="Enter TIN" value="{{ $employee['tin'] }}"
                    />
                    <span class="input__title">Tax Identification Number</span>
                  </div>
                </div>
              </div>
            </div>
            <?php endif; ?>
          </form>
        </div>
        <div class="employee__card">
          <form class="form__container">
            <p class="profile__heading government__details">Employment History</p>
            <table class="responsive-table">
              <thead>
                  <th class="w-275">Designation</th>
                  <th>Company and Address</th>
                  <th class="w-150">From</th>
                  <th class="w-150">To</th>
                  <th class="w-100">Action</th>
              </thead>
              <tbody id="tblhistory">
              </tbody>
            </table>
          </form>
        </div>
        <div class="employee__card">
          <form class="form__container">
          <p class="profile__heading government__details">Certificates/Trainings</p>
            <table class="responsive-table">
              <thead>
                  <th class="w-275">Title</th>
                  <th>Venue</th>
                  <th class="w-150">From</th>
                  <th class="w-150">To</th>
                  <th class="w-100">Action</th>
              </thead>
              <tbody id="tblcertificate">
              </tbody>
            </table>
          </form>
        </div>
          <div class="employee__card history__card">
            <form class="history__container__parent pos__rel">
            <p class="profile__heading government__details">Career Movement</p>
            <div class="history__grid__layout">
              <div class="history__container">
                <div class="history__box ">
                  <p class="history__date">January 2025</p>
                  <div class="history__title__desc">
                    <div class="history__heading">
                      <p class="history__title">Job Transfer</p>
                      <ion-icon name="repeat-outline" class="history__icon"></ion-icon>
                    </div>
                    <p class="history__description">Moved from area to head office</p>
                    <p class="history__description history__data">Taliwas Office <ion-icon name="arrow-forward-outline"></ion-icon><span class="new__data">Cabanatuan Office</span></p>
                  </div>
                </div>
                <div class="history__box ">
                  <p class="history__date">December 2025</p>
                  <div class="history__title__desc">
                    <div class="history__heading">
                      <p class="history__title">Promotion</p>
                      <ion-icon name="medal-outline" class="history__icon"></ion-icon>
                    </div>
                    <p class="history__description">Promoted from Jr. Developer to System Developer</p>
                    <p class="history__description history__data">12,000.00 <ion-icon name="arrow-forward-outline"></ion-icon> <span class="new__data">21,000.00</span></p>
                  </div>
                </div>
                <div class="history__box ">
                  <p class="history__date">September 2024</p>
                  <div class="history__title__desc">
                    <div class="history__heading">
                      <p class="history__title">Allowance</p>
                      <ion-icon name="wallet-outline" class="history__icon"></ion-icon>
                    </div>
                    <p class="history__description">Allowance adjusted</p>
                    <p class="history__description history__data">0.00<ion-icon name="arrow-forward-outline"></ion-icon> <span class="new__data">500.00</span></p>
                  </div>
                </div>
                <div class="history__box ">
                  <p class="history__date">May 2024</p>
                  <div class="history__title__desc">
                    <div class="history__heading">
                        <p class="history__title">Salary Adjustment</p>
                        <ion-icon name="wallet-outline" class="history__icon"></ion-icon>
                     </div>
                    <p class="history__description">Annual salary increase</p>
                    <p class="history__description history__data">11,000.00 <ion-icon name="arrow-forward-outline"></ion-icon> <span class="new__data">12,000.00</span></p>
                  </div>
                </div>  
              </div>
              <div class="desc__box">
                <p class="history__title">Tovvy Dumaplin's</p>
                <p class="history__description history__subheading">Career Progression</p>
                <p class="history__description">
                A timeline of growth, achievements, and milestones – from early career beginnings to key promotions, job transfers, skill development, and well-earned salary increases. This journey reflects dedication, adaptability, and continuous progress in pursuing greater responsibilities and new opportunities.
                </p>
                <img class="career__image" src="/assets/images/career__progression.png">
              </div>
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
        fetchEmployeeHistory();fetchEmployeeCertificate();

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

        $("#showDropdownOptions").on("click", function (e) {
          e.stopPropagation();
          showDropdownOptions();
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

      function showDropdownOptions() {
       let dropDownOptions = $('.dropdown__options');

       dropDownOptions.toggleClass('show');
      }
      function openModal() {
          $('#modalOverlay').css('display', 'flex');
          $('#employeeCertificateID').attr("value",$('#employeeID').val());
          $('body').addClass('no-scroll');  
      }

      function closeModal() {
          $('#modalOverlay').css('display', 'none');
          $('body').removeClass('no-scroll');  
      }
      function openWorkModal() {
          $('#modalOverlay2').css('display', 'flex');
          $('#employeeWorkID').attr("value",$('#employeeID').val());
          $('body').addClass('no-scroll');  
      }

      function closeWorkModal() {
          $('#modalOverlay2').css('display', 'none');
          $('body').removeClass('no-scroll'); 
      }

      $(document).on('click','.editWork',function (){
          $.ajax({
            url:"{{route('edit-history')}}",method:"GET",
            data:{value:$(this).val()},
            success:function(response)
            {
              $('#modalOverlay3').css('display', 'flex');
              $('body').addClass('no-scroll');
              $('#workResult').html(response);
            }
          });  
      });

      function closeModalEditOverlay() {
          $('#modalOverlay3').css('display', 'none');
          $('body').removeClass('no-scroll'); 
      }

      $(document).on('click','.editCert',function (){
        $.ajax({
            url:"{{route('edit-certificate')}}",method:"GET",
            data:{value:$(this).val()},
            success:function(response)
            {
              $('#modalOverlay4').css('display', 'flex');
              $('body').addClass('no-scroll'); 
              $('#certificateResult').html(response);
            }
          }); 
      });

      function closeModalEditCertOverlay() {
          $('#modalOverlay4').css('display', 'none');
          $('body').removeClass('no-scroll'); 
      }

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
        $(".dropdown__options").removeClass("show");
      }

      $('#frmEmployment').on('submit',function(e){
        e.preventDefault();
        $('.error-message').html('');
        var formData = $(this).serialize();
        $.ajax({
          url:"{{route('save-employee-history')}}",method:"POST",
          data:formData,success:function(response)
          {
            if(response.success)
            {
              closeWorkModal();fetchEmployeeHistory();
            }else{
                var errors = response.errors;
                // Iterate over each error and display it under the corresponding input field
                for (var field in errors) {
                    $('#' + field + '-error').html('<p>' + errors[field][0] + '</p>'); // Show the first error message
                    $('#' + field).addClass('input-error'); // Highlight the input field with an error
                }
            }
          }
        });
      });

      $(document).on('click','.editForm',function(e){
        e.preventDefault();
        var formData = $('#frmEditEmployment').serialize();
        $.ajax({
          url:"{{route('update-history')}}",method:"POST",
          data:formData,success:function(response)
          {
            if(response.success)
            {
              closeModalEditOverlay();fetchEmployeeHistory();
            }else{
                var errors = response.errors;
                // Iterate over each error and display it under the corresponding input field
                for (var field in errors) {
                    $('#' + field + '-error').html('<p>' + errors[field][0] + '</p>'); // Show the first error message
                    $('#' + field).addClass('input-error'); // Highlight the input field with an error
                }
            }
          }
        });
      });

      $('#frmCertificate').on('submit',function(e){
        e.preventDefault();
        $('.error-messages').html('');
        var formData = $(this).serialize();
        $.ajax({
          url:"{{route('save-employee-certificates')}}",method:"POST",
          data:formData,success:function(response)
          {
            if(response.success)
            {
              closeModal();fetchEmployeeCertificate()
            }else{
                var errors = response.errors;
                // Iterate over each error and display it under the corresponding input field
                for (var field in errors) {
                    $('#' + field + '-error').html('<p>' + errors[field][0] + '</p>'); // Show the first error message
                    $('#' + field).addClass('input-error'); // Highlight the input field with an error
                }
            }
          }
        });
      });

      $(document).on('click','.submitForm',function(e){
        e.preventDefault();
        var formData = $('#frmEditCertificate').serialize();
        $.ajax({
          url:"{{route('update-certificate')}}",method:"POST",
          data:formData,success:function(response)
          {
            if(response.success)
            {
              closeModalEditCertOverlay();fetchEmployeeCertificate();
            }else{
                var errors = response.errors;
                // Iterate over each error and display it under the corresponding input field
                for (var field in errors) {
                    $('#' + field + '-error').html('<p>' + errors[field][0] + '</p>'); // Show the first error message
                    $('#' + field).addClass('input-error'); // Highlight the input field with an error
                }
            }
          }
        });
      });

      function fetchEmployeeHistory()
      {
        $('#tblhistory').html("tr><td colspan='5'><center>Loading...</center></td></tr>");
        $.ajax({
          url:"{{route('fetch-employee-history')}}",method:"GET",
          data:{employeeID:$('#employeeID').val()},
          success:function(response){$('#tblhistory').html(response);}
        });
      }

      function fetchEmployeeCertificate()
      {
        $('#tblcertificate').html("tr><td colspan='5'><center>Loading...</center></td></tr>");
        $.ajax({
          url:"{{route('fetch-employee-certificates')}}",method:"GET",
          data:{employeeID:$('#employeeID').val()},
          success:function(response){$('#tblcertificate').html(response);}
        });
      }

      $(document).on('click','.removeCert',function()
      {
        var confirmation = confirm("Do you want to remove this certificate?");
        if(confirmation)
        {
          var csrfToken = $('meta[name="csrf-token"]').attr('content');
          $.ajax({
            url:"{{route('remove-employee-certificates')}}",method:"POST",
            data:{value:$(this).val()},
            headers: {'X-CSRF-TOKEN': csrfToken},success:function(response)
            {
              if(response==="success"){fetchEmployeeCertificate();}else{alert(response);}
            }
          });
        }
      });

      $(document).on('click','.removeWork',function()
      {
        var confirmation = confirm("Do you want to remove this employment record?");
        if(confirmation)
        {
          var csrfToken = $('meta[name="csrf-token"]').attr('content');
          $.ajax({
            url:"{{route('remove-employee-history')}}",method:"POST",
            data:{value:$(this).val()},
            headers: {'X-CSRF-TOKEN': csrfToken},success:function(response)
            {
              if(response==="success"){fetchEmployeeHistory();}else{alert(response);}
            }
          });
        }
      });
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
