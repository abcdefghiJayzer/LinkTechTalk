<aside class="hidden lg:block bg-neutral-900 fixed h-screen top-0 left-0 w-72 shadow-lg">
    <div class="pl-4 pt-28 pr-8">
        <button id="show_sidebar-btn" class="sidebar_toogle text-white mb-6">
            <i class="uil uil-angle-right-b text-xl"></i>
        </button>
        <button id="hide_sidebar-btn" class="sidebar_toogle text-white mb-6">
            <i class="uil uil-angle-left-b text-xl"></i>
        </button>

        <ul>
            <li class="mb-4">
                <a href="{{route('admin.index')}}" class="text-white hover:bg-neutral-700 p-4 rounded flex items-center active">
                    <h5>Manage Post</h5>
                </a>
            </li>

            <li class="mb-4">
                <a href="{{route('admin.showCategory')}}" class="text-white hover:bg-neutral-700 p-4 rounded flex items-center">
                    <h5>Categories</h5>
                </a>
            </li>
        </ul>
    </div>
</aside>
