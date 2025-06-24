<!-- v_header.blade.php -->
<header class="bg-[#213374] shadow-sm border-b border-gray-200">
  <div class="mx-4 px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16 items-center">
      <!-- Left side - Logo/Brand -->
      <div class="flex items-center">
        <div class="flex-shrink-0 flex items-center">
          <img class="h-8 w-auto" src="{{ asset('gambar/icon2.png') }}" alt="School Guestbook">
          <a href="{{ route('landing') }}" class="ml-2 text-lg font-semibold text-white hover:text-blue-300">School Guestbook</a>
        </div>
      </div>

      <!-- Right side - Info and User dropdown -->
      <div class="flex items-center space-x-4">
        <!-- Tahun Ajaran -->
        <div class="hidden md:flex items-center text-sm text-white">
          <span>Tahun Ajaran Aktif: <strong class="ml-1 text-red-500">{{Session::get('namatahunajaran')}}</strong></span>
        </div>

        <!-- User dropdown -->
        <div class="relative">
          <div class="flex items-center">
            <span class="text-sm text-white mr-2">Anda Login sebagai:</span>
            <button type="button" class="flex items-center text-sm font-medium text-white hover:text-blue-300 focus:outline-none" id="user-menu-button">
              <span>{{ Auth::user()->name }}</span>
              <svg class="ml-1 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
              </svg>
            </button>
          </div>

          <!-- Dropdown menu -->
          <div id="user-menu" class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
            <div class="py-1">
              <a class="block px-4 py-2 text-sm text-gray-700">ID User: {{ Auth::user()->id }}</a>
              <a class="block px-4 py-2 text-sm text-gray-700">Level: {{ Auth::user()->role }}</a>
              <div class="border-t border-gray-200"></div>
              <a href="{{ route('logoutaksi') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                <i class="fas fa-sign-out-alt mr-1"></i> Log Out
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const userButton = document.getElementById('user-menu-button');
    const userMenu = document.getElementById('user-menu');

    // Toggle dropdown menu
    userButton.addEventListener('click', function() {
      const isExpanded = userMenu.classList.contains('hidden');
      userMenu.classList.toggle('hidden', !isExpanded);
      userMenu.classList.toggle('block', isExpanded);
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
      if (!userButton.contains(e.target) && !userMenu.contains(e.target)) {
        userMenu.classList.add('hidden');
        userMenu.classList.remove('block');
      }
    });
  });
</script>
