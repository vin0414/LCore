
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
    <link rel="stylesheet" href="/assets/css/employee.css" />
    <title>{{isset($about['companyName']) ? $about['companyName'] : 'Company name is not available' }}</title>
  </head>
  <body>
    <header class="header pos__rel">
      <div class="header__box flex flex__align__center">
        <div class="logo__box">
          <img class="logo" src="/assets/images/{{isset($about['companyLogo']) ? $about['companyLogo'] : '' }}" />
        </div>
        <div class="cta__box flex flex__align__center">
          <div class="settings__icons flex flex__align__center">
            <div class="notif__box">
              <ion-icon
                class="header__icon icon__notification"
                name="notifications-outline"
              ></ion-icon>
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
            </div>
            <p class="notification__count">34</p>
          </div>
          <div class="user__images flex flex__align__center">
            <img
              src="/assets/images/user.png"
              alt="Image of the user" height="40"
              class="user__image"
            />
            <p id="userName" class="user__name name__screen__lg"><?php echo session('fullname') ?></p>
            <div class="account__dropdown">
              <p
                class="user__name name__screen__sm flex flex__align__center gap__1"
              >
                <ion-icon name="person-outline"></ion-icon><?php echo session('fullname') ?>
              </p>
              <p
                class="user__name name__screen__sm flex flex__align__center gap__1"
              >
                <ion-icon
                  class="sidebar__icon"
                  name="settings-outline"
                ></ion-icon
                >Account Settings
              </p>
              <p
                class="user__name name__screen__sm flex flex__align__center gap__1"
              >
                <ion-icon
                  class="sidebar__icon"
                  name="settings-outline"
                ></ion-icon
                >Settings
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
            <a href="{{route('hr/memo/new')}}" class="nav__links"
              ><ion-icon
                class="sidebar__icon"
                name="cloud-upload-outline"
              ></ion-icon
              >Upload Files</a
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
          @if(\Session::has('message'))
            <div class="alert alert-danger">
                {{\Session::get('message')}}
            </div>
          @endif
          <form class="form__container" method="POST" action="{{route('update-employee')}}" enctype="multipart/form-data">
            @csrf
            <?php if($employee): ?>
            <input type="hidden" name="employeeID" value="{{ $employee['employeeID'] }}"/> 
            <div class="first__row grid">
              <div class="profile__picture">
                <p class="profile__heading">Profile Picture</p>
                <div class="picture__box pos__rel">
                  <img
                    class="profile__image"
                    src="/profile/{{$employee['Image']}}"
                    id="profileImage"
                  />
                  <ion-icon
                    class="icon__change__image"
                    name="image-outline"
                    id="uploadButton"
                  ></ion-icon>
                  <ion-icon
                    class="icon__delete__image"
                    name="trash-outline"
                    id="cancelButton"
                  ></ion-icon>
                  <!-- Hidden File Input -->
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
                  <a href="{{route('hr/employee')}}" class="btn__primary no-underline">
                    <ion-icon
                      name="arrow-back-outline"
                      class="icon__edit"
                    ></ion-icon
                    >Back
                  </a>
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
                      @if ($errors->has('surname'))
                        <p class="text-danger">{{$errors->first('surname')}}</p>
                      @endif
                    </div>
                    <div class="input__box">
                      <input
                        class="information__input"
                        placeholder="Enter firstname"
                        name="firstname" value="{{$employee['firstName']}}"
                      />
                      <span class="input__title">Firstname</span>
                      @if ($errors->has('firstname'))
                        <p class="text-danger">{{$errors->first('firstname')}}</p>
                      @endif
                    </div>
                    <div class="input__box">
                      <input
                        class="information__input"
                        placeholder="Enter middle name"
                        name="middlename" value="{{$employee['middleName']}}"
                      />
                      <span class="input__title">Middle Name</span>
                      @if ($errors->has('middlename'))
                        <p class="text-danger">{{$errors->first('middlename')}}</p>
                      @endif
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
                  <div class="input__row grid__5cols__modified">
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
                      @if ($errors->has('gender'))
                        <p class="text-danger">{{$errors->first('gender')}}</p>
                      @endif
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
                      @if ($errors->has('civil_status'))
                        <p class="text-danger">{{$errors->first('civil_status')}}</p>
                      @endif
                    </div>
                    <div class="input__box">
                      <input
                        type="date"
                        class="information__input" name="date_of_birth"
                        placeholder="Enter date of birth" value="{{$employee['dob']}}"
                      />
                      <span class="input__title">Date of Birth</span>
                      @if ($errors->has('date_of_birth'))
                        <p class="text-danger">{{$errors->first('date_of_birth')}}</p>
                      @endif
                    </div>
                    <div class="input__box">
                      <input
                        class="information__input" name="religion"
                        placeholder="Enter religion" value="{{ $employee['religion'] }}"
                      />
                      <span class="input__title">Religion</span>
                      @if ($errors->has('religion'))
                        <p class="text-danger">{{$errors->first('religion')}}</p>
                      @endif
                    </div>
                    <div class="input__box">
                      <input
                        type="phone"
                        class="information__input" name="contact_number"
                        placeholder="Enter contact no." value="{{ $employee['contactNumber'] }}"
                        maxlength="11" minlength="11" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                      />
                      <span class="input__title">Contact Number</span>
                      @if ($errors->has('contact_number'))
                        <p class="text-danger">{{$errors->first('contact_number')}}</p>
                      @endif
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
                      @if ($errors->has('email_address'))
                        <p class="text-danger">{{$errors->first('email_address')}}</p>
                      @endif
                    </div>
                    <div class="input__box">
                      <input
                        class="information__input" name="address"
                        placeholder="Enter address" value="{{ $employee['address'] }}"
                      />
                      <span class="input__title">Permanent Address</span>
                      @if ($errors->has('address'))
                        <p class="text-danger">{{$errors->first('address')}}</p>
                      @endif
                    </div>
                    <div class="input__box grid__column__mod">
                      <input
                        class="information__input" name="education" value="{{ $employee['education'] }}"
                        placeholder="Enter educational attainment"
                      />
                      <span class="input__title">Educational Attainment</span>
                      @if ($errors->has('education'))
                        <p class="text-danger">{{$errors->first('education')}}</p>
                      @endif
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
                      type="date"
                      class="information__input"
                      placeholder="Enter date" name="date_hired" value="{{ $employee['dateHired'] }}"
                    />
                    <span class="input__title">Date Hired</span>
                    @if ($errors->has('date_hired'))
                        <p class="text-danger">{{$errors->first('date_hired')}}</p>
                      @endif
                  </div>
                  <div class="input__box">
                    <input
                      class="information__input" name="designation"
                      placeholder="Enter designation" value="{{ $employee['designation'] }}"
                    />
                    <span class="input__title">Designation</span>
                    @if ($errors->has('designation'))
                        <p class="text-danger">{{$errors->first('designation')}}</p>
                      @endif
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
                    @if ($errors->has('office'))
                        <p class="text-danger">{{$errors->first('office')}}</p>
                      @endif
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
                    @if ($errors->has('department'))
                        <p class="text-danger">{{$errors->first('department')}}</p>
                      @endif
                  </div>
                </div>
                <!-- 2 -->
                <div class="input__row grid__4cols__modified">
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
                    @if ($errors->has('job_level'))
                        <p class="text-danger">{{$errors->first('job_level')}}</p>
                      @endif
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
                    @if ($errors->has('employment_status'))
                        <p class="text-danger">{{$errors->first('employment_status')}}</p>
                      @endif
                  </div>
                  <div class="input__box">
                    <input
                      type="date"
                      class="information__input" value="{{ $employee['regularizationDate'] }}"
                      placeholder="Enter date" name="regularization_date"
                    />
                    <span class="input__title">Regularization Date</span>
                  </div>
                  <div class="input__box">
                    <input
                      type="number"
                      class="information__input" name="account_number"
                      placeholder="Enter bank account no." value="{{ $employee['accountNumber'] }}"
                    />
                    <span class="input__title">Bank Account Number</span>
                    @if ($errors->has('account_number'))
                        <p class="text-danger">{{$errors->first('account_number')}}</p>
                      @endif
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
                    @if ($errors->has('sss_no'))
                        <p class="text-danger">{{$errors->first('sss_no')}}</p>
                      @endif
                  </div>
                  <div class="input__box">
                    <input
                      type="number"
                      class="information__input" value="{{ $employee['philhealthNo'] }}"
                      placeholder="Enter philhealth no." name="ph_no"
                    />
                    <span class="input__title">Philhealth Number</span>
                    @if ($errors->has('ph_no'))
                        <p class="text-danger">{{$errors->first('ph_no')}}</p>
                      @endif
                  </div>
                  <div class="input__box">
                    <input
                      type="number"
                      class="information__input" value="{{ $employee['hdmfNo'] }}"
                      placeholder="Enter pag-ibig no." name="hdmf_no"
                    />
                    <span class="input__title">Pag-IBIG Number</span>
                    @if ($errors->has('hdmf_no'))
                        <p class="text-danger">{{$errors->first('hdmf_no')}}</p>
                      @endif
                  </div>
                  <div class="input__box">
                    <input
                      type="number"
                      class="information__input" name="tin"
                      placeholder="Enter TIN" value="{{ $employee['tin'] }}"
                    />
                    <span class="input__title">Tax Identification Number</span>
                    @if ($errors->has('tin'))
                        <p class="text-danger">{{$errors->first('tin')}}</p>
                      @endif
                  </div>
                </div>
              </div>
            </div>
            <div class="btn__box">
              <button class="btn__primary" type="submit">
                <ion-icon class="icon__add" name="save-outline"></ion-icon> Save Changes
              </button>
            </div>
            <?php endif; ?>
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
        $('#office-select').change(function(){
            $('#department-select').find('option').not(':first').remove();
            $.ajax({
                url:"{{route('fetch-department')}}",method:"GET",
                data:{value:$(this).val()},
                success:function(response)
                {
                    $('#department-select').append(response);
                }
            });
        });
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
