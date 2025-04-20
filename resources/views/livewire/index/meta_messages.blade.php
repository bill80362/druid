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
                <div class="chat-message {{$item->status=="I"?"sent":"received"}} ">
                    <div class="message-content">
                        <div>
                            @if($item->type=="I")
                                <img src="/api/meta/image/{{$item->meta_id}}/{{ $item->message }}" />
                            @else
                                {{ $item->message }}
                            @endif
                        </div>
                        <div>
                            <i class="bi bi-alarm"></i>
                            <small>{{ $item->message_at }}</small>
                            @if($item->status=="O")
                                {{ $item->meta?->name }}
                            @elseif($item->member?->name)
                                {{ $item->member?->name }}
                            @else
                                {{ $item->member_meta_id }}
                                <button type="button" class="btn btn-sm btn-primary">綁定已存在的會員</button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>


<script>
    function scrollToBottom() {
        const chatBox = document.getElementById('chat-box');
        chatBox.scrollTop = chatBox.scrollHeight;
    }
    scrollToBottom();
</script>

