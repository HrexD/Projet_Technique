<?php

namespace App\Controller;

use App\Repository\ToolsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ItemsController extends AbstractController
{
    #[Route('/items/{id}', name: 'app_items')]
    public function index(ToolsRepository $toolsRepository): Response
    {
        $tools = $toolsRepository->findAll();

        return $this->render('items/index.html.twig', [
            'tools' => $tools,
        ]);
    }
}
