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


class ImportMaterialCommand extends AbstractCommand
{
    protected function configure()
    {
        $this
            ->setName('material:import')
            ->setDescription('add new material');
            
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
    
    	$material = new \Pimcore\Model\DataObject\Importdata\Listing();
                $material->setCondition('class_name = ?', 'Material');
                $material->setLimit(1);
                foreach ($material->getFile() as $path) {
                	$json = file_get_contents($path);
            		$data = json_decode($json);
                }

            
            foreach ($data as $cat)
            {
                $category = new \Pimcore\Model\DataObject\Material();
                $category->setKey($cat->name);
                $category->setPublished(true);
                $category->setParentId(9);
                $category->setName($cat->name);
                $category->setDescription($cat->description);
                $category->save();
            }
            $this->dump('saved');
       }
}


