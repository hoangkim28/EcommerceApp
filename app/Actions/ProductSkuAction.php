<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;

class ProductSkuAction extends AbstractAction {

    public function getTitle() {
        return 'Sku';
    }

    public function getIcon() {
        return 'voyager-list-add';
    }

    public function getPolicy()
    {
        return 'edit';
    }

    public function getAttributes() {
        return [
            'class' => 'btn btn-sm btn-success pull-right confirm',
            'style' => 'margin-right:5px;',
        ];
    }

    public function shouldActionDisplayOnDataType() {
        //Display this action only for the orders
        return $this->dataType->slug === 'products';
    }

    public function getDefaultRoute() {
        $sku_id = $this->data->product_skus->first(); // get first sku
        return route('product.productsku', ['id'=>$this->data->id]);
    }
}