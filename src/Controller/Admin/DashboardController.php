<?php

namespace App\Controller\Admin;

use App\Entity\Song;
use App\Entity\Album;
use App\Entity\Genre;
use App\Entity\Artist;
use App\Controller\Admin\GenreCrudController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator
    )
    {
        
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // entrypoint
        $url = $this->adminUrlGenerator->setController(GenreCrudController::class)->generateUrl();

        return $this->redirect($url);

        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('<img src="/images/bo.jpg" style="width: 30px; height: 30px" alt="logo"><span class="text-small"> Spotify</span>')
            ->setFaviconPath('/images/bo.jpg');
    }

    public function configureMenuItems(): iterable
    {
        //Section principale
        yield MenuItem::section(label: 'Gestion Discographie');
        //Liste des sous-menu
        yield MenuItem::subMenu(label: 'Gestion Catégories', icon: 'fa fa-star')->setSubItems([
            MenuItem::linkToCrud(label: 'Ajouter une catégorie', icon: 'fa fa-plus', entityFqcn: Genre::class)->setAction(actionName: Crud::PAGE_NEW),
            MenuItem::linkToCrud(label: 'Voir les catégories', icon: 'fa fa-eye', entityFqcn: Genre::class)
        ]);
        yield MenuItem::subMenu(label: 'Gestion Albums', icon: 'fa fa-music')->setSubItems([
            MenuItem::linkToCrud(label: 'Ajouter un album', icon: 'fa fa-plus', entityFqcn: Album::class)->setAction(actionName: Crud::PAGE_NEW),
            MenuItem::linkToCrud(label: 'Voir les albums', icon: 'fa fa-eye', entityFqcn: Album::class)
        ]);
        yield MenuItem::subMenu(label: 'Gestion Chansons', icon: 'fa fa-play')->setSubItems([
            MenuItem::linkToCrud(label: 'Ajouter une chanson', icon: 'fa fa-plus', entityFqcn: Song::class)->setAction(actionName: Crud::PAGE_NEW),
            MenuItem::linkToCrud(label: 'Voir les chansons', icon: 'fa fa-eye', entityFqcn: Song::class)
        ]);
        yield MenuItem::subMenu(label: 'Gestion Artistes', icon: 'fa fa-user')->setSubItems([
            MenuItem::linkToCrud(label: 'Ajouter un artiste', icon: 'fa fa-plus', entityFqcn: Artist::class)->setAction(actionName: Crud::PAGE_NEW),
            MenuItem::linkToCrud(label: 'Voir les artistes', icon: 'fa fa-eye', entityFqcn: Artist::class)
        ]);
    }
    
}
