<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\String\Slugger\SluggerInterface;


class SignInController extends AbstractController
{
    #[Route('/', name: 'app_sign_in')]
    public function signIn(): Response
    {
        return $this->render('sign_in.html.twig');
    }

    #[Route('/signin/save-image', name: 'sign_in_save_image')]
    public function saveImage(Request $request, SluggerInterface $slugger): Response
    {
        $imageData = $request->request->get('image');
        $imageData = str_replace('data:image/jpeg;base64,', '', $imageData);
        $imageData = base64_decode($imageData);

        // Générer un SluggerId unique pour le nom de l'image
        $sluggerId = $slugger->slug(uniqid());

        // Définir le nom de l'image avec le SluggerId
        $imageName = 'identification_scan_' . $sluggerId . '.jpg';

        // Chemin de destination pour enregistrer l'image
        $imagePath = $this->getParameter('kernel.project_dir') . '/public/images/' . $imageName;

        file_put_contents($imagePath, $imageData);

        // Récupérer le contenu de l'image pour l'afficher dans la réponse
        $imageContent = file_get_contents($imagePath);

        // Supprimer l'image du disque
        unlink($imagePath);

        // Créer la réponse avec le contenu de l'image
        $response = new Response($imageContent);
        $response->headers->set('Content-Type', 'image/jpeg');

        return $response;
    }
}
