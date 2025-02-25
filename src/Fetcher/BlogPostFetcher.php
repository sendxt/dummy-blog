<?php

declare(strict_types=1);

namespace App\Fetcher;

use App\Dto\BlogPostListDto;
use App\Fetcher\Constant\Endpoint;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class BlogPostFetcher
{
    public function __construct(
        private HttpClientInterface $blogApiClient,
        private SerializerInterface $serializer,
    ) {
    }

    public function fetch(): BlogPostListDto
    {
        try {
            $response = $this->blogApiClient->request('GET', Endpoint::GET_POSTS);

            return $this->serializer->deserialize(
                $response->getContent(),
                BlogPostListDto::class,
                'json',
            );
        } catch (\Throwable $e) {
            //TOOD: logger

            return new BlogPostListDto([]);
        }
    }
}