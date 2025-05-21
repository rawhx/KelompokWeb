<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $imageId) {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'image_id' => $imageId,
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan.');
    }

    public function destroy(Comment $comment) {
        if ($comment->user_id !== auth()->id()) {
            abort(403, 'Anda tidak punya izin untuk menghapus komentar ini.');
        }

        $comment->delete();
        return redirect()->back()->with('success', 'Komentar berhasil dihapus.');
    }

    public function update(Request $request, $id){
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment = Comment::findOrFail($id);

        if ($comment->user_id !== auth()->id()) {
            abort(403, 'Anda tidak punya izin untuk mengedit komentar ini.'); 
        }

        $comment->content = $request->content;
        $comment->save();

        return back()->with('success', 'Komentar berhasil diperbarui.');
    }


}
