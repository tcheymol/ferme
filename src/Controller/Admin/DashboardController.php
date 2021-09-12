<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Administration')
            ->setFaviconPath('favicon.png');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('admin_home', 'fa fa-home');
        yield MenuItem::linkToCrud('users', 'fas fa-users', User::class);
        yield MenuItem::linkToCrud('products', 'fas fa-carrot', Product::class);
    }
}
