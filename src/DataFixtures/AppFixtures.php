<?php

namespace App\DataFixtures;

use App\Entity\Civility;
use App\Entity\Employee;
use App\Entity\Matter;
use App\Entity\Payment;
use App\Entity\Product;
use App\Entity\ProductCategory;
use App\Entity\ServiceCategory;
use App\Entity\Status;
use App\Entity\User;
use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private const CIVILITIES = [
        'M.',
        'MME.',
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
        ]
    ];

    private const PRODUCTS_CATEGORY = [
        'Hauts',
        'Bas',
        'Divers',
    ];

    private const PRODUCTS = [
        [
            'name' => 'Chemise',
            'description' => 'Lorem',
            'picture' => '/uploads/chemise.jpg',
            'category' => 'Hauts',
        ],
        [
            'name' => 'Pantalon',
            'description' => 'Lorem',
            'picture' => '/uploads/pantalon.jpg',
            'category' => 'Bas',
        ],
        [
            'name' => 'Chaussure',
            'description' => 'Lorem',
            'picture' => '/uploads/chaussure.jpg',
            'category' => 'Divers',
        ],
    ];

    private const SERVICES_CATEGORY = [
        [
            'name' => 'Repassage',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem voluptatum dolorem id nobis aliquam, esse voluptas atque omnis harum error',
            'start_price' => 9.99,
        ],
        [
            'name' => 'Nettoyage',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem voluptatum dolorem id nobis aliquam, esse voluptas atque omnis harum error',
            'start_price' => 11.99,
        ],
        [
            'name' => 'Retouche',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem voluptatum dolorem id nobis aliquam, esse voluptas atque omnis harum error',
            'start_price' => 14.99,
        ],
    ];

    private const PAYMENT = [
        'Carte bancaire',
        'Paypal',
        'Apple Pay',
        'Google Pay'
    ];

    private const STATUS = [
        'En attente de validation',
        'En cours',
        'Terminé'
    ];

    private const SERVICES = [
        [
            'name' => 'Repassage Simple',
            'description' => 'Lorem',
            'picture' => '/uploads/repassage-simple.jpg',
            'price' => '100',
            'category' => 'Repassage'
        ],
        [
            'name' => 'Repassage Complet',
            'description' => 'Lorem',
            'picture' => '/uploads/repassage-complet.jpg',
            'price' => '100',
            'category' => 'Repassage'
        ],
        [
            'name' => 'Nettoyage Simple',
            'description' => 'Lorem',
            'picture' => '/uploads/nettoyage-simple.jpg',
            'price' => '100',
            'category' => 'Nettoyage'
        ],
        [
            'name' => 'Nettoyage Complet',
            'description' => 'Lorem',
            'picture' => '/uploads/nettoyage-complet.jpg',
            'price' => '100',
            'category' => 'Nettoyage'
        ],
        [
            'name' => 'Retouche Simple',
            'description' => 'Lorem',
            'picture' => '/uploads/retouche-simple.jpg',
            'price' => '100',
            'category' => 'Retouche'
        ],
        [
            'name' => 'Retouche Complet',
            'description' => 'Lorem',
            'picture' => '/uploads/retouche-complet.jpg',
            'price' => '100',
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
            $product->setPicture($oneProduct['picture']);
            $product->setCategory($productCategories[$oneProduct['category']]);
            $manager->persist($product);
        }

        foreach (self::PAYMENT as $onePayment) {
            $payment = new Payment();
            $payment->setName($onePayment);
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

        $user = new User();
        $user->setFirstname($faker->firstName);
        $user->setLastname($faker->lastName);
        $user->setEmail('user@user.com');
        $user->setPassword('user');
        $user->setAddress($faker->address);
        $user->setCivility($civility);
        $user->setPassword('user');
        $manager->persist($user);

        $employee = new Employee();
        $employee->setFirstname($faker->firstName);
        $employee->setLastname($faker->lastName);
        $employee->setEmail('employee@employee.com');
        $employee->setPassword('employee');
        $employee->setAddress($faker->address);
        $employee->setCivility($civility);
        $employee->setPassword('employee');
        $employee->setCategory($serviceCategories[$oneService['category']]);
        $manager->persist($employee);

        $manager->flush();
    }
}
