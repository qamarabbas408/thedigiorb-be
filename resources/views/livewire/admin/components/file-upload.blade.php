<div class="space-y-4">
    <!-- Upload Area -->
    @if($canUploadMore ?? true)
        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 hover:border-blue-400 transition-colors">
            <div class="text-center">
                <i class="bi bi-cloud-upload text-4xl text-gray-400 mb-3"></i>
                <div class="mb-4">
                    <label for="{{ $attributes->get('id', 'file-upload') }}" class="cursor-pointer">
                        <span class="mt-2 block text-sm font-medium text-gray-900">
                            Click to upload or drag and drop
                        </span>
                        <span class="mt-1 block text-xs text-gray-500">
                            PNG, JPG, GIF, WebP up to 10MB each (Max {{ $maxFiles ?? 5 }} files)
                        </span>
                    </label>
                    <input
                        type="file"
                        id="{{ $attributes->get('id', 'file-upload') }}"
                        wire:model="files"
                        accept="{{ $accept ?? 'image/*' }}"
                        multiple
                        class="sr-only"
                        @change="$wire.uploadFiles()"
                    />
                </div>
            </div>
        </div>
    @endif

    <!-- Progress Bar -->
    @if(($showProgress ?? true) && (($maxFiles ?? 5) > 1))
        <div class="w-full bg-gray-200 rounded-full h-2">
            <div 
                class="bg-blue-600 h-2 rounded-full transition-all duration-300"
                style="width: {{ $uploadProgress ?? 0 }}%"
            ></div>
        </div>
        <div class="text-xs text-gray-500 text-center mt-1">
            {{ count($uploadedFiles ?? []) + count($files ?? []) }} / {{ $maxFiles ?? 5 }} files
        </div>
    @endif

    <!-- Temporary Files (Uploading) -->
    @if(count($files ?? []) > 0)
        <div class="space-y-2">
            <h4 class="text-sm font-medium text-gray-700">Uploading...</h4>
            @foreach($files ?? [] as $index => $file)
                <div class="flex items-center justify-between p-3 bg-blue-50 border border-blue-200 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0">
                            <i class="bi bi-file-earmark-image text-blue-600"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">
                                {{ $file->getClientOriginalName() }}
                            </p>
                            <p class="text-xs text-gray-500">
                                {{ $this->formatFileSize($file->getSize()) }}
                            </p>
                        </div>
                    </div>
                    <button
                        type="button"
                        wire:click="removeTemporaryFile({{ $index }})"
                        class="text-red-600 hover:text-red-800"
                    >
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Uploaded Files -->
    @if(count($uploadedFiles ?? []) > 0)
        <div class="space-y-2">
            <h4 class="text-sm font-medium text-gray-700">Uploaded Files</h4>
            <div class="grid {{ ($previewImages ?? true) ? 'grid-cols-2 md:grid-cols-3 lg:grid-cols-4' : 'grid-cols-1' }} gap-4">
                @foreach($uploadedFiles ?? [] as $index => $file)
                    <div class="relative group">
                        @if($previewImages ?? true)
                            <!-- Image Preview -->
                            <div class="aspect-square rounded-lg overflow-hidden border border-gray-200">
                                <img 
                                    src="{{ $file['url'] }}" 
                                    alt="{{ $file['original_name'] }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-200"
                                />
                            </div>
                            <!-- Remove Button Overlay -->
                            <button
                                type="button"
                                wire:click="removeUploadedFile({{ $index }})"
                                class="absolute top-2 right-2 bg-red-600 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity duration-200 hover:bg-red-700"
                            >
                                <i class="bi bi-x text-sm"></i>
                            </button>
                            <!-- File Info -->
                            <div class="mt-2">
                                <p class="text-xs font-medium text-gray-900 truncate">
                                    {{ $file['original_name'] }}
                                </p>
                                <p class="text-xs text-gray-500">
                                    {{ $this->formatFileSize($file['size']) }}
                                </p>
                            </div>
                        @else
                            <!-- File List View -->
                            <div class="flex items-center justify-between p-3 bg-green-50 border border-green-200 rounded-lg">
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0">
                                        <i class="bi bi-check-circle text-green-600"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate">
                                            {{ $file['original_name'] }}
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            {{ $this->formatFileSize($file['size']) }}
                                        </p>
                                    </div>
                                </div>
                                <button
                                    type="button"
                                    wire:click="removeUploadedFile({{ $index }})"
                                    class="text-red-600 hover:text-red-800"
                                >
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Validation Errors -->
    @error('files.*')
        <div class="text-sm text-red-600 mt-1">
            {{ $message }}
        </div>
    @enderror
</div>
