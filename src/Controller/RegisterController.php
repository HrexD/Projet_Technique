<?php

// src/Controller/RegisterController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;

class RegisterController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            $nom = $request->request->get('nom');
            $prenom = $request->request->get('prenom');

            // Enregistrer la photo capturée dans le dossier public/images
            $photoFileName = $nom . '_' . time() . '.jpg';
            $photoPath = $this->getParameter('images_directory') . '/' . $photoFileName;
            file_put_contents($photoPath, file_get_contents('php://input'));

            // Enregistrer les autres données de l'utilisateur dans la base de données
            $entityManager = $this->getDoctrine()->getManager();

            // Créer une instance de l'entité User et définir les valeurs
            $user = new User();
            $user->setNom($nom);
            $user->setPrenom($prenom);
            $user->setPhoto($photoFileName);

            // Persist et flush l'entité dans la base de données
            $entityManager->persist($user);
            $entityManager->flush();

            // Rediriger ou retourner une réponse appropriée
            return $this->redirectToRoute('app_register_success');
        }

        return $this->render('register/index.html.twig');
    }

    #[Route('/register/success', name: 'app_register_success')]
    public function registerSuccess(): Response
    {
        return $this->render('register/success.html.twig');
    }
}
