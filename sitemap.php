<?

define('SCRIPTACCESS', true);
ini_set('display_errors', 1);
include('kernel/main/conf.php');
// Задаем формат даты
define('DATE_FORMAT_RFC822','r');
// Сообщяем браузеру что передаем XML
$content = header("Content-type: text/xml; charset=utf-8");

$lastBuildDate = date(DATE_ATOM);
$content .= '<?xml version="1.0" encoding="utf-8"?>';
$content .= '
<urlset
    xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
    //Home
    $priority = 1;
    $content .= '
    <url>
        <loc>https://nsgostdom.com/</loc>
        <lastmod>'.$lastBuildDate.'</lastmod>
        <changefreq>weekly</changefreq>
        <priority>'.$priority.'</priority>
    </url>';
    //SitePages
    $priority = $priority - 0.10;
    $pages = mysql::select("SELECT id, alias FROM #sitemap WHERE display = '1' AND first != 1 ORDER BY pos ASC");
    foreach ($pages as $page) {
        if($page['alias']) $url = $page['alias'];
        else $url = $page['id'];
        $url = 'https://nsgostdom.com/' .$page['alias'];
        $content .= '<url>
            <loc>'.$url.'</loc>
            <lastmod>'.$lastBuildDate.'</lastmod>
            <changefreq>weekly</changefreq>
            <priority>'.$priority.'</priority>
        </url>';
    }
    
    //Catalog - Rooms
    $priority = $priority - 0.10;
    $catalog_rooms = mysql::select("SELECT id FROM #catalog_rooms WHERE display = '1' ORDER by name");
    foreach ($catalog_rooms as $rooms) {
        $url = 'https://nsgostdom.com/gostevye-komnaty/?catalog_rooms_id=' . $rooms['id'];
        $content .= '<url>
            <loc>'.$url.'</loc>
            <lastmod>'.$lastBuildDate.'</lastmod>
            <changefreq>weekly</changefreq>
            <priority>'.$priority.'</priority>
        </url>';
    }

     //Catalog - Excursions
//    $priority = $priority - 0.10;
//    $excursions = mysql::select("SELECT id FROM #excursions WHERE display = 1 ");
//    foreach ($excursions as $excurs) {
//        $url = 'https://nsgostdom.com/excursions/?excurs=' . $excurs['id'];
//        $content .= '<url>
//            <loc>'.$url.'</loc>
//            <lastmod>'.$lastBuildDate.'</lastmod>
//            <changefreq>weekly</changefreq>
//            <priority>'.$priority.'</priority>
//        </url>';
//    }
    
    //Catalog - Cars
//    $priority = $priority - 0.10;
//    $cars = mysql::select("SELECT id FROM #cars WHERE display = 1 ORDER BY name");
//    foreach ($cars as $car) {
//        $url = 'https://nsgostdom.com/cars/?car=' . $car['id'];
//        $content .= '
//        <url>
//            <loc>'.$url.'</loc>
//            <lastmod>'.$lastBuildDate.'</lastmod>
//            <changefreq>weekly</changefreq>
//            <priority>'.$priority.'</priority>
//        </url>';
//    }
    $content .= '</urlset>';
	/*
    if (file_exists(dirname(__FILE__) . '/sitemap.xml')) {
        unlink(dirname(__FILE__) . '/sitemap.xml');
    }
    
    file_put_contents(dirname(__FILE__) . '/sitemap.xml', $content);
	*/
	header("Content-type: text/xml");
	echo $content;
