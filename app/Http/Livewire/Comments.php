<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;
use Livewire\WithPagination;

class Comments extends Component
{
    use WithPagination;
    
    public $addComment;

    public $image;

    protected $listeners = ['fileUpload' => 'handleFileUpload'];

    public function handleFileUpload($imageData)
    {
        $this->image = $imageData;
    }

    public function addComment()
    {
        $this->validate(['addComment' => 'required']);

        $comment = Comment::create(['body' => $this->addComment, 'user_id' => 1]);

        $this->addComment = '';
        session()->flash('message', 'Comment added successfully');
    }

    public function removeComment($commentId)
    {
        $comment = Comment::findOrFail($commentId)->delete();

        session()->flash('message', 'Comment deleted successfully');
    }

    public function render()
    {
        return view('livewire.comments', ['comments' => Comment::latest()->paginate(2)]);
    }
}
