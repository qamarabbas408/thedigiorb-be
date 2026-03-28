<div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-900 relative overflow-hidden">
    <!-- Enhanced animated background elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-blue-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-purple-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse" style="animation-delay: 1s"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-pink-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse" style="animation-delay: 2s"></div>
        
        <!-- Floating particles -->
        <div class="absolute top-1/4 left-1/4 w-2 h-2 bg-white/30 rounded-full animate-bounce" style="animation-delay: 0s; animation-duration: 3s"></div>
        <div class="absolute top-3/4 right-1/4 w-3 h-3 bg-blue-300/30 rounded-full animate-bounce" style="animation-delay: 1s; animation-duration: 4s"></div>
        <div class="absolute bottom-1/4 left-1/3 w-2 h-2 bg-purple-300/30 rounded-full animate-bounce" style="animation-delay: 2s; animation-duration: 3.5s"></div>
        <div class="absolute top-1/2 right-1/3 w-1 h-1 bg-white/40 rounded-full animate-bounce" style="animation-delay: 1.5s; animation-duration: 2.5s"></div>
    </div>

    <div class="relative bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl p-10 w-full max-w-md border border-white/20 transform transition-all hover:scale-[1.02] duration-300">
        <!-- Header with enhanced branding -->
        <div class="mb-8 text-center">
            <div class="relative inline-block mb-6 group">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl blur-lg opacity-50 group-hover:blur-xl transition-all duration-300"></div>
                <div class="relative w-20 h-20 bg-gradient-to-br from-blue-600 to-purple-600 rounded-2xl flex items-center justify-center shadow-xl transform group-hover:rotate-12 transition-all duration-300">
                    <i class="bi bi-hexagon-fill text-white text-2xl"></i>
                </div>
                <!-- Glow effect on hover -->
                <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-purple-400 rounded-2xl opacity-0 group-hover:opacity-30 blur-xl transition-all duration-300"></div>
            </div>
            
            <h1 class="text-3xl font-bold bg-gradient-to-r from-gray-900 to-gray-700 bg-clip-text text-transparent mb-2">
                Admin Portal
            </h1>
            <p class="text-gray-600 flex items-center justify-center gap-2">
                <i class="bi bi-stars text-purple-500 animate-pulse"></i>
                Portfolio Management System
                <i class="bi bi-stars text-purple-500 animate-pulse" style="animation-delay: 1s"></i>
            </p>
        </div>

        <form wire:submit.prevent="login" class="space-y-6">
            @csrf
            
            <!-- Enhanced error message -->
            @if($error)
                <div class="p-4 bg-red-50 border-2 border-red-200 rounded-xl text-red-600 text-sm flex items-center gap-3 animate-shake">
                    <i class="bi bi-exclamation-triangle-fill text-red-500 text-lg"></i>
                    <div>
                        <strong>Authentication Failed</strong>
                        <p class="text-xs mt-1">{{ $error }}</p>
                    </div>
                </div>
            @endif
            
            <!-- Enhanced password field -->
            <div class="text-left space-y-2">
                <label for="password" class="block text-sm font-semibold text-gray-700 flex items-center gap-2">
                    <i class="bi bi-lock-fill text-gray-500"></i>
                    Secure Password
                </label>
                <div class="relative">
                    <input
                        type="password"
                        id="password"
                        wire:model="password"
                        required
                        placeholder="Enter your secure password"
                        class="w-full px-4 py-3.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all hover:border-gray-300 bg-gray-50 focus:bg-white pl-12"
                    />
                    <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                        <i class="bi bi-shield-lock text-lg"></i>
                    </div>
                    <!-- Password strength indicator -->
                    @if($password)
                        <div class="absolute right-3 top-1/2 transform -translate-y-1/2">
                            @if(strlen($password) >= 8)
                                <i class="bi bi-check-circle-fill text-green-500"></i>
                            @else
                                <i class="bi bi-x-circle-fill text-red-500"></i>
                            @endif
                        </div>
                    @endif
                </div>
                <p class="text-xs text-gray-500 flex items-center gap-1">
                    <i class="bi bi-info-circle"></i>
                    Use your admin secure password to access the dashboard
                </p>
            </div>
            
            <!-- Enhanced submit button -->
            <button 
                type="submit" 
                class="w-full py-3.5 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl font-semibold hover:from-blue-700 hover:to-purple-700 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 active:translate-y-0 relative overflow-hidden group"
            >
                <div class="absolute inset-0 bg-gradient-to-r from-white/0 to-white/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <span class="relative flex items-center justify-center gap-2">
                    <i class="bi bi-shield-check text-lg"></i>
                    Secure Login
                    <i class="bi bi-arrow-right-circle"></i>
                </span>
            </button>
            
            <!-- Additional security info -->
            <div class="text-center pt-4 border-t border-gray-200">
                <p class="text-xs text-gray-500 flex items-center justify-center gap-2">
                    <i class="bi bi-lock-fill text-green-500"></i>
                    Secure authentication • Encrypted connection
                </p>
            </div>
        </form>
    </div>
    
    <!-- Custom styles for animations -->
    <style>
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
        .animate-shake {
            animation: shake 0.5s ease-in-out;
        }
    </style>
</div>
