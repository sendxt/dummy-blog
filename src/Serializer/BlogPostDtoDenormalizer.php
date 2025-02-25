<?php

declare(strict_types=1);

namespace App\Serializer;

use App\Dto\BlogPostDto;
use App\Dto\BlogPostListDto;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class BlogPostDtoDenormalizer implements DenormalizerInterface
{
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        if ($type === BlogPostDto::class) {
            return new BlogPostDto(
                $data['userId'],
                $data['id'],
                $data['comment_count'],
                $data['title'],
                $data['body'],
                $data['link'],
                'https://picsum.photos/id/101/300/150', //TODO: change to $post['image'] when will be implemented
            );
        }

        if ($type === BlogPostListDto::class) {
            $posts = [];
            foreach ($data as $postData) {
                $posts[] = $this->denormalize($postData, BlogPostDto::class, $format, $context);
            }

            return new BlogPostListDto($posts);
        }

        throw new \LogicException("Unsupported type: $type");
    }

    public function getSupportedTypes(?string $format): array
    {
        return [
            BlogPostDto::class => true,
            BlogPostListDto::class => true,
        ];
    }

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return in_array($type, $this->getSupportedTypes(null));
    }
}