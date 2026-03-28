<div class="p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
        <p class="text-gray-600">Welcome to the DigitalOrb Portfolio Management System</p>
    </div>

    @if($loading)
        <div class="flex items-center justify-center min-h-64">
            <div class="w-10 h-10 border-4 border-gray-200 border-t-blue-500 rounded-full animate-spin"></div>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center text-xl mb-4">
                    <i class="bi bi-briefcase"></i>
                </div>
                <h3 class="text-3xl font-bold text-gray-900">{{ count($projects) }}</h3>
                <p class="text-gray-600 text-sm">Total Projects</p>
            </div>
            
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="w-12 h-12 bg-green-100 text-green-600 rounded-xl flex items-center justify-center text-xl mb-4">
                    <i class="bi bi-check-circle"></i>
                </div>
                <h3 class="text-3xl font-bold text-gray-900">{{ $publishedProjects }}</h3>
                <p class="text-gray-600 text-sm">Published</p>
            </div>
            
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-xl flex items-center justify-center text-xl mb-4">
                    <i class="bi bi-star"></i>
                </div>
                <h3 class="text-3xl font-bold text-gray-900">{{ $featuredProjects }}</h3>
                <p class="text-gray-600 text-sm">Featured</p>
            </div>
            
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="w-12 h-12 bg-orange-100 text-orange-600 rounded-xl flex items-center justify-center text-xl mb-4">
                    <i class="bi bi-envelope"></i>
                </div>
                <h3 class="text-3xl font-bold text-gray-900">{{ $newContacts }}</h3>
                <p class="text-gray-600 text-sm">New Messages</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-800">Recent Projects</h2>
                    <a href="{{ route('admin.projects') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                        View All
                    </a>
                </div>
                <div class="divide-y divide-gray-100">
                    @if(count($projects) === 0)
                        <div class="p-6 text-center">
                            <i class="bi bi-inbox text-4xl text-gray-300 mb-3"></i>
                            <h3 class="text-gray-700 font-medium">No projects yet</h3>
                            <p class="text-gray-500 text-sm">Add your first project</p>
                        </div>
                    @else
                        @foreach(array_slice($projects, 0, 5) as $project)
                            <div class="px-6 py-4 flex items-center justify-between">
                                <div>
                                    <span class="font-medium text-gray-900">{{ $project['title'] }}</span>
                                    @php
                                        $category = collect($categories)->firstWhere('id', $project['category_id']);
                                    @endphp
                                    <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{
                                        $project['category_id'] === 'web-design' ? 'bg-blue-100 text-blue-800' :
                                        ($project['category_id'] === 'mobile-design' ? 'bg-green-100 text-green-800' :
                                        'bg-purple-100 text-purple-800')
                                    }}">
                                        {{ $category['name'] ?? $project['category_id'] }}
                                    </span>
                                </div>
                                <span class="px-2 py-1 rounded-full text-xs font-medium {{
                                    $project['status'] === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'
                                }}">
                                    {{ $project['status'] }}
                                </span>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-800">Categories</h2>
                    <a href="{{ route('admin.categories') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                        Manage
                    </a>
                </div>
                <div class="divide-y divide-gray-100">
                    @if(count($categories) === 0)
                        <div class="p-6 text-center">
                            <i class="bi bi-tags text-4xl text-gray-300 mb-3"></i>
                            <h3 class="text-gray-700 font-medium">No categories yet</h3>
                            <p class="text-gray-500 text-sm">Create categories</p>
                        </div>
                    @else
                        @foreach($categories as $category)
                            <div class="px-6 py-4 flex items-center justify-between">
                                <span class="font-medium text-gray-900">{{ $category['name'] }}</span>
                                <span class="text-gray-500 text-sm">
                                    {{ count(array_filter($projects, fn($p) => $p['category_id'] === $category['id'])) }} projects
                                </span>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>
