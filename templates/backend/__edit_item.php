<?php namespace components\account; if(!defined('TX')) die('No direct access.'); tx('Account')->page_authorisation(2);
$form_id = tx('Security')->random_string(20);
?>

<div id="faq-item-form">

  <h3>Nieuw FAQ-item</h3>

  <form method="post" id="<?php echo 'form'.$form_id; ?>" action="<?php echo url('action=faq/save_item/post'); ?>" class="form edit-faq-item-form">

    <input type="hidden" name="id" value="<?php echo $edit_item->item->id ?>" />
    <input type="hidden" name="faq_id" value="<?php echo $edit_item->faq->id; ?>" />

    <div class="ctrlHolder">
      <label for="l_question" accesskey="q"><?php __('Question'); ?></label>
      <input class="big large" type="text" id="l_question" name="question" value="<?php echo $edit_item->item->question; ?>" required />
    </div>

    <div class="ctrlHolder">
      <label for="l_answer" accesskey="a"><?php __('Answer'); ?></label>
      <textarea name="answer" id="<?php echo 'editor'.$form_id; ?>" class="editor"><?php echo $edit_item->item->answer; ?></textarea>
    </div>

    <div class="buttonHolder">
      <input class="primaryAction button black" type="submit" value="<?php __('Save'); ?>" />
    </div>

  </form>

</div>

<script type="text/javascript">

$(function(){

  //init editor
  tx_editor.init({selector:"#<?php echo 'editor'.$form_id; ?>"});

  //submit form
  $("#form<?php echo $form_id; ?>").on("submit", function(e){

    e.preventDefault();
  
    $("#form<?php echo $form_id; ?>").ajaxSubmit(function(d){
      $('#faq-item-form').replaceWith(d);
    });

  });
  
});
</script>
