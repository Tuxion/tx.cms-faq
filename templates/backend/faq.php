<?php namespace components\faq; if(!defined('TX')) die('No direct access.');

$form_id = 'faq'.time(); 
?>
<form id="form-faq" method="post" action="<?php echo url('action=faq/save_faq/post'); ?>" class="form-inline-elements">

  <input type="hidden" name="id" value="<?php echo $faq->faq->id; ?>" />
  <input type="hidden" name="page_id" value="<?php echo $faq->faq->page_id; ?>" />
  
  <div class="ctrlHolder">
    <label>Titel van FAQ</label>
    <input type="text" name="title" value="<?php echo $faq->faq->title; ?>" class="big" />
  </div>

  <br />

  <?php
  if($faq->faq->id->get('int') > 0)
    echo $faq->item_list;
  ?>

</form>

<script type="text/javascript">

//create save method
var com_cms = (function(TxComCms){

  TxComCms.init_com_faq = function(){

    //fill page_id
    $("#form-faq").find("input[name=page_id]").val($("#edit_page").find("input[name=page_id]").attr("value"));

    return this;
  
  }
    
  //public save_menu_item()
  TxComCms.save_page_content = function(){
    $("#form-faq").ajaxSubmit(function(data){
      $("#form-faq").find("input[name=id]").val(data);
    });
    return this;
  }
  
  return TxComCms;

})(com_cms||{});

com_cms.init_com_faq();

</script>