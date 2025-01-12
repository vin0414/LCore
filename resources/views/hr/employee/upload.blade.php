
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
              <a href="{{route('hr/employee/documents')}}" type="button" class="btn__return"><ion-icon class="icon__documents" name="arrow-back-outline"></ion-icon>Return</a>
              <button type="button" class="btn__primary add-folder" onclick="openFolderModal()"><ion-icon class="icon__documents" name="add-outline"></ion-icon>Upload Files</button>
          </div>
          <div class="grid__options">
            <!-- <ion-icon name="trash-outline" class="icon__grid icon__delete"></ion-icon> -->
            <ion-icon name="list-outline" class="icon__grid list__layout__button"></ion-icon>
            <ion-icon name="grid-outline" class="icon__grid grid__layout__button"></ion-icon>
          </div>
        </div>
        <ul class="card__list grid__layout">
          @php
            $directory = 'documents/'.$title;
            $files = scandir($directory);
          @endphp

          @foreach($files as $file)
          <?php 
          if($file !== '.' && $file !== '..') { 
            $file_info = pathinfo($file);
            $extension = isset($file_info['extension']) ? $file_info['extension'] : 'No extension';
          ?>
              <li class="card__folder">
                  <a href="/documents/{{$title}}/{{$file}}" class="link__folder" target="_BLANK">
                      <div class="img__box__folder">
                          <!-- <ion-icon class="folder__icon" name="document-outline"></ion-icon> -->
                          <img src="/assets/icons/<?php echo $extension ?>.png" width="30"/>
                          <p class="folder__title" title="{{ $file_info['filename'] }}">{{ $file_info['filename'] }}</p>
                      </div>
                  </a>
                  <ion-icon class="icon__trash" name="trash-outline"></ion-icon>
                  <div class="modal__options">
                      <div class="list__items">
                          <div class="item"><p class="text__description">Delete this file?</p></div>
                          <div class="item">
                              <button type="button" class="cancel">Cancel</button>
                              <button type="button" value="{{$file}}" class="delete">Delete</button>
                          </div>
                      </div>
                  </div>
              </li>
          <?php } ?>
          @endforeach
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
// File upload here
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
    const files = e.dataTransfer.files;
    selectedFiles = Array.from(files); 
    updateFileList(selectedFiles); 
    fileInput.files = files; 
});

fileInput.addEventListener("change", () => {
    selectedFiles = Array.from(fileInput.files); 
    updateFileList(selectedFiles); 
});

// Add event listener to trigger the file input click when drop area is clicked
dropArea.addEventListener("click", function () {
    fileInput.click(); // Open the file picker when the drop area is clicked
});

// Function to update the file list in the UI
function updateFileList(files) {
    fileList.innerHTML = ""; 

    if (files.length === 0) {
        fileInput.value = '';
        selectedFiles = [];
        updateFileCount(0); // Reset the file count display
        return;
    }

    files.forEach(file => {
        const listItem = document.createElement("li");
        listItem.style.display = 'flex';
        listItem.style.alignItems = 'center';
        listItem.style.justifyContent = 'space-between';
        listItem.style.marginBottom = '8px';

        const fileInfoContainer = document.createElement('div');
        fileInfoContainer.style.display = 'flex';
        fileInfoContainer.style.justifyContent = 'space-between';
        fileInfoContainer.style.width = '100%';
        fileInfoContainer.style.alignItems = 'center';
        fileInfoContainer.style.gap = '8px';

        const fileInfoSpan = document.createElement('span');
        fileInfoSpan.textContent = file.name;
        fileInfoSpan.classList.add("file__info__span");
        fileInfoSpan.setAttribute("title", file.name);
        fileInfoContainer.appendChild(fileInfoSpan);

        const fileSizeSpan = document.createElement('span');
        const fileSize = (file.size / 1024 / 1024).toFixed(2); 
        fileSizeSpan.textContent = `${fileSize} MB`;
        fileSizeSpan.style.color = '#3b3b3b';
        fileSizeSpan.style.fontSize = '1.2rem';
        fileSizeSpan.style.marginLeft = '10px'; 
        fileInfoContainer.appendChild(fileSizeSpan);

        const trashIcon = document.createElement('ion-icon');
        trashIcon.setAttribute('name', 'trash-outline');
        trashIcon.style.cursor = 'pointer';
        trashIcon.style.color = '#f00';
        trashIcon.style.width = '2rem';
        trashIcon.style.height = '2rem';

        trashIcon.addEventListener('click', function () {
            selectedFiles = selectedFiles.filter(f => f.name !== file.name);
            updateFileList(selectedFiles);
            if (selectedFiles.length === 0) {
                fileInput.value = ''; 
            } else {
                const dataTransfer = new DataTransfer();
                selectedFiles.forEach(f => dataTransfer.items.add(f));
                fileInput.files = dataTransfer.files; 
            }
        });

        fileInfoContainer.appendChild(trashIcon);
        listItem.appendChild(fileInfoContainer);
        fileList.appendChild(listItem);
    });

    // Update the file count display
    updateFileCount(files.length);
}

// Function to update the file count display
function updateFileCount(count) {
    fileCountDisplay.textContent = `Total Files: ${count}`; // Update the count display
}

      // File upload ends here

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

      $(document).on('click','.delete',function()
      {
        var folder = "<?php echo $title ?>";
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
          url:"{{route('delete-file')}}",method:"POST",
          data:{value:$(this).val(),folder:folder},
          headers: {'X-CSRF-TOKEN': csrfToken},success:function(response)
          {
            if(response==="success"){location.reload();}else{alert(response);}
          }
        });
      });

      $('#frmUpload').on('submit', function (e) 
      {
            e.preventDefault(); // Prevent default form submission
            $('.error-message').html('');
            var formData = new FormData(this);
            // If validation passes, make the AJAX request
            $.ajax({
                url: '{{ route("file-upload") }}', // Your Laravel route
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) 
                {
                    if (response.success) {
                        location.reload();
                    } else {
                      var errors = response.errors;
                      // Iterate over each error and display it under the corresponding input field
                      for (var field in errors) {
                          $('#file-error').html('<p>' + errors[field][0] + '</p>'); // Show the first error message
                          $('#file').addClass('input-error'); // Highlight the input field with an error
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
