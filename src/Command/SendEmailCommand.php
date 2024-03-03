<?php
	
	namespace App\Command;
	
	use App\Message\GreetingNewUserByEmail;
	use App\Repository\UserRepository;
	use Doctrine\ORM\EntityManagerInterface;
	use Symfony\Component\Console\Attribute\AsCommand;
	use Symfony\Component\Console\Command\Command;
	use Symfony\Component\Console\Input\InputInterface;
	use Symfony\Component\Console\Output\OutputInterface;
	use Symfony\Component\Messenger\MessageBusInterface;
	
	#[AsCommand(
		name: 'send:email',
		description: 'send an email to the user',
	)]
	class SendEmailCommand extends Command
	{
		public function __construct(
			private readonly MessageBusInterface $messageBus,
			private readonly UserRepository $userRepository,
			private readonly EntityManagerInterface $entityManager
		) {
			parent::__construct();
		}
		
		protected function execute(InputInterface $input, OutputInterface $output): int
		{
			$users = $this->userRepository->findOneBy([] , ['createdAt' => 'ASC']);
			
			foreach ($users as $user)
			{
				if (!$user->isActive())
				{
					$email = $user->getEmail();
					
					$this->messageBus->dispatch(new GreetingNewUserByEmail($email));
					$user->setIsActive(true);
					$this->entityManager->flush();
					$output->writeln('Email sent to ' . $email);
					
					return Command::SUCCESS;
				}
			}
			$output->writeln('Barcha foydalanubchilar activlashda');
			
            return Command::SUCCESS;
		}
		
	}
