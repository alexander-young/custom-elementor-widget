<?php

namespace WPC\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly


class Advertisement extends Widget_Base{

  public function get_name(){
    return 'advertisement';
  }

  public function get_title(){
    return 'Advertisement';
  }

  public function get_icon(){
    return 'fa fa-camera';
  }

  public function get_categories(){
    return ['general'];
  }

  protected function _register_controls(){

    $this->start_controls_section(
      'section_content',
      [
        'label' => 'Settings',
      ]
    );

    $this->add_control(
      'label_heading',
      [
        'label' => 'Label Heading',
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => 'My Example Heading'
      ]
    );

    $this->add_control(
      'content_heading',
      [
        'label' => 'Content Heading',
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => 'My Other Example Heading'
      ]
    );

    $this->add_control(
      'content',
      [
        'label' => 'Content',
        'type' => \Elementor\Controls_Manager::WYSIWYG,
        'default' => 'Some example content. Start Editing Here.'
      ]
    );

    $this->end_controls_section();
  }
  

  protected function render(){
    $settings = $this->get_settings_for_display();

    $this->add_inline_editing_attributes('label_heading', 'basic');
    $this->add_render_attribute(
      'label_heading',
      [
        'class' => ['advertisement__label-heading'],
      ]
    );

    ?>
    <div class="advertisement">
      <div <?php echo $this->get_render_attribute_string('label_heading'); ?>>
        <?php echo $settings['label_heading']?>
      </div>
      <div class="advertisement__content">
        <div class="advertisement__content__heading" <?php echo $this->get_render_attribute_string('content_heading'); ?>>
          <?php echo $settings['content_heading'] ?>
        </div>
        <div class="advertisement__content__copy" <?php echo $this->get_render_attribute_string('content'); ?>>
          <?php echo $settings['content'] ?>
        </div>
      </div>
    </div>
    <?php
  }

  protected function _content_template(){
    ?>
    <#
        view.addInlineEditingAttributes( 'label_heading', 'basic' );
    view.addRenderAttribute(
        'label_heading',
        {
            'class': [ 'advertisement__label-heading' ],
        }
    );
        #>
        <div class="advertisement">
      <div {{{ view.getRenderAttributeString( 'label_heading' ) }}}>{{{ settings.label_heading }}}</div>
      <div class="advertisement__content">
        <div class="advertisement__content__heading">{{{ settings.content_heading }}}</div>
        <div class="advertisement__content__copy">
          {{{ settings.content }}}
        </div>
      </div>
    </div>
        <?php
  }
}
