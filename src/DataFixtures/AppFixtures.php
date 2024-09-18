<?php

namespace App\DataFixtures;

use App\Entity\Civility;
use App\Entity\Matter;
use App\Entity\Payment;
use App\Entity\Product;
use App\Entity\ProductCategory;
use App\Entity\ServiceCategory;
use App\Entity\Status;
use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private const CIVILITIES = [
        'Madame',
        'Monsieur',
        'Autres'
    ];

    private const MATTERS = [
        [
            'name' => 'Coton',
            'coeff' => 1.00
        ],
        [
            'name' => 'Daim',
            'coeff' => 1.20
        ],
        [
            'name' => 'Velours',
            'coeff' => 2.00
        ],
        [
            'name' => 'Cuir',
            'coeff' => 2.00
        ],
        [
            'name' => 'Soie',
            'coeff' => 3.00
        ],
        [
            'name' => 'Laine',
            'coeff' => 1.50
        ],
        [
            'name' => 'Lin',
            'coeff' => 1.10
        ],
        [
            'name' => 'Polyester',
            'coeff' => 0.90
        ],
        [
            'name' => 'Nylon',
            'coeff' => 1.00
        ],
        [
            'name' => 'Viscose',
            'coeff' => 1.30
        ],
        [
            'name' => 'Cachemire',
            'coeff' => 2.50
        ],
        [
            'name' => 'Acrylique',
            'coeff' => 1.00
        ],
        [
            'name' => 'Jeans (Denim)',
            'coeff' => 1.10
        ],
        [
            'name' => 'Tweed',
            'coeff' => 1.80
        ],
        [
            'name' => 'Microfibre',
            'coeff' => 1.40
        ]
    ];

    private const PRODUCTS_CATEGORY = [
        'Hauts',
        'Bas',
        'Robes',
        'Accessoires',
        'Linge de maison',
        'Divers',
    ];

    const PRODUCTS = [
        [
            'name' => 'Chemise',
            'description' => 'Chemise élégante et parfaitement repassée, idéale pour le bureau ou les occasions spéciales. Confort et style garantis.',
            'category' => 'Hauts',
        ],
        [
            'name' => 'Pantalon',
            'description' => 'Pantalon repassé avec soin, offrant une allure impeccable pour vos journées de travail ou vos sorties décontractées.',
            'category' => 'Bas',
        ],
        [
            'name' => 'Chaussure',
            'description' => 'Chaussures nettoyées et entretenues pour un éclat durable, prêtes à accompagner tous vos déplacements avec élégance.',
            'category' => 'Divers',
        ],
        [
            'name' => 'Veste',
            'description' => 'Veste repassée et nettoyée en profondeur pour une présentation impeccable, que ce soit pour le travail ou des occasions spéciales.',
            'category' => 'Hauts',
        ],
        [
            'name' => 'Robe',
            'description' => 'Robe soigneusement nettoyée et repassée, prête à vous faire briller lors de soirées ou événements formels.',
            'category' => 'Robes',
        ],
        [
            'name' => 'Blouson',
            'description' => 'Blouson nettoyé avec des techniques adaptées pour préserver la qualité du tissu tout en offrant une protection optimale.',
            'category' => 'Hauts',
        ],
        [
            'name' => 'Cravate',
            'description' => 'Cravate nettoyée et repassée, idéale pour une présentation professionnelle soignée.',
            'category' => 'Accessoires',
        ],
        [
            'name' => 'Manteau',
            'description' => 'Manteau soigneusement nettoyé pour enlever toutes les taches et garantir une fraîcheur durable, parfait pour l’hiver.',
            'category' => 'Hauts',
        ],
        [
            'name' => 'Couette',
            'description' => 'Couette nettoyée en profondeur, assurant une hygiène irréprochable pour un sommeil confortable et sain.',
            'category' => 'Linge de maison',
        ],
        [
            'name' => 'Oreiller',
            'description' => 'Oreiller nettoyé et désinfecté, idéal pour un sommeil réparateur.',
            'category' => 'Linge de maison',
        ],
        [
            'name' => 'Tapis',
            'description' => 'Tapis nettoyé à sec ou en profondeur, préservant la qualité et la couleur tout en éliminant la saleté et les taches.',
            'category' => 'Linge de maison',
        ],
        [
            'name' => 'Costume',
            'description' => 'Costume nettoyé et repassé avec soin, parfait pour une allure professionnelle ou pour des occasions spéciales.',
            'category' => 'Hauts',
        ],
        [
            'name' => 'Jupe',
            'description' => 'Jupe repassée et nettoyée, idéale pour des sorties élégantes ou professionnelles.',
            'category' => 'Bas',
        ],
        [
            'name' => 'Serviette',
            'description' => 'Serviette nettoyée et assouplie, offrant douceur et propreté pour chaque utilisation.',
            'category' => 'Linge de maison',
        ],
    ];


    private const SERVICES_CATEGORY = [
        [
            'name' => 'Repassage',
            'description' => 'Nous offrons un service de repassage professionnel, avec une attention particulière aux détails pour garantir des vêtements impeccablement repassés et prêts à porter.',
            'start_price' => 9.99,
        ],
        [
            'name' => 'Nettoyage',
            'description' => 'Notre service de nettoyage professionnel prend soin de vos vêtements en profondeur, en utilisant des produits de qualité pour un résultat frais et propre.',
            'start_price' => 11.99,
        ],
        [
            'name' => 'Retouche',
            'description' => 'Confiez-nous vos vêtements pour des retouches précises et sur mesure, assurant un ajustement parfait à chaque fois.',
            'start_price' => 14.99,
        ],
    ];


    private const PAYMENT = [
        [
            'name' => 'Carte bancaire',
            'icon' => 'fa-brands fa-cc-visa'
        ],
        [
            'name' => 'Paypal',
            'icon' => 'fa-brands fa-paypal'
        ],
        [
            'name' => 'Apple Pay',
            'icon' => 'fa-brands fa-apple-pay'
        ]
    ];

    private const STATUS = [
        'En attente de validation',
        'En cours',
        'Terminé'
    ];

    private const SERVICES = [
        [
            'name' => 'Repassage Simple',
            'description' => 'Un service de repassage rapide et soigné pour vos vêtements du quotidien, avec une attention particulière aux détails.',
            'picture' => 'repassage-simple.webp',
            'price' => 9.99,
            'category' => 'Repassage'
        ],
        [
            'name' => 'Repassage Complet',
            'description' => 'Un service de repassage complet qui garantit des vêtements impeccables, y compris les pièces les plus délicates.',
            'picture' => 'repassage-complet.webp',
            'price' => 14.99,
            'category' => 'Repassage'
        ],
        [
            'name' => 'Nettoyage Simple',
            'description' => 'Nettoyage basique de vos vêtements avec des produits de qualité, idéal pour l’entretien régulier de votre garde-robe.',
            'picture' => 'nettoyage-simple.webp',
            'price' => 11.99,
            'category' => 'Nettoyage'
        ],
        [
            'name' => 'Nettoyage Complet',
            'description' => 'Un nettoyage en profondeur pour éliminer les taches tenaces et rafraîchir vos vêtements, tout en respectant les textiles délicats.',
            'picture' => 'nettoyage-complet.webp',
            'price' => 16.99,
            'category' => 'Nettoyage'
        ],
        [
            'name' => 'Retouche Simple',
            'description' => 'Ajustements mineurs de vos vêtements pour un meilleur ajustement, comme des ourlets ou des reprises de coutures.',
            'picture' => 'retouche-simple.webp',
            'price' => 14.99,
            'category' => 'Retouche'
        ],
        [
            'name' => 'Retouche Complet',
            'description' => 'Service de retouche complet pour des modifications plus importantes, comme le réajustement de la taille ou la refonte de pièces spécifiques.',
            'picture' => 'retouche-complet.webp',
            'price' => 18.99,
            'category' => 'Retouche'
        ]
    ];


    public function __construct(
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');

        foreach (self::CIVILITIES as $oneCivility) {
            $civility = new Civility();
            $civility->setWording($oneCivility);
            $manager->persist($civility);
        }

        foreach (self::MATTERS as $oneMatter) {
            $matter = new Matter();
            $matter->setName($oneMatter['name']);
            $matter->setCoeff($oneMatter['coeff']);
            $manager->persist($matter);
        }

        $productCategories = [];
        foreach (self::PRODUCTS_CATEGORY as $oneCategory) {
            $productCategory = new ProductCategory();
            $productCategory->setName($oneCategory);
            $manager->persist($productCategory);
            $productCategories[$oneCategory] = $productCategory;
        }

        foreach (self::PRODUCTS as $oneProduct) {
            $product = new Product();
            $product->setName($oneProduct['name']);
            $product->setDescription($oneProduct['description']);
            $product->setCategory($productCategories[$oneProduct['category']]);
            $manager->persist($product);
        }

        foreach (self::PAYMENT as $onePayment) {
            $payment = new Payment();
            $payment->setName($onePayment['name']);
            $payment->setIcon($onePayment['icon']);
            $manager->persist($payment);
        }

        foreach (self::STATUS as $oneStatus) {
            $status = new Status();
            $status->setName($oneStatus);
            $manager->persist($status);
        }

        $serviceCategories = [];
        foreach (self::SERVICES_CATEGORY as $oneCategory) {
            $serviceCategory = new ServiceCategory();
            $serviceCategory->setName($oneCategory['name']);
            $serviceCategory->setDescription($oneCategory['description']);
            $serviceCategory->setStartPrice($oneCategory['start_price']);
            $manager->persist($serviceCategory);
            $serviceCategories[$oneCategory['name']] = $serviceCategory;
        }

        foreach (self::SERVICES as $oneService) {
            $service = new Service();
            $service->setName($oneService['name']);
            $service->setDescription($oneService['description']);
            $service->setPicture($oneService['picture']);
            $service->setPrice($oneService['price']);
            $service->setCategory($serviceCategories[$oneService['category']]);
            $manager->persist($service);
        }

        // $user = new User();
        // $user->setFirstname($faker->firstName);
        // $user->setLastname($faker->lastName);
        // $user->setUsername('user');
        // $user->setPassword('user');
        // $user->setAddress($faker->address);
        // $user->setCivility($civility);
        // $user->setPassword('user');
        // $manager->persist($user);

        // $employee = new Employee();
        // $employee->setFirstname($faker->firstName);
        // $employee->setLastname($faker->lastName);
        // $employee->setUsername('employee');
        // $employee->setPassword('employee');
        // $employee->setAddress($faker->address);
        // $employee->setCivility($civility);
        // $employee->setPassword('employee');
        // $employee->setRoles(['ROLE_EMPLOYEE']);
        // $employee->setCategory($serviceCategories[$oneService['category']]);
        // $manager->persist($employee);

        // $admin = new User();
        // $admin->setFirstname($faker->firstName);
        // $admin->setLastname($faker->lastName);
        // $admin->setUsername('admin');
        // $admin->setPassword('admin');
        // $admin->setAddress($faker->address);
        // $admin->setCivility($civility);
        // $admin->setPassword('admin');
        // $admin->setRoles(['ROLE_ADMIN']);
        // $manager->persist($admin);

        $manager->flush();
    }
}
