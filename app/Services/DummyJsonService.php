<?php
declare(strict_types=1);

namespace App\Services;

use App\Contracts\DummyJsonInterface;
use Illuminate\Support\Facades\Http;

class DummyJsonService implements DummyJsonInterface
{
    protected string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.dummy_json.base_url');
    }

    public function createPost(array $data): array
    {
        $response = Http::post("{$this->baseUrl}/posts/add", [
            'title' => $data['title'],
            'body' => $data['description'],
            'userId' => 1,
        ]);

        return $response->json();
    }

    public function updatePost(int $id, array $data): array
    {
        $response = Http::put("{$this->baseUrl}/posts/{$id}", [
            'title' => $data['title'],
            'body' => $data['description'],
        ]);

        return $response->json();
    }

    public function getPost(int $id): array
    {
        $response = Http::get("{$this->baseUrl}/posts/{$id}");

        return $response->json();
    }
}
