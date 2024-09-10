<?php

namespace App\Controller\Dashboard;

use App\Entity\Civility;
use App\Entity\Employee;
use App\Entity\Item;
use App\Entity\Matter;
use App\Entity\Order;
use App\Entity\Payment;
use App\Entity\Product;
use App\Entity\ProductCategory;
use App\Entity\Service;
use App\Entity\ServiceCategory;
use App\Entity\Status;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class DashboardController extends AbstractDashboardController
{
    public function __construct(private Security $security)
    {
    }

    #[Route('/dashboard', name: 'dashboard')]
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(ItemCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('@EasyAdmin/page/content.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Hackapress')
            ->setLocales(['fr' => '🇫🇷 Français', 'en' => '🇬🇧 English', 'es' => '🇪🇸 Español', 'it' => '🇮🇹 Italiano', 'de' => '🇩🇪 Deutsch']);
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Orders');
        yield MenuItem::linkToCrud('Orders', 'fa-brands fa-dropbox', Order::class)->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Item', 'fa fa-tag', Item::class);

        yield MenuItem::section('Account')->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Employee', 'fa-regular fa-address-card', Employee::class)->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('User', 'fa fa-user', User::class)->setPermission('ROLE_ADMIN');

        yield MenuItem::section('Products & Services')->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Product', 'fa fa-shirt', Product::class)->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Product Category', 'fa fa-table', ProductCategory::class)->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Service', 'fa fa-handshake', Service::class)->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Service Category', 'fa fa-table', ServiceCategory::class)->setPermission('ROLE_ADMIN');

        yield MenuItem::section('Misc')->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Civility', 'fa fa-venus-mars', Civility::class)->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Matter', 'fa-solid fa-recycle', Matter::class)->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Payment', 'fa-solid fa-money-check-dollar', Payment::class)->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Status', 'fa-solid fa-signal', Status::class)->setPermission('ROLE_ADMIN');

        yield MenuItem::section('Exit');
        yield MenuItem::linkToLogout('Deconnexion', 'fa fa-sign-out-alt');
    }
}
