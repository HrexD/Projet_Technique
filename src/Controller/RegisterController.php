<?php

// src/Controller/RegisterController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use App\Entity\User;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

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

    #[Route('/signin/register_user', name: 'register_user')]
    public function saveImage(Request $request, SluggerInterface $slugger): Response
    {
        $imageData = $request->request->get('image');
        $image_name = $request->request->get('image_name');
        $imageData = str_replace('data:image/jpeg;base64,', '', $imageData);
        $imageData = base64_decode($imageData);

        // Récupérer le compteur d'images à partir du cache
        $cache = new FilesystemAdapter();
        $counter = $cache->getItem('image_counter');
        $counterValue = $counter->get() ?? 0;

       // Définir le nom de l'image

        $imageName = $image_name;


        // Chemin de destination pour enregistrer l'image
        $imagePath = $this->getParameter('kernel.project_dir') . '/public/images/' . $imageName;

        file_put_contents($imagePath, $imageData);


        return $this->render(
            'sign_in.html.twig',
            ['error' => false]
        );
    }
}
