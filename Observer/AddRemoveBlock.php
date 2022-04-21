<?php
namespace Asad\Observers\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class AddRemoveBlock implements ObserverInterface{

    public function execute(Observer $observer){

        $layout = $observer->getLayout();

        if($observer->getFullActionName() == "catalog_product_view"){

            $block = $layout->getBlock("view.addto.compare");
            if($block){
                $layout->unsetElement($block->getNameInLayout()); //view.addto.compare
            }
        }
    }
}