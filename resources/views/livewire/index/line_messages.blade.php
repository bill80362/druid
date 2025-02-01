<style>
    #chat-box {
        height: 500px;
        overflow-y: scroll;
        border: 1px solid #ccc;
        padding: 10px;
    }
    .chat-message {
        margin-bottom: 10px;
    }
    .chat-message .message-content {
        padding: 10px;
        border-radius: 5px;
    }
    .chat-message.sent .message-content {
        background-color: #d1e7dd;
        text-align: right;
    }
    .chat-message.received .message-content {
        background-color: #f8d7da;
    }
</style>
<div class="p-3 text-gray-900">
    <div class="p-2 ">
        <div id="chat-box" class="list-group">
            <!-- Chat messages will be appended here -->
            @foreach ($paginator->reverse() as $item)
                @continue(empty($item->message))
                <div class="chat-message sent">
                    <div class="message-content">
                        <div>
                            @if($item->type=="I")
                                <img src="/api/line/image/{{$item->line_id}}/{{ $item->message }}" />
                            @else
                                {{ $item->message }}
                            @endif
                        </div>
                        <div>
                            <i class="bi bi-alarm"></i>
                            <small>{{ $item->message_at }}</small>
                            @if($item->member?->name)
                                {{ $item->member?->name }}
                            @else
                                {{ $item->member_line_id }}
                                <button type="button" class="btn btn-sm btn-primary">綁定會員</button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
{{--            <div class="chat-message received">--}}
{{--                <div class="message-content">--}}
{{--                    <div>I'm good, thank you! How about you?</div>--}}
{{--                    <div>客服 <small>2022-02-02 02:02:02</small></div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
{{--        <div class="input-group mt-3">--}}
{{--            <input type="text" class="form-control" placeholder="Type a message" id="message-input">--}}
{{--            <button class="btn btn-primary" id="send-button">Send</button>--}}
{{--        </div>--}}
    </div>
</div>
{{--<script>--}}
{{--    document.getElementById('send-button').addEventListener('click', function() {--}}
{{--        const messageInput = document.getElementById('message-input');--}}
{{--        const messageText = messageInput.value.trim();--}}
{{--        if (messageText) {--}}
{{--            const chatBox = document.getElementById('chat-box');--}}
{{--            const message = document.createElement('div');--}}
{{--            message.className = 'chat-message sent';--}}
{{--            message.innerHTML = `<div class="message-content">${messageText}</div>`;--}}
{{--            chatBox.appendChild(message);--}}
{{--            messageInput.value = '';--}}
{{--            chatBox.scrollTop = chatBox.scrollHeight;--}}
{{--        }--}}
{{--    });--}}
{{--</script>--}}

<script>
    function scrollToBottom() {
        const chatBox = document.getElementById('chat-box');
        chatBox.scrollTop = chatBox.scrollHeight;
    }
    scrollToBottom();
</script>
