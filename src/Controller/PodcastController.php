<?php

namespace App\Controller;

use App\Entity\Podcast;
use App\Form\PodcastType;
use App\Serializer\PodcastSerializer;
use App\Uploader\PodcastUploader;
use App\Helper\ValidationHelper;
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
     * @var ValidationHelper
     */
    protected $validationHelper;

    /**
     * @param PodcastSerializer $serializer
     * @param PodcastUploader $uploader
     * @param ValidatorInterface $validator
     * @param ValidationHelper $validationHelper
     */
    public function __construct(PodcastSerializer $serializer, PodcastUploader $uploader, ValidatorInterface $validator, ValidationHelper $validationHelper)
    {
        $this->serializer = $serializer;
        $this->uploader = $uploader;
        $this->validator = $validator;
        $this->validationHelper = $validationHelper;
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

    /**
     * @param Request $request
     */
    public function cpostAction(Request $request)
    {
        $data = $request->request->all();
        $file = $request->files->all();

        $podcast = new Podcast();

        // The form is used to bind the data to the entity
        $form = $this->createForm(PodcastType::class, $podcast);

        $form->submit($data);

        if (isset($file['file'])) {
            $filename = $this->uploader->upload($file['file']);
            $podcast->setFilename($filename);
        }

        $errors = $this->validator->validate($podcast);

        if (count($errors) > 0) {
            $errorMessages = $this->validationHelper->formatErrors($errors);
            
            return $errorMessages;
        } else {
            // @TODO Store the podcast
            // For the test, I'm not working with a DB

            // $em = $this->getDoctrine()->getManager();
            //
            // $em->persist($podcast);
            // $em->flush();

            $serializedData = $this->serializer->serialize($podcast);

            return new Response($serializedData);
        }
    }
}
