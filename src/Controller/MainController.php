<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class MainController extends AbstractController
{
    
    public function showIndices(): Response
    {

        $projectRoot = $this->getParameter('kernel.project_dir');
        $strJsonFileContents = file_get_contents($projectRoot . '/resources/indices.json');
        $indexData = json_decode($strJsonFileContents, true);

        // return $this->render('main/index.html.twig',['indexData' => $indexData]);
        return new JsonResponse($indexData);
    }

    /**
     * @Route("/api/index/{id}", name="index")
     */
    #[Route('/api/index/{id}', name: 'index')]
    public function getindex($id): Response
    {

        $projectRoot = $this->getParameter('kernel.project_dir');
        $strJsonFileContents = file_get_contents($projectRoot . '/resources/' . $id . '.json');
        $indexData = json_decode($strJsonFileContents, true);

        // return $this->render('main/index.html.twig',['indexData' => $indexData]);
        return new JsonResponse($indexData);
    }
}
