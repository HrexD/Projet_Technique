<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\String\Slugger\SluggerInterface;
use App\Service\CompareImage;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class SignInController extends AbstractController
{
    #[Route('/', name: 'app_sign_in')]
    public function signIn(): Response
    {
        return $this->render('sign_in.html.twig');
    }

    #[Route('/signin/save-image', name: 'sign_in_save_image')]
    public function saveImage(Request $request, SluggerInterface $slugger, CompareImage $compareImages): Response
    {
        $imageData = $request->request->get('image');
        $imageData = str_replace('data:image/jpeg;base64,', '', $imageData);
        $imageData = base64_decode($imageData);

        // Récupérer le compteur d'images à partir du cache
        $cache = new FilesystemAdapter();
        $counter = $cache->getItem('image_counter');
        $counterValue = $counter->get() ?? 0;

        // Incrémenter le compteur
        $counterValue++;
        $counter->set($counterValue);
        $cache->save($counter);

        // Définir le nom de l'image avec le compteur
        $imageName = 'identification_scan_' . $counterValue . '.jpg';

        // Chemin de destination pour enregistrer l'image
        $imagePath = $this->getParameter('kernel.project_dir') . '/public/images/' . $imageName;

        file_put_contents($imagePath, $imageData);

        // Récupérer le référentiel pour l'entité User
        $userRepository = $this->entityManager->getRepository(User::class);

        // Récupérer tous les utilisateurs
        $users = $userRepository->findAll();
        $trouver = 0;
        // Faire quelque chose avec les utilisateurs récupérés
        foreach ($users as $user) {
            // Accéder aux propriétés de l'utilisateur
            $image_user = $user->getPicture();
            
            $message = $compareImages->Compare2Image($image_user, $imageName);
            if($message =="true") {
                $trouver = 1;
                $id_user = $user->getId();
                echo "Les images sont similaires avec ".$id_user;

            }
            else {
                
            }
        }
        
        if ($trouver == 0) {
            return new RedirectResponse('http://127.0.0.1:8000/');
        } else {
            return new RedirectResponse('http://127.0.0.1:8000/item/'.$id_user);
        }
        
        return new Response('L\'image a été enregistrée avec succès dans le dossier public/images.');
    }
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
}
