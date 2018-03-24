<?php

namespace App\Transformers;

use App\Models\Comment;
use App\Models\Rating;
use App\Models\User;
use League\Fractal\TransformerAbstract;

class RatingTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'comment',
        'user'

    ];

    /**
     * Turn this item object into a generic array
     *
     * @param User $user
     * @return array
     */
    public function transform(Rating $rating)
    {
        return [
            'id' => $rating->id,
            'rate' => $rating->rate
        ];
    }

    /**
     * Include comment
     *
     * @param Comment $comment
     * @return \League\Fractal\Resource\Item
     */
    public function includeComment(Rating $rating)
    {
        return $this->item(
            $rating->comment, new CommentTransformer(), 'comment'
        );
    }

    /**
     * Include comment
     *
     * @param Comment $comment
     * @return \League\Fractal\Resource\Item
     */
    public function includeUser(Rating $rating)
    {
        return $this->item(
            $rating->user, new UserTransformer(), 'user'
        );
    }
}
