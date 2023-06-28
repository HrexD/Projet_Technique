<?php namespace App\Service;

class CompareImage
{
    /**
     * @Route("/compareImages", name="compare_images")
     */
    public function Compare2Image($image1, $image2): string
    {
        $pythonScript = './comapre.py';
        
        // Paramètres à passer au script Python
        $param1 = './images/'.$image1;
        $param2 = './images/'.$image2;
        
        // Construire la commande d'exécution du script Python
        $command = "python $pythonScript $param1 $param2";
        
        // Exécuter la commande et récupérer la sortie
        $output = shell_exec($command);
        echo $output;
        // Afficher la sortie
        if ($output>55) {
            echo 'SIUUUUUUUUUUUUUUUUUUUUUUUU';
            return "true";
        } else {
            echo 'zebi';
            return "false";
        }
    }
}