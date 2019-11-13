<?php if (!defined('SCRIPTACCESS'))
exit; ?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <title><?= conf::$title ?></title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="description" content="<?= conf::$description ?>">
   <meta name="keywords" content="<?= conf::$key_words ?>">
   <meta name="author" content="">
   <meta name='yandex-verification' content='5aae979ef6e4f24e' />
   <meta name="google-site-verification" content="Oh_nsQ2lD82Q4gY07pwdiJGvukb9pf-9RrPBOING0ZI" />
   <meta name='wmail-verification' content='61de4b0c23b4067577c476348dfe25f3' />
   <link rel="icon" href="https://nsgostdom.com/favicon.ico" type="image/x-icon">
   <link rel="shortcut icon" href="https://nsgostdom.com/short-favicon.ico" type="image/x-icon">
   <!-- LOAD CSS FILES -->
   <link href="/css/main.css" rel="stylesheet" type="text/css">
   <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">


   <!-- LOAD JS FILES -->
   <script src="/js/jquery.min.js"></script>
   <script src="/js/bootstrap.min.js"></script>
   <script src="/js/jquery.isotope.min.js"></script>
   <script src="/js/jquery.prettyPhoto.js"></script>
   <script src="/js/easing.js"></script>
   <script src="/js/jquery.lazyload.js"></script>
   <script src="/js/jquery.ui.totop.js"></script>
   <script src="/js/selectnav.js"></script>
   <script src="/js/ender.js"></script>
   <script src="/js/custom.js"></script>
   <script src="/js/responsiveslides.min.js"></script>
   <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>


   <link rel="stylesheet" href="/css/datepicker.min.css" />
   <link rel="stylesheet" href="/css/datepicker3.min.css" />

   <script src="/js/bootstrap-datepicker.min.js"></script>
   <script src="/js/bootstrap-datepicker.ru.js"></script>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(39735600, "init", {
        id:39735600,
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/39735600" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-115853123-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-115853123-1');
</script>
</head>

<body onload="set_height()">
   <div id="main-wrap">
      <!-- header begin -->
      <header>
         <div id="logo">
            <div class="inner">
               <a href="/"><img src="/img/logo_1.png" alt=""></a>
            </div>
         </div>
		<div class="header-contacts">
			<span itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress"><span itemprop="streetAddress"><p><strong>Адрес</strong>: г. Санкт-Петербург, Новосельковская, д. 18</p></span></span>
			<span itemprop="telephone"><p><strong>Телефоны</strong>: +7 (812)&nbsp;304-35-41, +7 (931)&nbsp;335-18-38 </p></span>
			<span itemprop="email"><strong>Email</strong>: ns.gostevoydom@mail.ru</span>
		</div>
		<!--<a href="/novogodnee-predlozhenie">
			<div class="new-year">
				<img class="left-new-year" src="/images/vetka.png">
				<div class="text">НОВЫЙ ГОД 2017</div>
				<img class="right-new-year" src="/images/vetka.png">
			</div>
		</a>-->
		<!--<a href="/shkolnye-kanikuly">
			<div class="kanikuly">
				<img class="left-listik" src="/images/podsneg.png">
				<div class="text-2"><p>Школьные каникулы</p><p> в Питере</p></div>
				<img class="right-listik" src="/images/podsneg.png">
			</div>
		</a>-->
       <div class="header-phone">
           <!--<a href="tel:+78123043541">+7(812)304-35-41</a><br><br><a href="tel:+79313351838">+7(931)335-18-38</a>-->
           <address itemscope itemtype="http://schema.org/Organization">
                                             <span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress"><span itemprop="streetAddress"><p><strong>Адрес</strong>: г. Санкт-Петербург, Новосельковская, д. 18</p></span></span>
                                             <span itemprop="telephone"><p><strong>Телефон</strong>: +7 (812) 304-35-41,<br /><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;+7 (931)&nbsp;335 18 38</span></p></span>
                                             <span itemprop="email"><strong>Email</strong>: ns.gostevoydom@mail.ru</span>
                                       </address>
       </div>
        <div class="awards">
            <img class="booking-com" src="/images/booking_small.jpg" alt="Guest Review Awards 9,0 в 2018 году!" title="Guest Review Awards 9,0 в 2018 году!">
            <img class="booking-com" src="/images/101-hotel-recomend.jpg" alt="101 отель рекомендует нас!" title="101 отель рекомендует нас!">
            <img class="booking-com" src="https://amigohostels.com/images/banners/blue-square.jpg" title="AmigoHostels.com рекомендует нас!">
        </div>
         <!-- mainmenu begin -->
         <div id="mainmenu-container">
            <ul id="mainmenu">
               <? foreach($menu as $item){ ?>
                  <li>
                     <a href="<?=cms::sitemap_path($item['id'])?>"><?=$item['name']?></a>
                     <? $parents = get_sitemap_parents($item['id'])?>
                     <? if($parents){ ?>
                        <ul>
                           <? foreach($parents as $parent){ ?>
                              <li><a href="<?=cms::sitemap_path($parent['id'])?>"><?=$parent['name']?></a></li>
                              <? } ?>
                           </ul>
                           <? } ?>
                        </li>
                        <? } ?>
                     </ul>
                  </div>
               </header>
               <!-- header close -->

               <? if(conf::$pathid != 1){ ?>

                  <!-- subheader begin -->

                  <div id="subheader">
                     <div class="container">
                        <div class="row">
                           <div class="span6">
                              <h1><?= conf::$header ?></h1>
                           </div>
                           <div class="span6" style="text-align: right; margin-top: 10px;">
                              <?=generate_breadcrumb()?>
                           </div>
                        </div>
                     </div>
                  </div>
                  <? } ?>
                  <!-- subheader close -->
                  <? if(conf::$pathid == 1){ ?>

                     <? if ($slider) { ?>
                        <!-- flexslider -->
                        <div id="slider">
                           <div class="callbacks_container" style="margin-bottom: 40px;">
                              <ul class="rslides pic_slider">
                                 <? foreach ($slider as $row) { ?>
                                    <li>
                                       <img src="/images/slider/<?= $row['pic'] ?>.jpg" alt="">

                                       <? if(!empty($row['url'])){ ?>
                                          <a href="<?= $row['url']?>">
                                             <div class="slider-info">
                                                <? if(!empty($row['text'])){ ?>
                                                   <h1 class="slider_font"><?= $row['text'] ?></h1>
                                                <? } ?>
                                             </div>
                                          </a>
                                       <? }else{ ?>
                                          <div class="slider-info">
                                             <? if(!empty($row['text'])){ ?>
                                                <h1 class="slider_font"><?= $row['text'] ?></h1>
                                             <? } ?>
                                          </div>
                                       <? } ?>

                                    </li>
                                    <? } ?>
                                 </ul>
                              </div>
                           </div>
                           <? } ?>


                           <!-- search begin -->
                           <div id="content">
                              <div id="booking">
                                 <div class="container text-center">
                                    <div class="row text-center">
                                       <span class="span3">Забронировать сейчас:</span>
                                       <form id="form-fbooking" method="post" enctype="multipart/form-data">

                                          <div class="span3">
                                             <select id="fbooking">
                                                <option value="/6/#booking_rooms">Номер в гостевом доме</option>
                                                <!--<option value="/6/#booking_excursions">Экскурсию</option>
                                                <option value="/6/#booking_cars">Автомобиль</option>-->
                                             </select>
                                          </div>

                                          <div class="span3">
                                             <input type="button" value="Перейти"  onclick = "window.location = document.forms[0].fbooking.options[document.forms[0].fbooking.selectedIndex].value"  class="btn btn-pimary btn-submit"/>
                                          </div>
                                       </form>
                                    </div>
                                 </div>
                              </div>
                              <!-- search close -->
                              <? } ?>


                        <div class="content-main">
                           <? if(conf::$pathid == 4){ ?>

								<? include CONTENT; ?>
								<?}else{?>
                                 <div id="content">
                                    <div class="container">
                                       <? include CONTENT; ?>
                                    </div>
                                 </div>
                                 <? } ?>
                              </div>

                              <!-- content close -->

                           </div>
                           <!-- footer begin -->
                           <footer>
                              <div class="container" style="padding-bottom: 15px;">
                                 <div class="row">
                                    <div class="span3">
                                       <a href="/"><img src="/img/logo_1.png" alt=""></a>
                                    </div>
                                    <div class="span5">
									
									
									<?
										if ($_SERVER['REQUEST_URI']=='/')
									{?>
										<h3>О нас</h3>
                                       <?=cms::display_content(10)?>
									<?} else {?>
									
									<!--noindex-->
									<h3>О нас</h3>
                                       <?=cms::display_content(10)?>
									<!--/noindex-->
                                    <?}?>
									   
									   
									   
                                    </div>

                                    <div class="span4" style="padding-top: 0px;">
                                       <h3><?=cms::display_content(11,true)?></h3>
                                       <address itemscope itemtype="http://schema.org/Organization">
                                             <span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress"><span itemprop="streetAddress"><?=cms::display_content(14)?></span></span>
                                             <span itemprop="telephone"><?=cms::display_content(15)?></span>
                                             <span itemprop="email"><?=cms::display_content(16)?></span>
                                       </address>
                                       <div class="social-icons">
                                          <a href="https://vk.com/nsgostdom" target="_blank"><img src="/img/vk.png" alt=""/></a>
                                       </div>

                                    </div>
                                 </div>
                              </div>

                              <div class="subfooter">
                                 <div class="container">
                                    <div class="row">

                                       <div class="span6"><?=cms::display_content(4)?></div>
                                       <div class="span6" style="text-align: right;">&nbsp;</div>
                                    </div>
                                 </div>
                              </div>

                           </footer>
                           <!-- footer close -->

   </body>
</html>
