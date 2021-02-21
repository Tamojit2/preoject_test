<?php

namespace AppBundle\Command;

use Pimcore\Console\AbstractCommand;
use Pimcore\Console\Dumper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AwesomeCommand extends AbstractCommand
{
    protected function configure()
    {
        $this
            ->setName('abc:command')
            ->setDescription('Awesome command');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
    
    	$a=5;
    	if($a>2){
        // dump
        $this->dump("First command");
        }else{
        
        $this->writeError('Bye!');
        }

        
    }
}
