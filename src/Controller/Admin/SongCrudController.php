<?php

namespace App\Controller\Admin;

use App\Entity\Song;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Entity\File;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;


class SongCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Song::class;
    }

    //Fonction pour agir sur les boutons d'actions
public function configureActions(Actions $actions): Actions
{
    //Permet de configurer les différentes actions
    return $actions
        ->add(Crud::PAGE_INDEX, Action::DETAIL)
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
        ->update(Crud::PAGE_INDEX, Action::DETAIL, function (Action $action) {
            return $action->setIcon('fa fa-info')->setLabel('Informations');
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

public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title', 'Titre de la chanson'),
            ImageField::new('file_path', 'Choisir mp3')
                ->setBasePath('/uploads/files/music')
                ->setUploadDir('public/uploads/files/music')
                ->hideOnIndex()
                ->hideOnDetail(),
            TextField::new('file_path', 'Aperçu')
                ->hideOnForm()
                ->formatValue(function ($value, $entity) {
                    return '<audio controls>
                                <source src="/upload/files/music/' . $value . '" type="audio/mpeg">
                            </audio>';
                }),
            NumberField::new('duration', 'durée du titre'),
            AssociationField::new('album_id', 'Album associé'),
        ];
    }



}
