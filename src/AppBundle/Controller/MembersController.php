<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

class MembersController extends FOSRestController
{
    /**
     * @Rest\Get("/members")
     */
    public function getAllAction()
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Member');
        $members = $repository->findAll();

        return $members;
    }
}
