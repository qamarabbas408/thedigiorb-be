<div class="p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Site Settings</h1>
        <p class="text-gray-600">Manage your site information</p>
    </div>

    @if($loading)
        <div class="flex items-center justify-center min-h-64">
            <div class="w-10 h-10 border-4 border-gray-200 border-t-blue-500 rounded-full animate-spin"></div>
        </div>
    @else
        <form wire:submit.prevent="save">
            <!-- Logo & Branding Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800">Logo & Branding</h2>
                </div>
                
                <div class="p-6 space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Logo Type</label>
                        <div class="flex gap-4">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" wire:model="logo_type" value="text" class="w-4 h-4 text-blue-600" />
                                <span class="text-sm text-gray-700">Text Logo</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" wire:model="logo_type" value="image" class="w-4 h-4 text-blue-600" />
                                <span class="text-sm text-gray-700">Image Logo</span>
                            </label>
                        </div>
                    </div>

                    @if($logo_type === 'image')
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Logo Image URL</label>
                            <input type="url" wire:model="logo_image" placeholder="https://..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" />
                            @if($logo_image)
                                <div class="mt-2">
                                    <img src="{{ $logo_image }}" alt="Logo Preview" class="h-10 w-auto" />
                                </div>
                            @endif
                        </div>
                    @endif

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Favicon URL</label>
                        <input type="url" wire:model="favicon" placeholder="https://..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" />
                        @if($favicon)
                            <div class="mt-2 flex items-center gap-2">
                                <img src="{{ $favicon }}" alt="Favicon Preview" class="w-6 h-6" />
                                <span class="text-sm text-gray-500">Browser Tab</span>
                            </div>
                        @endif
                    </div>

                    <div class="pt-4 border-t border-gray-200">
                        <h3 class="text-sm font-medium text-gray-700 mb-3">Preview</h3>
                        <div class="flex items-center gap-8 p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-center gap-2">
                                @if($logo_type === 'image' && $logo_image)
                                    <img src="{{ $logo_image }}" alt="Logo Preview" class="h-10 w-auto" />
                                @else
                                    <span class="text-2xl font-bold text-gray-800">{{ $company_name ?: 'Company Name' }}</span>
                                @endif
                            </div>
                            <div class="flex items-center gap-2">
                                @if($favicon)
                                    <img src="{{ $favicon }}" alt="Favicon Preview" class="w-6 h-6" />
                                @else
                                    <div class="w-6 h-6 bg-blue-600 rounded"></div>
                                @endif
                                <span class="text-sm text-gray-500">Browser Tab</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Company Information Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800">Company Information</h2>
                </div>
                
                <div class="p-6 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Company Name</label>
                            <input type="text" wire:model="company_name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" wire:model="company_email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                            <input type="text" wire:model="company_phone" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                            <input type="text" wire:model="company_address" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" />
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea wire:model="company_description" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none resize-none"></textarea>
                    </div>
                </div>
            </div>

            <!-- Social Media Links Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800">Social Media Links</h2>
                </div>
                
                <div class="p-6 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Facebook URL</label>
                            <input type="url" wire:model="facebook_url" placeholder="https://facebook.com/..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Twitter/X URL</label>
                            <input type="url" wire:model="twitter_url" placeholder="https://twitter.com/..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">LinkedIn URL</label>
                            <input type="url" wire:model="linkedin_url" placeholder="https://linkedin.com/in/..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Instagram URL</label>
                            <input type="url" wire:model="instagram_url" placeholder="https://instagram.com/..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" wire:disabled="saving" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors disabled:opacity-50 flex items-center gap-2">
                    @if($saving)
                        <div class="w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin"></div>
                        Saving...
                    @else
                        <i class="bi bi-check-lg"></i>
                        Save Settings
                    @endif
                </button>
            </div>
        </form>
    @endif
</div>
