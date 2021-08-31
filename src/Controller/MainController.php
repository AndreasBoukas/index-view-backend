<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class MainController extends AbstractController
{
    /**
     * @Route("/api/indices", name="indices")
     */
    public function showIndices(): Response
    {
        // Reads the indices.json file and returns a json response at /api/indices
        $projectRoot = $this->getParameter('kernel.project_dir');
        $strJsonFileContents = file_get_contents($projectRoot . '/resources/indices.json');
        $indexData = json_decode($strJsonFileContents, true);

        return new JsonResponse($indexData);
    }

    /**
     * @Route("/api/index/{id}", name="index")
     */
    public function getindex($id): Response
    {

        // Reads an index file. Chosen by the id variable and returns as a json Response at /api/index/{id}
        $projectRoot = $this->getParameter('kernel.project_dir');
        $strJsonFileContents = file_get_contents($projectRoot . '/resources/' . $id . '.json');
        $indexData = json_decode($strJsonFileContents, true);

        return new JsonResponse($indexData);
    }
}
