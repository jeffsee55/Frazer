<?php
/**
 * Theme Admin Class.
 *
 * Manages Admin functions
 *
 * @package Classy
 */

namespace Classy;

/**
 * Class OptionsTable
 */
class OptionsTable
{

    function getTable($table)
    {
        $html = '';
        $html .= '<table class="form-table options-table">';
            $html .= '<colgroup>';
               $html .= '<col span="1" style="width: 20%;">';
               $html .= '<col span="1" style="width: 80%;">';
            $html .= '</colgroup>';
            $html .= '<tbody>';
                foreach($table['options'] as $index => $option) {
                    if(! isset($option['raw'])) {
                		$optionName = preg_match("/\[([a-z_]*)\]/D", $option['option'], $matches);
                        if(isset($matches[1]))
                        {
                            $class = (empty($option['value']) && $option['type'] == 'multi' ) ? 'hidden' : '';
                            $html .= '<tr class="' . $class . ' q4vr_settings_row_' . $matches[1] . '">';
                        } else {
                            $html .= '<tr>';
                        }
                    } else {
                        $html .= '<tr>';
                    }
                        $html .= '<th class="fields-label"><div>' . $option['name'] . '</div></th>';
                        if(! isset($option['raw'])) {
                            $html .= '<td>' . $this->getInputType($option['type'],
                                $option['option'],
                                isset($option['value']) ? $option['value'] : null,
                                isset($option['arguments']) ? $option['arguments'] : null,
                                isset($option['argument_options']) ? $option['argument_options'] : null
                                ) . '</td>';
                        } else {
                            $html .= '<td>' . $option['option'] . '</td>';
                        }
                    $html .= '</tr>';
                }
            $html .= '</tbody>';
        $html .= '</table>';
        return $html;
    }

    function getInputType($type, $option, $value = null, $arguments = null, $argumentOptions = null)
    {
        if(! $value)
            $value = get_site_option($option);
        if($type == 'text')
            return '<input type="text" name="' . $option . '" value="' . $value . '" placeholder="Text here">';

        if($type == 'textarea')
            return '<textarea name="' . $option . '" rows="5" cols="70">' . $value . '</textarea>';

        if($type == 'button')
        {
            $html = '<input type="text" name="' . $option . '[link]" value="' . $value['link'] . '" placeholder="Link">';
            $html .= '<input type="text" name="' . $option . '[label]" value="' . $value['label'] . '" placeholder="Label">';
            return $html;
        }

        if($type == 'wysiwyg')
        {
            ob_start();
            wp_editor( $value, 'options_table_wysiwyg_' . rand(), $settings = array(
                'textarea_name' => $option,
                'textarea_rows' => 5,
                'wpautop' => false,
            ) );
            $editor = ob_get_clean();
            return $editor;
        }

        if($type == 'select')
        {
            $html = '<select data-select name="' . $option . '">';
                $currentValue = $value;
                foreach($arguments as $argumentKey => $argumentValue)
                {
                    $selected = $currentValue == $argumentKey ? 'selected' : '';
                    $html .= '<option ' . $selected . ' value="' . $argumentKey . '">' . $argumentValue . '</option>';
                }
            $html .= '</select>';

            return $html;
        }

        if($type == 'multi')
        {
            $html = '<ul class="arguments">';
            if($value)
            {
                foreach($value as $key => $value) {
                    $html .= '<li>';
                        $html .= '<input name="' . $option . '[]" type="text" value="' . $key . '">';
                        $html .= '<input name="' .  $option . '[]" type="text" value="' . $value . '">';
                        $html .= '<span data-remove="" class="q4vr-icon q4vr-minus"></span>';
                        $html .= '<span data-add="" class="q4vr-icon q4vr-plus"></span>';
                    $html .= '</li>';
                }
            } else {
                $html .= '<li>';
                    $html .= '<input name="' . $option . '[]" type="text" value="">';
                    $html .= '<input name="' .  $option . '[]" type="text" value="">';
                    $html .= '<span data-remove="" class="q4vr-icon q4vr-minus"></span>';
                    $html .= '<span data-add="" class="q4vr-icon q4vr-plus"></span>';
                $html .= '</li>';
            }
            $html .= '</ul>';

            return $html;
        }

        if($type == 'checkbox')
        {
            $checkboxes = '';
            foreach($arguments as $name => $displayName)
            {
                $currentValues = $value;
                $checked = '';
                if(isset($value[$name])) {
                    $checked = 'checked';
                }
                $checkboxes .= sprintf('<div class="checkbox"><label><input type="checkbox" %s name="%s[]" value="%s">%s</label>', $checked, $option, $name, $displayName);
                foreach($argumentOptions as $argumentOption)
                {
                    $argumentName = $option . '[' . $name . '][' . $argumentOption['option'] . ']';
                    $checkboxes .= '<label>' . $argumentOption['name'] . '</label>';
                    $checkboxes .= '<select name="' . $argumentName . '">';
                        $checkboxes .= '<option></option>';
                        foreach($argumentOption['arguments'] as $argumentOptionName => $label)
                        {
                            $selected = '';
                            if(isset($value[$name][$argumentOption['option']]))
                            {
                                if((int) $value[$name][$argumentOption['option']] == $argumentOptionName)
                                    $selected = 'selected';
                            }
                            $checkboxes .= '<option ' . $selected . ' value="' . $argumentOptionName . '">' . $label . '</option>';
                        }
                    $checkboxes .= '</select>';
                }
                $checkboxes .= '</div>';
            }
            return $checkboxes;
        }

        if($type == 'image')
            return $this->fileInput($option, $value);
    }

    public function fileInput($option, $value)
    {
        global $post;
        // Get WordPress' media upload URL
        $upload_link = esc_url( get_upload_iframe_src( 'image', $post->ID ) );
        $currentImageExists = false;
        $currentImageSrc = [];
        $currentImageId = '';
        if($value)
        {
            $currentImageId = $value;
            $currentImageSrc = wp_get_attachment_image_src($currentImageId, 'thumbnail' );
            $currentImageExists = is_array($currentImageSrc);
        }
        $upload_id = str_replace('[', '-', $option);
        $upload_id = str_replace(']', '', $upload_id);

        $html = '<div class="image-file-input" id="' . $upload_id . '">';
        $html .= '<div class="custom-img-container">';
            if ( $currentImageExists) :
                $html .= '<img src="' . $currentImageSrc[0] . '" alt="" style="max-width:100%;" />';
            endif;
        $html .= '</div>';

        $html .= '<p class="hide-if-no-js">';
            $html .= '<a class="upload-custom-img"';
               $html .= 'href="' . $upload_link . '">';
                $html .=  'Set image';
            $html .= '</a>';
        $html .= '</p>';

        $html .= '<input class="custom-img-id" name="' . $option  . '" type="hidden" value="' . $currentImageId . '" />';
        $html .= '</div>';
        return $html;
    }

    public function heroTable($index)
    {
        global $post;
        $meta = get_post_meta($post->ID, '_messages', true);
        if(is_null($index))
            $index = 0;
        return [
            'title' => 'Messages',
            'options' => [
                [
                    'name' => 'Label',
                    'option' => '_messages[' . $index . '][label]',
                    'type' => 'text',
                    'value' => isset($meta[$index]['label']) ? $meta[$index]['label'] : ''
                ],
                [
                    'name' => 'Button',
                    'option' => '_messages[' . $index . '][button]',
                    'type' => 'button',
                    'value' => isset($meta[$index]['button']) ? $meta[$index]['button'] : ''
                ],
                [
                    'name' => 'Image',
                    'option' => '_messages[' . $index . '][image]',
                    'type' => 'image',
                    'value' => isset($meta[$index]['image']) ? $meta[$index]['image'] : ''
                ],
                [
                    'name' => 'Body',
                    'option' => '_messages[' . $index . '][body]',
                    'type' => 'wysiwyg',
                    'value' => isset($meta[$index]['body']) ? $meta[$index]['body'] : ''
                ],
            ]
        ];
    }
}
