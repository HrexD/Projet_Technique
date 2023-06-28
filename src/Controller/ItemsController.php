<?php

namespace App\Controller;

use App\Repository\ToolsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ItemsController extends AbstractController
{
    #[Route('/items/{id}', name: 'app_items')]
    public function index(int $id, ToolsRepository $toolsRepository, EntityManagerInterface $manager): Response
    {
        $user = $manager->getRepository(User::class)->find($id);
        $booking = $manager->getRepository(Booking::class)->findOneBy(['endDate' => null, 'user' => $user]);

        dump($booking);

        $tools = $toolsRepository->findAll();

        return $this->render('items/index.html.twig', [
            'user' => $user,
            'tools' => $tools,
        ]);
    }
}
