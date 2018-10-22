<? if($rooms_item){ ?>
<div class="row">
    <div class="span8">
        <!-- Slideshow -->
        <div class="callbacks_container">
            <ul class="rslides pic_slider callbacks callbacks1">
            <? if($rooms_item['pic'] && file_exists('images/rooms/'.$rooms_item['pic'].'.jpg')){ ?>
                <li id="callbacks1_s0" style="display: block; float: none; position: absolute; opacity: 0; z-index: 1; transition: opacity 500ms ease-in-out 0s;" class="">
                    <img alt="" data-original="/images/rooms/<?=$rooms_item['pic']?>.jpg" src="/images/rooms/<?=$rooms_item['pic']?>.jpg" style="display: block;">
                </li>
            <? } ?>
            <? if($rooms_item['pic1'] && file_exists('images/rooms/'.$rooms_item['pic1'].'.jpg')){ ?>
                <li id="callbacks1_s1" style="float: none; position: absolute; opacity: 0; z-index: 1; display: list-item; transition: opacity 500ms ease-in-out 0s;" class="">
                    <img alt="" data-original="/images/rooms/<?=$rooms_item['pic1']?>.jpg" src="/images/rooms/<?=$rooms_item['pic1']?>.jpg" style="display: block;">
                </li>
           <? } ?>
           <? if($rooms_item['pic2'] && file_exists('images/rooms/'.$rooms_item['pic2'].'.jpg')){ ?>
                <li id="callbacks1_s2" style="float: left; position: relative; opacity: 1; z-index: 2; display: list-item; transition: opacity 500ms ease-in-out 0s;" class="callbacks1_on">
                    <img alt="" data-original="/images/rooms/<?=$rooms_item['pic2']?>.jpg" src="/images/rooms/<?=$rooms_item['pic2']?>.jpg" style="display: block;">
                </li>
            <? } ?>
            </ul>
            <a class="callbacks_nav callbacks1_nav prev" href="#">Previous</a>
            <a class="callbacks_nav callbacks1_nav next" href="#">Next</a>
        </div>
        <!-- Slideshow close --> </div>

    <div class="span4">
        <div class="room-description">
            <h4 class="span4" style="margin-left: 0px;">Описание</h4>
            <?=$rooms_item['text']?>
        </div>

        <div class="row list-features">
            <h4 class="span4">Особенности</h4>
            <ul class="room-features">
                <?if($row['additional_space']){?>
                  <li class="span2"> <i class="icon-check-sign"></i>Дополнительное место</li>
               <? }else{ ?>
                  <li class="span2"> <i class="icon-check-empty"></i>Дополнительное место</li>
               <? } ?>
            </ul>
        </div>

        <!--<h4>Прайс</h4>-->
        <div class="row">
            <div class="span2">
                <!--<div class="price-info">
                    <span class="price"><i class="fa fa-rub"></i> <?=$rooms_item['price']?></span>
                    / Ночь
                </div>-->
            </div>

            <div class="span2 text-right">
                <a class="btn btn-primary" href="/bronirovanie?room-price=<?=$rooms_item['id_for_type_room']?>">Бронировать номер</a>
            </div>
        </div>
    </div>
</div>
<? }else{?>
<div class="row">
   <div class="text-center" style="margin-top: 40px;">
      <h2>Лучшие номера</h2>
      Выберите для себя наиболее подходящую комнату
      <br><br>
   </div>
   <!-- room -->
   <? foreach ($catalog_rooms as $row) { ?>

      <? $url = 'https://nsgostdom.com/nomera/'.'?catalog_rooms_id='.$row['id']; ?>

   <div class="room span4" itemscope itemtype="http://schema.org/Product">
      <div class="btn-book-container">
         <a href="/bronirovanie?arrival-date-offset=0&nights=1" class="btn-book">Бронировать</a>
      </div>
       <a href="<?=$url?>"><img itemprop="image" data-original="/images/rooms/<?=$row['pic']?>prev3x4.jpg" src="/images/rooms/<?=$row['pic']?>prev3x4.jpg" alt=""></a>
      <h4 itemprop="name"><?=$row['name'] ?></h4>
      <!--<div class="description"><p class="clip"><?=$row['text'] ?></p></div>-->
      <div class="row">
         <ul class="room-features">
            <?if($row['additional_space']){?>
               <li class="span2"> <i class="icon-check-sign"></i>Дополнительное место</li>
            <? }else{ ?>
               <li class="span2"> <i class="icon-check-empty"></i>Дополнительное место</li>
            <? } ?>
         </ul>
         <div class="clearfix"></div>
         <br>
         <div class="span2">
            <!--<div class="price-info" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
               <span class="price"><i class="fa fa-rub"></i> <span itemprop="price"><?=$row['price']?></span></span> / Ночь
            </div>-->
         </div>
         <div class="span2 text-right">
            <a href="<?=$url?>" class="btn btn-primary">Подробнее</a>
         </div>
      </div>
   </div>
   <!-- close room -->
   <? } ?>
</div>
<? } ?>
<hr>

<div class="row" style="margin-bottom: 60px;">
   <div class="span3 feature">
      <i class="icon-desktop icon-3x"></i>
      <br>
      <h4><?=cms::display_content(5,true)?></h4>
      <?=cms::display_content(5)?>
   </div>
   <div class="span3 feature">
      <i class="icon-calendar icon-3x"></i>
      <br>
      <h4><?=cms::display_content(6,true)?></h4>
      <?=cms::display_content(6)?>
   </div>
   <div class="span3 feature">
      <i class="icon-circle-arrow-right icon-3x"></i>
      <br>
      <h4><?=cms::display_content(7,true)?></h4>
      <?=cms::display_content(7)?>
   </div>
   <div class="span3 feature">
      <i class="icon-thumbs-up icon-3x"></i>
      <br>
      <h4><?=cms::display_content(8,true)?></h4>
      <?=cms::display_content(8)?>
   </div>
</div>
</div>
