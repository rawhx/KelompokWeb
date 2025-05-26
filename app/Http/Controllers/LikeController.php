<?php 

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Image;

class LikeController extends Controller {
    public function toggle($imageId) {
        $user = auth()->user();

        $like = Like::where('user_id', $user->id)
                    ->where('image_id', $imageId)
                    ->first();

        if ($like) {
            $like->delete();
        } else {
            Like::create([
                'user_id' => $user->id,
                'image_id' => $imageId,
            ]);
        }

        return back();

    }

    public function index() {
        $user = auth()->user();

        $likedImages = Image::whereHas('likes', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();

        return view('pages.like.index', compact('likedImages'));
    }


}
?>