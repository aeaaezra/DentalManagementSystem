<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dental Care | Messages</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/emoji-mart@latest/css/emoji-mart.css">
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link rel="stylesheet" href="{{ asset('css/chat.css') }}">

</head>
<body class="bg-pink-50 h-screen font-sans">
<nav class="fixed top-0 left-0 w-full z-[99999] bg-white/90 backdrop-blur-md shadow-sm">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">

        <!-- Logo + Burger -->
        <div class="relative flex items-center gap-4">

            <div class="text-2xl font-bold text-[#E91E63]">
                Shine & Smile
            </div>
        </div>

    <div class="hidden md:flex items-center gap-8 font-medium mx-auto">
    <a href="{{ route('appointments.homepage') }}"
    class="hover:text-[#E91E63] transition">Home</a>

<a href="{{ route('appointments.create') }}"
    class="hover:text-[#E91E63] transition">
    Appointments
</a>

<a href="{{ route('appointments.dentists') }}"
    class="hover:text-[#E91E63] transition">
    Dentists
</a>

<a href="{{ route('appointments.message') }}"
    class="px-4 py-2 rounded-lg transition
    {{ request()->routeIs('appointments.message') ? 'bg-pink-500 text-white' : 'hover:text-[#E91E63]' }}">
    Message
</a>




    <a href="{{ route('appointments.history') }}"
    class="hover:text-[#E91E63] transition">
    History
</a>

</div>

        <!-- Notification + Profile -->
    <div class="flex items-center gap-4">

            <button id="notificationBtn" class="notification-btn">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V4a2 2 0 10-4 0v1.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0a3 3 0 11-6 0m6 0H9" />
                    </svg>


            @if($notificationCount > 0)
                <span class="notification-badge">
                    {{ $notificationCount }}
                </span>
            @endif

        </button>

    <!-- Dropdown -->
     <div id="notificationDropdown"
         class="hidden absolute top-full right-12 mt-3 w-80 bg-white rounded-xl shadow-2xl border border-gray-200 z-[999999]">

        <div class="px-4 py-3 border-b font-semibold text-lg">
            Notifications
        </div>

        @forelse(($notifications ?? []) as $notification)

<div class="px-4 py-3 border-b hover:bg-gray-50">

    <div class="flex justify-between items-start">

        <div>

            <div class="font-medium">
                {{ $notification->title }}
            </div>

            <div class="text-sm text-gray-600">
                {{ $notification->message }}
            </div>

            <div class="text-xs text-gray-400 mt-1">
                {{ $notification->created_at->diffForHumans() }}
            </div>

        </div>

        <form method="POST"
              action="{{ route('notifications.destroy', $notification->id) }}">

            @csrf
            @method('DELETE')

            <button type="submit"
                class="text-red-500 hover:text-red-700 text-sm font-bold">
                ✕
            </button>

        </form>

    </div>

</div>

@empty

<div class="p-4 text-gray-500">
    No notifications.
</div>

@endforelse

    </div>

</div>

<!-- Profile Dropdown -->
<div class="relative">

    <button id="profileBtn"
        type="button"
        class="flex items-center gap-2 focus:outline-none">

        <img
    src="{{ Auth::user()->profile_picture
            ? asset('storage/' . Auth::user()->profile_picture)
            : asset('images/default-profile.png') }}"
    alt="Profile"
    class="w-10 h-10 rounded-full border-2 border-pink-500 object-cover">

        <div class="hidden md:block text-left">
            <p class="text-sm font-semibold text-gray-800">
{{ auth()->user()?->name ?? 'Guest User' }}
</p>
            <p class="text-xs text-gray-500">
                Patient
            </p>
        </div>

        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-4 h-4 text-gray-500"
             fill="none"
             viewBox="0 0 24 24"
             stroke="currentColor">
            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M19 9l-7 7-7-7" />
        </svg>

    </button>

    <!-- Dropdown Menu -->
   <div id="profileMenu"
     class="hidden absolute right-0 mt-3 w-52 bg-white rounded-xl shadow-xl border border-gray-100 overflow-hidden z-[9999]">

    <!-- Settings -->
    <a href="{{ route('appointments.settings', [  'return' => url()->current() ]) }}"
    class="flex items-center gap-3 px-2 py-2 text-gray-700 hover:bg-pink-50 hover:text-pink-600 transition">

       <svg xmlns="http://www.w3.org/2000/svg"
     class="w-5 h-5"
     viewBox="0 0 24 24"
     fill="currentColor">

    <path d="M19.14,12.94a7.49,7.49,0,0,0,.05-.94,7.49,7.49,0,0,0-.05-.94l2.03-1.58a.5.5,0,0,0,.12-.64l-1.92-3.32a.5.5,0,0,0-.6-.22l-2.39.96a7.28,7.28,0,0,0-1.63-.94L14.4,2.81A.5.5,0,0,0,13.91,2H10.09a.5.5,0,0,0-.49.81L9.25,5.32a7.28,7.28,0,0,0-1.63.94l-2.39-.96a.5.5,0,0,0-.6.22L2.71,8.84a.5.5,0,0,0,.12.64L4.86,11.06a7.49,7.49,0,0,0-.05.94,7.49,7.49,0,0,0,.05.94L2.83,14.52a.5.5,0,0,0-.12.64l1.92,3.32a.5.5,0,0,0,.6.22l2.39-.96a7.28,7.28,0,0,0,1.63.94l.35,2.51a.5.5,0,0,0,.49.41h3.82a.5.5,0,0,0,.49-.41l.35-2.51a7.28,7.28,0,0,0,1.63-.94l2.39.96a.5.5,0,0,0,.6-.22l1.92-3.32a.5.5,0,0,0-.12-.64ZM12,15.5A3.5,3.5,0,1,1,15.5,12,3.5,3.5,0,0,1,12,15.5Z"/>
</svg>

        <span>Settings</span>
    </a>

    <!-- Logout -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <button type="submit"
                class="w-full text-left flex items-center gap-3 px-2 py-1 text-red-600 hover:bg-red-50 transition">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M17 16l4-4m0 0l-4-4m4 4H7" />
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M3 12h4" />
            </svg>

            <span>Logout</span>
        </button>
    </form>

</div>

</div>

        </div>

    </div>
</nav>


   <div class="flex h-[calc(100vh-90px)] mt-[90px] overflow-hidden">
        <!-- Sidebar -->
        <div class="w-[380px] bg-white border-r border-pink-100 flex flex-col shadow-sm">
            <div class="p-5 border-b border-pink-100">
                <h2 class="text-2xl font-bold text-pink-600 mb-4">Messages</h2>
                <input type="text" placeholder="Search Doctors..." class="w-full p-2 border border-pink-200 rounded-lg focus:ring-2 focus:ring-pink-300 outline-none">
            </div>
           <div class="overflow-y-auto custom-scrollbar flex-1">

    @foreach($dentists as $dentist)

    <a
    href="{{ route('messages.chat', $dentist->id) }}"
    class="flex items-center p-4 hover:bg-pink-50 cursor-pointer border-b border-pink-50 transition">

        <div class="relative">

            <img
            src="https://ui-avatars.com/api/?name={{ urlencode($dentist->name) }}&background=f472b6&color=fff"
            class="w-12 h-12 rounded-full">

            <span
            class="absolute bottom-0 right-0 w-3 h-3 bg-green-400 border-2 border-white rounded-full">
            </span>

        </div>

        <div class="ml-4 flex-1">

            <div class="flex justify-between">

                <span class="font-bold text-gray-800">
                    {{ $dentist->name }}
                </span>

            </div>

            <p class="text-sm text-gray-500">

                {{ $dentist->specialization }}

            </p>

        </div>

    </a>

    @endforeach

</div>

        </div>

<div class="flex-1 flex flex-col bg-white relative">

    <div id="chat-header"
    class="h-[80px] bg-white border-b border-gray-200 flex items-center justify-between px-8">

    <div class="flex items-center gap-4">

        <img
        id="headerAvatar"
        src="https://ui-avatars.com/api/?name=Dr+Maria&background=f472b6&color=fff"
        class="w-14 h-14 rounded-full">

        <div>

            <h3 id="chat-name"
                class="font-bold text-xl text-slate-800">

                    {{ $receiver->name ?? 'Select a Dentist' }}

                </h3>

            <p class="text-green-500 text-sm">
                Active now
            </p>

        </div>

    </div>

    <div class="flex gap-6 text-pink-500 text-xl">

        <i id="infoBtn"
    class="fa-solid fa-circle-info cursor-pointer text-pink-500">
    </i>

    </div>


</div>


<div id="messages-container"
class="flex-1 overflow-y-auto px-8 py-6 space-y-6 min-h-0">

@forelse($messages ?? [] as $message)

@if($message->sender_id == auth()->id())

<div class="flex justify-end mb-4">

   <div class="message-group">

        <!-- Hover Actions -->
        <div class="hover-actions relative flex items-center gap-2">

    <!-- Three Dots -->
    <div class="relative">

        <button
            type="button"
            onclick="toggleMenu({{ $message->id }})"
            class="hover:text-pink-500 transition text-lg">

            ⋮

        </button>

        <!-- Menu -->
       <div
    id="menu-{{ $message->id }}"
    class="hidden absolute
           right-full
           mr-2
           top-1/2
           -translate-y-1/2
           bg-white
           rounded-2xl
           shadow-xl
           min-w-[180px]
           py-2
           z-[99999]">

    <!-- EDIT -->
    <button
        type="button"
        onclick="editMessage(
            {{ $message->id }},
            `{{ addslashes($message->message) }}`
        )"
        class="flex items-center gap-3 w-full px-4 py-3 hover:bg-gray-100">

        Edit

    </button>

    <!-- PIN -->
    <form
        action="{{ route('messages.pin', $message->id) }}"
        method="POST">

        @csrf

        <button
            type="submit"
            class="flex items-center gap-3 w-full px-4 py-3 hover:bg-gray-100">

             {{ $message->is_pinned ? 'Unpin' : 'Pin' }}

        </button>

    </form>

    <!-- UNSEND -->
   <button
    type="button"
    onclick="openUnsendModal({{ $message->id }})"
    class="flex items-center gap-3 w-full px-4 py-3 text-red-500 hover:bg-red-50">

    Unsend

</button>
</div>

    </div>

    <!-- Emoji -->
    <button
        type="button"
        onclick="toggleReactionMenu({{ $message->id }})"
        class="hover:text-pink-500">

        <svg xmlns="http://www.w3.org/2000/svg"
     fill="none"
     viewBox="0 0 24 24"
     stroke-width="1.5"
     stroke="currentColor"
     class="w-5 h-5">

    <path stroke-linecap="round"
          stroke-linejoin="round"
          d="M14.25 9h.008v.008h-.008V9Zm-4.5 0h.008v.008H9.75V9Zm-1.5 5.25c1.125.75 2.25 1.125 3.75 1.125s2.625-.375 3.75-1.125M21 12a9 9 0 11-18 0 9 9 0 0118 0Z" />
</svg>

    </button>
    <div
    id="reaction-menu-{{ $message->id }}"
    class="hidden absolute
           bottom-full
           left-0
           mb-2
           bg-white
           rounded-full
           shadow-xl
           px-3
           py-2
           flex
           gap-2
           z-[99999]">

    <form action="{{ route('messages.react', $message->id) }}"
          method="POST">
        @csrf
        <input type="hidden" name="emoji" value="❤️">
        <button type="submit">❤️</button>
    </form>

    <form action="{{ route('messages.react', $message->id) }}"
          method="POST">
        @csrf
        <input type="hidden" name="emoji" value="👍">
        <button type="submit">👍</button>
    </form>

    <form action="{{ route('messages.react', $message->id) }}"
          method="POST">
        @csrf
        <input type="hidden" name="emoji" value="😂">
        <button type="submit">😂</button>
    </form>

    <form action="{{ route('messages.react', $message->id) }}"
          method="POST">
        @csrf
        <input type="hidden" name="emoji" value="😮">
        <button type="submit">😮</button>
    </form>

    <form action="{{ route('messages.react', $message->id) }}"
          method="POST">
        @csrf
        <input type="hidden" name="emoji" value="😢">
        <button type="submit">😢</button>
    </form>

</div>

    <!-- Reply -->
    <button
        type="button"
        onclick="replyToMessage(
            {{ $message->id }},
            '{{ addslashes($message->message) }}'
        )"
        class="hover:text-pink-500">

        <svg xmlns="http://www.w3.org/2000/svg"
     fill="none"
     viewBox="0 0 24 24"
     stroke-width="1.5"
     stroke="currentColor"
     class="w-5 h-5">

    <path stroke-linecap="round"
          stroke-linejoin="round"
          d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 016 6v3" />
</svg>

    </button>

</div>

        <!-- Dropdown -->


        <!-- Bubble -->
     <div
    class="chat-bubble bg-pink-500 text-white px-5 py-3 rounded-[20px] rounded-br-md max-w-md shadow-sm">
@if($message->is_pinned)

<div class="flex items-center gap-1 text-xs text-yellow-300 mb-1">



    <span>Pinned Message</span>

</div>

@endif
    @if($message->repliedMessage)

        <div class="bg-white/20 rounded-lg p-2 mb-2 text-sm">

            <div class="text-xs opacity-75 mb-1">

                @if($message->repliedMessage->sender_id == auth()->id())

                    You replied to yourself

                @else

                    Replying to message

                @endif

            </div>

            <div>

                {{ $message->repliedMessage->message }}

            </div>

        </div>

    @endif

@if($message->message === 'This message was unsent')

    <span class="italic text-gray-300">
        This message was unsent
    </span>

@else

    {{ $message->message }}

@endif

</div>

<div
    id="message-reaction-{{ $message->id }}"
    class="text-lg mt-1">
</div>

<div class="text-xs text-gray-400 mt-1 text-right">
    {{ $message->created_at->diffForHumans() }}
</div>

    </div>

</div>

@else

<div class="flex items-start gap-3 mb-4">

    <img
        src="https://ui-avatars.com/api/?name={{ urlencode($receiver->name ?? 'Dentist') }}&background=f472b6&color=fff"
        class="w-10 h-10 rounded-full">

    <div
        class="bg-[#eef0f3] px-5 py-3 rounded-[20px] rounded-tl-md max-w-md">

        {{ $message->message }}

    </div>

</div>

@endif

@empty

<div class="flex items-center justify-center h-full text-gray-400">
    Select a dentist to start chatting
</div>

@endforelse

</div>

           <div
id="input-area"
class="border-t border-gray-200 bg-white px-5 py-4">

<div
    id="reply-preview"
    class="hidden bg-gray-100 border-l-4 border-pink-500 p-2 rounded mb-2 flex justify-between items-center">

    <span id="reply-text"></span>

    <button
        type="button"
        onclick="cancelReply()"
        class="text-gray-500 hover:text-red-500">

        <svg xmlns="http://www.w3.org/2000/svg"
             fill="none"
             viewBox="0 0 24 24"
             stroke-width="1.5"
             stroke="currentColor"
             class="w-5 h-5">

            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M6 18L18 6M6 6l12 12"/>

        </svg>

    </button>

</div>


    <form
id="message-form"
method="POST"
action="{{ route('messages.store') }}"
class="flex items-center gap-3">



    @csrf

    @if(isset($receiver))

<input
type="hidden"
name="receiver_id"
value="{{ $receiver->id }}">

@endif

<input
    type="hidden"
    id="reply_to"
    name="reply_to">

<input
    type="hidden"
    id="edit_message_id"
    name="edit_message_id">

        <div class="relative">

    <button
    id="attachmentBtn"
    type="button"
    class="text-pink-500 text-2xl">

        <i class="fa-solid fa-circle-plus"></i>

    </button>

    <div

    id="attachmentMenu"
    class="hidden absolute bottom-12 left-0 bg-white border rounded-xl shadow-lg w-52 z-50">

   <button id="uploadImageBtn"
class="w-full flex items-center gap-3 px-4 py-3 hover:bg-pink-50">

    <i class="fa-regular fa-image text-pink-500"></i>

    Upload Image

</button>

<button id="uploadFileBtn"
class="w-full flex items-center gap-3 px-4 py-3 hover:bg-pink-50">

    <i class="fa-regular fa-file text-pink-500"></i>

    Upload File

</button>

<input
type="file"
id="imageUpload"
accept="image/*"
class="hidden">

<input
type="file"
id="fileUpload"
class="hidden">




    </div>

</div>


        <input
            type="text"
            id="msg-input"
            name="message"
            autocomplete="off"
            placeholder="Aa"
            class="flex-1 bg-[#eef0f3] rounded-full px-6 py-3 outline-none">

        <button
        type="submit"
        class="text-pink-500 text-2xl">

            <i class="fa-solid fa-paper-plane"></i>

        </button>

    </form>

</div>

<!-- INFO SIDEBAR -->

<aside id="infoPanel"
style="right:-350px;"
class="absolute top-[80px] right-0 bottom-[85px] w-[320px] bg-white border-l border-gray-200 shadow-xl transition-all duration-300 z-50 overflow-y-auto">

    <div class="p-5 border-b flex justify-between items-center">

        <h2 class="font-bold text-lg">
            Conversation Info
        </h2>

        <button id="closeInfoPanel"
        class="text-gray-500 hover:text-red-500">
            ✕
        </button>

    </div>

    <!-- Search Conversation -->
    <div class="p-5 border-b">

        <h3 class="font-semibold mb-3">
            🔍 Search Conversation
        </h3>

        <input
            id="searchMessages"
            type="text"
            placeholder="Search messages..."
            class="w-full border rounded-lg px-3 py-2">

    </div>

 <div class="p-5 border-t">

    <h3 class="font-semibold mb-3">
        🎨 Customize Theme
    </h3>

    <div class="flex gap-3 flex-wrap">

        <button
            onclick="changeTheme('pink')"
            class="w-8 h-8 rounded-full bg-pink-500">
        </button>

        <button
            onclick="changeTheme('blue')"
            class="w-8 h-8 rounded-full bg-blue-500">
        </button>

        <button
            onclick="changeTheme('green')"
            class="w-8 h-8 rounded-full bg-green-500">
        </button>

        <button
            onclick="changeTheme('purple')"
            class="w-8 h-8 rounded-full bg-purple-500">
        </button>

        <button
            onclick="changeTheme('red')"
            class="w-8 h-8 rounded-full bg-red-500">
        </button>

    </div>


</div><div class="mt-4">

    <input
        type="file"
        id="backgroundUpload"
        accept="image/*"
        class="hidden">

    <button
        type="button"
        onclick="document.getElementById('backgroundUpload').click()"
        class="w-full bg-pink-500 text-white py-2 rounded-lg">

        📷 Upload Background

    </button>

</div>
    <!-- Pinned Messages -->
    <div class="p-5 border-b">

        <h3 class="font-semibold mb-3">
            📌 Pinned Messages
        </h3>

       @forelse(($pinnedMessages ?? collect()) as $pinned)

<div
    class="bg-gray-100 p-3 rounded-lg mb-2">

    {{ $pinned->message }}

</div>

@empty

<div class="text-gray-400 text-sm">

    No pinned messages

</div>

@endforelse

    </div>

    <!-- Quick Reactions -->
   <div class="p-5">

    <h3 class="font-semibold mb-3">
        😀 Quick Reactions
    </h3>

    <div
    id="quickReactions"
    class="flex gap-3 text-2xl mb-4">

        <button class="reaction-btn">❤️</button>
        <button class="reaction-btn">👍</button>
        <button class="reaction-btn">😂</button>
        <button class="reaction-btn">😮</button>
        <button class="reaction-btn">😢</button>

    </div>

    <button
id="editReactionsBtn"
class="w-full flex items-center justify-center gap-2 bg-pink-500 text-white py-2 rounded-xl">

    <i class="fa-solid fa-face-smile"></i>

    Customize Reactions

</button>
  <div id="emojiModal"
class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-[9999]">

    <div class="bg-white rounded-2xl shadow-2xl w-[420px] overflow-hidden">

        <!-- Header -->
        <div class="flex items-center justify-between px-5 py-4 border-b">

            <h3 class="font-semibold text-lg text-slate-800">
                Choose Quick Reactions
            </h3>

            <button id="closeEmojiModal"
                    class="text-gray-500 hover:text-pink-500 text-xl">
                ✕
            </button>

        </div>

        <!-- Emoji Picker -->
        <div id="emojiPickerContainer"
             class="max-h-[420px] overflow-y-auto">
        </div>

        <!-- Footer -->
        <div class="p-4 border-t">

            <button
                id="saveReactions"
                class="w-full bg-pink-500 hover:bg-pink-600 text-white py-2 rounded-xl font-medium transition">

                Save Reactions

            </button>

        </div>

    </div>

</div>

</div>

</div>

</aside>

</div>
</div>

<div
    id="unsendModal"
    class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-[99999]">

    <div
        class="bg-white rounded-2xl w-[420px] p-6 shadow-2xl">

        <h2
            class="text-2xl font-bold text-gray-800 mb-2">

            Delete Message

        </h2>

        <p
            class="text-gray-500 mb-6">

            Choose how you want to remove this message.

        </p>

        <div class="space-y-4">

            <label
                class="flex items-center gap-3 cursor-pointer p-3 rounded-lg hover:bg-gray-50">

                <input
                    type="radio"
                    name="delete_option"
                    value="me"
                    class="w-4 h-4">

                <span
                    class="text-gray-700 font-medium">

                    Unsend for Me

                </span>

            </label>

            <label
                class="flex items-center gap-3 cursor-pointer p-3 rounded-lg hover:bg-gray-50">

                <input
                    type="radio"
                    name="delete_option"
                    value="everyone"
                    checked
                    class="w-4 h-4">

                <span
                    class="text-gray-700 font-medium">

                    Unsend for Everyone

                </span>

            </label>

        </div>

        <div
            class="flex justify-end gap-3 mt-8">

            <button
                type="button"
                onclick="closeUnsendModal()"
                class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 rounded-xl font-medium transition">

                Cancel

            </button>

            <button
                type="button"
                onclick="submitUnsend(); return false;"
                class="px-5 py-2.5 bg-red-500 hover:bg-red-600 text-white rounded-xl font-medium transition">

                Delete

            </button>

        </div>

    </div>

</div>

<form
    id="unsendForm"
    method="POST"
    style="display:none;">

    @csrf
    @method('DELETE')

    <input
        type="hidden"
        name="type"
        id="unsendType">

</form>
        <script src="{{ asset('js/chat.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/emoji-mart@latest/dist/browser.js"></script>
</body>
</html>
