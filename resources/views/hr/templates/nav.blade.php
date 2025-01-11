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
          <li class="dropdown__item"><a href="{{route('hr/leave/calendar')}}" class="no-underline">Calendar & Request</a></li>
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