<div id="blog-comment"  itemscope itemtype="http://schema.org/Question">
   <?php include(conf::$bpath.'admin/uside_book_review/edit.php') ?>
   <!-- вывод комментариев -->
   <h3 class="blog-title" itemprop="name">Отзывы</h3>
   <? if($records){ ?>
      <ol>
         <? foreach($records as $row){ ?>
            <li>
               <?if($row['pic']){?>
                  <div class="avatar"><img src="/images/avatar/<?=$row['pic']?>preview.jpg" alt="" style="width: 60px; height: 60px;"></div>
               <? }else{ ?>
                  <div class="avatar"><img src="/images/avatar/avatar1.jpg" alt=""></div>
               <? } ?>   
               <div class="comment-info">
                  <span class="c_name"><?=$row['author']?></span>
                  <span class="c_date"><?=$row['posted']?></span>

                  <div class="clearfix"></div>
               </div>
               
               <div class="comment"  itemprop="acceptedAnswer" itemscope itemtype="http://schema.org/Answer">
                  <span itemprop="text"><?=$row['message']?></span>
               </div>
               <ol itemprop=" suggestedAnswer" itemscope itemtype="http://schema.org/Answer">
                  <li>
                     <div class="avatar"><img src="/images/avatar/avatar2.png" alt=""></div>
                     <div class="comment-info">
                        <span class="c_name">Ответ</span>
                        <div class="clearfix"></div>
                     </div>
                     <div class="comment" itemprop="text"><?=$row['otvet']?></div>
                  </li>
               </ol>
            </li>
            <? } ?>
         </ol>

         <?
         if($page->page_amount > 1){
            $page->display();
         }
         ?>

         <? } ?>

</div>
