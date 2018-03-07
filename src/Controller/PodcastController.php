<?php

namespace App\Controller;

use App\Entity\Podcast;
use App\Form\PodcastType;
use App\Serializer\PodcastSerializer;
use App\Uploader\PodcastUploader;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * PodcastsController
 */
class PodcastController extends FOSRestController implements ClassResourceInterface
{
    /**
     * @var PodcastSerializer
     */
    protected $serializer;

    /**
     * @var PodcastUploader
     */
    protected $uploader;

    /**
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * @param PodcastSerializer $serializer
     */
    public function __construct(PodcastSerializer $serializer, PodcastUploader $uploader, ValidatorInterface $validator)
    {
        $this->serializer = $serializer;
        $this->uploader = $uploader;
        $this->validator = $validator;
    }

    /**
     * @return Response
     */
    public function cgetAction()
    {
        $podcasts = $this->getDoctrine()
            ->getRepository(Podcast::class)
            ->findAllPodcasts();

        $serializedData = $this->serializer->serialize($podcasts);

        return new Response($serializedData);
    }

    public function cpostAction(Request $request)
    {
        $data = $request->request->all();
        $file = $request->files->all();

        $podcast = new Podcast();
        $form = $this->createForm(PodcastType::class, $podcast);

        $form->submit($data);

        if (isset($file['file'])) {
            $filename = $this->uploader->upload($file['file']);
            $podcast->setFilename($filename);
        }

        $errors = $this->validator->validate($podcast);

        if (count($errors) > 0) {
            // @TODO Return actual errors
            throw new \InvalidArgumentException('The Podcast contains errors');
        } else {
            // @TODO
            // If working with a DB, store the Podcast
            // Because it's a test, we just return the Podcast

            $serializedData = $this->serializer->serialize($podcast);

            return new Response($serializedData);
        }
    }
}
