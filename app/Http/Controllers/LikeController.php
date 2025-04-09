<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Image;

class LikeController extends Controller {
   public function toggle(Request $request, $imageID) {
    $user = auth()->user();

    $like = Like::where('user_id', $user->id)
                ->where('image_id', $imageID)
                ->first();

    if ($like) {
        $like->delete();
    } else {
        Like::create([
            'user_id' => $user->id,
            'image_id' => $imageID,
        ]);
    }

    return back();

   }

}
?>