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