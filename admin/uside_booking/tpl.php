<div class="block-mobile-1">
    <?=cms::display_content(13)?>
</div>

<div class="block-mobile-2">
    <ul class="nav nav-tabs booking-tabs" style="margin-top: 20px;">
        <li class="active span3 text-center"><a data-toggle="tab" href="#booking_rooms">Номера</a></li>
        <li class="span3 text-center"><a data-toggle="tab" href="#booking_excursions">Экскурсии</a></li>
        <li class="span3 text-center"><a data-toggle="tab" href="#booking_cars">Автомобили</a></li>
    </ul>

    <div class="tab-content" style="margin-bottom: 50px;">
        <div id="booking_rooms" class="tab-pane fade in active" >
            <script>
                function showBookingForm(id) {
                    var o=document.getElementById(id)
                    o.style.display = (o.style.display == 'none')? 'block': 'none'
                }
            </script>
            <div class="booking-form">
                <!--
              <div class="span11" style="margin-top: 45px; margin-bottom: 25px;">

                  <a onclick="showBookingForm('tl-booking-form')"><div class="span3 room-button">Номер Люкс</div></a>
                  <a onclick="showBookingForm('tl-booking-form')"><div class="span3 room-button">Номер Полулюкс</div></a>
                  <a onclick="showBookingForm('tl-booking-form')"><div class="span3 room-button">Номер Стандарт</div></a>

                  <a href="?room-price=19657"><div class="span3 room-button">Номер Люкс</div></a>
                  <a href="?room-price=19656"><div class="span3 room-button">Номер Полулюкс</div></a>
                  <a href="?room-price=19655"><div class="span3 room-button">Номер Стандарт</div></a>
              </div>
              -->
                <div class="clearfix"></div>

                <? //if(isset($_GET['room-price'])){ ?>
                <!-- start booking form 2.0 -->
                <div id="tl-booking-form"></div>
                <script type="text/javascript">
                    (function(w){
                        var q=[
                            ['setContext', 'TL-INT-nsgostdom', 'ru'],
                            ['embed', 'booking-form', {container: 'tl-booking-form'}]
                        ];
                        var t=w.travelline=(w.travelline||{}),ti=t.integration=(t.integration||{});ti.__cq=ti.__cq?ti.__cq.concat(q):q;
                        if (!ti.__loader){ti.__loader=true;var d=w.document,p=d.location.protocol,s=d.createElement('script');s.type='text/javascript';s.async=true;s.src=(p=='https:'?p:'http:')+'//ibe.tlintegration.com/integration/loader.js';(d.getElementsByTagName('head')[0]||d.getElementsByTagName('body')[0]).appendChild(s);}
                    })(window);
                </script>
                <!-- end booking form 2.0 -->
                <? //} ?>
            </div>
        </div>


        <div id="booking_excursions" class="tab-pane fade">
            <h3>Бронирование экскурсии</h3>
            <div class="booking-form">
                <form name="booking_excursion" method="post" enctype="multipart/form-data" id="booking-excursion-form">
                    <div class="span9">
                        <div class="more-msg"></div>
                        <h5 class="title span9"><b>Персональные данные</b></h5>

                        <input type="hidden" name="type" value="excursions">
                        <input type="hidden" name="status" value="1">

                        <div class="span4">
                            <span class="text-label"><i class=" icon-user"></i>ФИО<span class="req">*</span></span>
                            <input type="text" name="fio" value="<?= vars('fio') ?>">
                        </div>
                        <div class="span4">
                            <span class="text-label"> <i class="icon-envelope-alt"></i>Email<span class="req">*</span></span>
                            <input type="text" name="email" value="<?= vars('email') ?>">
                        </div>
                        <div class="span4">
                            <span class="text-label"> <i class="icon-phone"></i>Телефон<span class="req">*</span></span>
                            <input type="text" name="phone_number" value="<?= vars('phone_number') ?>">
                        </div>
                        <h5 class="title span9"><b>Пребывание</b></h5>

                        <div class="span4">
                            <span class="text-label"><i class="icon-calendar"></i> Дата заезда</span>
                            <input type="text" id="datepickerInExcursions" name="dateIn" value="<?= vars('dateIn') ?>" required>
                        </div>
                        <div class="span4">
                            <span class="text-label"><i class="icon-calendar"></i>Кол-во суток</span>
                            <select name="id_excursions" required>
                                <? foreach ($excursions as $row) { ?>
                                    <option value="<?= $row['id'] ?>"><?= $row['group'] . ' чел. - ' . $row['price'], 'руб./' ?><?= $row['days'] . ' дн. ' ?></option>
                                <? } ?>
                            </select>
                        </div>
                        <div class="span4">
                            <span class="text-label"><i class="icon-user"></i>Взрослые(кол-во)</span>
                            <input name="persons" type="number" max="10" min="0" value="<?= $_POST['persons'] ?>"></div>
                        <div class="span4">
                            <span class="text-label"><i class="icon-user"></i>Дети(кол-во)</span>
                            <input name="kids" type="number" max="10" min="0" value="<?= $_POST['kids'] ?>">
                        </div>

                        <div class="span4">
                            <span class="text-label"><i class="icon-money"></i>Оплата</span>
                            <select name="payment">
                                <option value="Наличный">Наличный</option>
                                <option value="Безналичный">Безналичный</option>
                            </select>
                        </div>
                    </div>
                    <div class="span3 btn-book-submit" style="margin-left: 0px;">
                        <div class="captcha-wrapper">
                            <img src="/secret/" style="display:inline-block;vertical-align:middle; margin-right:10px;"/>
                            <input id="verify" class="verify" type="text" name="code" placeholder="Код проверки"
                                   style="width:110px !important; margin-bottom: 0px;"></div>
                        </br>
                        <input type="button" onclick="send_booking($('#booking-excursion-form'));return false; yaCounter35070890.reachGoal('zakaz_piter_konec'); return true;" value="Забронировать" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
        <div id="booking_cars" class="tab-pane fade">
            <h3>Бронирование автомобиля</h3>

            <div class="booking-form">
                <form name="booking_cars" method="post" enctype="multipart/form-data" id="booking-cars-form">
                    <div class="span9">
                        <div class="more-msg"></div>

                        <input type="hidden" name="type" value="cars">
                        <input type="hidden" name="status" value="1">

                        <h5 class="title span9"><b>Персональные данные</b></h5>

                        <div class="span4">
                            <span class="text-label"><i class=" icon-user"></i>ФИО<span class="req">*</span></span>
                            <input type="text" name="fio" value="<?= vars('fio') ?>">
                        </div>
                        <div class="span4">
                            <span class="text-label"> <i class="icon-envelope-alt"></i>Email<span class="req">*</span></span>
                            <input type="text" name="email" value="<?= vars('email') ?>">
                        </div>
                        <div class="span4">
                            <span class="text-label"> <i class="icon-phone"></i>Телефон<span class="req">*</span></span>
                            <input type="text" name="phone_number" value="<?= vars('phone_number') ?>">
                        </div>
                        <h5 class="title span9"><b>Пребывание</b></h5>

                        <div class="span4">
                            <span class="text-label"><i class="icon-calendar"></i> Дата заезда</span>
                            <input type="text" id="datepickerInCars" name="dateIn" value="<?= vars('dateIn') ?>" required>
                        </div>
                        <div class="span4">
                            <span class="text-label"><i class="icon-calendar"></i> Дата выезда</span>
                            <input type="text" id="datepickerOutCars" name="dateOut" value="<?= vars('dateOut') ?>" required>
                        </div>
                        <div class="span4">
                            <span class="text-label"><i class="icon-suitcase"></i>Автомобиль</span>
                            <select name="id_cars" required>
                                <? foreach ($cars as $row) { ?>
                                    <option value="<?= $row['id'] ?>"><?= $row['name'] . ' - ' . $row['price'], 'руб' ?></option>
                                <? } ?>
                            </select>
                        </div>

                        <div class="span4">
                            <span class="text-label"><i class="icon-money"></i>Оплата</span>
                            <select name="payment">
                                <option value="Наличный">Наличный</option>
                                <option value="Безналичный">Безналичный</option>
                            </select>
                        </div>
                    </div>
                    <div class="span3 btn-book-submit" style="margin-left: 0px;">
                        <div class="captcha-wrapper">
                            <img src="/secret/" style="display:inline-block;vertical-align:middle; margin-right:10px;"/>
                            <input id="verify" class="verify" type="text" name="code" placeholder="Код проверки"
                                   style="width:110px !important; margin-bottom: 0px;"></div>
                        </br>
                        <input type="button" onclick="send_booking($('#booking-cars-form'));return false; yaCounter35070890.reachGoal('zakaz_piter_konec'); return true;" value="Забронировать" class="btn btn-primary">
                    </div>
                </form>
            </div>

        </div>

    </div>

</div>





