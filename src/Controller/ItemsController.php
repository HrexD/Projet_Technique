<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Booking;
use App\Repository\ToolsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ItemsController extends AbstractController
{
    #[Route('/items/{id}', name: 'app_items')]
    public function index(int $id, ToolsRepository $toolsRepository, EntityManagerInterface $manager): Response
    {
        $user = $manager->getRepository(User::class)->find($id);
        $booking = $manager->getRepository(Booking::class)->findOneBy(['endDate' => null, 'user' => $user]);

        $tools = $toolsRepository->findAll();

        return $this->render('items/index.html.twig', [
            'user' => $user,
            'booking' => $booking,
            'tools' => $tools,
        ]);
    }
}
