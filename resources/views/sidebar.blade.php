<aside
  class="sidebar z-9999 fixed left-0 top-0 flex h-screen w-[290px] flex-col overflow-y-hidden border-r border-gray-200 bg-white px-5 duration-300 ease-linear lg:static lg:translate-x-0 dark:border-gray-800 dark:bg-black"
  :class="sidebarToggle ? 'translate-x-0 lg:w-[90px]' : '-translate-x-full'" @click.outside="sidebarToggle = false">
  <div class="sidebar-header flex items-center gap-2 pb-7 pt-8"
    :class="sidebarToggle ? 'justify-center' : 'justify-between'">
    <a href="/">
      <span class="logo" :class="sidebarToggle ? 'hidden' : ''">
        <img class="dark:hidden" src="{{ asset('images/logo/logo.svg') }}" alt="Logo" />
        <img class="hidden dark:block" src="{{ asset('images/logo/logo-dark.svg') }}" alt="Logo" />
      </span>
      <img class="logo-icon" src="{{ asset('images/logo/logo-icon.svg') }}" alt="Logo"
        :class="sidebarToggle ? 'lg:block' : 'hidden'" />
    </a>
  </div>
  <div class="no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear">
    <nav>
      <div>
        <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400">
          <span class="menu-group-title" :class="sidebarToggle ? 'lg:hidden' : ''">
            MENU
          </span>
          <svg class="menu-group-icon mx-auto fill-current" :class="sidebarToggle ? 'lg:block hidden' : 'hidden'"
            width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd"
              d="M5.99915 10.2451C6.96564 10.2451 7.74915 11.0286 7.74915 11.9951V12.0051C7.74915 12.9716 6.96564 13.7551 5.99915 13.7551C5.03265 13.7551 4.24915 12.9716 4.24915 12.0051V11.9951C4.24915 11.0286 5.03265 10.2451 5.99915 10.2451ZM17.9991 10.2451C18.9656 10.2451 19.7491 11.0286 19.7491 11.9951V12.0051C19.7491 12.9716 18.9656 13.7551 17.9991 13.7551C17.0326 13.7551 16.2491 12.9716 16.2491 12.0051V11.9951C16.2491 11.0286 17.0326 10.2451 17.9991 10.2451ZM13.7491 11.9951C13.7491 11.0286 12.9656 10.2451 11.9991 10.2451C11.0326 10.2451 10.2491 11.0286 10.2491 11.9951V12.0051C10.2491 12.9716 11.0326 13.7551 11.9991 13.7551C12.9656 13.7551 13.7491 12.9716 13.7491 12.0051V11.9951Z"
              fill="" />
          </svg>
        </h3>
        <ul class="mb-6 flex flex-col gap-4">
          <li>
            <a class="menu-item {{ Route::is('dashboard') ? 'menu-item-active' : 'menu-item-inactive' }} group"
              href="{{ route('dashboard') }}">
              <svg class="{{ Route::is('dashboard') ? 'menu-item-icon-active' : 'menu-item-icon-inactive' }}"
                width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M5.5 3.25C4.25736 3.25 3.25 4.25736 3.25 5.5V8.99998C3.25 10.2426 4.25736 11.25 5.5 11.25H9C10.2426 11.25 11.25 10.2426 11.25 8.99998V5.5C11.25 4.25736 10.2426 3.25 9 3.25H5.5ZM4.75 5.5C4.75 5.08579 5.08579 4.75 5.5 4.75H9C9.41421 4.75 9.75 5.08579 9.75 5.5V8.99998C9.75 9.41419 9.41421 9.74998 9 9.74998H5.5C5.08579 9.74998 4.75 9.41419 4.75 8.99998V5.5ZM5.5 12.75C4.25736 12.75 3.25 13.7574 3.25 15V18.5C3.25 19.7426 4.25736 20.75 5.5 20.75H9C10.2426 20.75 11.25 19.7427 11.25 18.5V15C11.25 13.7574 10.2426 12.75 9 12.75H5.5ZM4.75 15C4.75 14.5858 5.08579 14.25 5.5 14.25H9C9.41421 14.25 9.75 14.5858 9.75 15V18.5C9.75 18.9142 9.41421 19.25 9 19.25H5.5C5.08579 19.25 4.75 18.9142 4.75 18.5V15ZM12.75 5.5C12.75 4.25736 13.7574 3.25 15 3.25H18.5C19.7426 3.25 20.75 4.25736 20.75 5.5V8.99998C20.75 10.2426 19.7426 11.25 18.5 11.25H15C13.7574 11.25 12.75 10.2426 12.75 8.99998V5.5ZM15 4.75C14.5858 4.75 14.25 5.08579 14.25 5.5V8.99998C14.25 9.41419 14.5858 9.74998 15 9.74998H18.5C18.9142 9.74998 19.25 9.41419 19.25 8.99998V5.5C19.25 5.08579 18.9142 4.75 18.5 4.75H15ZM15 12.75C13.7574 12.75 12.75 13.7574 12.75 15V18.5C12.75 19.7426 13.7574 20.75 15 20.75H18.5C19.7426 20.75 20.75 19.7427 20.75 18.5V15C20.75 13.7574 19.7426 12.75 18.5 12.75H15ZM14.25 15C14.25 14.5858 14.5858 14.25 15 14.25H18.5C18.9142 14.25 19.25 14.5858 19.25 15V18.5C19.25 18.9142 18.9142 19.25 18.5 19.25H15C14.5858 19.25 14.25 18.9142 14.25 18.5V15Z"
                  fill="" />
              </svg>
              <span class="menu-item-text">
                Dashboard
              </span>
            </a>
          </li>
          <li>
            <a class="menu-item {{ Route::is('activity.index') || Route::is('activity.create') ? 'menu-item-active' : 'menu-item-inactive' }} group"
              href="{{ route('activity.index') }}">
              <svg class="{{ Route::is('activity') ? 'menu-item-icon-active' : 'menu-item-icon-inactive' }}"
                width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M8 2C8.41421 2 8.75 2.33579 8.75 2.75V3.75H15.25V2.75C15.25 2.33579 15.5858 2 16 2C16.4142 2 16.75 2.33579 16.75 2.75V3.75H18.5C19.7426 3.75 20.75 4.75736 20.75 6V9V19C20.75 20.2426 19.7426 21.25 18.5 21.25H5.5C4.25736 21.25 3.25 20.2426 3.25 19V9V6C3.25 4.75736 4.25736 3.75 5.5 3.75H7.25V2.75C7.25 2.33579 7.58579 2 8 2ZM8 5.25H5.5C5.08579 5.25 4.75 5.58579 4.75 6V8.25H19.25V6C19.25 5.58579 18.9142 5.25 18.5 5.25H16H8ZM19.25 9.75H4.75V19C4.75 19.4142 5.08579 19.75 5.5 19.75H18.5C18.9142 19.75 19.25 19.4142 19.25 19V9.75Z"
                  fill="" />
              </svg>
              <span class="menu-item-text">
                Kegiatan
              </span>
            </a>
            <ul class="menu-dropdown mt-2 flex flex-col gap-1 pl-9">
              <li>
                <a class="menu-dropdown-item {{ Route::is('category.index') ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive' }} group"
                  href="{{ route('category.index') }}">
                  Kategori Kegiatan
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</aside>
