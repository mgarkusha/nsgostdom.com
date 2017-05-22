<?php if (!defined('SCRIPTACCESS')) exit; ?>
<? a_message($t); ?>
<? a_header(cms::module_name(MODULE) . ': редактирование'); ?>


<link type="text/css" rel="stylesheet" href="/style_booking/css/jquery.ui.core.css"/>
<link type="text/css" rel="stylesheet" href="/style_booking/css/jquery.ui.theme.css"/>
<link type="text/css" rel="stylesheet" href="/style_booking/css/jquery.ui.tabs.css"/>
<link type="text/css" rel="stylesheet" href="/style_booking/css/admin.css"/>
<link type="text/css" rel="stylesheet" href="/style_booking/css/jquary.ui.datepicker.css"/>
<link type="text/css" rel="stylesheet" href="/css/datepicker.min.css" />
<link type="text/css" rel="stylesheet" href="/css/datepicker3.min.css" />

<script type="text/javascript" src="/style_booking/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="/style_booking/js/admin-core.js"></script>
<script type="text/javascript" src="/style_booking/js/jquery.ui.core.min.js"></script>
<script type="text/javascript" src="/style_booking/js/jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="/style_booking/js/jquery.ui.tabs.min.js"></script>
<script type="text/javascript" src="/style_booking/js/jquery.ui.datepicker.min.js"></script>
<script type="text/javascript" src="/style_booking/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="/style_booking/js/adminBookings.js"></script>
<script type="text/javascript" src="/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="/js/bootstrap-datepicker.ru.js"></script>



<div id="container">
    <div class="page-box">


        <div class="page-top">
            <p class="page-title">
                <span class="title-left"></span>
                <a href="/admin/booking/?type=<?= vars('type') ?>"><span class="title-text">Редактирование забронированного номера</span></a>
                <span class="title-right"></span>
            </p>
        </div>

        <? if ($type == 'catalog_rooms') { ?>

        <div class="page-middle">
            <div id="content">
                <form method="post" id="frmUpdateBooking" class="form" name="one" enctype="multipart/form-data">

                    <script type="text/javascript">
                        function store_(v) {
                            document.one.r.value = '';
                            document.one.s.value = v;
                            document.one.submit();
                        }
                    </script>

                    <input type="hidden" name="r" value="1"/>
                    <input type="hidden" name="s"/>
                    <input type="hidden" name="e" value="<?= vars('e') ?>"/>
                    <input type="hidden" name="types" value="<?= $type ?>"/>

                    <p>
                        <label class="title">С даты</label>
                        <input type="text" name="dateIn" id="datepickerInRooms" class="text w80 required pointer datepick hasDatepicker"
                               value="<?= vars('dateIn') ?>">
                        <img class="ui-datepicker-trigger" src="/style_booking/calendar.png" alt="..." title="...">
                    </p>

                    <p>
                        <label class="title">По дату</label>
                        <input type="text" name="dateOut" id="datepickerOutRooms" class="text w80 required pointer datepick hasDatepicker"
                               value="<?= vars('dateOut') ?>">
                        <img class="ui-datepicker-trigger" src="/style_booking/calendar.png" alt="..." title="...">
                    </p>

                    <p><label class="title">Тип</label>
                        <select name="id_room" class="select w250">
                            <? foreach ($rooms as $row) { ?>
                                <option value="<?= $row['id'] ?>" <?=(vars('id_room') == $row['id'])?'selected':''?>><?= $row['name'] . ' - ' . $row['price'] . 'руб' ?></option>
                            <? } ?>
                        </select>
                    </p>
                    <p><label class="title">Метод оплаты</label>
                        <select name="payment" class="select w250">
                            <? $payments = array('Наличный','Безналичный'); ?>
                            <? foreach ($payments as $row) { ?>
                                <option value="<?= $row ?>" <?=(vars('payment') == $row)?'selected':''?>><?= $row?></option>
                            <? } ?>
                        </select>
                    </p>
                    <p><label class="title">Статус</label>
                        <select name="status" id="status" class="select w150 required">
                            <? foreach (conf::$status as $number => $row) { ?>
                                <option value="<?= $number ?>" <?=(vars('status') == $number)?'selected':''?>><?= $row?></option>
                            <? } ?>
                        </select>
                    </p>

                    <p>
                        <label class="title">ФИО</label>
                        <input type="text" name="fio" class="text w250" value="<?= vars('fio') ?>">
                    </p>

                    <p>
                        <label class="title">Телефон</label>
                        <input type="text" name="phone_number" class="text w250" value="<?= vars('phone_number') ?>">
                    </p>

                    <p>
                        <label class="title">Email адрес</label>
                        <input type="text" name="email" class="text w250" value="<?= vars('email') ?>">
                    </p>

                    <p>
                        <label class="title">Кол-во взрослых</label>
                        <input type="text" name="persons" class="text w250" value="<?= vars('persons') ?>">
                    </p>

                    <p>
                        <label class="title">Кол-во детей</label>
                        <input type="text" name="kids" class="text w250" value="<?= vars('kids') ?>">
                    </p>

                    <p>
                        <label class="title">&nbsp;</label>

                        <span class="title-left"></span>
                        <a href="../../admin/booking/"><span class="title-text">Назад</span></a>
                        <span class="title-right"></span>
                        <span class="title-left"></span>
                        <a href="?type=<?= vars('type') ?>&e=n" onclick="store_(1);return false"><span class="title-text">Сохранить</span></a>
                        <span class="title-right"></span>
                        <span class="title-left"></span>
                        <a href="#" onclick="store_(2);return false;"><span class="title-text">Сохранить и назад</span></a>
                        <span class="title-right"></span>
                        <span class="title-left"></span>
                        <a href='javascript:if(confirm("Вы действительно желаете удалить эту запись?"))document.location.href="?d=<?= $row['id'] ?>"'><span
                                class="title-text">Удалить запись</span></a>
                        <span class="title-right"></span>
                    </p>
                </form>
            </div> <!-- content -->
        </div>

        <? } ?>


        <? if ($type == 'excursions') { ?>

            <div class="page-middle">
                <div id="content">
                    <form method="post" id="frmUpdateBooking" class="form" name="one" enctype="multipart/form-data">

                        <script type="text/javascript">
                            function store_(v) {
                                document.one.r.value = '';
                                document.one.s.value = v;
                                document.one.submit();
                            }
                        </script>

                        <input type="hidden" name="r" value="1"/>
                        <input type="hidden" name="s"/>
                        <input type="hidden" name="e" value="<?= vars('e') ?>"/>
                        <input type="hidden" name="types" value="<?= $type ?>"/>

                        <p>
                            <label class="title">С даты</label>
                            <input type="text" name="dateIn" id="datepickerInExcursions" class="text w80 required pointer datepick hasDatepicker"
                                   value="<?= vars('dateIn') ?>">
                            <img class="ui-datepicker-trigger" src="/style_booking/calendar.png" alt="..." title="...">
                        </p>

                        <p><label class="title">Продолжительность</label>
                            <select name="id_excursions" class="select w250">
                                <? $select_id_excursions = vars('id_excursions') ?>
                                <? foreach ($excursions as $row) { ?>
                                    <option value="<?= vars('id_excursions') ?>"><?= $row['days'] . ' дней' ?></option>
                                <? } ?>
                            </select>
                        </p>

                        <p><label class="title">Группа</label>
                            <select name="id_excursions" class="select w250">
                                <? foreach ($excursions as $row) { ?>
                                    <option value="<?= $row['id'] ?>" <?=(vars('id_excursions') == $row['excursions'])?'selected':''?>><?= $row['group'] . ' - ' . $row['price'], 'руб' ?></option>
                                <? } ?>
                            </select>
                        </p>
                        <p><label class="title">Метод оплаты</label>
                            <select name="payment" class="select w250">
                                <? $payments = array('Наличный','Безналичный'); ?>
                                <? foreach ($payments as $row) { ?>
                                    <option value="<?= $row ?>" <?=(vars('payment') == $row)?'selected':''?>><?= $row?></option>
                                <? } ?>
                            </select>
                        </p>
                        <p><label class="title">Статус</label>
                            <select name="status" id="status" class="select w150 required">

                                <? foreach (conf::$status as $number => $row) { ?>
                                    <option value="<?= $number ?>" <?=(vars('status') == $number)?'selected':''?>><?= $row?></option>
                                <? } ?>
                            </select>
                        </p>

                        <p>
                            <label class="title">ФИО</label>
                            <input type="text" name="fio" class="text w250" value="<?= vars('fio') ?>">
                        </p>

                        <p>
                            <label class="title">Телефон</label>
                            <input type="text" name="phone_number" class="text w250" value="<?= vars('phone_number') ?>">
                        </p>

                        <p>
                            <label class="title">Email адрес</label>
                            <input type="text" name="email" class="text w250" value="<?= vars('email') ?>">
                        </p>

                        <p>
                            <label class="title">Кол-во взрослых</label>
                            <input type="text" name="persons" class="text w250" value="<?= vars('persons') ?>">
                        </p>

                        <p>
                            <label class="title">Кол-во детей</label>
                            <input type="text" name="kids" class="text w250" value="<?= vars('kids') ?>">
                        </p>

                        <p>
                            <label class="title">&nbsp;</label>

                            <span class="title-left"></span>
                            <a href="../../admin/booking/"><span class="title-text">Назад</span></a>
                            <span class="title-right"></span>
                            <span class="title-left"></span>
                            <a href="#" onclick="store_(1);return false"><span class="title-text">Сохранить</span></a>
                            <span class="title-right"></span>
                            <span class="title-left"></span>
                            <a href="#" onclick="store_(2);return false;"><span class="title-text">Сохранить и назад</span></a>
                            <span class="title-right"></span>
                            <span class="title-left"></span>
                            <a href='javascript:if(confirm("Вы действительно желаете удалить эту запись?"))document.location.href="?d=<?= $row['id'] ?>"'><span
                                    class="title-text">Удалить запись</span></a>
                            <span class="title-right"></span>
                        </p>
                    </form>
                </div> <!-- content -->
            </div>

        <? } ?>


        <? if ($type == 'cars') { ?>

            <div class="page-middle">
                <div id="content">
                    <form method="post" id="frmUpdateBooking" class="form" name="one" enctype="multipart/form-data">

                        <script type="text/javascript">
                            function store_(v) {
                                document.one.r.value = '';
                                document.one.s.value = v;
                                document.one.submit();
                            }
                        </script>

                        <input type="hidden" name="r" value="1"/>
                        <input type="hidden" name="s"/>
                        <input type="hidden" name="e" value="<?= vars('e') ?>"/>
                        <input type="hidden" name="types" value="<?= $type ?>"/>

                        <p>
                            <label class="title">С даты</label>
                            <input type="text" name="dateIn" id="datepickerInCars" class="text w80 required pointer datepick hasDatepicker"
                                   value="<?= vars('dateIn') ?>">
                            <img class="ui-datepicker-trigger" src="/style_booking/calendar.png" alt="..." title="...">
                        </p>

                        <p>
                            <label class="title">По дату</label>
                            <input type="text" name="dateOut" id="datepickerOutCars" class="text w80 required pointer datepick hasDatepicker"
                                   value="<?= vars('dateOut') ?>">
                            <img class="ui-datepicker-trigger" src="/style_booking/calendar.png" alt="..." title="...">
                        </p>

                        <p><label class="title">Наименование</label>
                            <select name="id_cars" class="select w250">
                                <? $select_id_room = vars('id_cars') ?>
                                <? foreach ($cars as $row) { ?>
                                    <option value="<?= $row['id'] ?>" <?=(vars('id_cars') == $row['id'])?'selected':''?>><?= $row['name'] . ' - ' . $row['price'], 'руб' ?></option>
                                <? } ?>
                            </select>
                        </p>
                        <p><label class="title">Метод оплаты</label>
                            <select name="payment" class="select w250">
                                <? $payments = array('Наличный','Безналичный'); ?>
                                <? foreach ($payments as $row) { ?>
                                    <option value="<?= $row ?>" <?=(vars('payment') == $row)?'selected':''?>><?= $row?></option>
                                <? } ?>
                            </select>
                        </p>
                        <p><label class="title">Статус</label>
                            <select name="status" id="status" class="select w150 required">

                                <? foreach (conf::$status as $number => $row) { ?>
                                    <option value="<?= $number ?>" <?=(vars('status') == $number)?'selected':''?>><?= $row?></option>
                                <? } ?>
                            </select>
                        </p>

                        <p>
                            <label class="title">ФИО</label>
                            <input type="text" name="fio" class="text w250" value="<?= vars('fio') ?>">
                        </p>

                        <p>
                            <label class="title">Телефон</label>
                            <input type="text" name="phone_number" class="text w250" value="<?= vars('phone_number') ?>">
                        </p>

                        <p>
                            <label class="title">Email адрес</label>
                            <input type="text" name="email" class="text w250" value="<?= vars('email') ?>">
                        </p>

                        <p>
                            <label class="title">Кол-во взрослых</label>
                            <input type="text" name="persons" class="text w250" value="<?= vars('persons') ?>">
                        </p>

                        <p>
                            <label class="title">Кол-во детей</label>
                            <input type="text" name="kids" class="text w250" value="<?= vars('kids') ?>">
                        </p>

                        <p>
                            <label class="title">&nbsp;</label>

                            <span class="title-left"></span>
                            <a href="../../admin/booking/"><span class="title-text">Назад</span></a>
                            <span class="title-right"></span>
                            <span class="title-left"></span>
                            <a href="#" onclick="store_(1);return false"><span class="title-text">Сохранить</span></a>
                            <span class="title-right"></span>
                            <span class="title-left"></span>
                            <a href="#" onclick="store_(2);return false;"><span class="title-text">Сохранить и назад</span></a>
                            <span class="title-right"></span>
                            <span class="title-left"></span>
                            <a href='javascript:if(confirm("Вы действительно желаете удалить эту запись?"))document.location.href="?d=<?= $row['id'] ?>"'><span
                                    class="title-text">Удалить запись</span></a>
                            <span class="title-right"></span>
                        </p>
                    </form>
                </div> <!-- content -->
            </div>

        <? } ?>

    </div>
</div>
