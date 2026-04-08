<div class="p-8" x-data="{ showModal: @entangle('showModal'), showDeleteModal: @entangle('showDeleteModal') }">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Testimonials</h1>
            <p class="text-gray-600 mt-1">Manage client testimonials</p>
        </div>
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
            <button wire:click="openModal()" class="px-6 py-3 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 flex items-center gap-2">
                <i class="bi bi-plus-lg"></i> Add Testimonial
            </button>
        </div>
    </div>

    @if($loading)
        <div class="flex justify-center py-12">
            <div class="w-10 h-10 border-4 border-gray-200 border-t-blue-500 rounded-full animate-spin"></div>
        </div>
    @elseif($testimonials->count() === 0)
        <div class="bg-white rounded-xl shadow-sm p-12 text-center">
            <i class="bi bi-chat-quote text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">No testimonials yet</h3>
            <p class="text-gray-500 mb-6">Start by adding your first testimonial</p>
            <button wire:click="openModal()" class="px-6 py-3 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700">Add First Testimonial</button>
        </div>
    @else
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">#</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Client</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Company</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Content</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Rating</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Status</th>
                        <th class="px-6 py-4 text-right text-sm font-semibold text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach($testimonials as $index => $testimonial)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $testimonials->firstItem() + $index }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center font-semibold">
                                        {{ strtoupper(substr($testimonial['name'], 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $testimonial['name'] }}</p>
                                        @if($testimonial['title'])
                                            <p class="text-sm text-gray-500">{{ $testimonial['title'] }}</p>
                                        @endif
                                    </div>
                                    @if($testimonial['featured'])
                                        <span class="px-2 py-1 bg-amber-100 text-amber-700 text-xs rounded-full font-medium">
                                            <i class="bi bi-star-fill mr-1"></i> Featured
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-700">{{ $testimonial['company'] ?: '-' }}</td>
                            <td class="px-6 py-4">
                                <p class="text-gray-700 line-clamp-2 max-w-md">{{ $testimonial['content'] }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-0.5">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="bi {{ $i <= $testimonial['rating'] ? 'bi-star-fill text-amber-400' : 'bi-star text-gray-300' }}"></i>
                                    @endfor
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-sm font-medium {{ $testimonial['status'] === 'published' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                    {{ $testimonial['status'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-2">
                                    <button wire:click="openModal({{ json_encode($testimonial) }})" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg"><i class="bi bi-pencil"></i></button>
                                    <button wire:click="confirmDelete('{{ $testimonial['id'] }}')" class="p-2 text-red-600 hover:bg-red-50 rounded-lg"><i class="bi bi-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($testimonials->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="text-sm text-gray-600">
                    Showing {{ $testimonials->firstItem() }} to {{ $testimonials->lastItem() }} of {{ $testimonials->total() }} results
                </div>
                <nav class="flex items-center gap-1">
                    @if($testimonials->onFirstPage())
                        <span class="px-3 py-1 rounded border border-gray-300 text-gray-400 cursor-not-allowed">‹ Prev</span>
                    @else
                        <a href="?page={{ $testimonials->currentPage() - 1 }}" class="px-3 py-1 rounded border border-gray-300 text-gray-600 hover:bg-gray-50" wire:navigate>‹ Prev</a>
                    @endif
                    
                    @foreach(range(1, $testimonials->lastPage()) as $page)
                        @if($page == $testimonials->currentPage())
                            <span class="px-3 py-1 rounded bg-blue-600 text-white">{{ $page }}</span>
                        @else
                            <a href="?page={{ $page }}" class="px-3 py-1 rounded border border-gray-300 text-gray-600 hover:bg-gray-50" wire:navigate>{{ $page }}</a>
                        @endif
                    @endforeach
                    
                    @if($testimonials->hasMorePages())
                        <a href="?page={{ $testimonials->currentPage() + 1 }}" class="px-3 py-1 rounded border border-gray-300 text-gray-600 hover:bg-gray-50" wire:navigate>Next ›</a>
                    @else
                        <span class="px-3 py-1 rounded border border-gray-300 text-gray-400 cursor-not-allowed">Next ›</span>
                    @endif
                </nav>
            </div>
        @endif
    @endif

    <!-- Modal -->
    <div x-show="showModal" x-cloak class="fixed inset-0 bg-black/50 flex items-center justify-center z-[9999]">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl max-h-[90vh] overflow-y-auto scrollbar-light" @click.stop>
            <div class="p-6 border-b">
                <h2 class="text-2xl font-bold text-gray-900">{{ $editingId ? 'Edit Testimonial' : 'Add Testimonial' }}</h2>
            </div>
            <form wire:submit.prevent="save" class="p-6 space-y-5">
                <div class="grid grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Client Name *</label>
                        <input type="text" wire:model="name" required placeholder="Sarah K." class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Title / Position</label>
                        <input type="text" wire:model="title" placeholder="IT Director" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" />
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Company</label>
                    <input type="text" wire:model="company" placeholder="RetailCorp" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Testimonial Content *</label>
                    <textarea wire:model="content" required rows="4" placeholder="What the client said..." class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none resize-none"></textarea>
                </div>
                <div class="grid grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
                        <div class="flex gap-1">
                            @for($i = 1; $i <= 5; $i++)
                                <button type="button" wire:click="$set('rating', {{ $i }})" class="p-1 text-2xl hover:scale-110 transition-transform">
                                    <i class="bi {{ $i <= $rating ? 'bi-star-fill text-amber-400' : 'bi-star text-gray-300' }}"></i>
                                </button>
                            @endfor
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select wire:model="status" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" wire:model="featured" class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500" />
                        <span class="text-sm font-medium text-gray-700">Featured testimonial</span>
                    </label>
                </div>
                <div class="flex justify-end gap-3 pt-4 border-t">
                    <button type="button" wire:click="closeModal()" class="px-5 py-2.5 border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-50">Cancel</button>
                    <button type="submit" class="px-5 py-2.5 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700">{{ $editingId ? 'Update' : 'Add' }} Testimonial</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Modal -->
    <div x-show="showDeleteModal" x-cloak class="fixed inset-0 bg-black/50 flex items-center justify-center z-[9999]">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6">
            <div class="text-center">
                <div class="w-16 h-16 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="bi bi-exclamation-triangle text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Delete Testimonial?</h3>
                <p class="text-gray-600 mb-6">This action cannot be undone.</p>
                <div class="flex gap-3 justify-center">
                    <button wire:click="showDeleteModal = false" class="px-5 py-2.5 border border-gray-300 text-gray-700 rounded-lg">Cancel</button>
                    <button wire:click="delete()" class="px-5 py-2.5 bg-red-600 text-white rounded-lg">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
