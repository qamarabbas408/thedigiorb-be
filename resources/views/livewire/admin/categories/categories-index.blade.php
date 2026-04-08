<div class="p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Categories</h1>
        <p class="text-gray-600">Manage project categories</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h2 class="text-lg font-semibold text-gray-800">All Categories ({{ $categories->total() }})</h2>
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
                <button 
                    wire:click="openModal()"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center gap-2">
                    <i class="bi bi-plus"></i>
                    Add Category
                </button>
            </div>
        </div>
        
        @if($categories->count() === 0)
            <div class="p-12 text-center">
                <i class="bi bi-tags text-5xl text-gray-300 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-700 mb-2">No categories yet</h3>
                <p class="text-gray-500 mb-4">Create categories to organize your projects</p>
                <button 
                    wire:click="openModal()"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    Add Category
                </button>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Icon</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Slug</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Filter Class</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($categories as $index => $category)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $categories->firstItem() + $index }}
                                </td>
                                <td class="px-6 py-4">
                                    <i class="bi {{ $category['icon'] }} text-2xl text-blue-600"></i>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-medium text-gray-900">{{ $category['name'] }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <code class="px-2 py-1 bg-gray-100 text-gray-600 rounded text-sm">{{ $category['slug'] }}</code>
                                </td>
                                <td class="px-6 py-4">
                                    <code class="px-2 py-1 bg-gray-100 text-gray-600 rounded text-sm">{{ $category['filter_class'] }}</code>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-2">
                                        <button 
                                            wire:click="openModal({{ json_encode($category) }})"
                                            class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button 
                                            wire:click="confirmDelete('{{ $category['id'] }}')"
                                            class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($categories->hasPages())
                <div class="px-6 py-4 border-t border-gray-200 flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div class="text-sm text-gray-600">
                        Showing {{ $categories->firstItem() }} to {{ $categories->lastItem() }} of {{ $categories->total() }} results
                    </div>
                    <nav class="flex items-center gap-1">
                        @if($categories->onFirstPage())
                            <span class="px-3 py-1 rounded border border-gray-300 text-gray-400 cursor-not-allowed">‹ Prev</span>
                        @else
                            <a href="?page={{ $categories->currentPage() - 1 }}" class="px-3 py-1 rounded border border-gray-300 text-gray-600 hover:bg-gray-50" wire:navigate>‹ Prev</a>
                        @endif
                        
                        @foreach(range(1, $categories->lastPage()) as $page)
                            @if($page == $categories->currentPage())
                                <span class="px-3 py-1 rounded bg-blue-600 text-white">{{ $page }}</span>
                            @else
                                <a href="?page={{ $page }}" class="px-3 py-1 rounded border border-gray-300 text-gray-600 hover:bg-gray-50" wire:navigate>{{ $page }}</a>
                            @endif
                        @endforeach
                        
                        @if($categories->hasMorePages())
                            <a href="?page={{ $categories->currentPage() + 1 }}" class="px-3 py-1 rounded border border-gray-300 text-gray-600 hover:bg-gray-50" wire:navigate>Next ›</a>
                        @else
                            <span class="px-3 py-1 rounded border border-gray-300 text-gray-400 cursor-not-allowed">Next ›</span>
                        @endif
                    </nav>
                </div>
            @endif
        @endif
    </div>

    <!-- Add/Edit Modal -->
    @if($showModal)
        <div class="fixed inset-0 z-[9999] overflow-y-auto">
            <div class="flex min-h-screen items-center justify-center p-4">
                <div class="fixed inset-0 bg-black/50 transition-opacity" wire:click="closeModal"></div>
                <div class="relative bg-white rounded-xl shadow-xl max-w-md w-full max-h-[90vh] overflow-y-auto scrollbar-light">
                    <div class="border-b border-gray-200 px-6 py-4 flex justify-between items-center">
                        <h3 class="text-xl font-semibold text-gray-900">
                            {{ $editingCategory ? 'Edit Category' : 'Add New Category' }}
                        </h3>
                        <button 
                            wire:click="closeModal()"
                            class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                            <i class="bi bi-x-lg text-xl"></i>
                        </button>
                    </div>
                    
                    <form wire:submit.prevent="save" class="p-6">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Category Name *</label>
                            <input
                                type="text"
                                wire:model="name"
                                required
                                placeholder="e.g., Web Design"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                            />
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Icon</label>
                            <select
                                wire:model.live="icon"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                                @foreach($iconOptions as $icon)
                                    <option value="{{ $icon }}">{{ str_replace('bi-', '', $icon) }}</option>
                                @endforeach
                            </select>
                            <div class="mt-3 text-3xl">
                                <i class="bi {{ $icon }}"></i>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Filter Class</label>
                            <input
                                type="text"
                                wire:model="filterClass"
                                placeholder="e.g., web-design"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                            />
                        </div>

                        <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
                            <button 
                                type="button" 
                                wire:click="closeModal()"
                                class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                                Cancel
                            </button>
                            <button 
                                type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                {{ $editingCategory ? 'Update Category' : 'Add Category' }}
                            </button>
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
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Delete Category?</h3>
                    <p class="text-gray-600 mb-6">This action cannot be undone.</p>
                    <div class="flex gap-3 justify-center">
                        <button wire:click="cancelDelete" class="px-5 py-2.5 border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-50">Cancel</button>
                        <button wire:click="delete()" class="px-5 py-2.5 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
