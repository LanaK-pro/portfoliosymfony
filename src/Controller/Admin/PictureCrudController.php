<?php

namespace App\Controller\Admin;

use App\Entity\Picture;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use Symfony\Component\Validator\Constraints\Image;

class PictureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Picture::class;
    }

    public function configureFields(string $pageName): iterable
    {

        return [
            //J'ai caché le numéro de l'id, il s'autoincremente.
            IdField::new('id')->hideOnForm(),
            // J'ai ajouté un champs qui permet de choisir avec quel software a été fait l'image, je ne display pas l'id mais bien le nom du software, + pratique.
            AssociationField::new('software'),
            TextField::new('title'),
            //ajout de contraintes de taille et de format
            ImageField::new('url')->setBasePath('images/')
                                                ->setUploadDir('public/images/')
                                                ->setFileConstraints([new Image([
                                                    'maxSize' => '5000k',
                                                    'mimeTypes' => [
                                                        'image/jpeg',
                                                        'image/png',
                                                    ],
                                                    'mimeTypesMessage' => 'Format invalide (choisir .png ou .jpg) '
                                                ])]),

            TextField::new('description'),
        ];
    }
}
