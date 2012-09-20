<?php namespace components\faq; if(!defined('TX')) die('No direct access.'); tx('Account')->page_authorisation(2);

?>

<div id="faq-item-list">

  <a href="<?php echo url('section=faq/edit_item&pid='.$item_list->faq->page_id); ?>" id="new-faq-item">Nieuw FAQ-item</a>

  <?php

  echo $item_list->items->as_table(array(
    'Vraag' => 'question',
    __('actions', 1) => array(
      function($row)use($item_list){return '<a class="edit" href="'.url('section=faq/edit_item&pid='.$item_list->faq->page_id.'&item_id='.$row->id).'">'.__('edit', true).'</a>';},
      function($row){return '<a class="delete" href="'.url('action=faq/delete_item&item_id='.$row->id).'">delete</a>';}
    )
  ));

  ?>

</div>

<script type="text/javascript">

$(function(){

  //delete and edit
  $("#faq-item-list")
  
    .on("click", ".edit, #new-faq-item", function(e){
  
      e.preventDefault();
      
      $.ajax({
        url: $(this).attr("href")
      }).done(function(d){
        $("#faq-item-list").replaceWith(d);
      });
  
    })
    
    /* ---------- Delete item ---------- */
    .on('click', ".delete", function(e){

      e.preventDefault();

      if(confirm("<?php __('Are you sure?'); ?>")){

        $(this).closest('tr').fadeOut();

        $.ajax({
          url: $(this).attr('href')
        });
      }

    });
  });

</script>