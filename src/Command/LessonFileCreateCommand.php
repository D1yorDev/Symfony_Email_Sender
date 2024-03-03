<?php
	
	namespace App\Command;
	
	use Symfony\Component\Console\Attribute\AsCommand;
	use Symfony\Component\Console\Command\Command;
	use Symfony\Component\Console\Input\InputArgument;
	use Symfony\Component\Console\Input\InputInterface;
	use Symfony\Component\Console\Input\InputOption;
	use Symfony\Component\Console\Output\OutputInterface;
	use Symfony\Component\Console\Style\SymfonyStyle;
	
	#[AsCommand(
		name: 'lesson:file:create',
		description: 'Creates tmp file',
	)]
	class LessonFileCreateCommand extends Command
	{
		use GreetingTrait;
		protected function configure(): void
		{
			$this
				->addArgument('text', InputArgument::REQUIRED, 'File text')
				->addOption('append', 'a', InputOption::VALUE_NONE, 'Appends to existing file');
		}
		
		protected function execute(InputInterface $input, OutputInterface $output): int
		{
			$io = new SymfonyStyle($input, $output);
			$text = $input->getArgument('text');
			$operator = $input->getOption('append') ? '>>' : '>';
			$result = system("echo '$text' $operator /tmp/test.txt");
			
			$this->sayHello($io);
			
			if ($result === false) {
				$io->error('Undefined error. Failed to create file');
				return Command::FAILURE;
			}
			
			$io->success('File is updated');
			return Command::SUCCESS;
		}
	}
