
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="/assets/css/reusables.css" />
    <link rel="stylesheet" href="/assets/css/dashboard.css" />
    <link rel="stylesheet" href="/assets/css/table.css" />

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
      <!-- change job title-->
      <div class="modal-overlay" id="changeJobTitleModal">
          <div class="modal">
            <div class="modal__heading">
              <div class="heading__modal__box">
                <h2 class="heading__modal">Change Job Title</h2>
                <p class="subheading__modal">New Job Title</p>
              </div>
              <div class="close__box"><ion-icon onclick="closeModal()" class="icon__modal" name="close-outline"></ion-icon></div>
              </div>
              <form method="POST" class="form__modal" id="frmJobTitle">
                @csrf
                <input type="hidden" name="employeeID" id="employeeID"/>
                <div class="input__form__modal__box">
                  <div class="input__box">
                    <select class="information__input" name="designation">
                      <option value="" disabled selected>
                        Select Job Title
                      </option>
                      <?php foreach($job as $row): ?>
                        <option value="<?php echo $row['jobTitle'] ?>"><?php echo $row['jobTitle'] ?> - <small><?php echo $row['jobLevel'] ?></small></option>
                      <?php endforeach; ?>
                    </select>
                    <span class="input__title">Job Title</span>
                    <div id="designation-error" class="error-message text-danger"></div>
                  </div>
                </div>
                <button type="submit" class="btn__submit__modal"><ion-icon class="icon" name="paper-plane-outline"></ion-icon>Submit</button>
              </form>
          </div>
      </div>
      <!--New Assignment -->
      <div class="modal-overlay" id="newAssignmentModal">
        <div class="modal">
          <div class="modal__heading">
            <div class="heading__modal__box">
              <h2 class="heading__modal">New Assignment</h2>
              <p class="subheading__modal">Assigned Department/Branch</p>
            </div>
            <div class="close__box"><ion-icon onclick="closeJobModal()" class="icon__modal" name="close-outline"></ion-icon></div>
            </div>
            <form method="POST" class="form__modal" id="frmAssignment">
              @csrf
              <input type="hidden" name="employeeID" id="employeeJobID"/>
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
                  <select class="information__input" name="department" id="department">
                    <option value="" disabled selected>
                      Select department or branch
                    </option>
                  </select>
                  <span class="input__title">Department | Branch</span>
                  <div id="department-error" class="error-message text-danger"></div>
                </div>
              </div>
              <button type="submit" class="btn__submit__modal"><ion-icon class="icon" name="paper-plane-outline"></ion-icon>Submit</button>
            </form>
        </div>
      </div>
      <!--Job Transfer -->
      <div class="modal-overlay" id="jobTransferModal">
        <div class="modal">
          <div class="modal__heading">
            <div class="heading__modal__box">
              <h2 class="heading__modal">Job Transfer</h2>
              <p class="subheading__modal">New Job Assignment</p>
            </div>
            <div class="close__box"><ion-icon onclick="closeTransferModal()" class="icon__modal" name="close-outline"></ion-icon></div>
            </div>
            <form method="POST" class="form__modal" id="frmJob">
              @csrf
              <input type="hidden" name="employeeID" id="employeeTransferID"/>
              <div class="input__form__modal__box">
                <div class="input__box">
                  <select class="information__input" name="new_office" id="new_office">
                    <option value="" disabled selected>
                      Select Office
                    </option>
                    <?php foreach($office as $row): ?>
                      <option value="<?php echo $row['officeID'] ?>"><?php echo $row['officeName'] ?></option>
                    <?php endforeach; ?>
                  </select>
                  <span class="input__title">Office</span>
                  <div id="new_office-error" class="error-message text-danger"></div>
                </div>
                <div class="input__box">
                  <select class="information__input" name="new_department" id="new_department">
                    <option value="" disabled selected>
                      Select department or branch
                    </option>
                  </select>
                  <span class="input__title">Department | Branch</span>
                  <div id="new_department-error" class="error-message text-danger"></div>
                </div>
                <div class="input__box">
                  <select class="information__input" name="new_position">
                    <option value="" disabled selected>
                      Select Job Title
                    </option>
                    <?php foreach($job as $row): ?>
                      <option value="<?php echo $row['jobTitle'] ?>"><?php echo $row['jobTitle'] ?> - <small><?php echo $row['jobLevel'] ?></small></option>
                    <?php endforeach; ?>
                  </select>
                  <span class="input__title">Job Title</span>
                  <div id="new_position-error" class="error-message text-danger"></div>
                </div>
              </div>
              <button type="submit" class="btn__submit__modal"><ion-icon class="icon" name="paper-plane-outline"></ion-icon>Submit</button>
            </form>
        </div>
      </div>
      <!-- promote -->
      <div class="modal-overlay" id="promoteModal">
        <div class="modal">
          <div class="modal__heading">
            <div class="heading__modal__box">
              <h2 class="heading__modal">Promote</h2>
              <p class="subheading__modal">Employee Promotion</p>
            </div>
            <div class="close__box"><ion-icon onclick="closePromoteModal()" class="icon__modal" name="close-outline"></ion-icon></div>
            </div>
            <form method="POST" class="form__modal" enctype="multipart/form-data" id="frmPromote">
              @csrf
              <input type="hidden" name="employeeID" id="employeePromoteID"/>
              <div class="input__form__modal__box">
                <div class="input__box">
                  <select class="information__input" name="job_title">
                    <option value="" disabled selected>
                      Select Job Title
                    </option>
                    <?php foreach($job as $row): ?>
                      <option value="<?php echo $row['jobTitle'] ?>"><?php echo $row['jobTitle'] ?> - <small><?php echo $row['jobLevel'] ?></small></option>
                    <?php endforeach; ?>
                  </select>
                  <span class="input__title">Job Title</span>
                  <div id="job_title-error" class="error-message text-danger"></div>
                </div>
                <div class="input__box">
                  <input
                    class="information__input"
                    placeholder="Enter compensation"
                    name="rate"
                  />
                  <span class="input__title">New Rate</span>
                  <div id="rate-error" class="error-message text-danger"></div>
                </div>
                <div class="input__box">
                  <input type="file"
                    class="information__input"
                    placeholder="Attach document"
                    name="attachment"
                  />
                  <span class="input__title">Attachment</span>
                  <div id="attachment-error" class="error-message text-danger"></div>
                </div>
              </div>
              <button type="submit" class="btn__submit__modal"><ion-icon class="icon" name="paper-plane-outline"></ion-icon>Submit</button>
            </form>
        </div>
      </div>
      <!-- demoted -->
      <div class="modal-overlay" id="demoteModal">
        <div class="modal">
          <div class="modal__heading">
            <div class="heading__modal__box">
              <h2 class="heading__modal">Demotion</h2>
              <p class="subheading__modal">Employee Demotion</p>
            </div>
            <div class="close__box"><ion-icon onclick="closeDemoteModal()" class="icon__modal" name="close-outline"></ion-icon></div>
            </div>
            <form method="POST" class="form__modal" enctype="multipart/form-data" id="frmdemote">
              @csrf
              <input type="hidden" name="employeeID" id="employeeDemoteID"/>
              <div class="input__form__modal__box">
                <div class="input__box">
                  <select class="information__input" name="new_job_title">
                    <option value="" disabled selected>
                      Select Job Title
                    </option>
                    <?php foreach($job as $row): ?>
                      <option value="<?php echo $row['jobTitle'] ?>"><?php echo $row['jobTitle'] ?> - <small><?php echo $row['jobLevel'] ?></small></option>
                    <?php endforeach; ?>
                  </select>
                  <span class="input__title">Job Title</span>
                  <div id="new_job_title-error" class="error-message text-danger"></div>
                </div>
                <div class="input__box">
                  <input
                    class="information__input"
                    placeholder="Enter compensation"
                    name="new_rate"
                  />
                  <span class="input__title">New Rate</span>
                  <div id="new_rate-error" class="error-message text-danger"></div>
                </div>
                <div class="input__box">
                  <input type="file"
                    class="information__input"
                    placeholder="Attach document"
                    name="attachments"
                  />
                  <span class="input__title">Attachment</span>
                  <div id="attachments-error" class="error-message text-danger"></div>
                </div>
              </div>
              <button type="submit" class="btn__submit__modal"><ion-icon class="icon" name="paper-plane-outline"></ion-icon>Submit</button>
            </form>
        </div>
      </div>
      <!-- salary -->
      <div class="modal-overlay" id="salaryModal">
        <div class="modal">
          <div class="modal__heading">
            <div class="heading__modal__box">
              <h2 class="heading__modal">Salary Adjustment</h2>
              <p class="subheading__modal">New Salary Rate</p>
            </div>
            <div class="close__box"><ion-icon onclick="closeSalaryModal()" class="icon__modal" name="close-outline"></ion-icon></div>
            </div>
            <form method="POST" class="form__modal" enctype="multipart/form-data" id="frmSalary">
              @csrf
              <input type="hidden" name="employeeID" id="employeeSalaryID"/>
              <div class="input__form__modal__box">
                <div class="input__box">
                  <input
                    class="information__input"
                    placeholder="Enter compensation"
                    name="salary"
                  />
                  <span class="input__title">New Salary</span>
                  <div id="salary-error" class="error-message text-danger"></div>
                </div>
                <div class="input__box">
                  <input type="file"
                    class="information__input"
                    placeholder="Attach document"
                    name="document"
                  />
                  <span class="input__title">Attachment</span>
                  <div id="document-error" class="error-message text-danger"></div>
                </div>
              </div>
              <button type="submit" class="btn__submit__modal"><ion-icon class="icon" name="paper-plane-outline"></ion-icon>Submit</button>
            </form>
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
          <li class="nav__item">Track Leave <ion-icon name="chevron-down-outline"></ion-icon>
            <ul class="dropdown">
              <li class="dropdown__item"><a href="" class="no-underline">Calendar & Request</a></li>
              <li class="dropdown__item"><a href="" class="no-underline">Balances</a></li>
              <li class="dropdown__item"><a href="" class="no-underline">Types & Policies</a></li>
              <li class="dropdown__item"><a href="" class="no-underline">Approval Workflow</a></li>
            </ul>
          </li>
          <li class="nav__item">Memos & Broadcast<ion-icon name="chevron-down-outline"></ion-icon>
            <ul class="dropdown">
              <li class="dropdown__item"><a href="{{route('hr/memo')}}" class="no-underline">Overview</a></li>
              <li class="dropdown__item"><a href="{{route('hr/memo/new')}}" class="no-underline">Post Memo</a></li>
              <li class="dropdown__item"><a href="{{route('hr/memo/new-announcement')}}" class="no-underline">New Broadcast</a></li>
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
        @if(\Session::has('success'))
            <div class="alert alert-success">
                {{\Session::get('success')}}
            </div>
        @endif
        <div class="pos__rel">
          <div class="button__box pos__abs">
            <a href="{{route('hr/employee/new')}}" class="link add__btn">
              <ion-icon class="icon" name="add-outline"></ion-icon>Add Employee
            </a>
            <a href="" class="link btn__upload">
              <ion-icon class="icon" name="cloud-upload-outline"></ion-icon>Upload
            </a>
            <a href="#" class="link export__btn">
              <ion-icon class="icon" name="download-outline"></ion-icon>Export
            </a>
          </div>
          <div class="dataWrapper">
            <table id="dataTable" class="display">
              <thead>
                  <th>Employee's Name</th>
                  <th>Contact #</th>
                  <th>Email Address</th>
                  <th>Permanent Address</th>
                  <th>Birthday</th>
                  <th>Age</th>
                  <th>Gender</th>
                  <th>Civil Status</th>
                  <th>Educational Attainment</th>
                  <th>Status</th>
                  <th>Action</th>
              </thead>
              <tbody>
                <?php foreach($employee as $row): ?>
                  <?php
                  //age
                  $dobDate = new DateTime($row['dob']);
                  $today = new DateTime('today');
                  $age = $dobDate->diff($today)->y;
                  //formatted date
                  $dateObj = new DateTime($row['dob']);
                  $formattedDate = $dateObj->format('d M Y');
                  ?>
                  <tr>
                    <td>
                      <?php echo $row['surName'] ?> <?php echo $row['suffix'] ?>,&nbsp;<?php echo $row['firstName'] ?> <?php echo $row['middleName'] ?><br/>
                      <small><?php echo $row['designation'] ?></small>
                    </td>
                    <td><?php echo $row['contactNumber'] ?></td>
                    <td><?php echo $row['emailAddress'] ?></td>
                    <td><?php echo $row['address'] ?></td>
                    <td><?php echo $formattedDate ?></td>
                    <td><?php echo $age ?></td>
                    <td><?php echo $row['gender'] ?></td>
                    <td><?php echo $row['civilStatus'] ?></td>
                    <td><?php echo $row['education'] ?></td>
                    <td>
                      <?php if($row['employeeStatus']==0){ ?>
                        <span class="badge badge-danger">Resigned</span>
                      <?php }else if($row['employeeStatus']==1){?>
                        <span class="badge badge-success">Active</span>
                      <?php }else if($row['employeeStatus']==2){ ?>
                        <span class="badge badge-danger">Terminated</span>
                      <?php }else{ ?>
                        <span class="badge badge-dark-orange">Back-out/Failed</span>
                      <?php } ?>
                    </td>
                    <td class="pos__rel">
                      <button class="btn__select">
                        <ion-icon
                          name="ellipsis-horizontal"
                          class="icon__button"
                        ></ion-icon>
                      </button>
                      <div class="dropdown__select">
                        <a href="{{route('hr/employee/edit',['companyID'=>$row['companyID']])}}" class="select__item">
                          <ion-icon class="select__icon" name="create-outline"></ion-icon>Edit Profile
                        </a>
                        <a href="{{route('hr/employee/view',['companyID'=>$row['companyID']])}}" class="select__item">
                          <ion-icon class="select__icon" name="folder-open-outline"></ion-icon>View Profile
                        </a>
                        <!-- if employee is inactive -->
                        <?php if($row['employeeStatus']==1){ ?>
                          <?php if($row['employmentStatus']=="Regular" || $row['employmentStatus']=="Probationary"){ ?>
                          <button type="button" value="<?php echo $row['employeeID'] ?>" class="select__item promote">
                            <ion-icon class="select__icon" name="ribbon-outline"></ion-icon>Promotion
                          </button>
                          <button type="button" value="<?php echo $row['employeeID'] ?>" class="select__item salaryAdjusment">
                            <ion-icon class="select__icon" name="cash-outline"></ion-icon>Salary Adjustment
                          </button>
                          <button type="button" value="<?php echo $row['employeeID'] ?>" class="select__item jobTransfer">
                            <ion-icon class="select__icon" name="file-tray-full-outline"></ion-icon> Job Transfer
                          </button>
                          <button type="button" value="<?php echo $row['employeeID'] ?>" class="select__item newAssignment">
                            <ion-icon class="select__icon" name="file-tray-full-outline"></ion-icon> New Assignment
                          </button>
                          <a href="{{route('hr/employee/re-assign',['companyID'=>$row['companyID']])}}" class="select__item">
                            <ion-icon class="select__icon" name="file-tray-full-outline"></ion-icon>Re-Assignment
                          </a>
                          <button type="button" value="<?php echo $row['employeeID'] ?>" class="select__item changeJobTitle">
                            <ion-icon class="select__icon" name="pricetags-outline"></ion-icon>Change Job Title
                          </button>
                          <button type="button" value="<?php echo $row['employeeID'] ?>" class="select__item demote">
                            <ion-icon class="select__icon" name="thumbs-down-outline"></ion-icon>Demotion
                          </button>
                          <button type="button" value="<?php echo $row['employeeID'] ?>" class="select__item resign">
                            <ion-icon class="select__icon" name="log-out-outline"></ion-icon>Resign
                          </button>
                          <button type="button" value="<?php echo $row['employeeID'] ?>" class="select__item terminate">
                            <ion-icon class="select__icon" name="person-remove-outline"></ion-icon>Terminate
                          </button>
                          <?php }else{ ?>
                              <?php if($row['employeeStatus']==1){ ?>
                              <button type="button" value="<?php echo $row['employeeID'] ?>" class="select__item backOut">
                                <ion-icon class="select__icon" name="play-back-outline"></ion-icon>Back-Out
                              </button>
                              <button type="button" value="<?php echo $row['employeeID'] ?>" class="select__item fail">
                                <ion-icon class="select__icon" name="close-outline"></ion-icon>Failure
                              </button>
                              <?php } ?>
                          <?php } ?>
                        <?php } ?>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
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
          scrollX: false,
          oLanguage: { sSearch: "" },
          initComplete: function () {
            $("#dataTable_filter input").attr(
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

      $('#frmJobTitle').on('submit',function(e)
      {
          e.preventDefault();
          $('.error-message').html('');
          let data = $(this).serialize();
          $.ajax({
              url:"{{route('change-job-title')}}",method:"POST",
              data:data,
              success:function(response)
              {
                  if(response.success)
                  {
                      closeModal();
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

      $('#office').change(function(){
          $('#department').find('option').not(':first').remove();
          $.ajax({
              url:"{{route('fetch-department')}}",
              method:"GET",data:{value:$(this).val()},
              success:function(response){$('#department').append(response);}
          });
      });

      $('#new_office').change(function(){
          $('#new_department').find('option').not(':first').remove();
          $.ajax({
              url:"{{route('fetch-department')}}",
              method:"GET",data:{value:$(this).val()},
              success:function(response){$('#new_department').append(response);}
          });
      });

      $('#frmAssignment').on('submit',function(e)
      {
          e.preventDefault();
          $('.error-message').html('');
          let data = $(this).serialize();
          $.ajax({
              url:"{{route('new-assignment')}}",method:"POST",
              data:data,
              success:function(response)
              {
                  if(response.success)
                  {
                      closeJobModal();
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

      $('#frmJob').on('submit',function(e)
      {
          e.preventDefault();
          $('.error-message').html('');
          let data = $(this).serialize();
          $.ajax({
              url:"{{route('job-transfer')}}",method:"POST",
              data:data,
              success:function(response)
              {
                  if(response.success)
                  {
                      closeTransferModal();
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

      $('#frmPromote').on('submit',function(e)
      {
        e.preventDefault();
        $('.error-message').html('');
        var formData = new FormData(this);
        $.ajax({
            url:"{{route('promote')}}",method: 'POST',data: formData,
            processData: false,contentType: false,
            success: function(response) 
            {
              if(response.success)
              {
                  closePromoteModal();
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

      $('#frmdemote').on('submit',function(e)
      {
        e.preventDefault();
        $('.error-message').html('');
        var formData = new FormData(this);
        $.ajax({
            url:"{{route('demote')}}",method: 'POST',data: formData,
            processData: false,contentType: false,
            success: function(response) 
            {
              if(response.success)
              {
                  closeDemoteModal();
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

      $('#frmSalary').on('submit',function(e)
      {
        e.preventDefault();
        $('.error-message').html('');
        var formData = new FormData(this);
        $.ajax({
            url:"{{route('salary-adjustment')}}",method: 'POST',data: formData,
            processData: false,contentType: false,
            success: function(response) 
            {
              if(response.success)
              {
                  closeSalaryModal();
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

      $(document).on('click','.resign',function(){
        var confirmation = confirm("Would you like to tag this employee as resign?");
        if(confirmation)
        {
          var csrfToken = $('meta[name="csrf-token"]').attr('content');
          $.ajax({
            url:"{{route('resign')}}",method:"POST",
            data:{value:$(this).val()},
            headers: {'X-CSRF-TOKEN': csrfToken},success:function(response)
            {
              if(response==="success"){window.location.reload();}else{alert(response);}
            }
          });
        }
      });

      $(document).on('click','.terminate',function(){
        var confirmation = confirm("Would you like to tag this employee as terminated?");
        if(confirmation)
        {
          var csrfToken = $('meta[name="csrf-token"]').attr('content');
          $.ajax({
            url:"{{route('terminate')}}",method:"POST",
            data:{value:$(this).val()},
            headers: {'X-CSRF-TOKEN': csrfToken},success:function(response)
            {
              if(response==="success"){window.location.reload();}else{alert(response);}
            }
          });
        }
      });

      $(document).on('click','.backOut',function(){
        var confirmation = confirm("Would you like to tag this trainee as back-out?");
        if(confirmation)
        {
          var csrfToken = $('meta[name="csrf-token"]').attr('content');
          $.ajax({
            url:"{{route('back-out')}}",method:"POST",
            data:{value:$(this).val()},
            headers: {'X-CSRF-TOKEN': csrfToken},success:function(response)
            {
              if(response==="success"){window.location.reload();}else{alert(response);}
            }
          });
        }
      });

      $(document).on('click','.fail',function(){
        var confirmation = confirm("Would you like to tag this trainee as failed?");
        if(confirmation)
        {
          var csrfToken = $('meta[name="csrf-token"]').attr('content');
          $.ajax({
            url:"{{route('failure')}}",method:"POST",
            data:{value:$(this).val()},
            headers: {'X-CSRF-TOKEN': csrfToken},success:function(response)
            {
              if(response==="success"){window.location.reload();}else{alert(response);}
            }
          });
        }
      });
    </script>
    <script src="/assets/js/master-file.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  </body>
</html>
