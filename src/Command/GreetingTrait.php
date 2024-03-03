<?php
	
	declare(strict_types=1);
	
	namespace App\Command;
	
	use Symfony\Component\Console\Style\SymfonyStyle;
	
	trait GreetingTrait
	{
		protected function sayHello(SymfonyStyle $io): void
		{
			$io->info('Welcom to the victus Trait ishladi');
		}
	}