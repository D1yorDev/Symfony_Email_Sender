<?php

	declare(strict_types=1);

	namespace App\Controller;

	use App\Controller\Base\AbstractController;
	use App\Message\GreetingNewUserByEmail;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Messenger\MessageBusInterface;

	class UserSendEmailAction extends AbstractController
	{
		public function __invoke(MessageBusInterface $messageBus): Response
		{
			$message = new GreetingNewUserByEmail('diorkh07@mail.ru');
			$messageBus->dispatch($message);
			
			return $this->responseEmpty();
		}
	}
	