<?php namespace components\faq\models; if(!defined('TX')) die('No direct access.');

class FaqItems extends \dependencies\BaseModel
{
  
  protected static
  
    $table_name = 'faq_items',
  
    $relations = array(
      'Faqs' => array('faq_id' => 'Faqs.id')
    );
  
}