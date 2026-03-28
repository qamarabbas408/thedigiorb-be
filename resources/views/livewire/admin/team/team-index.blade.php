<div class="p-6" x-data="{ showModal: @entangle('showModal'), showDeleteModal: @entangle('showDeleteModal') }">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Team Members</h1>
        <p class="text-gray-600">Manage your team section</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-800">All Team Members ({{ count($members) }})</h2>
            <button wire:click="openModal()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center gap-2">
                <i class="bi bi-plus"></i> Add Team Member
            </button>
        </div>
        
        @if(count($members) === 0)
            <div class="p-12 text-center">
                <i class="bi bi-people text-5xl text-gray-300 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-700 mb-2">No team members yet</h3>
                <button wire:click="openModal()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Add Team Member</button>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
                @foreach($members as $member)
                    <div class="bg-gray-50 rounded-xl overflow-hidden hover:shadow-md transition-shadow">
                        <div class="aspect-square bg-gray-200 relative">
                            <img src="{{ $member['image'] ?: 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=400&h=400&fit=crop' }}" alt="{{ $member['name'] }}" class="w-full h-full object-cover" />
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
        @endif
    </div>

    <!-- Modal -->
    <div x-show="showModal" x-cloak class="fixed inset-0 z-[9999] overflow-y-auto">
        <div class="flex min-h-screen items-center justify-center p-4">
            <div class="fixed inset-0 bg-black/50" @click="showModal = false"></div>
            <div class="relative bg-white rounded-xl shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto scrollbar-light" @click.stop>
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
                            <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                            <input type="text" wire:model="role" placeholder="CEO" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Display Order</label>
                            <input type="number" wire:model="displayOrder" min="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" />
                        </div>
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                        <textarea wire:model="bio" rows="3" placeholder="Short bio..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none resize-none"></textarea>
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Image URL</label>
                        <input type="url" wire:model="image" placeholder="https://..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" />
                        @if($image)
                            <img src="{{ $image }}" alt="Preview" class="mt-2 w-24 h-24 object-cover rounded-lg" />
                        @endif
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Social Links</label>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs text-gray-500 mb-1">Facebook</label>
                                <input type="url" wire:model="facebook_url" placeholder="https://facebook.com/..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-sm" />
                            </div>
                            <div>
                                <label class="block text-xs text-gray-500 mb-1">Twitter</label>
                                <input type="url" wire:model="twitter_url" placeholder="https://twitter.com/..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-sm" />
                            </div>
                            <div>
                                <label class="block text-xs text-gray-500 mb-1">LinkedIn</label>
                                <input type="url" wire:model="linkedin_url" placeholder="https://linkedin.com/in/..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-sm" />
                            </div>
                            <div>
                                <label class="block text-xs text-gray-500 mb-1">Instagram</label>
                                <input type="url" wire:model="instagram_url" placeholder="https://instagram.com/..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-sm" />
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end gap-3 pt-4 border-t border-gray-200">
                        <button type="button" wire:click="closeModal()" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">{{ $editingMember ? 'Update' : 'Add Member' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div x-show="showDeleteModal" x-cloak class="fixed inset-0 bg-black/50 flex items-center justify-center z-[9999]">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6">
            <div class="text-center">
                <div class="w-16 h-16 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="bi bi-exclamation-triangle text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Delete Team Member?</h3>
                <p class="text-gray-600 mb-6">This action cannot be undone.</p>
                <div class="flex gap-3 justify-center">
                    <button wire:click="showDeleteModal = false" class="px-5 py-2.5 border border-gray-300 text-gray-700 rounded-lg">Cancel</button>
                    <button wire:click="delete()" class="px-5 py-2.5 bg-red-600 text-white rounded-lg">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
