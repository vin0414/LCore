
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="/assets/css/reusables.css" />
    <link rel="stylesheet" href="/assets/css/dashboard.css" />
    <link rel="stylesheet" href="/assets/css/table.css" />
    <link rel="stylesheet" href="/assets/css/settings.css" />
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
          <li class="nav__item">
            Maintenance<ion-icon name="chevron-down-outline"></ion-icon>
            <ul class="dropdown">
              <li class="dropdown__item"><a href="{{route('hr/recovery')}}" class="no-underline">Recovery</a></li>
              <li class="dropdown__item"><a href="{{route('hr/settings')}}" class="no-underline">System Settings</a></li>
              <li class="dropdown__item"><a href="{{route('hr/audit-trail')}}" class="no-underline">Audit Trail</a></li>
            </ul>
          </li>
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
      </aside>
      <div class="container">
        <div class="heading__box flex flex__align__center">
          <h1 class="heading__primary">{{$title}}</h1>
          <div class="breadcrumbs">
            <p class="pages">Maintenance | <span class="breadcrumbs__title">{{$title}}</span></p>
          </div>
        </div>
        @if(\Session::has('success'))
            <div class="alert alert-success">
                {{\Session::get('success')}}
            </div>
        @endif
        <div class="tabs">
          <ul class="tab-titles">
            <li class="tab active" id="tab1" onclick="openTab('tab1')">Application</li>
            <li class="tab" id="tab2" onclick="openTab('tab2')">User Accounts</li>
            <li class="tab" id="tab3" onclick="openTab('tab3')">Department/Branches</li>
            <li class="tab" id="tab4" onclick="openTab('tab4')">Policies</li>
            <li class="tab" id="tab5" onclick="openTab('tab5')">Schedule</li>
            <li class="tab" id="tab6" onclick="openTab('tab6')">Leave Credits</li>
            <li class="tab" id="tab7" onclick="openTab('tab7')">User Permission</li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="content-tab1">
              <form method="POST" class="form__settings" enctype="multipart/form-data" action="{{route('save')}}">
              @csrf
              <div class="profile__picture">
                <p class="profile__heading">Logo Upload</p>
                <div class="picture__box pos__rel">
                  <?php if(empty($about['companyLogo'])){ ?>
                  <img
                    class="logo__image"
                    src="/assets/images/default_image_mountain.png"
                    id="profileImage"
                  />
                  <?php }else { ?>
                    <img
                    class="logo__image"
                    src="/assets/images/{{$about['companyLogo']}}"
                    id="profileImage"
                  />
                  <?php } ?>
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
                <p class="text__description bg__color__td small-wd">
                  <span class="note">Note:</span> Only .png, .jpg and .jpeg
                  image files are accepted
                </p>
              </div>
                <div class="input__boxes">
                <p class="profile__heading system__detail">System Details</p>
                  <div class="input__box">
                    <input
                      class="information__input input__settings"
                      placeholder="Enter title" value="{{isset($about['companyName']) ? $about['companyName'] : 'Company name is not available' }}"
                      name="title"
                    />
                    <span class="input__title">Title</span>
                  </div>
                  <div class="input__box">
                    <textarea
                      class="information__input text__area__settings"
                      placeholder="Enter keywords"
                      name="keywords">{{isset($about['companyTag']) ? $about['companyTag'] : 'No Keywords available' }}</textarea>
                    <span class="input__title">Keywords</span>
                  </div>
                  <div class="input__box">
                    <textarea
                      class="information__input text__area__settings"
                      placeholder="Enter description"
                      name="description">{{isset($about['companyDetails']) ? $about['companyDetails'] : 'No Details available' }}</textarea>
                    <span class="input__title">Description</span>
                  </div>
                  <div class="settings__btn__box">
                     <button class="btn__primary"><ion-icon class="icon__settings" name="document-text-outline"></ion-icon>Save</button>  
                  </div>
                </div>
              </div>
            </form>
          </div>
            <div class="tab-pane" id="content-tab2">
              <div class="pos__rel">
                <div class="button__box pos__abs">
                  <a href="{{route('hr/new-account')}}" class="link add__btn"
                    ><ion-icon class="icon" name="add-outline"></ion-icon>Add
                    Account</a
                  >
                  <a href="#" class="link export__btn"
                    ><ion-icon class="icon" name="download-outline"></ion-icon
                    >Export</a
                  >
                </div>
                <div class="dataWrapper">
                  <table id="dataTable" class="display">
                    <thead>
                        <th>Username</th>
                        <th>Complete Name</th>
                        <th>Designation</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                    <?php foreach($account as $row): ?>
                    <tr>
                      <td><?php echo $row['Username'] ?></td>
                      <td><?php echo $row['Fullname'] ?></td>
                      <td><?php echo $row['Designation'] ?></td>
                      <td><?php echo $row['Email'] ?></td>
                      <td><?php echo $row['Role'] ?></td>
                      <td><?php if($row['Status']==1){echo "Active";}else{echo "Inactive";} ?></td>
                      <td class="pos__rel">
                      <button class="btn__select">
                        <ion-icon
                          name="ellipsis-horizontal"
                          class="icon__button"
                        ></ion-icon>
                      </button>
                      <div class="dropdown__select">
                        <a href="{{route('hr/edit-account',['Token'=>$row['Token']])}}" class="select__item">
                          <ion-icon class="select__icon" name="create-outline"></ion-icon>Edit Account
                        </a>
                        <button type="button" value="<?php echo $row['Token'] ?>" class="select__item reset">
                          <ion-icon class="select__icon" name="refresh-circle-outline"></ion-icon>Reset Password
                        </button>
                      </div>
                    </td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="content-tab3">
              <div class="pos__rel">
                <div class="button__box pos__abs">
                  <a href="javascript:void(0);" class="link add__btn department">
                    <ion-icon class="icon" name="add-outline"></ion-icon>New
                  </a>
                  <a href="#" class="link export__btn">
                    <ion-icon class="icon" name="download-outline"></ion-icon>Export
                  </a>
                </div>
                <div class="dataWrapper">
                  <table id="departmentTable" class="display">
                    <thead>
                        <th>#</th>
                        <th class="w-200">Office</th>
                        <th class="w-275">Department</th>
                        <th class="w-150">Contact No</th>
                        <th class="w-150">Date Created</th>
                        <th class="w-50">Action</th>
                    </thead>
                    <tbody>
                    <?php foreach($department as $row): ?>
                    <tr>
                      <td><?php echo $row->departmentID ?></td>
                      <td><?php echo $row->officeName ?></td>
                      <td><?php echo $row->departmentName ?></td>
                      <td><?php echo $row->departmentNumber ?></td>
                      <td><?php echo $row->created_at ?></td>
                      <td>
                        <a href="" class="select__item">
                          <ion-icon class="select__icon" name="create-outline"></ion-icon>Edit
                        </a>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="content-tab4">
              <h2>Add Holiday, late and overtime policy here</h2>
              <p>Designation and job level</p>
            </div>
            <div class="tab-pane" id="content-tab5">
              <div class="pos__rel">
                <div class="button__box pos__abs">
                  <a href="javascript:void(0);" class="link add__btn schedule"
                    ><ion-icon class="icon" name="add-outline"></ion-icon>New</a>
                  <a href="#" class="link export__btn"
                    ><ion-icon class="icon" name="download-outline"></ion-icon
                    >Export</a
                  >
                </div>
                <div class="dataWrapper">
                  <table id="scheduleTable" class="display">
                    <thead>
                        <th>#</th>
                        <th class="w-200">Type</th>
                        <th class="w-275">Hours</th>
                        <th class="w-150">Break-Time</th>
                        <th class="w-150">Notes</th>
                        <th class="w-50">Action</th>
                    </thead>
                    <tbody>
                    <?php foreach($schedule as $row):?>
                      <tr>
                        <td><?php echo $row['scheduleID'] ?></td>
                        <td><?php echo $row['scheduleType'] ?></td>
                        <td><?php echo $row['hours'] ?></td>
                        <td><?php echo $row['breakTime'] ?></td>
                        <td><?php echo $row['Notes'] ?></td>
                        <td>
                          <a href="" class="select__item">
                            <ion-icon class="select__icon" name="create-outline"></ion-icon>Edit
                          </a>
                        </td>
                      </tr>
                    <?php endforeach;?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="content-tab6">
              <div class="pos__rel">
                <div class="button__box pos__abs">
                  <a href="javascript:void(0);" class="link add__btn credit">
                    <ion-icon class="icon" name="add-outline"></ion-icon>New
                  </a>
                  <a href="#" class="link export__btn">
                    <ion-icon class="icon" name="download-outline"></ion-icon>Export
                  </a>
                </div>
                <div class="dataWrapper">
                  <table id="leaveSetupTable" class="display">
                    <thead>
                        <th>#</th>
                        <th class="w-200">Month</th>
                        <th class="w-150">Vacation</th>
                        <th class="w-150">Sick</th>
                        <th class="w-50">Action</th>
                    </thead>
                    <tbody>
                    <?php foreach($leaveSetup as $row): ?>
                      <tr>
                        <td><?php echo $row['setupID'] ?></td>
                        <td><?php echo $row['Month'] ?></td>
                        <td><?php echo $row['Vacation'] ?></td>
                        <td><?php echo $row['Sick'] ?></td>
                        <td>
                          <a href="" class="select__item">
                            <ion-icon class="select__icon" name="create-outline"></ion-icon>Edit
                          </a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="content-tab7">
              <h2>Content for Tab 7</h2>
              <p>This is some content for Tab 7.</p>
            </div>
          </div>
        </div>
      </div>
    </main>
    <!-- change job title-->
    <div class="modal-overlay" id="departmentModal">
        <div class="modal">
          <div class="modal__heading">
            <div class="heading__modal__box">
              <h2 class="heading__modal">Add Department/Branch</h2>
              <p class="subheading__modal">New Department/Branch</p>
            </div>
            <div class="close__box"><ion-icon onclick="closeModal()" class="icon__modal" name="close-outline"></ion-icon></div>
            </div>
            <form method="POST" class="form__modal" id="frmDepartment">
              @csrf
              <div class="input__form__modal__box">
                <div class="input__box">
                  <select class="information__input" name="office" id="office">
                    <option value="" disabled selected>
                      Select Office
                    </option>
                    <?php foreach($office as $row): ?>
                      <option value="<?php echo $row['officeID'] ?>"><?php echo $row['officeName'] ?></option>
                    <?php endforeach; ?>
                  </select>
                  <span class="input__title">Office</span>
                  <div id="office-error" class="error-message text-danger"></div>
                </div>
                <div class="input__box">
                  <input
                    class="information__input"
                    placeholder="Enter Department or Branch"
                    name="department"
                  />
                  <span class="input__title">Department/Branch</span>
                  <div id="department-error" class="error-message text-danger"></div>
                </div>
                <div class="input__box">
                  <input
                    class="information__input"
                    placeholder="Enter Department Number"
                    name="department_number"
                  />
                  <span class="input__title">Contact Number</span>
                  <div id="department_number-error" class="error-message text-danger"></div>
                </div>
              </div>
              <button type="submit" class="btn__submit__modal"><ion-icon class="icon" name="paper-plane-outline"></ion-icon>Submit</button>
            </form>
        </div>
    </div>
    <!-- add leave credit-->
    <div class="modal-overlay" id="creditModal">
        <div class="modal">
          <div class="modal__heading">
            <div class="heading__modal__box">
              <h2 class="heading__modal">Add Leave Credits</h2>
              <p class="subheading__modal">Leave Credit Setup</p>
            </div>
            <div class="close__box"><ion-icon onclick="closeCreditModal()" class="icon__modal" name="close-outline"></ion-icon></div>
            </div>
            <form method="POST" class="form__modal" id="frmCredit">
              @csrf
              <div class="input__form__modal__box">
                <div class="input__box">
                  <select class="information__input" name="month">
                    <option value="" disabled selected>
                      Select Month
                    </option>
                    <option>January</option>
                    <option>February</option>
                    <option>March</option>
                    <option>April</option>
                    <option>May</option>
                    <option>June</option>
                    <option>July</option>
                    <option>August</option>
                    <option>September</option>
                    <option>October</option>
                    <option>November</option>
                    <option>December</option>
                  </select>
                  <span class="input__title">Month</span>
                  <div id="month-error" class="error-message text-danger"></div>
                </div>
                <div class="input__box">
                  <input type="number"
                    class="information__input"
                    placeholder="Enter Vacation"
                    name="vacation"
                  />
                  <span class="input__title">Vacation Credit</span>
                  <div id="vacation-error" class="error-message text-danger"></div>
                </div>
                <div class="input__box">
                  <input type="number"
                    class="information__input"
                    placeholder="Enter Sick"
                    name="sick"
                  />
                  <span class="input__title">Sick Credit</span>
                  <div id="sick-error" class="error-message text-danger"></div>
                </div>
              </div>
              <button type="submit" class="btn__submit__modal"><ion-icon class="icon" name="paper-plane-outline"></ion-icon>Submit</button>
            </form>
        </div>
    </div>
    <!-- add schedule-->
    <div class="modal-overlay" id="scheduleModal">
        <div class="modal">
          <div class="modal__heading">
            <div class="heading__modal__box">
              <h2 class="heading__modal">Add Schedule</h2>
              <p class="subheading__modal">New Schedule</p>
            </div>
            <div class="close__box"><ion-icon onclick="closeScheduleModal()" class="icon__modal" name="close-outline"></ion-icon></div>
            </div>
            <form method="POST" class="form__modal" id="frmSchedule">
              @csrf
              <div class="input__form__modal__box">
                <div class="input__box">
                  <select class="information__input" name="type_schedule">
                    <option value="" disabled selected>
                      Select Type
                    </option>
                    <option>Default</option>
                    <option>Modified</option>
                  </select>
                  <span class="input__title">Type of Schedule</span>
                  <div id="type_schedule-error" class="error-message text-danger"></div>
                </div>
                <div class="input__box">
                  <input type="time"
                    class="information__input"
                    placeholder="Enter Time"
                    name="from_time"
                  />
                  <span class="input__title">From</span>
                  <div id="from_time-error" class="error-message text-danger"></div>
                </div>
                <div class="input__box">
                  <input type="time"
                    class="information__input"
                    placeholder="Enter Time"
                    name="to_time"
                  />
                  <span class="input__title">To</span>
                  <div id="to_time-error" class="error-message text-danger"></div>
                </div>
                <div class="input__box">
                  <select class="information__input" name="break_time">
                    <option value="" disabled selected>
                      Select
                    </option>
                    <option>11:00:00 am - 12:00:00 pm</option>
                    <option>12:00:00 pm - 01:00:00 pm</option>
                    <option>01:00:00 pm - 02:00:00 pm</option>
                  </select>
                  <span class="input__title">Break Time</span>
                  <div id="break_time-error" class="error-message text-danger"></div>
                </div>
              </div>
              <button type="submit" class="btn__submit__modal"><ion-icon class="icon" name="paper-plane-outline"></ion-icon>Submit</button>
            </form>
        </div>
    </div>
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
              "Search by name, etc."
            );
          },
        });

        $("#departmentTable").DataTable({
          dom:
            "<'row'<'col-sm-6'f>>" + // Search box on top in the same row
            "<'row'<'col-sm-12'tr>>" + // Table
            "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'p>>", // Bottom (length + pagination)

          oLanguage: { sSearch: "" },
          initComplete: function () {
            $("#departmentTable_filter input").attr(
              "placeholder",
              "Search by name, etc."
            );
          },
        });

        $("#scheduleTable").DataTable({
          dom:
            "<'row'<'col-sm-6'f>>" + // Search box on top in the same row
            "<'row'<'col-sm-12'tr>>" + // Table
            "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'p>>", // Bottom (length + pagination)

          oLanguage: { sSearch: "" },
          initComplete: function () {
            $("#scheduleTable_filter input").attr(
              "placeholder",
              "Search by name, etc."
            );
          },
        });

        $("#leaveSetupTable").DataTable({
          dom:
            "<'row'<'col-sm-6'f>>" + // Search box on top in the same row
            "<'row'<'col-sm-12'tr>>" + // Table
            "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'p>>", // Bottom (length + pagination)

          oLanguage: { sSearch: "" },
          initComplete: function () {
            $("#leaveSetupTable_filter input").attr(
              "placeholder",
              "Search by name, etc."
            );
          },
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
          $("#profileImage").attr("src", "/assets/images/default_image_mountain.png");
          $("#fileInput").val("");
        });
        // Uploading picture ends here ~


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

      $(document).on('click','.reset',function()
      {
        var confirmation = confirm("Would you like to reset the password of this account?");
        if(confirmation)
        {
          var csrfToken = $('meta[name="csrf-token"]').attr('content');
          $.ajax({
            url:"{{route('reset-password')}}",method:"POST",
            data:{value:$(this).val()},
            headers: {'X-CSRF-TOKEN': csrfToken},success:function(response)
            {
              if(response==="success"){window.location.reload();}else{alert(response);}
            }
          });
        }
      });

      $('#frmDepartment').on('submit',function(e)
      {
        e.preventDefault();
        $('.error-message').html('');
        var data = $(this).serialize();
        $.ajax({
            url:"{{route('add-department')}}",method: 'POST',
            data: data,
            success: function(response) 
            {
              if(response.success)
              {
                  window.location.reload();
              }
              else{
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

      $('#frmCredit').on('submit',function(e)
      {
        e.preventDefault();
        $('.error-message').html('');
        var data = $(this).serialize();
        $.ajax({
            url:"{{route('add-credit-leave')}}",method: 'POST',
            data: data,
            success: function(response) 
            {
              if(response.success)
              {
                  window.location.reload();
              }
              else
              {
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

      $('#frmSchedule').on('submit',function(e)
      {
        e.preventDefault();
        $('.error-message').html('');
        var data = $(this).serialize();
        $.ajax({
            url:"{{route('add-schedule')}}",method: 'POST',
            data: data,
            success: function(response) 
            {
              if(response.success)
              {
                  window.location.reload();
              }
              else
              {
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
    </script>
    <script src="/assets/js/settings.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  </body>
</html>
