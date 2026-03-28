<div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-900 relative overflow-hidden">
    <!-- Animated background elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-blue-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-purple-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse" style="animation-delay: 1s"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-pink-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse" style="animation-delay: 2s"></div>
    </div>

    <div class="relative bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl p-10 w-full max-w-md border border-white/20">
        <div class="mb-8 text-center">
            <div class="relative inline-block mb-6">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl blur-lg opacity-50 animate-pulse"></div>
                <div class="relative w-20 h-20 bg-gradient-to-br from-blue-600 to-purple-600 rounded-2xl flex items-center justify-center shadow-xl">
                    <i class="bi bi-hexagon-fill text-white text-2xl"></i>
                </div>
            </div>
            <h1 class="text-3xl font-bold bg-gradient-to-r from-gray-900 to-gray-700 bg-clip-text text-transparent mb-2">
                Admin Portal
            </h1>
            <p class="text-gray-600 flex items-center justify-center gap-2">
                <i class="bi bi-stars text-purple-500"></i>
                Portfolio Management System
            </p>
        </div>

        <form wire:submit.prevent="login" class="space-y-5">
            @csrf
            
            @if($error)
                <div class="p-3 bg-red-50 border border-red-200 rounded-lg text-red-600 text-sm">
                    {{ $error }}
                </div>
            @endif
            
            <div class="text-left">
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                    <i class="bi bi-lock text-gray-500"></i>
                    Password
                </label>
                <input
                    type="password"
                    id="password"
                    wire:model="password"
                    required
                    placeholder="Enter your secure password"
                    class="w-full px-4 py-3.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all hover:border-gray-300 bg-gray-50 focus:bg-white"
                />
            </div>
            
            <button 
                type="submit" 
                class="w-full py-3.5 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl font-semibold hover:from-blue-700 hover:to-purple-700 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 active:translate-y-0"
            >
                <span class="flex items-center justify-center gap-2">
                    Secure Login
                    <i class="bi bi-box-arrow-in-right"></i>
                </span>
            </button>
        </form>
    </div>
</div>
