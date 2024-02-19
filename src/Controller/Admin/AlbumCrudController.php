<?php

namespace App\Controller\Admin;

use App\Entity\Album;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AlbumCrudController extends AbstractCrudController
{
    //creation des constantes
    public const ALBUM_BASE_PATH = 'uploads/images/albums/';

    public const ALBUM_UPLOAD_DIR = 'public/uploads/images/albums/';

    public function configureFields(string $pageName): iterable
{
    return [
        IdField::new('id')->hideOnForm(),
        TextField::new('title', label: 'Titre de l\'album'),
        // TextEditorField::new('description', label: 'Description de l\'album'),
        //Champs d'association avec une autre table
        AssociationField::new('genre', label: 'Catégorie de l\'album'),
        AssociationField::new('artist', label: 'Nom de l\'artiste'),
        ImageField::new('imagePath', label: 'Choisir une image de couverture')
            ->setBasePath(self::ALBUM_BASE_PATH)
            ->setUploadDir(self::ALBUM_UPLOAD_DIR)
            ->setUploadedFileNamePattern(
                fn (UploadedFile $file): string => sprintf(
                    'upload_%d_%s.%s',
                    random_int(1, 9999),
                    $file->getFilename(),
                    $file->guessExtension()
                )
            ),
        //On donne un nom de fichier unique pour éviter de venir écraser une image en cas de même nom
        DateField::new('releaseDate', label: 'Date de sortie'),
        //Ici on cache createdAt et updatedAt on passera les données grace au persister
        DateField::new('createdAt')->hideOnForm(),
        DateField::new('updatedAt')->hideOnForm(),
    ];
}


    public static function getEntityFqcn(): string
    {
        return Album::class;
    }

    //Fonction pour agir sur les boutons d'actions
public function configureActions(Actions $actions): Actions
{
    //Permet de configurer les différentes actions
    return $actions
        // Permet de customiser les champs de la page index
        ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
            return $action->setIcon('fa fa-add')->setLabel('Ajouter')->setCssClass('btn btn-success');
        })
        ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
            return $action->setIcon('fa fa-pen')->setLabel('Modifier');
        })
        ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
            return $action->setIcon('fa fa-trash')->setLabel('Supprimer');
        })
        //Page edition
        ->update(Crud::PAGE_EDIT, Action::SAVE_AND_RETURN, function (Action $action) {
            return $action->setLabel('Enregistrer et quitter');
        })
        ->update(Crud::PAGE_EDIT, Action::SAVE_AND_CONTINUE, function (Action $action) {
            return $action->setLabel('Enregistrer et continuer');
        })
        //Page création
        ->update(Crud::PAGE_NEW, Action::SAVE_AND_RETURN, function (Action $action) {
            return $action->setLabel('Enregistrer');
        })
        ->update(Crud::PAGE_NEW, Action::SAVE_AND_ADD_ANOTHER, function (Action $action) {
            return $action->setLabel('Enregistrer et ajouter un nouveau');
        });
}


    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */

    //persister lors de la création d'un album, on génère la date
public function persistEntity(EntityManagerInterface $em, $entityInstance): void
{
    if (!$entityInstance instanceof Album) return;
    $entityInstance->setCreatedAt(new \DateTimeImmutable());
    $entityInstance->setUpdatedAt(new \DateTimeImmutable());
    parent::persistEntity($em, $entityInstance);
}

//persister lors de la modification d'un album, on génère la date
public function updateEntity(EntityManagerInterface $em, $entityInstance): void
{
    if (!$entityInstance instanceof Album) return;
    $entityInstance->setUpdatedAt(new \DateTimeImmutable());
    parent::updateEntity($em, $entityInstance);
}

}
