
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
    <link rel="stylesheet" href="/assets/css/employee.css" />
    <link rel="stylesheet" href="/assets/css/document_upload.css" />
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
              <li class="dropdown__item"><a href="{{route('hr/leave/policies')}}" class="no-underline">Types & Policies</a></li>
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
          <?php } ?>
        </ul>
      </aside>
      <div class="container">
        <div class="heading__box flex flex__align__center">
          <h1 class="heading__primary flex flex__align__center gap__1"><ion-icon class="folder__icon heading" name="folder-open"></ion-icon>{{$title}}</h1>
          <div class="breadcrumbs">
            <p class="pages">Employee | <span>{{$title}}</span></p>
          </div>
        </div>
        <div class="btn__grid__container">
          <div class="btn__box">
              <a href="#" type="button" class="btn__return"><ion-icon class="icon__documents" name="arrow-back-outline"></ion-icon>Return</a>
              <button type="button" class="btn__primary add-folder" onclick="openFolderModal()"><ion-icon class="icon__documents" name="add-outline"></ion-icon>Upload Files</button>
          </div>
          <div class="grid__options">
            <ion-icon name="list-outline" class="icon__grid list__layout__button"></ion-icon>
            <ion-icon name="grid-outline" class="icon__grid grid__layout__button"></ion-icon>
          </div>
        </div>
        <ul class="card__list grid__layout">
            <li class="card__folder">
                <a href="#" class="link__folder">
                    <div class="img__box__folder">
                    <ion-icon class="folder__icon" name="document-outline"></ion-icon>
                    <p class="folder__title">Test.jpg</p>
                    </div>
                </a>
                <ion-icon class="icon__trash" name="trash-outline"></ion-icon>
                <div class="modal__options">
                    <div class="list__items">
                        <div class="item"><p class="text__description">Delete this file?</p></div>
                        <div class="item">
                        <button type="button" class="cancel">Cancel</button>
                        <button type="button" class="delete">Delete </button>
                        </div>
                    </div>
                </div>
            </li>
            <li class="card__folder">
                <a href="#" class="link__folder">
                    <div class="img__box__folder">
                    <ion-icon class="folder__icon" name="document-outline"></ion-icon>
                    <p class="folder__title">Test.jpg</p>
                    </div>
                </a>
                <ion-icon class="icon__trash" name="trash-outline"></ion-icon>
                <div class="modal__options">
                    <div class="list__items">
                        <div class="item"><p class="text__description">Delete this file?</p></div>
                        <div class="item">
                        <button type="button" class="cancel">Cancel</button>
                        <button type="button" class="delete">Delete </button>
                        </div>
                    </div>
                </div>
            </li>
            <li class="card__folder">
                <a href="#" class="link__folder">
                    <div class="img__box__folder">
                    <ion-icon class="folder__icon" name="document-outline"></ion-icon>
                    <p class="folder__title">Test.jpg</p>
                    </div>
                </a>
                <ion-icon class="icon__trash" name="trash-outline"></ion-icon>
                <div class="modal__options">
                    <div class="list__items">
                        <div class="item"><p class="text__description">Delete this file?</p></div>
                        <div class="item">
                        <button type="button" class="cancel">Cancel</button>
                        <button type="button" class="delete">Delete </button>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
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
          <form method="POST" class="form__modal" id="frmFolder">
            @csrf
            <div id="drop-area" class="drop-area">
                <p>Drag & Drop Files Here</p>
                <p>Or</p>
                <p>Click to upload</p>
                <input type="file" id="file-input" class="file-input" multiple />
            </div>
            <ul id="file-list" class="file-list"></ul>

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
      // Drop down
    const dropArea = document.getElementById('drop-area');
    const fileInput = document.getElementById('file-input');
    const fileList = document.getElementById('file-list');

    dropArea.addEventListener('dragover', function(e) {
        e.preventDefault(); 
        e.stopPropagation(); 
        dropArea.classList.add('dragging');
    });

    // Handle drag leave
    dropArea.addEventListener('dragleave', function() {
        dropArea.classList.remove('dragging'); 
    });

    // Handle file drop event
    dropArea.addEventListener('drop', function(e) {
        e.preventDefault(); 
        e.stopPropagation(); 
        dropArea.classList.remove('dragging'); 

        const files = e.dataTransfer.files; 
        handleFiles(files); 
    });

    dropArea.addEventListener('click', function() {
        fileInput.click();
    });

    // Handle file selection from the file input
    fileInput.addEventListener('change', function() {
        const files = fileInput.files;
        handleFiles(files); 
    });

    const uploadedFiles = [];

    function handleFiles(files) {
    for (let file of files) {
        // Track the uploaded files
        uploadedFiles.push(file);

        // Create list item for the file
        const listItem = document.createElement('li');
        listItem.style.display = 'flex';
        listItem.style.alignItems = 'center';
        listItem.style.justifyContent = 'space-between';
        listItem.style.marginBottom = '8px';

        // Create a container for file name, size, and trash icon
        const fileInfoContainer = document.createElement('div');
        fileInfoContainer.style.display = 'flex';
        fileInfoContainer.style.justifyContent = 'space-between'; 
        fileInfoContainer.style.width = '100%'; 
        fileInfoContainer.style.alignItems = 'center'; 
        fileInfoContainer.style.gap = '8px';

        // Add file name to the container
        const fileInfoSpan = document.createElement('span');
        fileInfoSpan.textContent = file.name;
        fileInfoContainer.appendChild(fileInfoSpan);

        // Add file size to the container
        const fileSizeSpan = document.createElement('span');
        const fileSize = (file.size / 1024).toFixed(2); 
        fileSizeSpan.textContent = `${fileSize} KB`;
        fileSizeSpan.style.color = '#3b3b3b'; 
        fileSizeSpan.style.fontSize = '1.2rem';
        fileInfoContainer.appendChild(fileSizeSpan);

        // Create a trash icon for deleting the file
        const trashIcon = document.createElement('ion-icon');
        trashIcon.setAttribute('name', 'trash-outline');
        trashIcon.style.cursor = 'pointer';
        trashIcon.style.color = '#f00'; 
        trashIcon.style.width = '2rem';
        trashIcon.style.height = '2rem';

        trashIcon.addEventListener('click', function () {
            const index = uploadedFiles.indexOf(file);
            if (index !== -1) {
                uploadedFiles.splice(index, 1); 
            }
            listItem.remove(); 
        });
        fileInfoContainer.appendChild(trashIcon);
        listItem.appendChild(fileInfoContainer);
        fileList.appendChild(listItem);
    }
    fileInput.value = '';
}




// Event listener for the file input
fileInput.addEventListener('change', function () {
    const files = fileInput.files;
    handleFiles(files);
});


      // List view
      $('.list__layout__button').on("click", function(){
        $('.card__list').removeClass("grid__layout");
        $('.card__list').addClass("list__layout");
        $('.folder__icon').addClass("small");
      });
      // Grid view
      $('.grid__layout__button').on("click", function(){
        $('.card__list').removeClass("list__layout");
        $('.card__list').addClass("grid__layout");
        $('.folder__icon').removeClass("small");
      });

        $('.icon__trash').on("click", function(e) {
          e.stopPropagation(); 
          $('.modal__options').removeClass("show");
          $(this).siblings('.modal__options').toggleClass("show");
        });

        $(document).on("click", function() {
          $('.modal__options').removeClass("show");
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

      // Open folder modal
      function openFolderModal() {
            $('#folderContents').css('display', 'flex');
            $('body').addClass('no-scroll');
      }

      function closeFolderModal() {
            $('#folderContents').css('display', 'none');
            $('body').removeClass('no-scroll');
      }
      // Open folder modal end
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


      function closeWorkModal() {
          $('#folderModal').css('display', 'none');
          $('body').removeClass('no-scroll'); 
      }
      function closeFolderModal() {
          $('#folderContents').css('display', 'none');
          $('body').removeClass('no-scroll'); 
      }

      $('#frmFolder').on('submit',function(e){
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
          url:"{{route('create-folder')}}",method:"POST",
          data:formData,success:function(response)
          {
            if(response.success)
            {
              window.location.reload();
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
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  </body>
</html>
