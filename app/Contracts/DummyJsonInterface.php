<?php

namespace App\Contracts;

interface DummyJsonInterface
{
    public function createPost(array $data): array;

    public function updatePost(int $id, array $data): array;

    public function getPost(int $id): array;
}
