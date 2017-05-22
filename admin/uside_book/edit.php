<form name="one" method="post" enctype="multipart/form-data" class="row">
  <fieldset>
    <?php
    u_message($t);
    $st = '<span style="color:red;">&nbsp;*</span>';
    ?>
    <input type="hidden" name="e" value="n">
    <input type="hidden" name="s">
    <input type="hidden" name="r" value="1">

    <!-- форма ввода отзывов -->
    <script>
    function store_(v)
    {
      document.one.s.value=v;
      document.one.r.value='';
      document.one.submit();
    };
    </script>
    <div id="comment-form-wrapper">
      <h3>Здесь вы можете задать ваш вопрос </h3>
      <div class="comment_form_holder">

          <label>Ваше имя:</label>
          <input type="text" name="author" class="full"  value="<?=vars('author')?>">

          <label>Ваш E-mail <span class="req">*</span></label>
          <input type="text" name="mail" class="full" value="<?=vars('mail')?>">

          <label>Сообщение <span class="req">*</span></label>
          <textarea id="message" name="message" class="full" cols="6" rows="10"><?=vars('message')?></textarea>

          <div class="captcha">
            <div class="captcha-wrapper">
              <img src="/secret/" style="display:inline-block;vertical-align:middle; margin-right:10px;"/>
              <input id="verify" class="verify" type="text" name="code" placeholder="Код проверки" style="width:150px !important; margin-bottom: 0px;">
            </div>
          </div><br>

          <button type="submit" onclick="javascript:store_(2);" class="btn btn-large">Отправить</button>

  </fieldset>
</form>
