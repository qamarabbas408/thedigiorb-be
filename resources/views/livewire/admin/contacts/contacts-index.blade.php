<div class="p-8" x-data="{ showDeleteModal: @entangle('showDeleteModal') }">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Contact Messages</h1>
            <p class="text-gray-600 mt-1">Manage messages from your website visitors</p>
        </div>
        @if($newCount > 0)
            <div class="px-4 py-2 bg-blue-100 text-blue-700 rounded-full font-medium">
                {{ $newCount }} new message{{ $newCount > 1 ? 's' : '' }}
            </div>
        @endif
    </div>

    <div class="flex gap-2 mb-6">
        @foreach(['all', 'new', 'read', 'replied'] as $status)
            <button wire:click="$set('filter', '{{ $status }}')" class="px-4 py-2 rounded-lg font-medium transition-colors {{ $filter === $status ? 'bg-blue-600 text-white' : 'bg-white text-gray-600 hover:bg-gray-50 border border-gray-200' }}">
                {{ ucfirst($status) }}
                @if($status === 'all') ({{ count($contacts) }}) @endif
                @if($status === 'new') ({{ $newCount }}) @endif
            </button>
        @endforeach
    </div>

    @if($loading)
        <div class="flex justify-center py-12">
            <div class="w-10 h-10 border-4 border-gray-200 border-t-blue-500 rounded-full animate-spin"></div>
        </div>
    @elseif(count($contacts) === 0)
        <div class="bg-white rounded-xl shadow-sm p-12 text-center">
            <i class="bi bi-inbox text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">No messages</h3>
            <p class="text-gray-500">{{ $filter === 'all' ? 'No contact messages yet' : 'No ' . $filter . ' messages' }}</p>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-1 bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="divide-y max-h-[600px] overflow-y-auto scrollbar-light">
                    @foreach($contacts as $contact)
                        <button wire:click="selectContact({{ json_encode($contact) }})" class="w-full p-4 text-left hover:bg-gray-50 transition-colors {{ $selectedContact && $selectedContact['id'] === $contact['id'] ? 'bg-blue-50' : '' }}">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center font-semibold {{ $contact['status'] === 'new' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-600' }}">
                                    {{ strtoupper(substr($contact['name'], 0, 1)) }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between">
                                        <p class="font-medium truncate {{ $contact['status'] === 'new' ? 'text-gray-900' : 'text-gray-700' }}">{{ $contact['name'] }}</p>
                                        @if($contact['status'] === 'new')
                                            <span class="w-2 h-2 bg-blue-600 rounded-full"></span>
                                        @endif
                                    </div>
                                    <p class="text-sm text-gray-500 truncate">{{ $contact['subject'] ?: 'No subject' }}</p>
                                    <p class="text-xs text-gray-400 mt-1">{{ \Carbon\Carbon::parse($contact['created_at'])->format('M d, h:i A') }}</p>
                                </div>
                            </div>
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="lg:col-span-2 bg-white rounded-xl shadow-sm overflow-hidden">
                @if($selectedContact)
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-900">{{ $selectedContact['name'] }}</h2>
                                <p class="text-gray-500">{{ $selectedContact['email'] }}</p>
                                @if($selectedContact['phone'])
                                    <p class="text-gray-500">{{ $selectedContact['phone'] }}</p>
                                @endif
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="px-3 py-1 rounded-full text-sm font-medium {{ $selectedContact['status'] === 'new' ? 'bg-blue-100 text-blue-700' : ($selectedContact['status'] === 'read' ? 'bg-gray-100 text-gray-700' : 'bg-green-100 text-green-700') }}">
                                    {{ $selectedContact['status'] }}
                                </span>
                                <button wire:click="confirmDelete('{{ $selectedContact['id'] }}')" class="p-2 text-red-600 hover:bg-red-50 rounded-lg" title="Delete">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-6">
                            <span class="text-sm font-medium text-gray-500">Subject</span>
                            <p class="text-gray-900 mt-1">{{ $selectedContact['subject'] ?: 'No subject' }}</p>
                        </div>

                        <div>
                            <span class="text-sm font-medium text-gray-500">Message</span>
                            <div class="mt-2 p-4 bg-gray-50 rounded-lg">
                                <p class="text-gray-700 whitespace-pre-wrap">{{ $selectedContact['message'] }}</p>
                            </div>
                        </div>

                        <div class="mt-6 pt-6 border-t">
                            <p class="text-sm text-gray-500">Received on {{ \Carbon\Carbon::parse($selectedContact['created_at'])->format('F d, Y \a\t h:i A') }}</p>
                        </div>

                        <div class="mt-6 flex gap-3">
                            <a href="mailto:{{ $selectedContact['email'] }}?subject=Re: {{ $selectedContact['subject'] ?: 'Contact Form Message' }}" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 flex items-center justify-center gap-2">
                                <i class="bi bi-reply"></i>
                                Reply via Email
                            </a>
                        </div>
                    </div>
                @else
                    <div class="h-full flex items-center justify-center p-12 text-center">
                        <div>
                            <i class="bi bi-chat-dots text-6xl text-gray-300 mb-4"></i>
                            <p class="text-gray-500">Select a message to view</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif

    <!-- Delete Modal -->
    <div x-show="showDeleteModal" x-cloak class="fixed inset-0 bg-black/50 flex items-center justify-center z-[9999]">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6">
            <div class="text-center">
                <div class="w-16 h-16 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="bi bi-exclamation-triangle text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Delete Message?</h3>
                <p class="text-gray-600 mb-6">This action cannot be undone.</p>
                <div class="flex gap-3 justify-center">
                    <button wire:click="showDeleteModal = false" class="px-5 py-2.5 border border-gray-300 text-gray-700 rounded-lg">Cancel</button>
                    <button wire:click="delete()" class="px-5 py-2.5 bg-red-600 text-white rounded-lg">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
