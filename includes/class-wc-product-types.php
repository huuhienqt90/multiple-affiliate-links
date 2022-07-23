<?php

class WC_Affiliate extends WC_Product_External
{
    public function __construct( $product )
    {
        $this->product_type = 'zpaffiliate';
        parent::__construct( $product );
    }
}