<?php
declare(strict_types=1);

namespace App\Services;

use App\Contracts\DummyJsonInterface;
use App\Contracts\PostServiceInterface;
use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;

class PostService implements PostServiceInterface
{
    public function __construct(private DummyJsonInterface $dummyJsonService) {}

    public function getPaginatedList(): LengthAwarePaginator
    {
        $posts = Post::with('user')->paginate(10);

        $posts->getCollection()->map(function ($post) {
            return $this->getInfo($post);
        });

        return $posts;
    }

    public function create(int $userId, array $data): Post
    {
        $dummyPost = $this->dummyJsonService->createPost($data);

        return Post::create([
            'user_id' => $userId,
            'dummy_post_id' => $dummyPost['id'],
        ]);
    }

    public function update(Post $post, array $data): Post
    {
        $this->dummyJsonService->updatePost($post->dummy_post_id, $data);

        return $post;
    }

    public function getInfo(Post $post): Post
    {
        $dummyPost = $this->dummyJsonService->getPost($post->dummy_post_id);
        $post->title = Arr::get($dummyPost, 'title');
        $post->description = Arr::get($dummyPost, 'body');

        return $post;
    }

    public function delete(Post $post): void
    {
        $post->delete();
    }
}
