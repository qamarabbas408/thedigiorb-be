<div x-data="{ 
    sidebarOpen: true, 
    hoveredItem: '',
    showToast: false,
    toastMessage: '',
    toastType: 'success'
}" 
@toast.window="showToast = true; toastMessage = $event.detail.message; toastType = $event.detail.type || 'success'; setTimeout(() => showToast = false, 3000)"
class="flex min-h-screen">

    <!-- Toast Notification -->
    <div x-show="showToast" 
         x-transition 
         x-cloak
         class="fixed top-4 right-4 z-50 px-4 py-3 rounded-lg shadow-lg"
         :class="toastType === 'success' ? 'bg-green-600 text-white' : 'bg-red-600 text-white'">
        <span x-text="toastMessage"></span>
    </div>

    <!-- Toggle Button -->
    <button
        @click="sidebarOpen = !sidebarOpen"
        class="fixed top-2 z-50 p-2 rounded bg-gradient-to-br from-blue-600 to-purple-600 transition-all duration-300 hover:scale-105 active:scale-95"
        :class="sidebarOpen ? 'left-64' : 'left-16'"
        aria-label="Toggle sidebar">
        <i :class="sidebarOpen ? 'bi bi-chevron-left' : 'bi bi-chevron-right'" class="text-white"></i>
    </button>

    <!-- Sidebar -->
    <aside 
        class="bg-gradient-to-b from-slate-900 via-slate-900 to-slate-800 text-white flex flex-col fixed h-screen z-40 transition-all duration-300 shadow-2xl"
        :class="sidebarOpen ? 'w-72' : 'w-20'">
        
        <!-- Header -->
        <div class="px-6 py-6 border-b border-slate-700/50 flex items-center gap-3" :class="sidebarOpen ? 'justify-start' : 'justify-center'">
            <div class="relative group">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl blur opacity-75 group-hover:opacity-100 transition-opacity"></div>
                <div class="relative w-10 h-10 bg-gradient-to-br from-blue-600 to-purple-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg">
                    <i class="bi bi-hexagon-fill text-white text-lg"></i>
                </div>
            </div>
            <div x-show="sidebarOpen" class="flex flex-col">
                <span class="text-lg font-bold whitespace-nowrap bg-gradient-to-r from-white to-blue-200 bg-clip-text text-transparent">
                    DigitalOrb
                </span>
                <span class="text-xs text-slate-400">Admin Dashboard</span>
            </div>
        </div>
        
        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto py-4 scrollbar-dark px-3">
            <div class="space-y-1">
                @foreach($navItems as $item)
                    <a
                        href="{{ $item['href'] }}"
                        @mouseenter="hoveredItem = '{{ $item['href'] }}'"
                        @mouseleave="hoveredItem = ''"
                        class="group relative flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{
                            request()->routeIs($item['href']) 
                                ? 'bg-gradient-to-r from-blue-600 to-purple-600 text-white shadow-lg' 
                                : 'text-slate-400 hover:text-white hover:bg-slate-800/50'
                        }} {{ $sidebarOpen ? '' : 'justify-center px-3' }}"
                        title="{{ !$sidebarOpen ? $item['label'] : '' }}">
                        
                        @if(request()->routeIs($item['href']))
                            <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-white rounded-r-full"></div>
                        @endif
                        
                        <div class="relative flex-shrink-0 {{ request()->routeIs($item['href']) || $hoveredItem === $item['href'] ? 'scale-110' : '' }} transition-transform duration-200">
                            @if(!request()->routeIs($item['href']) && $hoveredItem === $item['href'])
                                <div class="absolute inset-0 bg-gradient-to-r {{ $item['color'] }} rounded-lg blur opacity-50"></div>
                            @endif
                            <i class="bi {{ str_replace('heroicon-o-', 'bi-', $item['icon']) }} w-5 h-5 relative z-10 {{ request()->routeIs($item['href']) ? 'text-white' : '' }}"></i>
                        </div>
                        
                        <span x-show="sidebarOpen" class="font-medium {{ request()->routeIs($item['href']) ? 'text-white' : '' }}">
                            {{ $item['label'] }}
                        </span>
                    </a>
                @endforeach
            </div>

            <div class="my-4 border-t border-slate-700/50"></div>

            <a
                href="/"
                target="_blank"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-emerald-400 hover:bg-emerald-500/10 transition-all duration-200 border border-transparent hover:border-emerald-500/30 {{ !$sidebarOpen ? 'justify-center px-3' : '' }}"
                title="{{ !$sidebarOpen ? 'View Site' : '' }}">
                <i class="bi bi-box-arrow-up-right w-5 h-5 flex-shrink-0"></i>
                <span x-show="sidebarOpen" class="font-medium">View Live Site</span>
            </a>
        </nav>
        
        <!-- Logout Button -->
        <div class="px-3 py-4 border-t border-slate-700/50 bg-slate-900/50 {{ !$sidebarOpen ? 'flex justify-center' : '' }}">
            <button
                wire:click="logout"
                class="group flex items-center gap-3 px-4 py-3 text-slate-400 border border-slate-700 rounded-xl hover:text-red-400 hover:border-red-500/50 hover:bg-red-500/10 transition-all duration-200 {{ $sidebarOpen ? 'w-full justify-start' : 'justify-center px-3' }}"
                title="{{ !$sidebarOpen ? 'Logout' : '' }}">
                <i class="bi bi-box-arrow-right w-5 h-5 group-hover:rotate-12 transition-transform duration-200"></i>
                <span x-show="sidebarOpen" class="font-medium">Logout</span>
            </button>
        </div>
    </aside>
    
    <!-- Main Content -->
    <main 
        class="flex-1 overflow-y-auto scrollbar-light transition-all duration-300"
        :class="sidebarOpen ? 'ml-72' : 'ml-20'">
        <div class="min-h-full">
            {{ $slot }}
        </div>
    </main>
</div>
