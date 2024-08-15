<?php

namespace App\EventListener;
use App\Repository\StatusRepository;
use App\Repository\UserRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Symfony\Component\HttpFoundation\RequestStack;

class JWTCreatedListener
{
    public function __construct(
        private RequestStack $requestStack,
        private UserRepository $userRepository,
        private StatusRepository $statusRepository
    ) {
    }

    public function onJWTCreated(JWTCreatedEvent $event): void
    {
        $payload = $event->getData();

        $user = $this->userRepository->findOneByUsername($payload['username']);
        $wainting = $this->statusRepository->findOneByName('En attente de validation');

        $payload['user_id'] = $user->getId();
        $payload['status_id'] = $wainting->getId();

        $event->setData($payload);
    }
}