<?php

declare(strict_types=1);

namespace App\Dto;

class BlogPostListDto
{
    /**
     * @param BlogPostDto[] $posts
     */
    public function __construct(private array $posts){}

    public function getPosts(): array
    {
        return $this->posts;
    }
}