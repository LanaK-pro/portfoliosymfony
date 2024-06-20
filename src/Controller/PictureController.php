<?php

namespace App\Controller;

use App\Entity\Picture;
use App\Form\PictureType;
use App\Repository\PictureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PictureController extends AbstractController
{
    #[Route('/pictures', name: 'picture_list')]
    public function list(PictureRepository $pictureRepository): Response
    {
        return $this->render('picture/list.html.twig', [
            'pictures' => $pictureRepository->findBy([])
        ]);
    }

    #[Route('/picture/new', name: 'app_picture')]
    public function new(Request $request): Response
    {
        $picture = new Picture();
        // ...

        $form = $this->createForm(PictureType::class, $picture);


        return $this->render('picture/index.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/picture/{id}', name: 'picture_item')]
    public function item(Picture $picture): Response
    {
        return $this->render('picture/item.html.twig', ['picture' => $picture]);
    }

}
