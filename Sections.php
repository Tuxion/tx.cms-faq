<?php namespace components\faq; if(!defined('TX')) die('No direct access.');

class Sections extends \dependencies\BaseViews
{

  protected function item_list($options)
  {
  
    $pid =
      ($options->pid->get('int') > 0 ? $options->pid : tx('Data')->filter('cms')->pid);

    $faq =
      $this->table('Faqs')
      ->where('page_id', $pid)
      ->execute_single();
  
    return array(
      'faq' =>
        $faq,
      'items' =>
        $this->table('FaqItems')
        ->where('faq_id', $faq->id)
        ->execute(),
    );

  }

  protected function edit_item($options)
  {
  
    $pid =
      ($options->pid->get('int') > 0 ? $options->pid : tx('Data')->filter('cms')->pid);

    $faq =
      $this->table('Faqs')
      ->where('page_id', $pid)
      ->execute_single();
      
    return array(
      'faq' =>
        $faq,
      'item' =>
        $this->table('FaqItems')
        ->where('id', tx('Data')->get->item_id)
        ->execute_single()
    );
      

  }

}
