<?php

echo
  '<h1>'.$faq->faq->title.'</h1>';

$faq->items->each(function($item){

  echo '
    <section class="faq-item">
      <h1 class="title">'.$item->question.'</h1>
      <div class="answer">'.$item->answer.'</div>
    </section>
    ';

});

?>

<script type="text/javascript">

$(function(){

  $('.faq-item .answer').hide();
  $('.faq-item .title').click(function(){
    $(this).next().slideToggle('fast');
  }); 

});

</script>

<style type="text/css">

.faq-item .title{
  cursor:pointer;
}
.faq-item .title:hover{
  color:#000;
}

</style>