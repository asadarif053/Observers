<?php
namespace Asad\Observers\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class AddRemoveBlock implements ObserverInterface{

    public function execute(Observer $observer){
        /**
         * in Magento\Framework\View\Layout\Builder class, when the layout block generates layout_generate_blocks_after event dispatches
         * with the event two parameter passes full_action_name and layout, we'll fetch both here
         */
        $layout = $observer->getLayout();

        if($observer->getFullActionName() == "catalog_product_view"){
        /**
         * look at the catalog_proudct_view.xml, you will find the block view.addto.compare, we are amied to remove the block
         * using unsetElement method
         */
            $block = $layout->getBlock("view.addto.compare");
            if($block){ // sometimes the block may be removed
                $layout->unsetElement($block->getNameInLayout()); //view.addto.compare
            }


            //Magento\Framework\View\Layout.php, addBlock()
            
            $newBlock = $layout->addBlock(\Magento\Framework\View\Element\Template::class, 'observer.test.block','product.info.addto'); //($block, $name = 'givenName', $parent = '', $alias = '')
            $newBlock->setTemplate("Asad_Observers::link.phtml");
        }
    }
}