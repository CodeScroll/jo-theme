<?php

namespace Library\Widget;

use Library\PostCustom;

class CategoryWidget extends AbstractWidget {
    const DEFAULT_LIMIT = 20;
    const DEFAULT_DISPLAY = 'all';
    const DEFAULT_ORDER_BY = 'rand';
    const DEFAULT_ORDER = 'ASC';
    public function __construct(){

        parent::__construct('category_widget', __('Category Widget', $this->transDomain));
    }
    public function form($inst)
    {
    	$postCustom = new PostCustom();
    	$postsAll = $postCustom->getAllPostTypes();
        $this->renderSelectField($inst, 'post_category_show', __('Post Category Show', $this->transDomain), $postsAll, self::DEFAULT_ORDER);	
    }
    public function getWidgetContent($args, $inst)
    {
        $limit    = (int)$this->getFieldValue($inst, 'limit', WooHelper::DEFAULT_LIMIT);
        $display  = $this->getFieldValue($inst, 'display', WooHelper::DEFAULT_DISPLAY);
        $order_by = $this->getFieldValue($inst, 'order_by', WooHelper::DEFAULT_ORDER_BY);
        $order    = $this->getFieldValue($inst, 'order', WooHelper::DEFAULT_ORDER);

        $products = WooHelper::getWidgetProducts($limit, $display, $order_by, $order);

        $items = [];

        foreach ($products as $product) {
            $html = Helper::getTemplatePart('woocommerce/content-product.php', ['product' => $product], false);

            if (!empty($html)) $items[] = $html;
        }

        $html = '<div>TEST</div>';

        return $html;
    }
}