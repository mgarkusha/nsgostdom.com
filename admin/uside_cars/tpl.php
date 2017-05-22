<? if ($cars_item){ ?>
    <div class="row" itemscope itemtype="http://schema.org/Product">
        <div class="span7">
            <!-- Slideshow -->
            <div class="callbacks_container">
                <ul class="rslides pic_slider callbacks callbacks1">
                    <? if ($cars_item['pic'] && file_exists('images/cars/' . $cars_item['pic'] . '.jpg')) { ?>
                        <li id="callbacks1_s0"
                            style="display: block; float: none; position: absolute; opacity: 0; z-index: 1; transition: opacity 500ms ease-in-out 0s;"
                            class="">
                            <img itemprop="image" alt="" data-original="/images/cars/<?= $cars_item['pic'] ?>.jpg"
                                 src="/images/cars/<?= $cars_item['pic'] ?>.jpg" style="display: block;" class=""></li>
                    <? } ?>
                    <? if ($cars_item['pic1'] && file_exists('images/cars/' . $cars_item['pic1'] . '.jpg')) { ?>
                        <li id="callbacks1_s1"
                            style="float: none; position: absolute; opacity: 0; z-index: 1; display: list-item; transition: opacity 500ms ease-in-out 0s;"
                            class="">
                            <img itemprop="image" alt="" data-original="/images/cars/<?= $cars_item['pic1'] ?>.jpg"
                                 src="/images/cars/<?= $cars_item['pic1'] ?>.jpg" style="display: block;" class=""></li>
                    <? } ?>
                    <? if ($cars_item['pic2'] && file_exists('images/cars/' . $cars_item['pic2'] . '.jpg')) { ?>
                        <li id="callbacks1_s2"
                            style="float: left; position: relative; opacity: 1; z-index: 2; display: list-item; transition: opacity 500ms ease-in-out 0s;"
                            class="callbacks1_on">
                            <img itemprop="image" alt="" data-original="/images/cars/<?= $cars_item['pic2'] ?>.jpg"
                                 src="/images/cars/<?= $cars_item['pic2'] ?>.jpg" style="display: block;"></li>
                    <? } ?>
                </ul>
                <a class="callbacks_nav callbacks1_nav prev" href="#">Previous</a>
                <a class="callbacks_nav callbacks1_nav next" href="#">Next</a>
            </div>
            <!-- Slideshow close --> </div>

        <div class="span5">
            <div class="room-description">
                <h4 class="span5" style="margin-left: 0px;" itemprop="name"><?= $cars_item['name'] ?></h4>
                <h5 class="span5" style="margin-left: 0px;">Описание</h5>
                <div itemprop="description"><?= $cars_item['text'] ?></div>
            </div>
            <div class="row list-features">
                <ul class="room-features">
                    <li class="span6"><h5>Особенности</h5></li>
                    <? if ($cars_item['transmission']) { ?>
                        <li class="span3"><i class="icon-check-sign"></i>МКПП</li>
                    <? } else { ?>
                        <li class="span3"><i class="icon-check-empty"></i>МКПП</li>
                    <? } ?>
                    <? if ($cars_item['collateral']) { ?>
                        <li class="span3"><i class="icon-check-sign"></i>Без залога</li>
                    <? } else { ?>
                        <li class="span3"><i class="icon-check-empty"></i>Без залога</li>
                    <? } ?>
                    <? if ($cars_item['unlimited_mileage']) { ?>
                        <li class="span3"><i class="icon-check-sign"></i>Без ограничания пробега</li>
                    <? } else { ?>
                        <li class="span3"><i class="icon-check-empty"></i>Без ограничания пробега</li>
                    <? } ?>
                    <? if ($cars_item['transfer_cars']) { ?>
                        <li class="span3"><i class="icon-check-sign"></i>Передача в любой точке города</li>
                    <? } else { ?>
                        <li class="span3"><i class="icon-check-empty"></i>Передача в любой точке города</li>
                    <? } ?>
                    <li class="span6"><h5>Условия</h5></li>
                    <li class="span2"><i class="icon-check-sign"></i>Паспорт</li>
                    <li class="span2"><i class="icon-check-sign"></i>Гражданство РФ</li>
                </ul>
            </div>
            <h4>Цена</h4>

            <div class="row">
                <div class="span3">
                    <div class="price-info" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                        <span class="price"><i class="fa fa-rub" itemprop="priceCurrency"></i> <span itemprop="price"><?= $cars_item['price'] ?></span></span> / сутки
                    </div>
                </div>
                <div class="span2 text-right">
                    <a class="btn btn-primary" onclick="yaCounter35070890.reachGoal('zakaz_piter_nachalo'); return true;" href="/6/#booking_cars">Бронировать</a>
                </div>
            </div>
        </div>
    </div>
 

<? }else{ ?>


    <div class="row room-list">
        <? foreach ($cars as $row) { ?>
            <? $url = cms::sitemap_path(conf::$pathid).'?cars_id='.$row['id']; ?>
            <!-- room -->
            <div class="room span6" itemscope itemtype="http://schema.org/Product">
                <div class="btn-book-container">
                    <a href="/6/#booking_cars" onclick="yaCounter35070890.reachGoal('zakaz_piter_nachalo'); return true;" class="btn-book">Бронировать</a>
                </div>
                <div class="img-reponsive1">
                    <img itemprop="image" src="/images/cars/<?=$row['pic']?>.jpg" data-original="/images/cars/<?=$row['pic']?>.jpg"  alt="" style="display: inline;">
                </div>
                
                <h4 itemprop="name"><?=$row['name']?></h4>
				<!--
                <div class="description">
                    Описание описание описание описание описание описание описание описание описание описание описание
                </div>
				-->
                <div class="row">
                    <ul class="room-features">
                        <? if ($row['transmission']) { ?>
                            <li class="span6"><h5>Особенности</h5></li>
                            <li class="span3"><i class="icon-check-sign"></i>МКПП</li>
                        <? } else { ?>
                            <li class="span3"><i class="icon-check-empty"></i>МКПП</li>
                        <? } ?>
                        <? if ($row['collateral']) { ?>
                            <li class="span3"><i class="icon-check-sign"></i>Без залога</li>
                        <? } else { ?>
                            <li class="span3"><i class="icon-check-empty"></i>Без залога</li>
                        <? } ?>
                        <? if ($row['unlimited_mileage']) { ?>
                            <li class="span3"><i class="icon-check-sign"></i>Без ограничания пробега</li>
                        <? } else { ?>
                            <li class="span3"><i class="icon-check-empty"></i>Без ограничания пробега</li>
                        <? } ?>
                        <? if ($row['transfer_cars']) { ?>
                            <li class="span3"><i class="icon-check-sign"></i>Передача в любой точке города</li>
                        <? } else { ?>
                            <li class="span3"><i class="icon-check-empty"></i>Передача в любой точке города</li>
                        <? } ?>
                        <li class="span6"><h5>Условия</h5></li>
                        <li class="span2"><i class="icon-check-sign"></i>Паспорт</li>
                        <li class="span2"><i class="icon-check-sign"></i>Гражданство РФ</li>
                    </ul>
                    <div class="clearfix"></div>
                    <br>
                </div>
                <div class="span3 text-left">
                    <div class="price-info" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                        <span class="price"><span itemprop="priceCurrency"><i class="fa fa-rub"></i> </span><span itemprop="price"><?= $row['price'] ?></span></span> / сутки
                    </div>
                </div>
                <div class="span2 text-right">
                    <a href="<?=$url?>" class="btn btn-primary">Подробнее</a>
                </div>


            </div>
            <!-- close room -->
        <? } ?>
    </div>


<? } ?>