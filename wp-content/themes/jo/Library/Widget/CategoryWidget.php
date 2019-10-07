<?php

namespace Library\Widget;

class CategoryWidget extends AbstractWidget {

    public function __construct(){

        parent::__construct(
            'category_widget',
            __('Category Widget', 'commercemall')
        );
    }

}