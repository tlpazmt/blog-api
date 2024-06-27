<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\PostServiceInterface;
use App\Http\Requests\Post\DestroyPostRequest;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class PostController extends Controller
{
    public function __construct(private PostServiceInterface $postService) {}

    public function index(): JsonResponse
    {
        return response()->json(
            $this->postService->getPaginatedList()
        );
    }

    public function update(UpdatePostRequest $request, Post $post): JsonResponse
    {
        return response()->json(
            $this->postService->update($post, $request->validated())
        );
    }

    public function store(StorePostRequest $request): JsonResponse
    {
        return response()->json(
            $this->postService->create(auth()->id(), $request->validated())
        );
    }

    public function destroy(DestroyPostRequest $request, Post $post): Response
    {
        $this->postService->delete($post);

        return response()->noContent();
    }
}
