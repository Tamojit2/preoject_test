<?php

namespace AppBundle\Command;

use Pimcore\Console\AbstractCommand;
use Pimcore\Model\DataObject\ClassDefinition\Data;
use Pimcore\Console\Dumper;
use Pimcore\Model\Asset\MetaData\ClassDefinition\Data\Asset;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Pimcore\Model\DataObject\Importdata;
use Pimcore\Model\DataObject\Products;
use Pimcore\Model\DataObject\Category;
use Pimcore\Model\DataObject\Material;
use Pimcore\Model\DataObject\AbstractObject;


class ImportProductCommand extends AbstractCommand
{
    protected function configure()
    {
        $this
            ->setName('product:import')
            ->setDescription('add new product');
            
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

    
    	$product = new \Pimcore\Model\DataObject\Importdata\Listing();
                $product->setCondition('class_name = ?', 'Products');
                $product->setLimit(1);
                foreach ($product as $path) {
                	
                	//p_r($path);die;
                	$file = $path->getFile();
                    $file=(PIMCORE_PROJECT_ROOT . '/web/var/assets' .$file->getPath().$file->getFilename());
                	//p_r(PIMCORE_PROJECT_ROOT . '/web/var/assets' .$file->getPath().$file->getFilename());die;
                    //$file2 = $file->getFilename();
                    //p_r($file2);die;
                    $json = file_get_contents($file);
            		$data = json_decode($json);
                    //p_r($data);die;
         	
            }
                foreach ($data as $cat)
                {
                    //p_r($cat);die;
            	
                //$category = new Category();
                //$category = Category::getById(17);

                $obj = new \Pimcore\Model\DataObject\Products();


                $category = new \Pimcore\Model\DataObject\Category\Listing();
                        $category->setCondition('name = ?', $cat->category);
                        $category->setLimit(1);
                        foreach ($category as $cat2) {
                            //p_r($cat2);die;
                            $obj->setCategory($cat2);
                        }
                
                //$fabric->addConditionParam("brand = ?", 'ABC', "AND");
                //p_r($entry);die;
                
                $material = new Material();
                $material = Material::getById(14);
                
                $col = new \Pimcore\Model\DataObject\Data\RgbaColor();
                $col->setRgba($cat->color);
                
                $date = \Carbon\Carbon::parse($cat->date);

            //$dt->getStartDate($date);
                
            //$image = \Pimcore\Model\Asset\Image::getByPath($cat->image);
            //$image = \Pimcore\Model\Asset\Image::getByPath("/_default_upload_bucket/" . $prod->name . ".png");

            //$obj->setImage($image);
                        
            //$obj = new \Pimcore\Model\DataObject\Products();

                $obj->setKey('product 31');
                $obj->setParentId(11);
                $obj->setPublished(false);
                $obj->setFirstName($cat->name);
                $obj->setPrice($cat->price);
                $obj->setDiscount($cat->discount);
                $obj->setColor($col);
                $obj->setMfg($date);
            /*$date=date_create("2020-03-09");
            date_format($date,"Y-m-d);
            $obj->setMfg($date); */
                $obj->setRating($cat->rating);
                $obj->setMaterial($material->getName());
                
                }
            
                if($obj) {
                    $obj->save();
                    $this->dump("Data Saved");
                    } else {
                    $this->dump("Some Error");
                    }
       }
}


