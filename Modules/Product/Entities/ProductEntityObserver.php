<?php

namespace Modules\Product\Entities;


class ProductEntityObserver
{
    /**
     * Unused function but good for example if you need to do more complex opperations
     * @param Product $product
     */
    public function saving(Product $product)
    {
//        $product->custom_attributes = json_encode($product->custom_attributes);
    }
}
