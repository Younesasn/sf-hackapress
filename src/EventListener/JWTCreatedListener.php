<?php

namespace App\EventListener;
use App\Repository\UserRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Symfony\Component\HttpFoundation\RequestStack;

class JWTCreatedListener
{
    public function __construct(
        private RequestStack $requestStack,
        private UserRepository $userRepository,
    ) {
    }

    public function onJWTCreated(JWTCreatedEvent $event): void
    {
        $payload = $event->getData();

        $user = $this->userRepository->findOneByUsername($payload['username']);

        $payload['user_id'] = $user->getId();

        $event->setData($payload);
    }
}