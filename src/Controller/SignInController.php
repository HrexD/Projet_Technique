<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\String\Slugger\SluggerInterface;
use App\Service\CompareImage;

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

        $param2 = 'image2.png';
        for($i = 1; $i <= 4; $i++) {
            echo "<br/>";
            $image_user = 'identification_scan_' . $i . '.jpg';
            $message = $compareImages->Compare2Image($image_user, $imageName);
            if($message =="true") {
                echo "Les images sont similaires avec ".$image_user;
            }
            else {
                echo "Les images ne sont pas similaires avec ".$image_user;
            }

        }
        
        
        return new Response('L\'image a été enregistrée avec succès dans le dossier public/images.');
    }
}
