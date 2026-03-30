<div class="p-6" x-data="{ showModal: @entangle('showModal'), showDeleteModal: @entangle('showDeleteModal') }">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Stats Management</h1>
        <p class="text-gray-600">Manage statistics displayed across your website</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 mb-6">
        <label class="block text-sm font-medium text-gray-700 mb-2">Select Section</label>
        <select wire:model.live="selectedSection" class="w-full md:w-64 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
            @foreach($sections as $section)
                <option value="{{ $section['value'] }}">{{ $section['label'] }}</option>
            @endforeach
        </select>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-800">
                {{ collect($sections)->firstWhere('value', $selectedSection)['label'] ?? 'Stats' }} ({{ count($stats) }})
            </h2>
            <button wire:click="openModal()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center gap-2">
                <i class="bi bi-plus"></i> Add Stat
            </button>
        </div>
        
        @if($loading)
            <div class="p-12 text-center">
                <div class="w-10 h-10 border-4 border-gray-200 border-t-blue-500 rounded-full animate-spin mx-auto"></div>
                <p class="mt-4 text-gray-500">Loading stats...</p>
            </div>
        @elseif(count($stats) === 0)
            <div class="p-12 text-center">
                <i class="bi bi-bar-chart text-5xl text-gray-300 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-700 mb-2">No stats yet</h3>
                <button wire:click="openModal()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Add Stat</button>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Icon</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Label</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Value</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($stats as $stat)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-gray-600">{{ $stat['display_order'] }}</td>
                                <td class="px-6 py-4">
                                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <i class="bi {{ $stat['icon'] }} text-blue-600 text-lg"></i>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $stat['label'] }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 bg-green-100 text-green-800 rounded text-sm font-medium">
                                        {{ $stat['value'] }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $stat['status'] === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ $stat['status'] }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-2">
                                        <button wire:click="openModal({{ json_encode($stat) }})" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg"><i class="bi bi-pencil"></i></button>
                                        <button wire:click="confirmDelete('{{ $stat['id'] }}')" class="p-2 text-red-600 hover:bg-red-50 rounded-lg"><i class="bi bi-trash"></i></button>
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
    <div x-show="showModal" x-cloak class="fixed inset-0 z-[9999] overflow-y-auto">
        <div class="flex min-h-screen items-center justify-center p-4">
            <div class="fixed inset-0 bg-black/50" @click="showModal = false"></div>
            <div class="relative bg-white rounded-xl shadow-xl max-w-md w-full max-h-[90vh] overflow-y-auto scrollbar-light" @click.stop>
                <div class="sticky top-0 bg-white border-b border-gray-200 px-6 py-4 flex justify-between items-center">
                    <h3 class="text-xl font-semibold text-gray-900">{{ $editingStat ? 'Edit Stat' : 'Add New Stat' }}</h3>
                    <button wire:click="closeModal()" class="p-2 text-gray-400 hover:text-gray-600 rounded-lg"><i class="bi bi-x-lg text-xl"></i></button>
                </div>
                <form wire:submit.prevent="save" class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Label *</label>
                        <input type="text" wire:model="label" required placeholder="e.g., Projects Delivered" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Value *</label>
                        <input type="text" wire:model="value" required placeholder="e.g., 150+ or 98%" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Icon</label>
                        <select wire:model="icon" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
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
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select wire:model="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>
                    <div class="mt-6 flex justify-end gap-3 pt-4 border-t border-gray-200">
                        <button type="button" wire:click="closeModal()" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">{{ $editingStat ? 'Update' : 'Add' }}</button>
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
                <h3 class="text-xl font-bold text-gray-900 mb-2">Delete Stat?</h3>
                <p class="text-gray-600 mb-6">This action cannot be undone.</p>
                <div class="flex gap-3 justify-center">
                    <button wire:click="showDeleteModal = false" class="px-5 py-2.5 border border-gray-300 text-gray-700 rounded-lg">Cancel</button>
                    <button wire:click="delete()" class="px-5 py-2.5 bg-red-600 text-white rounded-lg">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
