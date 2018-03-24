<?php

namespace App\Transformers;

use App\Models\Comment;
use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'comments',
    ];

    /**
     * Turn this item object into a generic array
     *
     * @param User $user
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email
        ];
    }

    /**
     * Include user
     *
     * @param Comment $comment
     * @return \League\Fractal\Resource\Collection
     */
    public function includeComments(User $user)
    {
        return $this->collection(
            $user->comments, new CommentTransformer(), 'comments'
        );
    }
}
