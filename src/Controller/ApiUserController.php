<?php

namespace App\Controller;

use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Entity\User;
use App\Repository\CivilityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api', name: 'api_')]
class ApiUserController extends AbstractController
{
    #[Route('/users', name: 'add_users', methods: ['POST'])]
    public function index(Request $request, EntityManagerInterface $manager, CivilityRepository $civilityRepository, SerializerInterface $serializer, ValidatorInterface $validator): JsonResponse
    {
        $data = $request->getContent();
        $user = $serializer->deserialize($data, User::class, 'json');
        $errors = $validator->validate($user);

        if (count($errors) > 0) {
            return new JsonResponse(['error' => $errors], 400);
        }

        $manager->persist($user);
        $manager->flush();

        return new JsonResponse(['message' => 'User added successfully!', 'user' => $user], 201);
    }
}
