<?php

namespace App\Transformers;

use App\Entity\Podcast;
use League\Fractal\TransformerAbstract;

class PodcastTransformer extends TransformerAbstract
{
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
            'filename' => $podcast->getFilename(),
        ];
    }
}
