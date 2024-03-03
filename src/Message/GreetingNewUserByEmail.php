<?php
	
	declare(strict_types=1);
	
	namespace App\Message;
	
	class GreetingNewUserByEmail
	{
		public function __construct(private readonly string $email)
		{
		
		}
		
		public function getEmail(): string
		{
			return $this->email;
		}
	}