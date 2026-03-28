<div class="p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Services</h1>
        <p class="text-gray-600">Manage your service offerings</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-800">All Services ({{ count($services) }})</h2>
            <button wire:click="openModal()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center gap-2">
                <i class="bi bi-plus"></i> Add Service
            </button>
        </div>
        
        @if(count($services) === 0)
            <div class="p-12 text-center">
                <i class="bi bi-gear text-5xl text-gray-300 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-700 mb-2">No services yet</h3>
                <button wire:click="openModal()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Add Service</button>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Icon</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Featured</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($services as $service)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <i class="bi {{ $service['icon'] }} text-blue-600 text-lg"></i>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $service['title'] }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">{{ $service['description'] }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $service['display_order'] }}</td>
                                <td class="px-6 py-4">
                                    @if($service['featured'])
                                        <span class="inline-flex items-center gap-1 px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-xs font-medium">
                                            <i class="bi bi-star-fill"></i> Featured
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $service['status'] === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ $service['status'] }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-2">
                                        <button wire:click="openModal({{ json_encode($service) }})" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg"><i class="bi bi-pencil"></i></button>
                                        <button wire:click="confirmDelete('{{ $service['id'] }}')" class="p-2 text-red-600 hover:bg-red-50 rounded-lg"><i class="bi bi-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Modal -->
    @if($showModal)
        <div class="fixed inset-0 z-[9999] overflow-y-auto">
            <div class="flex min-h-screen items-center justify-center p-4">
                <div class="fixed inset-0 bg-black/50" wire:click="closeModal"></div>
                <div class="relative bg-white rounded-xl shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto scrollbar-light">
                    <div class="sticky top-0 bg-white border-b border-gray-200 px-6 py-4 flex justify-between items-center">
                        <h3 class="text-xl font-semibold text-gray-900">{{ $editingService ? 'Edit Service' : 'Add New Service' }}</h3>
                        <button wire:click="closeModal()" class="p-2 text-gray-400 hover:text-gray-600 rounded-lg"><i class="bi bi-x-lg text-xl"></i></button>
                    </div>
                    <form wire:submit.prevent="save" class="p-6">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Service Title *</label>
                                <input type="text" wire:model="title" required placeholder="e.g., Web Development" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" />
                            </div>
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                <textarea wire:model="description" rows="3" placeholder="Describe the service..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none resize-none"></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Icon</label>
                                <select wire:model.live="icon" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                                    @foreach($iconOptions as $opt)
                                        <option value="{{ $opt['value'] }}">{{ $opt['label'] }}</option>
                                    @endforeach
                                </select>
                                <div class="mt-2 flex items-center gap-2">
                                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <i class="bi {{ $icon }} text-blue-600 text-lg"></i>
                                    </div>
                                    <span class="text-xs text-gray-500">Preview</span>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Display Order</label>
                                <input type="number" wire:model="displayOrder" min="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" />
                            </div>
                        </div>
                        <div class="mt-4 flex gap-6">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" wire:model="featured" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" />
                                <span class="text-sm text-gray-700">Featured Service</span>
                            </label>
                            <div class="flex-1">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <select wire:model="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                                    <option value="published">Published</option>
                                    <option value="draft">Draft</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-6 flex justify-end gap-3 pt-4 border-t border-gray-200">
                            <button type="button" wire:click="closeModal()" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">Cancel</button>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">{{ $editingService ? 'Update Service' : 'Add Service' }}</button>
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
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Delete Service?</h3>
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
