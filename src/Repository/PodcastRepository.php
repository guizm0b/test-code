<?php

namespace App\Repository;

use App\Entity\Podcast;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Podcasts|null find($id, $lockMode = null, $lockVersion = null)
 * @method Podcasts|null findOneBy(array $criteria, array $orderBy = null)
 * @method Podcasts[]    findAll()
 * @method Podcasts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PodcastRepository extends ServiceEntityRepository
{
    /**
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Podcast::class);
    }

    /**
     * @return array
     */
    public function findAllPodcasts()
    {
        $results = [];

        for ($i=1; $i <= 5; $i++) {
            $podcast = new Podcast();

            $podcast->setId($i);
            $podcast->setTitle("My podcast " . $i);
            $podcast->setDescription("My description " . $i);
            $podcast->setEpisodeNumber($i);
            $podcast->setFilename("filename-" . $i . ".mp3");

            $results[] = $podcast;
        }

        return $results;
    }
}
