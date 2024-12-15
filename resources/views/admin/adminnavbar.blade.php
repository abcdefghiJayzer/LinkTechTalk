<nav class="bg-neutral-900 sticky z-[99999]">
    <div class="flex mx-auto justify-between items-center max-w-screen-xl h-full px-4">

        <a href="{{ route('user.index') }}" class="hidden lg:block text-white font-bold text-xl p-2 lg:text-left w-full">
            LinkTechTalk
        </a>

        <!-- Mobile menu toggle buttons: Hamburger on left, User menu on right -->
        <div class="flex items-center justify-between w-full ">
            <!-- Hamburger button (left) -->
            <div class="relative text-left lg:hidden">
                <button class="flex items-center text-white p-2" onclick="toggleUserMenu(event)">
                    <i class="fa-solid fa-bars fa-lg hover:text-orange-400 text-sm px-2"></i>
                </button>
                <div class="user-menu hidden absolute left-0 mt-6 z-50 w-48 bg-white rounded-md shadow-2xl">
                    @if (Auth::user()->is_admin)
                    <a href="{{route('admin.index')}}" class="block px-4 py-2 text-black-400 rounded-md hover:bg-neutral-300">Manage Post</a>
                    @endif
                    <a href="{{route('admin.showCategory')}}" class="block px-4 py-2 text-black-400 rounded-md hover:bg-neutral-300">Categories</a>
                </div>
            </div>

            <!-- User button (right) -->
            <div class="flex items-end space-x-8 font-semibold ml-auto">
                <!-- Check if the user is authenticated -->
                @if (Auth::check())
                <div class="relative text-left">
                    <button class="flex items-center text-white p-2" onclick="toggleUserMenu(event)">
                        <i class="fas fa-user fa-lg hover:text-orange-400 text-sm px-2"></i>
                        <h1 class="hidden md:block text-lg px-2 text-white-400 rounded-md hover:text-orange-400">
                            {{ Auth::user()->username }}
                        </h1>
                    </button>
                    <div class="user-menu hidden absolute right-0 mt-6 z-50 w-48 bg-white rounded-md shadow-2xl">
                        <a href="{{ route('user.index') }}" class="block px-4 py-2 text-black-400 rounded-md hover:bg-neutral-300">Home</a>
                        <!-- Admin Dashboard link (if the user is an admin) -->
                        @if (Auth::user()->is_admin)

                        <a href="{{ route('admin.index') }}" class="block px-4 py-2 text-black-400 rounded-md hover:bg-neutral-300">Dashboard</a>
                        @endif
                        <!-- Logout link -->

                        <a href="{{ route('user.logout') }}" class="block px-4 py-2 text-red-400 rounded-md hover:bg-neutral-300">Logout</a>
                    </div>
                </div>
                @else
                <div class="flex items-center space-x-4">
                    <a href="{{ route('user.login') }}" class="text-white text-sm hover:text-neutral-400 w-10">Log In</a>
                    <a href="{{ route('user.signup') }}" class="text-white text-sm hover:text-neutral-400 w-14">Sign Up</a>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="hidden bg-neutral-900 p-4 lg:hidden shadow-lg font-semibold">
        @if (Auth::check())
        <a href="{{ route('user.logout') }}" class="block text-white hover:text-neutral-400 py-2">Logout</a>
        @else
        <a href="{{ route('user.login') }}" class="block text-white hover:text-neutral-400 py-2">Log In</a>
        <a href="{{ route('user.register') }}" class="block text-white hover:text-neutral-400 py-2">Register</a>
        @endif
    </div>
</nav>



<script>
    // Toggle the visibility of the user profile menu
    function toggleUserMenu(event) {
        const menu = event.currentTarget.nextElementSibling; // Get the next sibling (the menu)
        menu.classList.toggle('hidden'); // Toggle the visibility of the dropdown menu
    }

    // Mobile menu toggling
    document.getElementById('open_nav-btn').addEventListener('click', function() {
        document.getElementById('mobileMenu').classList.remove('hidden');
        document.getElementById('open_nav-btn').classList.add('hidden'); // Hide hamburger menu on mobile
        document.getElementById('close_nav-btn').classList.remove('hidden');
    });

    document.getElementById('close_nav-btn').addEventListener('click', function() {
        document.getElementById('mobileMenu').classList.add('hidden');
        document.getElementById('open_nav-btn').classList.remove('hidden'); // Show hamburger menu again
        document.getElementById('close_nav-btn').classList.add('hidden');
    });
</script>
