<?php

declare(strict_types=1);

namespace App\Controller;

use App\Component\User\UserFactory;
use App\Component\User\UserManager;
use App\Controller\Base\AbstractController;
use App\Entity\User;
use App\Message\GreetingNewUserByEmail;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * Class CreateUserController
 *
 * @package App\Controller
 */
class UserCreateAction extends AbstractController
{
    public function __invoke(User $data, UserFactory $userFactory, UserManager $userManager,MessageBusInterface $messageBus): User
    {
        $this->validate($data);

        $user = $userFactory->create($data->getEmail(), $data->getPassword());
	    $message = new GreetingNewUserByEmail($data->getEmail());
	    $messageBus->dispatch($message);
        $userManager->save($user, true);

        return $user;
    }
}
