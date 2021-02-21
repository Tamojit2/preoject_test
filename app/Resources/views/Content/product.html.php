<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout.html.php');

?>

<h1><?= $this->input("headline", ["width" => 540]); ?></h1>
<div class="product-info">
    <?php if($this->editmode):
        echo $this->relation('products');
    else: ?>
    <div id="product">
        <?php
        /** @var \Pimcore\Model\DataObject\Products $products */
        $products = $this->relation('products')->getElement();
        ?>
        <h2><?= $this->escape($products->getMaterial()); ?></h2>
        <div class="content">
            <?= $products->getSimage(); ?>
        </div>
        <div class="content">
    <?php
    $picture = $products->getSimage();
    if($picture instanceof \Pimcore\Model\Asset\Image):
        /** @var \Pimcore\Model\Asset\Image $Image */
        
    ?>
        <?= $picture->getThumbnail("content")->getHtml(); ?>
    <?php endif; ?> 
</div>
    </div>
    <?php endif; ?>
</div>
