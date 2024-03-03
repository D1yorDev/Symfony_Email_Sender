<?php
	
	declare(strict_types=1);
	
	namespace App\Message;
	
	use Symfony\Component\Mailer\MailerInterface;
	use Symfony\Component\Messenger\Attribute\AsMessageHandler;
	use Symfony\Component\Mime\Email;
	
	#[AsMessageHandler]
	class GreetingNewUserByEmailHandler
	{
		public function __construct(private readonly MailerInterface $mailer)
		{
		}
		
		public function __invoke(GreetingNewUserByEmail $message):void
		{
			$email = (new Email())
				->from('diorkh07@mail.ru')
				->to($message->getEmail())
				->subject('D1yorDev homeworks')
				->html('Men #hw33advanced ni bajardim <strong>Ustoz</strong>');
			
			$this->mailer->send($email);
		}
	}