<?php

declare(strict_types=1);

namespace App\Dto;

use Symfony\Component\Serializer\Annotation\SerializedName;

readonly class BlogPostDto
{
    public function __construct(
        public int $id,
        public int $userId,
        #[SerializedName('comment_count')]
        public int $commentCount,
        public string $title,
        public string $body,
        public string $link,
        public string $image = 'https://picsum.photos/id/101/300/150'
    ) {}

    public function getImage(): string
    {
        return $this->image;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getCommentCount(): int
    {
        return $this->commentCount;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getLink(): string
    {
        return $this->link;
    }
}