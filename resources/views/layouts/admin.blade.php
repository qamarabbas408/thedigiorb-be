<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - DigitalOrb</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        [x-cloak] { display: none !important; }
        
        a { text-decoration: none !important; }
        a:hover { text-decoration: none !important; }
        
        body { overflow-x: hidden !important; }
        
        /* Hide all horizontal scrollbars in sidebar */
        aside::-webkit-scrollbar { display: none !important; }
        aside { scrollbar-width: none !important; -ms-overflow-style: none !important; }
        
        .scrollbar-dark::-webkit-scrollbar { width: 6px; }
        .scrollbar-dark::-webkit-scrollbar-track { background: transparent; }
        .scrollbar-dark::-webkit-scrollbar-thumb { background: #475569; border-radius: 3px; }
        .scrollbar-dark::-webkit-scrollbar-thumb:hover { background: #64748b; }
        .scrollbar-dark { scrollbar-width: thin; scrollbar-color: #475569 transparent; }
        
        .scrollbar-light::-webkit-scrollbar { width: 6px; height: 6px; }
        .scrollbar-light::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 3px; }
        .scrollbar-light::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
        .scrollbar-light::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        .scrollbar-light { scrollbar-width: thin; scrollbar-color: #cbd5e1 #f1f5f9; }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 via-blue-50/30 to-indigo-50/30 min-h-screen" x-data="{ sidebarOpen: localStorage.getItem('sidebarOpen') === 'true', init() { if (!localStorage.getItem('sidebarOpen')) { this.sidebarOpen = true; } }, toggleSidebar() { this.sidebarOpen = !this.sidebarOpen; localStorage.setItem('sidebarOpen', this.sidebarOpen); } }">

    <!-- Toggle Button -->
    <button
        @click="toggleSidebar()"
        style="position: fixed; top: 16px; left: 16px; z-index: 9999; padding: 10px 14px; background: linear-gradient(135deg, #2563eb, #9333ea); color: white; border: none; border-radius: 8px; cursor: pointer; box-shadow: 0 4px 12px rgba(0,0,0,0.3);"
        aria-label="Toggle menu">
        <i class="bi bi-list" style="font-size: 20px;"></i>
    </button>

    <!-- Sidebar -->
    <aside class="bg-gradient-to-b from-slate-900 via-slate-900 to-slate-800 text-white flex flex-col fixed h-screen z-40 transition-all duration-300 shadow-2xl overflow-x-hidden" :class="sidebarOpen ? 'w-72' : 'w-20'">
        <!-- Header -->
        <div class="px-6 py-6 border-b border-slate-700/50 flex items-center gap-3" :class="sidebarOpen ? 'justify-start' : 'justify-center'">
            <div class="relative group">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl blur opacity-75 group-hover:opacity-100 transition-opacity"></div>
                <div class="relative w-10 h-10 bg-gradient-to-br from-blue-600 to-purple-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg">
                    <i class="bi bi-hexagon-fill text-white text-lg"></i>
                </div>
            </div>
            <div class="flex flex-col" x-show="sidebarOpen" x-cloak>
                <span class="text-lg font-bold whitespace-nowrap bg-gradient-to-r from-white to-blue-200 bg-clip-text text-transparent">DigitalOrb</span>
                <span class="text-xs text-slate-400">Admin Dashboard</span>
            </div>
        </div>
        
        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto py-4 scrollbar-dark px-2 lg:px-3">
            <div class="space-y-1">
                @php
                $currentPath = '/' . request()->segment(2);
                $navItems = [
                    ['href' => '/admin', 'label' => 'Dashboard', 'icon' => 'bi-grid-1x2-fill', 'color' => 'from-blue-500 to-cyan-500'],
                    ['href' => '/admin/projects', 'label' => 'Projects', 'icon' => 'bi-briefcase-fill', 'color' => 'from-violet-500 to-purple-500'],
                    ['href' => '/admin/categories', 'label' => 'Categories', 'icon' => 'bi-tags-fill', 'color' => 'from-pink-500 to-rose-500'],
                    ['href' => '/admin/services', 'label' => 'Services', 'icon' => 'bi-gear-fill', 'color' => 'from-amber-500 to-orange-500'],
                    ['href' => '/admin/stats', 'label' => 'Section Stats', 'icon' => 'bi-bar-chart-fill', 'color' => 'from-emerald-500 to-teal-500'],
                    ['href' => '/admin/global-stats', 'label' => 'Global Stats', 'icon' => 'bi-globe', 'color' => 'from-violet-500 to-purple-500'],
                    ['href' => '/admin/team', 'label' => 'Team', 'icon' => 'bi-people-fill', 'color' => 'from-indigo-500 to-blue-500'],
                    ['href' => '/admin/testimonials', 'label' => 'Testimonials', 'icon' => 'bi-chat-quote-fill', 'color' => 'from-cyan-500 to-sky-500'],
                    ['href' => '/admin/contacts', 'label' => 'Contacts', 'icon' => 'bi-envelope-fill', 'color' => 'from-red-500 to-pink-500'],
                    ['href' => '/admin/settings', 'label' => 'Settings', 'icon' => 'bi-sliders', 'color' => 'from-slate-500 to-gray-500'],
                ];
                @endphp
                
                @foreach($navItems as $item)
                    @php $itemLabel = addslashes($item['label']); @endphp
                    <a href="{{ $item['href'] }}" 
                       class="group relative flex items-center gap-3 px-3 py-3 rounded-xl transition-all duration-200 {{ $currentPath === $item['href'] ? 'bg-gradient-to-r from-blue-600 to-purple-600 text-white shadow-lg' : 'text-slate-400 hover:text-white hover:bg-slate-800/50' }}"
                       :class="sidebarOpen ? '' : 'justify-center px-2'"
                       x-data="{}"
                       @mouseenter="$el.title = sidebarOpen ? '' : '{{ $itemLabel }}'"
                       @mouseleave="$el.title = ''">
                        
                        @if($currentPath === $item['href'])
                            <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-white rounded-r-full"></div>
                        @endif
                        
                        <div class="relative flex-shrink-0">
                            <div class="absolute inset-0 bg-gradient-to-r {{ $item['color'] }} rounded-lg blur opacity-50" :class="sidebarOpen ? '' : 'hidden'"></div>
                            <i class="bi {{ $item['icon'] }} w-5 h-5 relative z-10"></i>
                        </div>
                        
                        <span class="font-medium" x-show="sidebarOpen" x-cloak>{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </div>

            <div class="my-4 border-t border-slate-700/50"></div>

            <a href="/" target="_blank" class="flex items-center gap-3 px-2 lg:px-4 py-3 rounded-xl text-slate-400 hover:text-emerald-400 hover:bg-emerald-500/10 transition-all duration-200 border border-transparent hover:border-emerald-500/30"
               :class="sidebarOpen ? '' : 'justify-center px-2'"
               title="View Live Site">
                <i class="bi bi-box-arrow-up-right w-5 h-5 flex-shrink-0"></i>
                <span class="font-medium" x-show="sidebarOpen" x-cloak>View Live Site</span>
            </a>
        </nav>
        
        <!-- Logout Button -->
        <div class="px-2 lg:px-3 py-4 border-t border-slate-700/50 bg-slate-900/50" :class="sidebarOpen ? '' : 'flex justify-center'">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="group flex items-center gap-3 px-2 lg:px-4 py-3 text-slate-400 border border-slate-700 rounded-xl hover:text-red-400 hover:border-red-500/50 hover:bg-red-500/10 transition-all duration-200"
                        :class="sidebarOpen ? 'w-full justify-start' : 'justify-center px-2'"
                        title="Logout">
                    <i class="bi bi-box-arrow-right w-5 h-5 group-hover:rotate-12 transition-transform duration-200"></i>
                    <span class="font-medium" x-show="sidebarOpen" x-cloak>Logout</span>
                </button>
            </form>
        </div>
    </aside>
    
    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto scrollbar-light transition-all duration-300 overflow-x-hidden" :class="sidebarOpen ? 'ml-72' : 'ml-20'">
        <div class="min-h-full">
            {{ $slot }}
        </div>
    </main>
    
    @livewireScripts
    
    <script>
        document.addEventListener('livewire:init', () => {
            // Toast notification system
            Livewire.on('toast', (event) => {
                const { message, type } = event[0] || event;
                
                // Create toast element if it doesn't exist
                let toast = document.getElementById('livewire-toast');
                if (!toast) {
                    toast = document.createElement('div');
                    toast.id = 'livewire-toast';
                    toast.className = 'fixed top-4 right-4 z-50 px-4 py-3 rounded-lg shadow-lg transform transition-all duration-300 translate-x-full';
                    document.body.appendChild(toast);
                }
                
                // Set content and styling
                toast.textContent = message;
                toast.className = `fixed top-4 right-4 z-50 px-4 py-3 rounded-lg shadow-lg transform transition-all duration-300 ${
                    type === 'success' ? 'bg-green-600 text-white' : 'bg-red-600 text-white'
                }`;
                
                // Show toast
                setTimeout(() => {
                    toast.classList.remove('translate-x-full');
                    toast.classList.add('translate-x-0');
                }, 100);
                
                // Hide toast after 3 seconds
                setTimeout(() => {
                    toast.classList.remove('translate-x-0');
                    toast.classList.add('translate-x-full');
                    
                    // Remove from DOM after animation
                    setTimeout(() => {
                        if (toast.parentNode) {
                            toast.parentNode.removeChild(toast);
                        }
                    }, 300);
                }, 3000);
            });
        });
    </script>
</body>
</html>
