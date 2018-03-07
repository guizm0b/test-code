<?php

namespace App\Serializer;

use App\Entity\Podcast;
use App\Transformers\PodcastTransformer;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Serializer\JsonApiSerializer;

class PodcastSerializer
{
    /**
     * @var PodcastTransformer
     */
    protected $transformer;

    /**
     * @var string
     */
    protected $baseUrl;

    /**
     * @param PodcastTransformer $transformer
     * @param string $baseUrl
     */
    public function __construct(PodcastTransformer $transformer, $baseUrl)
    {
        $this->transformer = $transformer;
        $this->baseUrl = $baseUrl;
    }

    /**
     * @param mixed $data
     *
     * @return string
     */
    public function serialize($data)
    {
        $manager = new Manager();
        $manager->setSerializer(new JsonApiSerializer($this->baseUrl));

        if ($data instanceof Podcast) {
            $resource = new Item($data, $this->transformer, 'podcasts');
        } elseif (is_array($data)) {
            $resource = new Collection($data, $this->transformer, 'podcasts');
        }

        $serializedData = $manager->createData($resource)->toJson();

        return $serializedData;
    }
}
