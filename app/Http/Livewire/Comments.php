<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Comments extends Component
{
    use WithPagination;

    public $addComment;

    public $image;

    public $ticketId;

    protected $listeners = ['fileUpload' => 'handleFileUpload', 'ticketSelected' => 'handleTicketSelect'];

    public function handleTicketSelect($ticketId)
    {
        $this->ticketId = $ticketId;
    }

    public function handleFileUpload($imageData)
    {
        $this->image = $imageData;
    }

    public function addComment()
    {
        $this->validate(['addComment' => 'required']);

        $image = $this->storeImage();

        $comment = Comment::create(['body' => $this->addComment, 'user_id' => 1, 'image' => $image, 'support_ticket_id' => $this->ticketId]);

        $this->addComment = '';
        $this->image = '';
        session()->flash('message', 'Comment added successfully');
    }

    public function storeImage()
    {
        if (!$this->image) {
            return null;
        };

        $img = ImageManagerStatic::make($this->image)->encode('jpg');

        $name = Str::random() . 'jpg';

        Storage::disk('public')->put($name, $img);

        return $name;
    }

    public function removeComment($commentId)
    {
        $comment = Comment::findOrFail($commentId);

        Storage::disk('public')->delete($comment->image);

        $comment->delete();

        session()->flash('message', 'Comment deleted successfully');
    }

    public function render()
    {
        return view('livewire.comments', ['comments' => Comment::where('support_ticket_id', $this->ticketId)->latest()->paginate(3)]);
    }
}
