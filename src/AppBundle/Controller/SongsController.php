<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\View\View as RestView;
use AppBundle\Entity\CoverSong;
use AppBundle\Entity\CoverArtist;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class SongsController extends FOSRestController
{
    /**
     * @Rest\Get("/songs")
     * @View(serializerGroups={"songs"})
     */
    public function getAllAction()
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:CoverSong');
        $songs = $repository->findByProposal(false);

        return $songs;
    }

    /**
     * @Rest\Get("/proposals")
     * @View(serializerGroups={"songs"})
     */
    public function getAllProposalsAction()
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:CoverSong');
        $proposals = $repository->findByProposal(true);

        return $proposals;
    }

    /**
     * @Rest\Post("/songs")
     */
    public function postAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:CoverArtist');
        $artist_id = $request->get('artist');
        $artist = $repository->find($artist_id);

        $song = new CoverSong();
        $song->setTitle($request->get('title'));
        $song->setArtist($artist);

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($song);
        try {
            $manager->flush();
        } catch (Exception $e) {
            return new RestView('Error', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new RestView($song, Response::HTTP_OK);
    }
}
