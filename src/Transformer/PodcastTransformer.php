<?php

namespace App\Transformer;

use App\Entity\Podcast;
use League\Fractal\TransformerAbstract;

class PodcastTransformer extends TransformerAbstract
{
    /**
     * @var string
     */
    protected $bucketBaseUrl;

    /**
     * @param string $bucketBaseUrl
     */
    public function __construct($bucketBaseUrl)
    {
        $this->bucketBaseUrl = $bucketBaseUrl;
    }

    /**
     * @param Podcast $podcast
     */
    public function transform(Podcast $podcast)
    {
        return [
            'id' => (int) $podcast->getId(),
            'title' => $podcast->getTitle(),
            'description' => $podcast->getDescription(),
            'episode_number' => (int) $podcast->getEpisodeNumber(),
            'publish_date' => $podcast->getPublishDate(),
            'url' => $this->bucketBaseUrl . $podcast->getFilename(),
        ];
    }
}
