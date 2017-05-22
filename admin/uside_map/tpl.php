<!--<script type="text/javascript" charset="utf-8" src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=8tNDQwzgNPB_nwXa1--NBYXASdxSz7PN&width=1170&height=400&lang=ru_RU&sourceType=constructor"></script>-->


<div id="map" style="width: 100%; height: 400px"></div>

<script type="text/javascript">
  ymaps.ready(init);
    var myMap1,
        myPlacemark1;

    function init(){     
        myMap1 = new ymaps.Map("map", {
            center: [60.029058, 30.290095],
            zoom: 16
        });

        myPlacemark1 = new ymaps.Placemark([60.029058, 30.290095], { 
            hintContent: 'Гостевой дом «Новосельковский»',
            balloonContentHeader: 'Гостевой дом «Новосельковский»',
            balloonContent: '<b>График работы:</b> круглосуточно (без выходных)<br><b>Телефон:</b> +7 (812) 304 35 41, +7 (931) 335 18 38<br><b>E-mail:</b> ns.gostevoydom@mail.ru' 
        }, {
            iconLayout: 'default#image',
            iconImageHref: '/images/marker.png',
            iconImageSize: [55, 75],
            iconImageOffset: [-27, -75]
        });
        myMap1.geoObjects.add(myPlacemark1);
    }
</script>

