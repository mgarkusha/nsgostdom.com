<?

function set_title($title){
   if(!$title)
   return false;

   $string = '';

   if(conf::$after_title)
   $string .= conf::$after_title;
   $string .= $title;
   if(conf::$before_title)
   $string .= conf::$before_title;

   conf::$title = $string;

}

function set_keywords($keywords){
   if($keywords)
   conf::$key_words = $keywords;
}

function set_description($description){
   if($description)
   conf::$description = $description;
}

function get_display_slide(){
   $slider = mysql::select("SELECT `pic`,`text`,`url` FROM `#slider` WHERE `display` = '1' ORDER BY `pos` DESC");
   return $slider;
}


function get_breadcrumb_sitemap($id){
   $now = mysql::selectrow("SELECT `id`,`name`,`parent` FROM `#sitemap` WHERE `id` = '".(int)$id."'");
   if($now){
      conf::$breadcrumb[] = array('url' => cms::sitemap_path($now['id']),'label' => $now['name']);
      get_breadcrumb_sitemap($now['parent']);
   }
}

function breadcrumb_reverse(){
   krsort(conf::$breadcrumb);
}

function add_breadcrumb($url,$label){
   conf::$breadcrumb = array('url' => $url,'label' => $label);
}

function get_sitemap_parents($parent = 0){
   $parent = mysql::select("SELECT `id`,`name` FROM `#sitemap` WHERE `display` = '1' AND `parent` = '".(int)$parent."' ORDER BY `pos`");
   return $parent;
}

function generate_breadcrumb(){
   $html = '<ul itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumb" style="margin-right: 60px;"><li itemprop="itemListElement" itemscope
      itemtype="http://schema.org/ListItem"><a itemscope itemtype="http://schema.org/Thing"
       itemprop="item" href="/"><span itemprop="name">Главная</span> </a><meta itemprop="position" content="1" /> / </li>';
   $firstelem = true;
   foreach(conf::$breadcrumb as $item){
      if($firstelem){
         $html .= '<li itemprop="itemListElement" itemscope
      itemtype="http://schema.org/ListItem"> <span itemscope itemtype="http://schema.org/Thing"
       itemprop="item" ><span itemprop="name"> '.$item['label'].'</span> </span><meta itemprop="position" content="2" /></li>';
      }else{
         $html .= '<li itemprop="itemListElement" itemscope
      itemtype="http://schema.org/ListItem"> / <span itemscope itemtype="http://schema.org/Thing"
       itemprop="item"  ><span itemprop="name"> '.$item['label'].'</span></span><meta itemprop="position" content="2" /> </li>';
      }
      $firstelem = false;
   }
   $html .= '</ul>';
   return $html;
}

function generate_menu($parent = 0){
   $parents = get_sitemap_parents($parent);
   $html = '';
   if($parents){
      $class_ul = 'dropdown-menu';
      if(!$parent){
         $class_ul = 'nav navbar-nav pull-right';
      }
      $html .= '<ul class="'.$class_ul.'">';
      foreach($parents as $item){
         $parent_ul = generate_menu($item['id']);
         $class_li = '';
         $attr_a = '';
         if($parent_ul){
            $class_li = 'dropdown';
            $attr_a = ' class="dropdown-toggle" data-toggle="dropdown"';
         }

         if($item['id'] == conf::$pathid){
            $class_li .= ' active';
         }

         if($item['id'] == 13){
            $url = 'http://kru-god.ru/';
            $target = 'target="_blank"';
         }else{
            $url = cms::sitemap_path($item['id']);
            $target = '';
         }

         $html .= '<li class="'.$class_li.'">';
         $html .= '<a href="'.$url.'" '.$attr_a.' '.$target.'>'.$item['name'].'</a>';
         $html .= $parent_ul;
         $html .= '</li>';
      }
      $html .= '</ul>';
   }
   return $html;
}

