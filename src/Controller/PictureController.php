<?php

namespace App\Controller;

use App\Entity\Picture;
use App\Form\PictureType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PictureController extends AbstractController
{
    #[Route('/picture', name: 'app_picture')]
    public function new(Request $request): Response
    {
        $picture = new Picture();
        // ...

        $form = $this->createForm(PictureType::class, $picture);


        return $this->render('picture/index.html.twig', [
            'form' => $form,
        ]);
    }

}
