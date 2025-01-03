
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
    <link rel="stylesheet" href="/assets/css/employee.css" />
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
              <p
                class="user__name name__screen__sm flex flex__align__center gap__1">
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
          <form class="form__container" method="POST" action="{{route('save-employee')}}" enctype="multipart/form-data">
            @csrf
            <div class="first__row grid">
              <div class="profile__picture">
                <p class="profile__heading">Profile Picture</p>
                <div class="picture__box pos__rel">
                  <img
                    class="profile__image"
                    src="/assets/images/default_image.png"
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
                        name="surname" value="{{ old('surname') }}"
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
                        name="firstname" value="{{ old('firstname') }}"
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
                        name="middlename" value="{{ old('middlename') }}"
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
                        name="suffix"
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
                        <option value="Male" {{ old('gender') == "Male" ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender') == "Female" ? 'selected' : '' }}>Female</option>
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
                        <option {{ old('civil_status') == "Single" ? 'selected' : '' }}>Single</option>
                        <option {{ old('civil_status') == "Married" ? 'selected' : '' }}>Married</option>
                        <option {{ old('civil_status') == "Widowed" ? 'selected' : '' }}>Widowed</option>
                        <option {{ old('civil_status') == "Separated" ? 'selected' : '' }}>Separated</option>
                        <option {{ old('civil_status') == "Divorced" ? 'selected' : '' }}>Divorced</option>
                        <option {{ old('civil_status') == "Single with Children" ? 'selected' : '' }}>Single with Children</option>
                        <option {{ old('civil_status') == "With Live-In Partner" ? 'selected' : '' }}>With Live-In Partner</option>
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
                        placeholder="Enter date of birth" value="{{ old('date_of_birth') }}"
                      />
                      <span class="input__title">Date of Birth</span>
                      @if ($errors->has('date_of_birth'))
                        <p class="text-danger">{{$errors->first('date_of_birth')}}</p>
                      @endif
                    </div>
                    <div class="input__box">
                      <input
                        class="information__input" name="religion"
                        placeholder="Enter religion" value="{{ old('religion') }}"
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
                        placeholder="Enter contact no." value="{{ old('contact_number') }}"
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
                        placeholder="Enter email address" value="{{ old('email_address') }}"
                      />
                      <span class="input__title">Email Address</span>
                      @if ($errors->has('email_address'))
                        <p class="text-danger">{{$errors->first('email_address')}}</p>
                      @endif
                    </div>
                    <div class="input__box">
                      <input
                        class="information__input" name="address"
                        placeholder="Enter address" value="{{ old('address') }}"
                      />
                      <span class="input__title">Permanent Address</span>
                      @if ($errors->has('address'))
                        <p class="text-danger">{{$errors->first('address')}}</p>
                      @endif
                    </div>
                    <div class="input__box grid__column__mod">
                      <input
                        class="information__input" name="education" value="{{ old('education') }}"
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
                      placeholder="Enter date" name="date_hired" value="{{ old('date_hired') }}"
                    />
                    <span class="input__title">Date Hired</span>
                    @if ($errors->has('date_hired'))
                        <p class="text-danger">{{$errors->first('date_hired')}}</p>
                      @endif
                  </div>
                  <div class="input__box">
                      <ion-icon
                        class="pos__abs input__chev__down"
                        name="chevron-down-outline"
                      ></ion-icon>
                      <select
                        class="information__input" name="designation"
                        placeholder="Enter job title"
                      >
                        <option value="" disabled selected>
                          Select
                        </option>
                        <?php foreach($job as $row): ?>
                          <option value="<?php echo $row['jobTitle'] ?>"><?php echo $row['jobTitle'] ?> - <small><?php echo $row['jobLevel'] ?></small></option>
                        <?php endforeach; ?>
                      </select>

                      <span class="input__title">Job Title</span>
                      @if ($errors->has('designation'))
                        <p class="text-danger">{{$errors->first('designation')}}</p>
                      @endif
                    </div>
                  <div class="input__box">
                    <input
                      type="phone"
                      class="information__input" maxlength="11" minlength="11" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                      placeholder="Enter contact no." name="company_phone"
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
                        <option value="<?php echo $row['officeID'] ?>"  {{ old('office') == $row['officeID'] ? 'selected' : '' }}><?php echo $row['officeName'] ?></option>
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
                    <input
                      class="information__input" name="allowance_rates"
                      placeholder="Enter allowance" value="{{ old('allowance_rates') }}"
                    />
                    <span class="input__title">Allowance Rates</span>
                    @if ($errors->has('allowance_rates'))
                        <p class="text-danger">{{$errors->first('allowance_rates')}}</p>
                      @endif
                  </div>
                  <div class="input__box">
                    <input
                      type="date"
                      class="information__input"
                      placeholder="Enter date" name="regularization_date">
                    <span class="input__title">Regularization Date</span>
                  </div>
                  <div class="input__box">
                    <ion-icon
                      class="pos__abs input__chev__down"
                      name="chevron-down-outline"
                    ></ion-icon>
                    <select class="information__input" name="payroll_payment" id="payroll_payment">
                      <option value="" disabled selected>
                        Select payment
                      </option>
                      <option value="Cash" {{ old('payroll_payment') == "Cash" ? 'selected' : '' }}>Cash</option>
                      <option value="Card" {{ old('payroll_payment') == "Card" ? 'selected' : '' }}>Card</option>
                      <option value="Check" {{ old('payroll_payment') == "Check" ? 'selected' : '' }}>Check</option>
                    </select>
                    <span class="input__title">Payroll Payment</span>
                    @if ($errors->has('payroll_payment'))
                        <p class="text-danger">{{$errors->first('payroll_payment')}}</p>
                      @endif
                  </div>
                  <div class="input__box">
                    <input
                      type="number"
                      class="information__input" name="account_number" id="account_number"
                      placeholder="Enter bank account no." value="{{ old('account_number') }}" disabled/>
                    <span class="input__title">Bank Account Number</span>
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
                      class="information__input" value="{{ old('sss_no') }}"
                      placeholder="Enter SSS number" name="sss_no"
                    />
                    <span class="input__title">SSS Number</span>
                  </div>
                  <div class="input__box">
                    <input
                      type="number"
                      class="information__input" value="{{ old('philhealth_no') }}"
                      placeholder="Enter philhealth no." name="philhealth_no"
                    />
                    <span class="input__title">Philhealth Number</span>
                  </div>
                  <div class="input__box">
                    <input
                      type="number"
                      class="information__input" value="{{ old('hdmf_no') }}"
                      placeholder="Enter pag-ibig no." name="hdmf_no"
                    />
                    <span class="input__title">Pag-IBIG Number</span>
                  </div>
                  <div class="input__box">
                    <input
                      type="number"
                      class="information__input" name="tin"
                      placeholder="Enter TIN" value="{{ old('tin') }}"
                    />
                    <span class="input__title">Tax Identification Number</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="btn__box">
              <button class="btn__primary" type="submit">
                <ion-icon class="icon__add" name="document-text-outline"></ion-icon> Save Records
              </button>
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

      $('#payroll_payment').change(function(){
        let val = $(this).val();
        if(val==="Cash"||val ==="Check")
        {
          $('#account_number').attr("disabled",true);
        }
        else if(val==="Card")
        {
          $('#account_number').attr("disabled",false);
        }
      });
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
