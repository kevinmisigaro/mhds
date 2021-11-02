@component('layouts.dashboard')
    @slot('title')
        Complaint chat
    @endslot

    <style>
        .sender{
            background: rgb(225, 225, 225);
            padding: 15px 15px;
        }

        .reciever{
            background: rgb(89, 89, 231);
            padding: 15px 15px;
        }
    </style>

    <div class="d-flex row justify-content-between">
        <h1 class="h3 mb-2 text-gray-800">Complaint chat</h1>

        @if ($complaint->status == 'open')
        <button type="button" class="btn btn-outline-success">
            Open
        </button>
        @else
        <button type="button" class="btn btn-outline-danger">
            Closed
        </button> 
        @endif
    </div>

    <div class="mt-3">

        @foreach ($conversation as $chat)
            @if (\Illuminate\Support\Facades\Auth::user()->id == $chat->sender_id)
            <div class="row">
                <div class="col-md-6 offset-md-6 reciever text-white mb-2 rounded">
                    {{ $chat->message }}
                </div>
            </div>
            @else
            <div class="row">
                <div class="col-md-6 sender mb-2 rounded">
                    {{ $chat->message }}
                </div> 
            </div> 
            @endif
        @endforeach
        
        <form method="POST" action="/dashboard/insurer/sendComplaintChat">
            @csrf
            <input type="hidden" name="convoId" value="{{ $convoId }}">
            <textarea {{ ($complaint->status == 'open')? '' : 'disabled' }} class="mt-5 form-control" cols="100%" rows="3" name="message"></textarea>
            
            <button type="submit" class="btn btn-primary mt-3" {{ ($complaint->status == 'open')? '' : 'disabled' }}>
                Send
            </button>
        </form>
        
    </div>

@endcomponent