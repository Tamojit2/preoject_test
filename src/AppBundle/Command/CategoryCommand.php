<?php

namespace AppBundle\Command;

use Pimcore\Console\AbstractCommand;
use Pimcore\Model\DataObject\ClassDefinition\Data;
use Pimcore\Console\Dumper;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface; 
use Pimcore\Model\DataObject\Products;
use Pimcore\Model\DataObject\Category;
use Pimcore\Model\DataObject\Material;
use Pimcore\Model\DataObject\AbstractObject;


class CategoryCommand extends AbstractCommand
{
    protected function configure()
    {
        $this
            ->setName('category:save')
            ->setDescription('add new category');
            $this->addOption('file', 'c', InputOption::VALUE_REQUIRED, 'abc');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
    
    
    	$path = $input->getOptions()['file'];
            $json = file_get_contents($path);
            $data = json_decode($json);
            foreach ($data as $cat)
            {
                $category = new \Pimcore\Model\DataObject\Category();
                $category->setKey($cat->name);
                $category->setPublished(true);
                $category->setParentId(8);
                $category->setName($cat->name);
                $category->setDescription($cat->description);
                //$category->save();
            }
            if($category) {
		$category->save();
		$this->dump("Data Saved");
		} else {
		$this->dump("Some Error");
		}
		   
       }
}


