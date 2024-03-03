<?php
	
	namespace App\Command;
	
	use Symfony\Component\Console\Style\SymfonyStyle;
	
	trait GoodbyeTrait
	{
		private function sayBye(SymfonyStyle $io): void
		{
			$io->block('Bye-Bye VICTUS!');
		}
		
		private function sayHello(SymfonyStyle $io): void
		{
			$io->warning('Welcome to VICTUS!');
		}
  
	}