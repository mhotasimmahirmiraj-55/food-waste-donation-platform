<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-3">
                    <div class="w-1.5 h-8 rounded-full bg-emerald-500"></div>
                    <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                        Notifications
                    </h2>
                </div>
                <p class="text-sm text-gray-500 mt-1 ml-4">
                    Stay updated with real-time alerts on your claims, deliveries, and pickups.
                </p>
            </div>

            @if ($unreadCount > 0)
                <form method="POST" action="{{ route('receiver.notifications.read-all') }}">
                    @csrf
                    <button type="submit"
                            class="inline-flex items-center px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold rounded-xl shadow-md shadow-emerald-600/20 hover:-translate-y-0.5 transition duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                        Mark All as Read ({{ $unreadCount }})
                    </button>
                </form>
            @endif
        </div>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-emerald-100 via-teal-50 to-cyan-100 py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('success'))
                <div class="rounded-2xl bg-emerald-50 border border-emerald-200 p-4 text-emerald-800 flex items-center gap-3 shadow-sm font-semibold">
                    <svg class="w-6 h-6 text-emerald-600 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-sm">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="font-bold text-gray-800 text-lg">All Notifications</span>
                        @if ($unreadCount > 0)
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800 border border-amber-200">
                                {{ $unreadCount }} Unread
                            </span>
                        @endif
                    </div>
                </div>

                <div class="divide-y divide-gray-100">
                    @forelse ($notifications as $notification)
                        <div class="p-6 transition flex items-start justify-between gap-4 {{ $notification->is_read ? 'bg-white hover:bg-gray-50/80' : 'bg-emerald-50/50 hover:bg-emerald-50/80 border-l-4 border-emerald-500' }}">
                            <div class="flex items-start gap-4 min-w-0">
                                {{-- Icon badge based on title or read status --}}
                                <div class="shrink-0 mt-0.5">
                                    @if (str_contains(strtolower($notification->title), 'delivered') || str_contains(strtolower($notification->title), 'complete'))
                                        <div class="w-11 h-11 rounded-2xl bg-emerald-100 text-emerald-800 border border-emerald-200 flex items-center justify-center font-bold shadow-sm">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                    @elseif (str_contains(strtolower($notification->title), 'cancel'))
                                        <div class="w-11 h-11 rounded-2xl bg-rose-100 text-rose-800 border border-rose-200 flex items-center justify-center font-bold shadow-sm">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </div>
                                    @elseif (str_contains(strtolower($notification->title), 'volunteer') || str_contains(strtolower($notification->title), 'assigned'))
                                        <div class="w-11 h-11 rounded-2xl bg-teal-100 text-teal-800 border border-teal-200 flex items-center justify-center font-bold shadow-sm">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                    @elseif (str_contains(strtolower($notification->title), 'picked'))
                                        <div class="w-11 h-11 rounded-2xl bg-amber-100 text-amber-800 border border-amber-200 flex items-center justify-center font-bold shadow-sm">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                                            </svg>
                                        </div>
                                    @else
                                        <div class="w-11 h-11 rounded-2xl bg-cyan-100 text-cyan-800 border border-cyan-200 flex items-center justify-center font-bold shadow-sm">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>

                                <div>
                                    <div class="flex items-center gap-2">
                                        <h4 class="font-bold text-gray-800 text-base">
                                            {{ $notification->title ?? 'Notification' }}
                                        </h4>
                                        @if (!$notification->is_read)
                                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                        @endif
                                    </div>
                                    <p class="text-sm text-gray-600 mt-1 leading-relaxed font-normal">
                                        {{ $notification->message }}
                                    </p>
                                    <p class="text-xs text-gray-400 mt-2 flex items-center gap-1 font-medium">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ $notification->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center gap-2 shrink-0">
                                @if (!$notification->is_read)
                                    <form method="POST" action="{{ route('receiver.notifications.read', $notification) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                                class="px-3.5 py-1.5 text-xs font-semibold text-emerald-800 bg-emerald-50 border border-emerald-200 hover:bg-emerald-100 rounded-xl transition"
                                                title="Mark as read">
                                            Mark Read
                                        </button>
                                    </form>
                                @endif

                                <form method="POST" action="{{ route('receiver.notifications.destroy', $notification) }}"
                                      onsubmit="return confirm('Delete this notification?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="p-2 text-gray-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition"
                                            title="Delete notification">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-16 px-4">
                            <div class="w-16 h-16 mx-auto bg-gray-100 rounded-2xl flex items-center justify-center text-gray-400 mb-4">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                            </div>
                            <h3 class="font-bold text-gray-800 text-lg">No notifications yet</h3>
                            <p class="text-sm text-gray-500 font-normal mt-1 max-w-sm mx-auto">
                                You'll receive real-time notifications here when you claim food, when volunteers accept, or when deliveries complete.
                            </p>
                        </div>
                    @endforelse
                </div>

                @if ($notifications->hasPages())
                    <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                        {{ $notifications->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
