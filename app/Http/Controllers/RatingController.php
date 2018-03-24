<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Rating;
use App\Models\User;
use App\Transformers\RatingTransformer;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use Nord\Lumen\Fractal\FractalService;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RatingController extends BaseController
{
    /**
     * Store the specified property.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function store(FractalService $fractal,Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|integer',
            'comment_id' => 'required|integer',
            'rate' => 'required|boolean'
        ]);

        $user = User::find($request->get('user_id'));
        $comment = Comment::findOrFail($request->get('comment_id'));

        if(is_null($user) || is_null($comment)) {
            throw new NotFoundHttpException();
        }

        $rating = new Rating();
        $rating->fill($request->all())->save();


        return response()
            ->json($fractal
                ->item($rating, new RatingTransformer())
                ->toArray());

    }

}
