<div class="p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Projects</h1>
        <p class="text-gray-600">Manage your portfolio projects</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-800">All Projects ({{ count($projects) }})</h2>
            <button 
                wire:click="openModal()"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center gap-2">
                <i class="bi bi-plus"></i>
                Add Project
            </button>
        </div>
        
        @if(count($projects) === 0)
            <div class="p-12 text-center">
                <i class="bi bi-briefcase text-5xl text-gray-300 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-700 mb-2">No projects yet</h3>
                <p class="text-gray-500 mb-4">Add your first project to showcase your work</p>
                <button 
                    wire:click="openModal()"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    Add Project
                </button>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Image</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Gallery</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Featured</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Active</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($projects as $project)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <img
                                        src="{{ $project['image'] ?: 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=300&h=200&fit=crop' }}"
                                        alt="{{ $project['title'] }}"
                                        class="w-12 h-12 object-cover rounded-lg"
                                        onerror="this.src='https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=300&h=200&fit=crop'"
                                    />
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-900">{{ $project['title'] }}</div>
                                    @if($project['subtitle'])
                                        <div class="text-sm text-gray-500">{{ $project['subtitle'] }}</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $category = collect($categories)->firstWhere('id', $project['category_id']);
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{
                                        $project['category_id'] === 'web-design' ? 'bg-blue-100 text-blue-800' :
                                        ($project['category_id'] === 'mobile-design' ? 'bg-green-100 text-green-800' :
                                        'bg-purple-100 text-purple-800')
                                    }}">
                                        {{ $category['name'] ?? $project['category_id'] }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex -space-x-2">
                                        @if(is_array($project['gallery']) && count($project['gallery']) > 0)
                                            @foreach(array_slice($project['gallery'], 0, 3) as $img)
                                                <img src="{{ $img }}" alt="" class="w-8 h-8 rounded-full border-2 border-white object-cover" onerror="this.src='https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=100&h=100&fit=crop'" />
                                            @endforeach
                                            @if(count($project['gallery']) > 3)
                                                <span class="w-8 h-8 rounded-full border-2 border-white bg-gray-100 flex items-center justify-center text-xs font-medium text-gray-600">
                                                    +{{ count($project['gallery']) - 3 }}
                                                </span>
                                            @endif
                                        @else
                                            <span class="text-xs text-gray-400">No gallery</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @if($project['featured'])
                                        <span class="inline-flex items-center gap-1 px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-xs font-medium">
                                            <i class="bi bi-star-fill"></i> Featured
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{
                                        $project['is_active'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
                                    }}">
                                        {{ $project['is_active'] ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{
                                        $project['status'] === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'
                                    }}">
                                        {{ $project['status'] }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-2">
                                        <button 
                                            wire:click="openModal({{ json_encode($project) }})"
                                            class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button 
                                            wire:click="confirmDelete('{{ $project['id'] }}')"
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
        @endif
    </div>

    <!-- Add/Edit Modal -->
    @if($showModal)
        <div class="fixed inset-0 z-9999 overflow-y-auto">
            <div class="flex min-h-screen items-center justify-center p-4">
                <div class="fixed inset-0 bg-black/50 transition-opacity" wire:click="closeModal"></div>
                <div class="relative bg-white rounded-xl shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto scrollbar-light">
                    <div class="sticky top-0 bg-white border-b border-gray-200 px-6 py-4 flex justify-between items-center">
                        <h3 class="text-xl font-semibold text-gray-900">
                            {{ $editingProject ? 'Edit Project' : 'Add New Project' }}
                        </h3>
                        <button 
                            wire:click="closeModal()"
                            class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                            <i class="bi bi-x-lg text-xl"></i>
                        </button>
                    </div>
                    
                    <form wire:submit.prevent="save" class="p-6">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Project Title *</label>
                                <input
                                    type="text"
                                    wire:model="title"
                                    required
                                    placeholder="e.g., BookNStay"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                                />
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Subtitle</label>
                                <input
                                    type="text"
                                    wire:model="subtitle"
                                    placeholder="e.g., Hotel Booking Platform"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                                />
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Category *</label>
                                <select
                                    wire:model="categoryId"
                                    required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                                    <option value="">Select category</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat['id'] }}">{{ $cat['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Year</label>
                                <input
                                    type="text"
                                    wire:model="year"
                                    placeholder="e.g., 2024"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                                />
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Client</label>
                                <input
                                    type="text"
                                    wire:model="client"
                                    placeholder="Client name"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                                />
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Technologies (comma-separated)</label>
                            <input
                                type="text"
                                wire:model="technologies"
                                placeholder="e.g., ReactJS, Laravel, MySQL"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                            />
                        </div>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea
                                wire:model="description"
                                placeholder="Describe the project..."
                                rows="3"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none resize-none"
                            ></textarea>
                        </div>

                        <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Main Image *</label>
                        
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
                                    <i class="bi bi-image text-3xl text-gray-400 mb-2"></i>
                                    <label for="main-image-upload" class="cursor-pointer">
                                        <span class="text-sm font-medium text-gray-900">
                                            Click to upload main image
                                        </span>
                                        <span class="text-xs text-gray-500 block">
                                            PNG, JPG, GIF, WebP up to 10MB
                                        </span>
                                    </label>
                                    <input
                                        type="file"
                                        id="main-image-upload"
                                        wire:model="mainImageFile"
                                        accept="image/*"
                                        class="sr-only"
                                    />
                                </div>
                            </div>
                            
                            <!-- Preview uploaded main image -->
                            @if($mainImageFile)
                                <div class="mt-4">
                                    <img src="{{ $mainImageFile->temporaryUrl() }}" alt="Preview" class="w-32 h-32 object-cover rounded-lg border border-blue-200">
                                    <p class="text-xs text-blue-600 mt-1">New main image preview</p>
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
                                    placeholder="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&h=600&fit=crop"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                />
                                <p class="text-xs text-gray-500 mt-1">Enter image URL from Unsplash, Pexels, or any other source</p>
                                
                                <!-- Preview URL image -->
                                @if($imageUrl)
                                    <div class="mt-4">
                                        <img src="{{ $imageUrl }}" alt="Preview" class="w-32 h-32 object-cover rounded-lg border border-blue-200" onerror="this.src='https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=300&h=200&fit=crop'">
                                        <p class="text-xs text-blue-600 mt-1">URL image preview</p>
                                    </div>
                                @endif
                                
                                @error('imageUrl')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        @endif
                        
                        <!-- Show current image if editing -->
                        @if($editingProject && $editingProject['image'])
                            <div class="mt-4 p-3 bg-gray-50 rounded-lg">
                                <p class="text-xs font-medium text-gray-700 mb-2">Current Image:</p>
                                <img src="{{ $editingProject['image'] }}" alt="Current" class="w-24 h-24 object-cover rounded border border-gray-300" onerror="this.src='https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=300&h=200&fit=crop'">
                            </div>
                        @endif
                        
                        @error('imageRequired')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Gallery Images (up to 5 total)</label>
                        
                        @php
                            $galleryArray = is_array($gallery) ? $gallery : (is_string($gallery) ? json_decode($gallery, true) : []);
                            $galleryArray = $galleryArray ?? [];
                        @endphp
                        
                        @if(!empty($galleryArray))
                            <div class="mb-4">
                                <p class="text-sm font-medium text-gray-700 mb-2">Current Gallery Images:</p>
                                <div class="grid grid-cols-5 gap-2">
                                    @foreach($galleryArray as $index => $galleryImage)
                                        <div class="relative group">
                                            <img src="{{ $galleryImage }}" alt="Gallery image {{ $index + 1 }}" class="w-full h-20 object-cover rounded border border-gray-200">
                                        <button
                                            type="button"
                                            wire:click="removeGalleryImage({{ $index }})"
                                            class="absolute top-1 right-1 bg-red-600 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity duration-200 hover:bg-red-700"
                                        >
                                            <i class="bi bi-x text-xs"></i>
                                        </button>
                                    </div>
                                    @endforeach
                                </div>
                                <p class="text-xs text-gray-500 mt-1">{{ is_countable($galleryArray) ? count($galleryArray) : 0 }}/5 images</p>
                            </div>
                        @endif
                        
                        <livewire:admin.components.file-upload 
                            :maxFiles="(5 - (is_countable($galleryArray) ? count($galleryArray) : 0))"
                            directory="projects/gallery"
                            previewImages="true"
                            showProgress="false"
                            wire:key="'gallery-upload-' . (is_countable($galleryArray) ? count($galleryArray) : 0)"
                            on-file-uploaded="onFileUploaded"
                            on-file-removed="onFileRemoved"
                        />
                        
                        @if(is_countable($galleryArray) && count($galleryArray) >= 5)
                            <p class="text-sm text-amber-600 mt-2">Maximum gallery images reached (5)</p>
                        @endif
                    </div>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Project URL</label>
                            <input
                                type="url"
                                wire:model="url"
                                placeholder="https://..."
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                            />
                        </div>

                        <div class="mt-4 flex gap-6">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input
                                    type="checkbox"
                                    wire:model="featured"
                                    class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                                />
                                <span class="text-sm text-gray-700">Featured Project</span>
                            </label>
                            
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input
                                    type="checkbox"
                                    wire:model="isActive"
                                    class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                                />
                                <span class="text-sm text-gray-700">Show on Website</span>
                            </label>
                            
                            <div class="flex-1">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Display Order</label>
                                <input
                                    type="number"
                                    wire:model="displayOrder"
                                    min="0"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                                />
                            </div>
                            
                            <div class="flex-1">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <select
                                    wire:model="status"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                                    <option value="published">Published</option>
                                    <option value="draft">Draft</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end gap-3 pt-4 border-t border-gray-200">
                            <button 
                                type="button" 
                                wire:click="closeModal()"
                                class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                                Cancel
                            </button>
                            <button 
                                type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                {{ $editingProject ? 'Update Project' : 'Add Project' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- Delete Confirmation Modal -->
    @if($showDeleteModal)
        <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-9999">
            <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6">
                <div class="text-center">
                    <div class="w-16 h-16 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="bi bi-exclamation-triangle text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Delete Project?</h3>
                    <p class="text-gray-600 mb-6">This action cannot be undone.</p>
                    <div class="flex gap-3 justify-center">
                        <button
                            wire:click="cancelDelete"
                            class="px-5 py-2.5 border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-50 transition-colors">
                            Cancel
                        </button>
                        <button
                            wire:click="delete()"
                            class="px-5 py-2.5 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 transition-colors">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
