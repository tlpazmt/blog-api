<?php

namespace App\Contracts;

use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface PostServiceInterface
{
    public function getPaginatedList(): LengthAwarePaginator;

    public function create(int $userId, array $data): Post;

    public function update(Post $post, array $data): Post;

    public function getInfo(Post $post): Post;

    public function delete(Post $post): void;
}
