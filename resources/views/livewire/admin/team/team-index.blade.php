<div class="p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Team Members</h1>
        <p class="text-gray-600">Manage your team section</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h2 class="text-lg font-semibold text-gray-800">All Team Members ({{ $members->total() }})</h2>
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2">
                    <label class="text-sm text-gray-600">Show:</label>
                    <select wire:model="perPage" wire:change="resetPage" class="border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <option value="12">12</option>
                        <option value="24">24</option>
                        <option value="48">48</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <button wire:click="openModal()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center gap-2">
                    <i class="bi bi-plus"></i> Add Team Member
                </button>
            </div>
        </div>
        
        @if($members->count() === 0)
            <div class="p-12 text-center">
                <i class="bi bi-people text-5xl text-gray-300 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-700 mb-2">No team members yet</h3>
                <button wire:click="openModal()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Add Team Member</button>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
                @foreach($members as $index => $member)
                    <div class="bg-gray-50 rounded-xl overflow-hidden hover:shadow-md transition-shadow relative">
                        <div class="absolute top-2 left-2 z-10 bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded-full">
                            #{{ $members->firstItem() + $index }}
                        </div>
                        <div class="aspect-square bg-gray-200 relative">
                            <img src="{{ $member['image'] ?: 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=400&h=400&fit=crop' }}" alt="{{ $member['name'] }}" class="w-full h-full object-cover" onerror="this.src='https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=400&h=400&fit=crop'" />
                            <div class="absolute top-2 right-2 flex gap-2">
                                <button wire:click="openModal({{ json_encode($member) }})" class="p-2 bg-white rounded-full shadow hover:bg-blue-50">
                                    <i class="bi bi-pencil text-blue-600"></i>
                                </button>
                                <button wire:click="confirmDelete('{{ $member['id'] }}')" class="p-2 bg-white rounded-full shadow hover:bg-red-50">
                                    <i class="bi bi-trash text-red-600"></i>
                                </button>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900">{{ $member['name'] }}</h3>
                            <p class="text-blue-600 text-sm mb-2">{{ $member['role'] }}</p>
                            @if($member['bio'])
                                <p class="text-gray-500 text-sm line-clamp-2">{{ $member['bio'] }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            @if($members->hasPages())
                <div class="px-6 py-4 border-t border-gray-200 flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div class="text-sm text-gray-600">
                        Showing {{ $members->firstItem() }} to {{ $members->lastItem() }} of {{ $members->total() }} results
                    </div>
                    <nav class="flex items-center gap-1">
                        @if($members->onFirstPage())
                            <span class="px-3 py-1 rounded border border-gray-300 text-gray-400 cursor-not-allowed">‹ Prev</span>
                        @else
                            <a href="?page={{ $members->currentPage() - 1 }}" class="px-3 py-1 rounded border border-gray-300 text-gray-600 hover:bg-gray-50" wire:navigate>‹ Prev</a>
                        @endif
                        
                        @foreach(range(1, $members->lastPage()) as $page)
                            @if($page == $members->currentPage())
                                <span class="px-3 py-1 rounded bg-blue-600 text-white">{{ $page }}</span>
                            @else
                                <a href="?page={{ $page }}" class="px-3 py-1 rounded border border-gray-300 text-gray-600 hover:bg-gray-50" wire:navigate>{{ $page }}</a>
                            @endif
                        @endforeach
                        
                        @if($members->hasMorePages())
                            <a href="?page={{ $members->currentPage() + 1 }}" class="px-3 py-1 rounded border border-gray-300 text-gray-600 hover:bg-gray-50" wire:navigate>Next ›</a>
                        @else
                            <span class="px-3 py-1 rounded border border-gray-300 text-gray-400 cursor-not-allowed">Next ›</span>
                        @endif
                    </nav>
                </div>
            @endif
        @endif
    </div>

    @if($showModal)
        <div class="fixed inset-0 z-[9999] overflow-y-auto">
            <div class="flex min-h-screen items-center justify-center p-4">
                <div class="fixed inset-0 bg-black/50" wire:click="closeModal"></div>
                <div class="relative bg-white rounded-xl shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto scrollbar-light">
                    <div class="sticky top-0 bg-white border-b border-gray-200 px-6 py-4 flex justify-between items-center">
                        <h3 class="text-xl font-semibold text-gray-900">{{ $editingMember ? 'Edit Team Member' : 'Add Team Member' }}</h3>
                        <button wire:click="closeModal()" class="p-2 text-gray-400 hover:text-gray-600 rounded-lg"><i class="bi bi-x-lg text-xl"></i></button>
                    </div>
                    <form wire:submit.prevent="save" class="p-6">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Name *</label>
                                <input type="text" wire:model="name" required placeholder="John Doe" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Role *</label>
                                <input type="text" wire:model="role" required placeholder="CEO" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Display Order</label>
                                <input type="number" wire:model="displayOrder" min="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" />
                            </div>
                        </div>
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                            <textarea wire:model="bio" rows="3" placeholder="Brief description..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none resize-none"></textarea>
                        </div>
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Profile Image *</label>
                            
                            <!-- Tab Navigation -->
                            <div class="flex space-x-1 mb-3">
                                <button 
                                    type="button" 
                                    wire:click="$set('imageTab', 'upload')"
                                    class="flex-1 py-2 px-3 text-sm font-medium rounded-l-lg {{ $imageTab === 'upload' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}"
                                >
                                    Upload Image
                                </button>
                                <button 
                                    type="button" 
                                    wire:click="$set('imageTab', 'url')"
                                    class="flex-1 py-2 px-3 text-sm font-medium rounded-r-lg {{ $imageTab === 'url' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}"
                                >
                                    Image URL
                                </button>
                            </div>
                            
                            <!-- Upload Tab -->
                            @if($imageTab === 'upload')
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4">
                                    <div class="text-center">
                                        <i class="bi bi-person text-3xl text-gray-400 mb-2"></i>
                                        <label for="team-image-upload" class="cursor-pointer">
                                            <span class="text-sm font-medium text-gray-900">
                                                Click to upload profile image
                                            </span>
                                            <span class="text-xs text-gray-500 block">
                                                PNG, JPG, GIF, WebP up to 10MB
                                            </span>
                                        </label>
                                        <input
                                            type="file"
                                            id="team-image-upload"
                                            wire:model="mainImageFile"
                                            accept="image/*"
                                            class="sr-only"
                                        />
                                    </div>
                                </div>
                                
                                <!-- Preview uploaded image -->
                                @if($mainImageFile)
                                    <div class="mt-4">
                                        <img src="{{ $mainImageFile->temporaryUrl() }}" alt="Preview" class="w-24 h-24 object-cover rounded-lg border border-blue-200">
                                        <p class="text-xs text-blue-600 mt-1">New profile image preview</p>
                                    </div>
                                @endif
                                
                                @error('mainImageFile')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            @endif
                            
                            <!-- URL Tab -->
                            @if($imageTab === 'url')
                                <div>
                                    <input
                                        type="url"
                                        wire:model="imageUrl"
                                        placeholder="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=400&fit=crop"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    />
                                    <p class="text-xs text-gray-500 mt-1">Enter profile image URL from Unsplash, LinkedIn, or any other source</p>
                                    
                                    <!-- Preview URL image -->
                                    @if($imageUrl)
                                        <div class="mt-4">
                                            <img src="{{ $imageUrl }}" alt="Preview" class="w-24 h-24 object-cover rounded-lg border border-blue-200" onerror="this.src='https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=300&h=300&fit=crop'">
                                            <p class="text-xs text-blue-600 mt-1">URL image preview</p>
                                        </div>
                                    @endif
                                    
                                    @error('imageUrl')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            @endif
                            
                            <!-- Show current image if editing -->
                            @if($editingMember && $editingMember['image'])
                                <div class="mt-4 p-3 bg-gray-50 rounded-lg">
                                    <p class="text-xs font-medium text-gray-700 mb-2">Current Image:</p>
                                    <img src="{{ $editingMember['image'] }}" alt="Current" class="w-20 h-20 object-cover rounded border border-gray-300" onerror="this.src='https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=300&h=300&fit=crop'">
                                </div>
                            @endif
                            
                            @error('imageRequired')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mt-6 flex justify-end gap-3 pt-4 border-t border-gray-200">
                            <button type="button" wire:click="closeModal()" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">Cancel</button>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">{{ $editingMember ? 'Update' : 'Add' }} Team Member</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- Delete Modal -->
    @if($showDeleteModal)
        <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-[9999]">
            <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6">
                <div class="text-center">
                    <div class="w-16 h-16 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="bi bi-exclamation-triangle text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Delete Team Member?</h3>
                    <p class="text-gray-600 mb-6">This action cannot be undone.</p>
                    <div class="flex gap-3 justify-center">
                        <button wire:click="cancelDelete" class="px-5 py-2.5 border border-gray-300 text-gray-700 rounded-lg">Cancel</button>
                        <button wire:click="delete()" class="px-5 py-2.5 bg-red-600 text-white rounded-lg">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
