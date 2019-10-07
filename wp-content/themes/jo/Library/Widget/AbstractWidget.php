<?php

namespace Library\Widget;

use Library\ThemeSettings;

abstract class AbstractWidget extends \WP_Widget
{
	use ThemeSettings;
    abstract function getWidgetContent($args, $inst);

    public function __construct($id_base, $name, $widget_options = [], $control_options = [])
    {
        parent::__construct($id_base, $name, $widget_options, $control_options);
    }

    public function getWidgetID($args, $prefix = '')
    {
        $id = $args['widget_id'];
        $id = str_replace('_', '-', $id);
        $id = trim($id, '-');

        if (!empty($prefix)) $id .= '-' . $prefix;

        return $id;
    }

    public function widget($args, $inst)
    {
        $html = [
            $this->getBeforeWidget($args, $inst),
            $this->getWidgetContent($args, $inst),
            $this->getAfterWidget($args, $inst),
        ];

        $html = array_map('trim', $html);
        $html = implode('', $html);

        echo $html;
    }

    public function form($inst)
    {
        $this->renderTextField($inst, 'title', __('Title', $this->transDomain));

        $this->renderTextField($inst, 'extra_class', __('Class', $this->transDomain));

        $this->renderSelectField(
            $inst, 'container', __('Container', $this->transDomain), [
                     'container-none'  => __('None', $this->transDomain),
                     'container'       => __('Normal', $this->transDomain),
                     'container-fluid' => __('Fluid', $this->transDomain),
                 ]
        );
    }

    protected function getBeforeWidget($args, $inst)
    {
        $title     = $this->getFieldValue($inst, 'title', '');
        $container = $this->getFieldValue($inst, 'container', 'none');
        $class     = $this->getFieldValue($inst, 'extra_class', '');
        $class     = trim($class);

        if (empty($class)) {
            $class = 'no-extra-class';
        }

        $html   = [];
        $html[] = $args['before_widget'];

        $html[] = "<div class='{$class}'>";
        $html[] = "<div class='{$container}'>";

        if (!empty($title)) {
            $html[] = "<div class='widget-title'>";
            $html[] = $args['before_title'];
            $html[] = apply_filters('widget_title', $title);
            $html[] = $args['after_title'];
            $html[] = "</div>";
        }

        $html[] = "<div class='widget-content'>";

        return implode('', $html);
    }

    protected function getAfterWidget($args, $inst)
    {
        $html   = [];
        $html[] = "</div>"; // widget-content
        $html[] = "</div>";
        $html[] = "</div>";


        $html[] = $args['after_widget'];

        return implode('', $html);
    }

    protected function getFieldValue($inst, $id, $default = false)
    {
        $field_id = $this->getFieldId($id);

        if (isset($inst[$field_id])) return $inst[$field_id];
        if (isset($inst[$id])) return $inst[$id];

        return $default;
    }

    protected function getFieldId($id)
    {
        return esc_attr($this->get_field_id($id));
    }

    protected function getFieldName($id)
    {
        return esc_attr($this->get_field_name($id));
    }

    protected function renderSep()
    {
        echo "<hr />";
    }

    protected function renderTitle($title)
    {
        $this->renderSep();

        echo "<h3 class='margin-bottom'>{$title}</h3>";
    }

    protected function renderMediaLibraryField($inst, $id, $label, $show_icon = true)
    {
        echo "<div class='margin-bottom'>";

        $this->renderTextField($inst, $id, $label);
        $this->renderHiddenField($inst, $id . '-icon');

        $field_id      = $this->getFieldId($id);
        $icon_value    = strval($this->getFieldValue($inst, $id . '-icon'));
        $icon_field_id = $this->getFieldId($id . '-icon');
        $icon_class    = !$show_icon || empty($icon_value) ? " hidden " : "";

        echo "<div id='{$icon_field_id}-preview' class='commercemall-media-icon margin-bottom {$icon_class}'>";
        if (!empty($icon_value)) echo "<img src='{$icon_value}' />";
        echo "</div>";

        echo "<a class='commercemall-media-library-trigger button button-primary' data-id='{$field_id}'>Media Library</a>";
        echo "</div>";

    }

    protected function renderTextField($inst, $id, $label, $default = '')
    {
        $value      = $this->getFieldValue($inst, $id, $default);
        $field_id   = $this->getFieldId($id);
        $field_name = $this->getFieldName($id);
        $input      = "<input id='{$field_id}' name='{$field_name}' class='widefat' type='text' value='{$value}' />";

        echo $this->getAdminField($input, $label);
    }

    protected function renderHiddenField($inst, $id, $default = '')
    {
        $value      = $this->getFieldValue($inst, $id, $default);
        $field_id   = $this->getFieldId($id);
        $field_name = $this->getFieldName($id);
        $input      = "<input id='{$field_id}' name='{$field_name}' type='hidden' value='{$value}' />";

        echo $this->getAdminField($input);
    }

    protected function renderIntField($inst, $id, $label, $min = 0, $max = 9999, $default = 0)
    {
        $value      = (int)$this->getFieldValue($inst, $id, $default);
        $field_id   = $this->getFieldId($id);
        $field_name = $this->getFieldName($id);
        $min        = (int)$min;
        $max        = (int)$max;
        $input      = "<input id='{$field_id}' name='{$field_name}' class='widefat' type='number' min='{$min}' max='{$max}' value='{$value}' />";

        echo $this->getAdminField($input, $label);
    }

    protected function renderSelectField($inst, $id, $label, array $options = [], $default = false)
    {
        $value      = $this->getFieldValue($inst, $id, $default);
        $field_id   = $this->getFieldId($id);
        $field_name = $this->getFieldName($id);
        $input      = "<select id='{$field_id}' name='{$field_name}' class='widefat'>";

        foreach ($options as $val => $lab) {
            $selected = ($value == $val) ? " selected " : '';
            $input    .= "<option value='{$val}' {$selected}>{$lab}</option>";

        }

        $input .= "</select>";

        echo $this->getAdminField($input, $label);
    }

    private function getAdminField($input, $label = '')
    {
        $label = trim($label);
        $label = !empty($label) ? "<label>{$label}</label>" : '';

        return "<div class='commercemall-field margin-bottom'>{$label}{$input}</div>";
    }
}
