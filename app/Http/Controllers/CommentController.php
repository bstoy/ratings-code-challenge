<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Transformers\CommentTransformer;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use Nord\Lumen\Fractal\FractalService;

class CommentController extends BaseController
{

    /**
     * Display the specified comment.
     *
     * @param $commentId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(FractalService $fractal, $commentId, Request $request)
    {
        $comment = Comment::find($commentId);

        return response()
            ->json($fractal
                ->item($comment, new CommentTransformer())
                ->toArray());
    }

}
