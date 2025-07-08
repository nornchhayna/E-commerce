<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- Alpine.js CDN --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    {{-- Lucide Icons --}}
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans" x-data="{ sidebarOpen: false }">

    <div class="flex h-screen overflow-hidden">
        {{-- Sidebar --}}
        <aside class="z-40 fixed inset-y-0 left-0 w-64 bg-white border-r shadow-md transform lg:translate-x-0 transition-transform duration-200 ease-in-out lg:static lg:block"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">

            <div class="p-6 text-xl font-bold text-indigo-600 border-b">Admin Panel</div>
            <nav class="mt-4 space-y-1 px-4 text-sm font-medium">
                @foreach([
                    ['route' => 'admin.dashboard', 'label' => 'Dashboard', 'icon' => 'home'],
                    ['route' => 'admin.products.index', 'label' => 'Products', 'icon' => 'box'],
                    ['route' => 'admin.orders.index', 'label' => 'Orders', 'icon' => 'shopping-cart'],
                    ['route' => 'admin.inventory.index', 'label' => 'Inventory', 'icon' => 'layers'],
                    ['route' => 'admin.categories.index', 'label' => 'Categories', 'icon' => 'tag'],
                    ['route' => 'admin.support.index', 'label' => 'Support', 'icon' => 'life-buoy'],
                    ['route' => 'admin.coupons.index', 'label' => 'Coupons', 'icon' => 'percent'],
                ] as $item)
                    <a href="{{ route($item['route']) }}" class="flex items-center space-x-2 p-2 rounded hover:bg-indigo-50">
                        <i data-lucide="{{ $item['icon'] }}" class="w-5 h-5 text-indigo-500"></i>
                        <span>{{ $item['label'] }}</span>
                    </a>
                @endforeach

                @if(Auth::user()->isSuperAdmin())
                    <a href="{{ route('admin.admins.index') }}" class="flex items-center space-x-2 p-2 rounded hover:bg-indigo-50">
                        <i data-lucide="users" class="w-5 h-5 text-indigo-500"></i>
                        <span>Manage Admins</span>
                    </a>
                @endif
                @foreach(auth()->user()->unreadNotifications as $notification)
                <div class="p-2 bg-gray-100 mb-2 rounded">
                    {{ $notification->data['message'] }}
                    <small class="block text-xs text-gray-500">{{ $notification->created_at->diffForHumans() }}</small>
                </div>
            @endforeach
            
                <form action="{{ route('logout') }}" method="POST" class="mt-4">
                    @csrf
                    <button type="submit" class="flex items-center space-x-2 w-full p-2 rounded hover:bg-red-100 text-red-600">
                        <i data-lucide="log-out" class="w-5 h-5"></i><span>Logout</span>
                    </button>
                </form>
            </nav>
        </aside>
    
        {{-- Overlay --}}
        <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-black bg-opacity-30 z-30 lg:hidden"></div>

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col overflow-y-auto">
            {{-- Header --}}
            <header class="bg-white shadow-sm px-6 py-6 flex justify-between items-center sticky top-0 z-10">
                <div class="flex items-center space-x-4">
                    <button class="lg:hidden" @click="sidebarOpen = true">
                        <i data-lucide="menu" class="w-6 h-6 text-gray-700"></i>
                    </button>
                    <h1 class="text-lg font-semibold">@yield('header', 'Admin Dashboard')</h1>
                </div>
                <div class="text-sm text-gray-600 hidden sm:block">👋 {{ Auth::user()->name }}</div>
            </header>

            {{-- Content --}}
            <main class="flex-1 p-4 sm:p-6">
                @yield('content')
            </main>
        </div>
    </div>

    {{-- Activate Lucide Icons --}}
    <script> lucide.createIcons(); </script>
</body>
</html>
