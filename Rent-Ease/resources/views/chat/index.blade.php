@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-4 border rounded shadow mt-6" x-data="{ selectedUser: '{{ $chatUser->id ?? '' }}' }">
    <h2 class="text-xl font-bold mb-4">Simple Chat</h2>

    <!-- Dropdown to choose user -->
    <div class="mb-4">
        <label for="user-select" class="block font-medium mb-1">Choose a user to chat with:</label>
        <select id="user-select" x-model="selectedUser" @change="window.location.href = `/chat/${selectedUser}`"
            class="w-full border px-3 py-2 rounded">
            <option disabled value="">-- Select User --</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ isset($chatUser) && $chatUser->id == $user->id ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>
    </div>

    @if($chatUser)
        <h3 class="text-lg font-semibold mb-3">Chatting with {{ $chatUser->name }}</h3>

        <div id="chat-box" class="border p-3 h-64 overflow-y-auto bg-gray-100 mb-4 rounded text-sm"></div>

        <form id="chat-form" class="flex gap-2" onsubmit="sendMessage(event)">
            <input type="text" id="message-input" class="flex-1 border rounded px-3 py-2"
                placeholder="Type your message..." required>
            <button type="submit" class="bg-blue-600 text-white px-4 rounded">Send</button>
        </form>

        <script>
            const chatBox = document.getElementById('chat-box');
            const messageInput = document.getElementById('message-input');
            const receiverId = {{ $chatUser->id }};

            async function fetchMessages() {
                const res = await fetch("{{ route('chat.fetch', $chatUser->id) }}");
                const messages = await res.json();
                chatBox.innerHTML = '';
                messages.forEach(msg => {
                    const msgEl = document.createElement('div');
                    msgEl.classList.add('mb-1');
                    const sender = msg.sender_id === {{ auth()->id() }} ? 'You' : '{{ $chatUser->name }}';
                    msgEl.innerHTML = `<strong>${sender}:</strong> ${msg.message}`;
                    chatBox.appendChild(msgEl);
                });
                chatBox.scrollTop = chatBox.scrollHeight;
            }

            async function sendMessage(e) {
                e.preventDefault();
                const message = messageInput.value.trim();
                if (!message) return;

                await fetch("{{ route('chat.send') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        receiver_id: receiverId,
                        message: message
                    })
                });

                messageInput.value = '';
                fetchMessages();
            }

            setInterval(fetchMessages, 2000);
            fetchMessages();
        </script>
    @else
        <p class="text-gray-600">Please select a user to start chatting.</p>
    @endif
</div>
@endsection