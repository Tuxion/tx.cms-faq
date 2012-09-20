<?php namespace components\faq; if(!defined('TX')) die('No direct access.');

class Actions extends \dependencies\BaseComponent
{

  protected function save_faq($data)
  {
    
    $faq_id = 0;
    tx($data->id->get('int') > 0 ? 'Updating a faq.' : 'Adding a new faq', function()use($data, &$faq_id){
      
      //append user object for easy access
      $user_id = tx('Data')->session->user->id;
      
      //save faq
      tx('Sql')->table('faq', 'Faqs')->pk($data->id->get('int'))->execute_single()->is('empty')
        ->success(function()use($data, $user_id, &$faq_id){
         tx('Sql')->model('faq', 'Faqs')->merge($data->having('page_id', 'title'))->merge(array('dt_created' => date("Y-m-d H:i:s")))->merge(array('user_id' => $user_id))->save();
          $faq_id = mysql_insert_id();
        })
        ->failure(function($item)use($data, $user_id, &$faq_id){
          $item->merge($data->having('page_id', 'title'))->merge(array('user_id' => $user_id))->save();
          $faq_id = $item->id->get('int');
        });

      //save item info
      // $item_info = tx('Sql')->table('text', 'ItemInfo')->where('item_id', "'{$item_id}'")->execute_single()->is('empty')
        // ->success(function()use($data, $item_id){
          // tx('Sql')->model('text', 'ItemInfo')->set($data->having('title', 'description', 'text'))->merge(array('language_id' => LANGUAGE))->merge(array('item_id' => $item_id))->save();
        // })
        // ->failure(function($item_info)use($data){
          // $item_info->merge($data->having('title', 'description', 'text'))->merge(array('language_id' => LANGUAGE))->save();
        // });

    })
    
    ->failure(function($info){
      throw $info->exception;
      tx('Controller')->message(array(
        'error' => $info->get_user_message()
      ));

    });

    echo $faq_id;exit;
    // tx('Url')->redirect(url('item_id=NULL'));
    
  }

  protected function save_item($data)
  {
    
    $item_id = 0;
    tx($data->id->get('int') > 0 ? 'Updating a faq item.' : 'Adding a new faq item', function()use($data, &$item_id){
      
      //append user object for easy access
      $user_id = tx('Data')->session->user->id;
      
      //save item
      $item = tx('Sql')->table('faq', 'FaqItems')->pk($data->id->get('int'))->execute_single()->is('empty')
        ->success(function()use($data, $user_id, &$item_id){
          tx('Sql')->model('faq', 'FaqItems')->merge($data->having('faq_id', 'question', 'answer'))->save();
          $item_id = mysql_insert_id();
        })
        ->failure(function($item)use($data, $user_id, &$item_id){
          $item->merge($data->having('faq_id', 'question', 'answer'))->save();
          $item_id = $item->id->get('int');
        });

    })
    
    ->failure(function($info){
      throw $info->exception;
      tx('Controller')->message(array(
        'error' => $info->get_user_message()
      ));

    });

    // echo $item_id;exit;
    tx('Url')->redirect(url('section=faq/item_list&item_id=NULL'));
    
  }

  protected function delete_item($data)
  {
    $item = tx('Sql')->table('faq', 'FaqItems')->pk($data->item_id)->execute_single()->is('empty', function()use($data){
      throw new \exception\User('Could not delete this item, because no entry was found in the database with id %s.', $data->id);
    })
    ->delete();
  }
 
}