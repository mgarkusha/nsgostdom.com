<?php if (!defined('SCRIPTACCESS')) exit;
a_message($t);
a_header(cms::module_name(MODULE));

?>


<link type="text/css" rel="stylesheet" href="/style_booking/css/jquery.ui.core.css"/>
<link type="text/css" rel="stylesheet" href="/style_booking/css/jquery.ui.theme.css"/>
<link type="text/css" rel="stylesheet" href="/style_booking/css/jquery.ui.tabs.css"/>
<link type="text/css" rel="stylesheet" href="/style_booking/css/admin.css"/>
<link type="text/css" rel="stylesheet" href="/style_booking/css/jquery.ui.button.css"/>
<link type="text/css" rel="stylesheet" href="/style_booking/css/jquery.ui.dialog.css"/>
<!--<link type="text/css" rel="stylesheet" href="/style_booking/css/jquery.ui.datepicker.css"/>-->

<script type="text/javascript" src="/style_booking/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="/style_booking/js/admin-core.js"></script>
<script type="text/javascript" src="/style_booking/js/jquery.ui.core.min.js"></script>
<script type="text/javascript" src="/style_booking/js/jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="/style_booking/js/jquery.ui.tabs.min.js"></script>
<script type="text/javascript" src="/style_booking/js/jquery.ui.button.min.js"></script>
<script type="text/javascript" src="/style_booking/js/jquery.ui.position.min.js"></script>
<script type="text/javascript" src="/style_booking/js/jquery.ui.dialog.min.js"></script>
<script type="text/javascript" src="/style_booking/js/adminBookings.js"></script>



<div id="container">
    <div class="page-box">
        <div class="page-top">
            <div>
                <p class="page-title">
                    <span class="title-left"></span>
                    <a href="/admin/booking/?type=catalog_rooms"><span class="title-text">Номера</span></a>
                    <span class="title-right"></span>
                    <span class="title-left"></span>
                    <a href="/admin/booking/?type=excursions"><span class="title-text">Экскурсии</span></a>
                    <span class="title-right"></span>
                    <span class="title-left"></span>
                    <a href="/admin/booking/?type=cars"><span class="title-text">Автомобили</span></a>
                    <span class="title-right"></span>
                </p>
            </div>
            <div class="button_add">
                <p>
                    <span class="title-left"></span>
                    <a href="?type=<?= vars('type') ?>&e=n"><span class="title-text">Добавить</span></a>
                    <span class="title-right"></span>
                </p>
            </div>
        </div>

        <? if ($type == 'catalog_rooms') { ?>
            <h1 class="h1_booking">Список бронирования номеров</h1>
            <div class="page-middle">

                <div id="content">

                    <table class="table" cellpadding="0" cellspacing="0">
                        <thead>
                        <tr>
                            <th class="sub">Дата заявки</th>
                            <th class="sub">Дата (С - По)</th>
                            <th class="sub">Клиент</th>
                            <th class="sub">Номер</th>
                            <th class="sub">Люди</th>
                            <th class="sub">Статус</th>
                            <th class="sub" style="width: 7%"></th>
                            <th class="sub last" style="width: 8%"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <? foreach ($array as $row) { ?>
                            <tr class="even">
                                <td class="align_top nowrap"><?= $row['posted']?></td>
                                <td class="align_top nowrap" style="font-weight: bolder;"><?= $row['dateIn'].' - '.$row['dateOut'] ?></td>
                                <td class="align_top"><?= $row['fio'] ?><br/><span class="light-blue fs11"><?= $row['email'] ?></span><br/><span class="light-blue fs11"><?= $row['phone_number'] ?></span></td>
                                <td class="align_top">
                                    <? if ($row['value_1']) { ?>
                                        <div><?= $row['value_1']. ' - ' ?></div>
                                    <? } ?>
                                    <? if ($row['value_2']) { ?>
                                        <div><?= $row['value_2'].' руб' ?> </div>
                                    <? } ?>
                                </td>
                                <td class="align_top">Взрослые: <?= $row['persons'] ?><br/>Дети: <span><?= $row['kids'] ?></span></td>

                                <? if(conf::$status[$row['status']] == 'Новая заявка'){ ?>
                                    <td><span class="booking-status booking-status-pending"><?= conf::$status[$row['status']] ?></span></td>
                                <? } ?>
                                <? if(conf::$status[$row['status']] == 'Забронирован'){ ?>
                                    <td><span class="booking-status booking-status-confirmed"><?= conf::$status[$row['status']] ?></span></td>
                                <? } ?>
                                <? if(conf::$status[$row['status']] == 'Отменен'){ ?>
                                    <td><span class="booking-status booking-status-cancelled"><?= conf::$status[$row['status']] ?></span></td>
                                <? } ?>
                                <? if(conf::$status[$row['status']] == 'Оплачено'){ ?>
                                    <td><span class="booking-status booking-status-paid"><?= conf::$status[$row['status']] ?></span></td>
                                <? } ?>

                                <td><a class="icon" href="?type=<?= vars('type') ?>&e=<?= $row['id'] ?>">Ред.</a></td>
                                <td><a class="icon"
                                       href='javascript:if(confirm("Вы действительно желаете удалить эту запись?"))document.location.href="?d=<?= $row['id'] ?>"'>Удалить</a>
                                </td>
                            </tr>
                        <? } ?>
                        </tbody>
                    </table>


                </div> <!-- content -->
            </div> <!-- page-middle -->

        <? } ?>

        <? if ($type == 'excursions') { ?>
            <h1 class="h1_booking">Список бронирования экскурсий</h1>
            <div class="page-middle">
                <div id="content">
                    <table class="table" cellpadding="0" cellspacing="0">
                        <thead>
                        <tr>
                            <th class="sub">Дата заявки</th>
                            <th class="sub">Дата бронирования</th>
                            <th class="sub">Клиент</th>
                            <th class="sub">Группа</th>
                            <th class="sub">Люди</th>
                            <th class="sub">Статус</th>
                            <th class="sub" style="width: 7%"></th>
                            <th class="sub last" style="width: 8%"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <? foreach ($array as $row) { ?>
                            <tr class="even">
                                <td class="align_top nowrap"><?= $row['posted'] ?></td>
                                <td class="align_top nowrap" style="font-weight: bolder;"><?= $row['dateIn'] ?></td>
                                <td class="align_top"><?= $row['fio'] ?><br/><span class="light-blue fs11"><?= $row['email'] ?></span><br/><span
                                        class="light-blue fs11"><?= $row['phone_number'] ?></span></td>
                                <td class="align_top">
                                    <? if ($row['value_1']) { ?>
                                        <div><?= $row['value_1'] ?></div>
                                    <? } ?>
                                    <? if ($row['value_2']) { ?>
                                        <div><?= $row['value_2'] ?></div>
                                    <? } ?>
                                </td>
                                <td class="align_top">Взрослые: <?= $row['persons'] ?><br/>Дети: <span><?= $row['kids'] ?></span></td>
                                <? if(conf::$status[$row['status']] == 'Новая заявка'){ ?>
                                    <td><span class="booking-status booking-status-pending"><?= conf::$status[$row['status']] ?></span></td>
                                <? } ?>
                                <? if(conf::$status[$row['status']] == 'Забронирован'){ ?>
                                    <td><span class="booking-status booking-status-confirmed"><?= conf::$status[$row['status']] ?></span></td>
                                <? } ?>
                                <? if(conf::$status[$row['status']] == 'Отменен'){ ?>
                                    <td><span class="booking-status booking-status-cancelled"><?= conf::$status[$row['status']] ?></span></td>
                                <? } ?>
                                <? if(conf::$status[$row['status']] == 'Оплачено'){ ?>
                                    <td><span class="booking-status booking-status-paid"><?= conf::$status[$row['status']] ?></span></td>
                                <? } ?>
                                <td><a class="icon" href="?type=<?= vars('type') ?>&e=<?= $row['id'] ?>">Ред.</a></td>
                                <td><a class="icon"
                                       href='javascript:if(confirm("Вы действительно желаете удалить эту запись?"))document.location.href="?d=<?= $row['id'] ?>"'>Удалить</a>
                                </td>
                            </tr>
                        <? } ?>
                        </tbody>
                    </table>

                </div> <!-- content -->
            </div> <!-- page-middle -->

        <? } ?>

        <? if ($type == 'cars') { ?>
            <h1 class="h1_booking">Список бронирования автомобилей</h1>
            <div class="page-middle">

                <div id="content">

                    <table class="table" cellpadding="0" cellspacing="0">
                        <thead>
                        <tr>
                            <th class="sub">Дата заявки</th>
                            <th class="sub">Дата бронирования</th>
                            <th class="sub">Клиент</th>
                            <th class="sub">Автомобиль</th>
                            <th class="sub">Люди</th>
                            <th class="sub">Статус</th>
                            <th class="sub" style="width: 3%"></th>
                            <th class="sub last" style="width: 8%"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <? foreach ($array as $row) { ?>
                            <tr class="even">
                                <td class="align_top nowrap"><?= $row['posted'] ?></td>
                                <td class="align_top nowrap" style="font-weight: bolder;"><?= $row['dateIn'].' - '.$row['dateOut'] ?></td>
                                <td class="align_top"><?= $row['fio'] ?><br/><span class="light-blue fs11"><?= $row['email'] ?></span><br/><span
                                        class="light-blue fs11"><?= $row['phone_number'] ?></span></td>
                                <td class="align_top">
                                    <? if ($row['value_1']) { ?>
                                        <div><?= $row['value_1'] ?></div>
                                    <? } ?>
                                    <? if ($row['value_2']) { ?>
                                        <div><?= $row['value_2'] ?></div>
                                    <? } ?>
                                </td>
                                <td class="align_top">Взрослые: <?= $row['persons'] ?><br/>Дети: <span><?= $row['kids'] ?></span></td>
                                <? if(conf::$status[$row['status']] == 'Новая заявка'){ ?>
                                    <td><span class="booking-status booking-status-pending"><?= conf::$status[$row['status']] ?></span></td>
                                <? } ?>
                                <? if(conf::$status[$row['status']] == 'Забронирован'){ ?>
                                    <td><span class="booking-status booking-status-confirmed"><?= conf::$status[$row['status']] ?></span></td>
                                <? } ?>
                                <? if(conf::$status[$row['status']] == 'Отменен'){ ?>
                                    <td><span class="booking-status booking-status-cancelled"><?= conf::$status[$row['status']] ?></span></td>
                                <? } ?>
                                <? if(conf::$status[$row['status']] == 'Оплачено'){ ?>
                                    <td><span class="booking-status booking-status-paid"><?= conf::$status[$row['status']] ?></span></td>
                                <? } ?>
                                <td><a class="icon" href="?type=<?= vars('type') ?>&e=<?= $row['id'] ?>">Ред.</a></td>
                                <td><a class="icon"
                                       href='javascript:if(confirm("Вы действительно желаете удалить эту запись?"))document.location.href="?d=<?= $row['id'] ?>"'>Удалить</a>
                                </td>
                            </tr>
                        <? } ?>
                        </tbody>
                    </table>

                </div> <!-- content -->
            </div> <!-- page-middle -->

        <? } ?>


    </div> <!-- page-box -->
</div> <!-- container -->




