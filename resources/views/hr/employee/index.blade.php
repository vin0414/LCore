
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
    <link rel="stylesheet" href="/assets/css/uploadModal.css" />

    <title>{{isset($about['companyName']) ? $about['companyName'] : 'Company name is not available' }}</title>
    <link rel="icon" sizes="180x180" href="/assets/images/{{isset($about['companyLogo']) ? $about['companyLogo'] : 'No Logo' }}"/>
  </head>
  <body>
    @include('hr.templates.header')
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
                  <select class="information__input" name="assign_office" id="assign_office">
                    <option value="" disabled selected>
                      Select Office
                    </option>
                    <?php foreach($office as $row): ?>
                      <option value="<?php echo $row['officeID'] ?>"><?php echo $row['officeName'] ?></option>
                    <?php endforeach; ?>
                  </select>
                  <span class="input__title">Office</span>
                </div>
                <div class="input__box">
                  <select class="information__input" name="assign_department" id="assign_department">
                  </select>
                  <span class="input__title">Department | Branch</span>
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
                  <select class="information__input" name="assign_new_office" id="assign_new_office">
                    <option value="" disabled selected>
                      Select Office
                    </option>
                    <?php foreach($office as $row): ?>
                      <option value="<?php echo $row['officeID'] ?>"><?php echo $row['officeName'] ?></option>
                    <?php endforeach; ?>
                  </select>
                  <span class="input__title">Office</span>
                </div>
                <div class="input__box">
                  <select class="information__input" name="assign_new_department" id="assign_new_department">
                  </select>
                  <span class="input__title">Department | Branch</span>
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
            <a href="#" class="link btn__upload"  onclick="openFolderModal()">
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
    <div class="modal-overlay" id="folderContents">
      <div class="folder__modal">
        <div class="modal__heading">
          <div class="heading__modal__box">
            <h2 class="heading__primary">Upload Files</h2>  
          </div>
          <div class="close__box">
            <ion-icon onclick="closeFolderModal()" class="icon__modal" name="close-outline"></ion-icon>
          </div>
          </div>
          <form method="POST" enctype="multipart/form-data" class="form__modal" id="frmUpload">
            @csrf
            <input type="hidden" name="folderName" value="{{$title}}"/>
            <div id="drop-area" class="drop-area">
                <p>Drag & Drop Files Here</p>
                <p>Or</p>
                <p>Click to upload</p>
                <input type="file" id="files" name="file[]" class="" multiple hidden/>
            </div>
            <div id="file-error" class="error-message text-danger"></div>
            <p id="file-count" class="file-count">Total Files: 0</p>
            <p id="file-count" class="file-count note__size "><span class="note">Note:</span> The maximum allowed file size is 5MB</p>
            <ul id="file-list" class="file-list"></ul>
            <button type="submit" class="btn__submit__modal"><ion-icon class="icon" name="cloud-upload-outline"></ion-icon>Upload</button>
          </form>
      </div>
    </div>
    <footer class="footer">
      <p class="copyright">&copy;{{isset($about['companyName']) ? $about['companyName'] : 'Company name is not available' }} <?php echo date('Y') ?>. All Rights Reserved.</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
      // upload modal
      const dropArea = document.getElementById("drop-area");
      const fileInput = document.getElementById("files");
      const fileList = document.getElementById("file-list");
      const fileCountDisplay = document.getElementById("file-count"); // Display element for the count

      let selectedFiles = [];

      ["dragenter", "dragover", "dragleave", "drop"].forEach(eventName => {
          dropArea.addEventListener(eventName, e => e.preventDefault());
      });

      dropArea.addEventListener("dragover", () => {
          dropArea.classList.add("drag-over");
      });

      ["dragleave", "drop"].forEach(eventName => {
          dropArea.addEventListener(eventName, () => {
              dropArea.classList.remove("drag-over");
          });
      });

      dropArea.addEventListener("drop", e => {
          const files = Array.from(e.dataTransfer.files);
          handleFileSelection(files);
      });

      fileInput.addEventListener("change", () => {
          const files = Array.from(fileInput.files);
          handleFileSelection(files);
      });

      dropArea.addEventListener("click", function () {
          fileInput.click();
      });

      // Function to handle file selection
      function handleFileSelection(files) {
          if (files.length > 1) {
              alert("Only one file is allowed.");
              resetFileSelection();
              return;
          }

          const file = files[0];
          if (!isExcelFile(file)) {
              alert("Only Excel files (.xlsx, .xls) are allowed.");
              resetFileSelection();
              return;
          }

          selectedFiles = [file];
          updateFileList(selectedFiles);
          const dataTransfer = new DataTransfer();
          dataTransfer.items.add(file);
          fileInput.files = dataTransfer.files;
      }

      function isExcelFile(file) {
          const allowedExtensions = ["application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", "application/vnd.ms-excel"];
          return allowedExtensions.includes(file.type);
      }

      function resetFileSelection() {
          selectedFiles = [];
          updateFileList(selectedFiles);
          fileInput.value = ""; 
      }

      function updateFileList(files) {
          fileList.innerHTML = "";

          if (files.length === 0) {
              updateFileCount(0); 
              return;
          }

          const file = files[0];
          const listItem = document.createElement("li");
          listItem.style.display = "flex";
          listItem.style.alignItems = "center";
          listItem.style.justifyContent = "space-between";
          listItem.style.marginBottom = "8px";

          const fileInfoContainer = document.createElement("div");
          fileInfoContainer.style.display = "flex";
          fileInfoContainer.style.justifyContent = "space-between";
          fileInfoContainer.style.width = "100%";
          fileInfoContainer.style.alignItems = "center";
          fileInfoContainer.style.gap = "8px";

          const fileInfoSpan = document.createElement("span");
          fileInfoSpan.textContent = file.name;
          fileInfoSpan.classList.add("file__info__span");
          fileInfoSpan.setAttribute("title", file.name);
          fileInfoContainer.appendChild(fileInfoSpan);

          const fileSizeSpan = document.createElement("span");
          const fileSize = (file.size / 1024 / 1024).toFixed(2); // Convert bytes to MB
          fileSizeSpan.textContent = `${fileSize} MB`;
          fileSizeSpan.style.color = "#3b3b3b";
          fileSizeSpan.style.fontSize = "1.2rem";
          fileSizeSpan.style.marginLeft = "10px";
          fileInfoContainer.appendChild(fileSizeSpan);

          const trashIcon = document.createElement("ion-icon");
          trashIcon.setAttribute("name", "trash-outline");
          trashIcon.style.cursor = "pointer";
          trashIcon.style.color = "#f00";
          trashIcon.style.width = "2rem";
          trashIcon.style.height = "2rem";

          trashIcon.addEventListener("click", function () {
              resetFileSelection();
          });

          fileInfoContainer.appendChild(trashIcon);
          listItem.appendChild(fileInfoContainer);
          fileList.appendChild(listItem);

          updateFileCount(files.length);
      }

      function updateFileCount(count) {
          fileCountDisplay.textContent = `Total Files: ${count}`;
      }

      document.addEventListener("keydown", function(event) {
          if (event.key === "Escape" || event.keyCode === 27) {
              closeFolderModal();
          }
      });
      // Upload modal up to here

        // Data Table
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

      // upload modal
      // Open folder modal
      function openFolderModal() {
            $('#folderContents').css('display', 'flex');
            $('body').addClass('no-scroll');
      }

      function closeFolderModal() {
            $('#folderContents').css('display', 'none');
            $('body').removeClass('no-scroll');
      }
        // upload modal up to here
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

      $('#assign_office').change(function(){
          $('#assign_department').find('option').remove();
          $.ajax({
              url:"{{route('fetch-department')}}",
              method:"GET",data:{value:$(this).val()},
              success:function(response){$('#assign_department').append(response);}
          });
      });

      $('#assign_new_office').change(function(){
          $('#assign_new_department').find('option').remove();
          $.ajax({
              url:"{{route('fetch-department')}}",
              method:"GET",data:{value:$(this).val()},
              success:function(response){$('#assign_new_department').append(response);}
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
