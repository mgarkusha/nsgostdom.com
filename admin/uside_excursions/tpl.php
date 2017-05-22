<? if ($excurs_item){ ?>
    <div class="row" itemscope itemtype="http://schema.org/Product">
        <div class="span7">
            <!-- Slideshow -->
            <div class="callbacks_container">
                <ul class="rslides pic_slider callbacks callbacks1">
                    <? if ($excurs_item['pic'] && file_exists('images/excursions/' . $excurs_item['pic'] . '.jpg')) { ?>
                        <li id="callbacks1_s0"
                            style="display: block; float: none; position: absolute; opacity: 0; z-index: 1; transition: opacity 500ms ease-in-out 0s;"
                            class="">
                            <img itemprop="image" alt="" data-original="/images/excursions/<?= $excurs_item['pic'] ?>.jpg"
                                 src="/images/excursions/<?= $excurs_item['pic'] ?>.jpg" style="display: block;"></li>
                    <? } ?>
                    <? if ($excurs_item['pic1'] && file_exists('images/excursions/' . $excurs_item['pic1'] . '.jpg')) { ?>
                        <li id="callbacks1_s1"
                            style="float: none; position: absolute; opacity: 0; z-index: 1; display: list-item; transition: opacity 500ms ease-in-out 0s;"
                            class="">
                            <img itemprop="image" alt="" data-original="/images/excursions/<?= $excurs_item['pic1'] ?>.jpg"
                                 src="/images/excursions/<?= $excurs_item['pic1'] ?>.jpg" style="display: block;"></li>
                    <? } ?>
                    <? if ($excurs_item['pic2'] && file_exists('images/excursions/' . $excurs_item['pic2'] . '.jpg')) { ?>
                        <li id="callbacks1_s2"
                            style="float: left; position: relative; opacity: 1; z-index: 2; display: list-item; transition: opacity 500ms ease-in-out 0s;"
                            class="callbacks1_on">
                            <img itemprop="image" alt="" data-original="/images/excursions/<?= $excurs_item['pic2'] ?>.jpg"
                                 src="/images/excursions/<?= $excurs_item['pic2'] ?>.jpg" style="display: block;"></li>
                    <? } ?>
                </ul>
                <a class="callbacks_nav callbacks1_nav prev" href="#">Previous</a>
                <a class="callbacks_nav callbacks1_nav next" href="#">Next</a>
            </div>
            <!-- Slideshow close --> </div>

        <div class="span5">
            <div class="room-description">
                <h4 class="span5" style="margin-left: 0px;" itemprop="name">Группа: <?= $excurs_item['group'] ?> человек</h4>
                <h5 class="span5" style="margin-left: 0px;">Описание</h5>
                <div itemprop="description"><?= $excurs_item['text'] ?></div>
            </div>
            <div class="row list-features">
                <ul class="room-features">
                    <li class="span4"><h5>В стоимость путевки входит:</h5></li>
                    <? if ($excurs_item['accommodation']) { ?>
                        <li class="span3"><i class="icon-check-sign"></i>проживание в двухместном номере категории стандарт</li>
                    <? } else { ?>
                        <li class="span3"><i class="icon-check-empty"></i>проживание в двухместном номере категории стандарт</li>
                    <? } ?>
                    <? if ($excurs_item['breakfast']) { ?>
                        <li class="span3"><i class="icon-check-sign"></i>завтрак</li>
                    <? } else { ?>
                        <li class="span3"><i class="icon-check-empty"></i>завтрак</li>
                    <? } ?>
                    <? if ($excurs_item['excursions']) { ?>
                        <li class="span3"><i class="icon-check-sign"></i>экскурсионное обслуживание (услуги экскурсовода, автобус)</li>
                    <? } else { ?>
                        <li class="span3"><i class="icon-check-empty"></i>экскурсионное обслуживание (услуги экскурсовода, автобус)</li>
                    <? } ?>
                    <? if ($excurs_item['tickets']) { ?>
                        <li class="span3"><i class="icon-check-sign"></i>входные билеты в музеи (кроме рекомендованных к самостоятельному просмотру)</li>
                    <? } else { ?>
                        <li class="span3"><i class="icon-check-empty"></i>входные билеты в музеи (кроме рекомендованных к самостоятельному просмотру)</li>
                    <? } ?>
                </ul>
            </div>
            <h4>Цена</h4>

            <div class="row">
                <div class="span3">
                    <div class="price-info" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                        <span class="price"><i class="fa fa-rub"></i> <span itemprop="price"><?= $excurs_item['price'] ?></span></span>
                        / <?= $excurs_item['days'] ?> суток
                    </div>
                </div>
                <div class="span2 text-right">
                    <a class="btn btn-primary" onclick="yaCounter35070890.reachGoal('zakaz_piter_nachalo'); return true;" href="/6/#booking_excursions">Бронировать</a>
                </div>
            </div>
        </div>
    </div>
    <hr>

<? }else{ ?>

<div style="margin-bottom: 50px;"><?=cms::display_content(12)?></div>
<div class="row room-list">
    <? foreach ($excurs as $row) { ?>
    <? $url = cms::sitemap_path(conf::$pathid).'?excursions_id='.$row['id']; ?>
    <!-- room -->
    <div class="room span6" itemscope itemtype="http://schema.org/Product">
        <div class="btn-book-container">
            <a href="/6/#booking_excursions" onclick="yaCounter35070890.reachGoal('zakaz_piter_nachalo'); return true;" class="btn-book">Бронировать</a>
        </div>
        <div class="img-reponsive1">
            <img itemprop="image" src="/images/excursions/<?=$row['pic']?>.jpg" data-original="/images/excursions/<?=$row['pic']?>.jpg" class="" alt="" style="display: inline;">
        </div>
        <h4 itemprop="name">Группа: <?= $row['group']?> человек</h4>
		<!--
        <div class="description">
            Описание описание описание описание описание описание описание описание описание описание описание
        </div>
		-->
        <div class="row">
            <ul class="room-features">
                <li class="span6"><h5>В стоимость путевки входит:</h5></li>
                <? if ($row['accommodation']) { ?>
                    <li class="span6"><i class="icon-check-sign"></i>проживание в двухместном номере категории стандарт</li>
                <? } else { ?>
                    <li class="span6"><i class="icon-check-empty"></i>проживание в двухместном номере категории стандарт</li>
                <? } ?>
                <? if ($row['breakfast']) { ?>
                    <li class="span6"><i class="icon-check-sign"></i>завтрак</li>
                <? } else { ?>
                    <li class="span6"><i class="icon-check-empty"></i>завтрак</li>
                <? } ?>
                <? if ($row['excursions']) { ?>
                    <li class="span6"><i class="icon-check-sign"></i>экскурсионное обслуживание (услуги экскурсовода, автобус)</li>
                <? } else { ?>
                    <li class="span6"><i class="icon-check-empty"></i>экскурсионное обслуживание (услуги экскурсовода, автобус)</li>
                <? } ?>
                <? if ($row['tickets']) { ?>
                    <li class="span6"><i class="icon-check-sign"></i>входные билеты в музеи (кроме рекомендованных к самостоятельному просмотру)</li>
                <? } else { ?>
                    <li class="span6"><i class="icon-check-empty"></i>входные билеты в музеи (кроме рекомендованных к самостоятельному просмотру)</li>
                <? } ?>
            </ul>
            <div class="clearfix"></div>
            <br>
        </div>
        <div class="span3 text-left">
            <div class="price-info" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                <span class="price"><i class="fa fa-rub"></i> <span itemprop="price"><?=$row['price']?></span></span> / <?=$row['days']?> суток
            </div>
        </div>
        <div class="span2 text-right">
            <a href="<?=$url?>" class="btn btn-primary">Подробнее</a>
        </div>


    </div>
    <!-- close room -->
    <? } ?>
</div>
    <hr>

<? } ?>
