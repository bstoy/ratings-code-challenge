<?php

namespace App\Transformers;

use App\Models\Comment;
use League\Fractal\TransformerAbstract;

class CommentTransformer extends TransformerAbstract
{
    /**
     * List of resources to include by default
     *
     * @var array
     */
    protected $defaultIncludes = [
        'user',
        'ratings'
    ];

    /**
     * Turn this item object into a generic array
     *
     * @param Comment $comment
     * @return array
     */
    public function transform(Comment $comment)
    {
        return [
            'id' => $comment->id,
            'text' => $comment->text
        ];
    }

    /**
     * Include user
     *
     * @param Comment $comment
     * @return \League\Fractal\Resource\Item
     */
    public function includeUser(Comment $comment)
    {
        return $this->item(
            $comment->user, new UserTransformer(), 'user'
        );
    }

    /**
     * Include ratings.
     *
     * @param Comment $comment
     * @return \League\Fractal\Resource\Collection
     */
    public function includeRatings(Comment $comment)
    {
        return $this->collection(
            $comment->ratings, new RatingsTransformer(), 'ratings'
        );
    }

}
