<?php

// protected/components/SubscriberFormWidget.php

class AdminMenuWidget extends CWidget
{
    /**
     * @var CFormModel
     */
    public $items;

    public function run()
    {
        $this->render('adminmenu', array('items'=>$this->items));
    }
}