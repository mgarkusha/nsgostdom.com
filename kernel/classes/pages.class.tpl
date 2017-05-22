<table border="0" cellpadding="0" cellspacing="0" align="right">
    <tr>
        <td>
            <table border="0" cellpadding="0" cellspacing="3px">
                <tr>
                    <td nowrap style='padding-top:3px; color:#505253;'>Страницы: &nbsp;</td>

                    <?if($p->previous){?>
                        <td nowrap class='page'>
                            <a href='<?=$p->firstpage?>' class="page_l">1</a>
                        </td>

                        <td nowrap class='page'>
                            <a href='<?=$p->previous?>' class="page_l">...</a></td><td><?=html::ispace(3,1)?>
                        </td>
                    <?}?>
                    <?foreach($p->link as $key=>$value){?>
                        <?if($p->active[$key]){?>
                                <td nowrap class='page2'><?=$key?></td>
                        <?}else{?>
                                <td nowrap class='page'><a class='page_l' href='<?=$value?>'><?=$key?></td>
                        <?}?>
                    <?}?>
                    <?if($p->next){?>
                        <td nowrap>
                                <?=html::ispace(3,1)?></td><td nowrap class='page'><a href='<?=$p->next?>' class="page_l">...</a>&nbsp;&nbsp;
                                <a href='<?=$p->lastpage?>' class="page_l"><?=$p->page_amount?></a>&nbsp;
                        </td>
                    <?}?>
                </tr>
            </table>
        </td>
    </tr>
</table>
<script language="javascript" type="text/javascript"><?=$p->js?></script>