<?php
    namespace AppBundle\EventListener;

    use Pimcore\Event\Model\DataObjectEvent;
    use Pimcore\Model\DataObject\Products;
    use Pimcore\Model\Element\ValidationException;

    class PriceListener{

        public function getProductsObject(DataObjectEvent $e){

            //p_r($e->getObject());

            if ($e->getObject() instanceof products) {
                $product = $e->getObject();
                //p_r($product->getPrice());
                if ($product->getPrice() > 25000) {
                    throw new \Pimcore\Model\Element\ValidationException("price should be less than 25000");
                }
            }

        }
    }
