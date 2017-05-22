<? if($rooms_item){ ?>
<div class="row" itemscope itemtype="http://schema.org/Product">
    <div class="span8">
        <!-- Slideshow -->
        <div class="callbacks_container">
            <ul class="rslides pic_slider callbacks callbacks1">
            <? if($rooms_item['pic'] && file_exists('images/rooms/'.$rooms_item['pic'].'.jpg')){ ?>
                <li id="callbacks1_s0" style="display: block; float: none; position: absolute; opacity: 0; z-index: 1; transition: opacity 500ms ease-in-out 0s;" class="">
                    <img itemprop="image" alt="" data-original="/images/rooms/<?=$rooms_item['pic']?>.jpg" src="/images/rooms/<?=$rooms_item['pic']?>.jpg" style="display: block;"></li>
            <? } ?>
            <? if($rooms_item['pic1'] && file_exists('images/rooms/'.$rooms_item['pic1'].'.jpg')){ ?>
                <li id="callbacks1_s1" style="float: none; position: absolute; opacity: 0; z-index: 1; display: list-item; transition: opacity 500ms ease-in-out 0s;" class="">
                    <img itemprop="image" alt="" data-original="/images/rooms/<?=$rooms_item['pic1']?>.jpg" src="/images/rooms/<?=$rooms_item['pic1']?>.jpg" style="display: block;"></li>
           <? } ?>
           <? if($rooms_item['pic2'] && file_exists('images/rooms/'.$rooms_item['pic2'].'.jpg')){ ?>
                <li id="callbacks1_s2" style="float: left; position: relative; opacity: 1; z-index: 2; display: list-item; transition: opacity 500ms ease-in-out 0s;" class="callbacks1_on">
                    <img itemprop="image" alt="" data-original="/images/rooms/<?=$rooms_item['pic2']?>.jpg" src="/images/rooms/<?=$rooms_item['pic2']?>.jpg" style="display: block;"></li>
            <? } ?>
            </ul>
            <a class="callbacks_nav callbacks1_nav prev" href="#">Previous</a>
            <a class="callbacks_nav callbacks1_nav next" href="#">Next</a>
        </div>
        <!-- Slideshow close --> </div>

    <div class="span4" style="padding-top: 0px;">
        <div class="room-description">
            <h3 class="span4" style="margin-left: 0px;padding-top: 0px; padding-bottom: 0px;" itemprop="name"><?=$rooms_item['name']?></h3>
            <h4 class="span4" style="margin-left: 0px; padding-top: 0px;">Описание</h4>
            <div itemprop="description"><?=$rooms_item['text']?></div>
        </div>
        <div class="row list-features">
            <h4 class="span4">Особенности</h4>
            <ul class="room-features">
                <?if($rooms_item['additional_space']){?>
                  <li class="span2"> <i class="icon-check-sign"></i>Дополнительное место</li>
               <? }else{ ?>
                  <li class="span2"> <i class="icon-check-empty"></i>Дополнительное место</li>
               <? } ?>
            </ul>
        </div>
        <!--<h4>Цена</h4>-->
        <div class="row">
            <div class="span2">
                <!--<div class="price-info" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                    <span class="price"><i class="fa fa-rub"></i> <span itemprop="price"><?=$rooms_item['price']?></span></span>
                    / Ночь
                </div>-->
            </div>
            <div class="span2 text-right">
                <!--<a class="btn btn-primary" href="/6/#booking_rooms">Бронировать номер</a>-->
				<a href="/bronirovanie?room-price=<?=$rooms_item['id_for_type_room']?>" target="_blank" onclick="yaCounter35070890.reachGoal('zakaz_piter_nachalo'); return true;" class="btn btn-primary">Бронировать</a>
            </div>
        </div>
    </div>
</div>

<hr>

<div class="row">
   <div class="text-center" style="margin-top: 40px;">
      <h2>Лучшие номера</h2>
      Выберите для себя наиболее подходящую комнату
      <br>
      <br></div>

   <!-- room -->
   <? foreach ($catalog_rooms as $row1) { ?>
   <div class="room span4">
      <div class="btn-book-container">
         <!--<a href="/6/#booking_rooms" class="btn-book">Бронировать</a>-->
		 <a href="/bronirovanie?room-price=<?=$row1['id_for_type_room']?>"  onclick="yaCounter35070890.reachGoal('zakaz_piter_nachalo'); return true;" target="_blank" class="btn-book">Бронировать</a>
      </div>
      <img data-original="/images/rooms/<?=$row1['pic']?>prev3x4.jpg" src="/images/rooms/<?=$row1['pic']?>prev3x4.jpg" class="img-polaroid" alt="">
      <h4><?=$row1['name'] ?></h4>
      <div class="description"><!--noindex--><p class="clip"><?=$row1['text'] ?></p><!--/noindex--></div>
      <div class="row">
         <ul class="room-features">
            <?if($row1['additional_space']){?>
               <li class="span2"> <i class="icon-check-sign"></i>Дополнительное место</li>
            <? }else{ ?>
               <li class="span2"> <i class="icon-check-empty"></i>Дополнительное место</li>
            <? } ?>
         </ul>
         <div class="clearfix"></div>
         <br>
         <div class="span2">
            <!--<div class="price-info">
               <span class="price"><i class="fa fa-rub"></i> <?=$row1['price']?></span> / Ночь
            </div>-->
         </div>
         <? $url = 'http://nsg.vps8.r70.ru/7/'.'?catalog_rooms_id='.$row1['id']; ?>
         <div class="span2 text-right">
            <a href="<?=$url?>" class="btn btn-primary">Подробнее</a>
         </div>
      </div>
   </div>
   <!-- close room -->
   <? } ?>
</div>

<? }else{ ?>
<div class="row">
   <div class="row room-list">
      <? foreach ($rooms as $row) { ?>
      <? $url = cms::sitemap_path(conf::$pathid).'?catalog_rooms_id='.$row['id']; ?>
      <!-- room -->
      <div class="room span4" itemscope itemtype="http://schema.org/Product">
         <div class="btn-book-container">
            <!--<a href="/6/#booking_rooms" class="btn-book">Бронировать</a>-->
			
			<a href="/bronirovanie?room-price=<?=$row['id_for_type_room']?>" target="_blank" class="btn-book">Бронировать</a>
         </div>
          <div class="img-reponsive2">
            <img itemprop="image" style="display: inline;" src="/images/rooms/<?=$row['pic']?>prev3x4.jpg" data-original="/images/rooms/<?=$row['pic']?>prev3x4.jpg" class="" alt="">
          </div>
         <h4 itemprop="name"><a href="<?=$url?>"><?=$row['name'] ?></a></h4>
         <!--<div class="description"><p class="clip"><?=$row['text']?></p></div>-->
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
      <? if($page->page_amount > 1){ ?>
        <div class="pagiation-page">
        <? $page->display(); ?>
        </div>
    <? } ?>
   </div>
</div>
<? } ?>

