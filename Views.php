<?php namespace components\faq; if(!defined('TX')) die('No direct access.');

class Views extends \dependencies\BaseViews
{

  protected function faq($options)
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
      'item_list' =>
        $this->section('item_list', $options)
    );
  
  }

}
