@component('layouts.dashboard')
    @slot('title')
        Complaint chat
    @endslot

    <style>
        .admin{
            background: rgb(89, 89, 231);
            padding: 15px 15px;
        }

        .client{
            background: rgb(225, 225, 225);
            padding: 15px 15px;
        }
    </style>

    <div class="d-flex row justify-content-between">
        <h1 class="h3 mb-2 text-gray-800">Complaint chat</h1>

        @if ($complaint->status == 'open')
        <a href="/dashboard/customer/closeComplaint/{{ $complaint->id }}" class="btn btn-outline-success">
            Open
        </a>
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
                <div class="col-md-6 offset-md-6 admin text-white mb-2 rounded">
                    {{ $chat->message }}
                </div>
            </div>
            @else
            <div class="row">
                <div class="col-md-6 client mb-2 rounded">
                    {{ $chat->message }}
                </div> 
            </div>
            @endif
        @endforeach
        
        <form method="POST" action="/dashboard/customer/sendComplaintChat">
            @csrf
            <input type="hidden" name="convoId" value="{{ $convoId }}">
            <textarea {{ ($complaint->status == 'open')? '' : 'disabled' }} class="mt-5 form-control" cols="100%" rows="3" name="message"></textarea>
            
            <button type="submit" class="btn btn-primary mt-3" {{ ($complaint->status == 'open')? '' : 'disabled' }}>
                Send
            </button>
        </form>
        
    </div>

@endcomponent