<?php

namespace Library\Widget;

class AbstractWidget extends \WP_Widget {

    public function __construct($id_base, $name, $widget_options = [], $control_options = [])
    {
        parent::__construct($id_base, $name, $widget_options, $control_options);
    }

}