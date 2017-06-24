<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View as RestView;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\CoverArtist;

class ArtistsController extends FOSRestController
{
    /**
     * @Rest\Get("/artists")
     * @View(serializerGroups={"artists"})
     */
    public function getAllAction()
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:CoverArtist');
        $artists = $repository->findAll();

        return $artists;
    }

     /**
      * @Rest\Post("/artists")
      * @View(serializerGroups={"artists"})
      */
     public function postAction(Request $request)
     {
         $artist = new CoverArtist();
         $artist->setName($request->get('name'));

         $manager = $this->getDoctrine()->getManager();
         $manager->persist($artist);
         try {
             $manager->flush();
         } catch (Exception $e) {
             return new RestView('Error', Response::HTTP_INTERNAL_SERVER_ERROR);
         }

         return new RestView($artist, Response::HTTP_OK);
     }
}
