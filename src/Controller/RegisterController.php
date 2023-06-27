<?php
// src/Controller/RegisterController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class RegisterController extends AbstractController
{
#[Route('/register', name: 'app_register')]
public function register(Request $request, SluggerInterface $slugger): Response
{
if ($request->isMethod('POST')) {
$data = $request->request->all();

// Récupérer les données du formulaire
$nom = $data['nom'];
$prenom = $data['prenom'];
$role = $data['role'];

// Récupérer l'image de la webcam
$imageData = $data['image'];
$imageData = str_replace('data:image/jpeg;base64,', '', $imageData);
$imageData = base64_decode($imageData);

// Générer un SluggerId unique pour le nom de l'image
$sluggerId = $slugger->slug(uniqid());

// Définir le nom de l'image avec le SluggerId
$imageName = 'user_photo_' . $sluggerId . '.jpg';

// Chemin de destination pour enregistrer l'image
$imagePath = $this->getParameter('kernel.project_dir') . '/public/images/' . $imageName;

file_put_contents($imagePath, $imageData);

// Enregistrer les données dans la table User
// Remplacez le code suivant par votre propre logique d'enregistrement

// Exemple :
$user = new User();
$user->setNom($nom);
$user->setPrenom($prenom);
$user->setRole($role);
$user->setPhoto($imageName);

$entityManager = $this->getDoctrine()->getManager();
$entityManager->persist($user);
$entityManager->flush();

// Rediriger vers une page de succès ou afficher un message de succès
return $this->redirectToRoute('app_register_success');
}

return $this->render('register/index.html.twig');
}
}
