<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Complaint;
use App\Models\ComplaintConversation;

class NewComplaintForm extends Component
{
    public $title;
    public $description;

    protected $rules = [
        'title' => 'required|min:4',
        'description' => 'required|min:6'
    ];

    public function submit(){
        $this->validate();

        $complaint = new Complaint;
        $complaint->subject = $this->title;
        $complaint->description = $this->description;
        $complaint->status = 'open';
        $complaint->complainer = Auth::user()->id;
        $complaint->save();

        $convo = new ComplaintConversation;
        $convo->complaint_id = $complaint->id;
        $convo->sender_id = Auth::user()->id;
        $convo->message = $this->description;
        $convo->save();

        return redirect('/dashboard/customer/complaints');
    }

    public function render()
    {
        return view('livewire.new-complaint-form');
    }
}
