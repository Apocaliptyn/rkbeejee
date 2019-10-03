<div class="task">
<?  if (!empty($viewdata_list)) : ?>
        <table class="taskTable <?=(((isset($viewdata_username)) AND (!empty($viewdata_username))) ? "admin" : "")?>">
            <tr>
                <th class="sortable">
                    <a href="?order=<?=((((isset($viewdata_request["orderby"])) AND (isset($viewdata_request["order"]))) AND (($viewdata_request["orderby"] == "status") AND ($viewdata_request["order"] == "ASC"))) ? "DESC" : "ASC")?>&page=<?=((isset($viewdata_request["page"])) ? $viewdata_request["page"] : 0)?>&orderby=status">
                        Статус
                    </a>
                </th>
                <th class="sortable">
                    <a href="?order=<?=((((isset($viewdata_request["orderby"])) AND (isset($viewdata_request["order"]))) AND (($viewdata_request["orderby"] == "username") AND ($viewdata_request["order"] == "ASC"))) ? "DESC" : "ASC")?>&page=<?=((isset($viewdata_request["page"])) ? $viewdata_request["page"] : 0)?>&orderby=username">
                        Имя пользователя
                    </a>
                </th>
                <th class="sortable">
                    <a href="?order=<?=((((isset($viewdata_request["orderby"])) AND (isset($viewdata_request["order"]))) AND (($viewdata_request["orderby"] == "email") AND ($viewdata_request["order"] == "ASC"))) ? "DESC" : "ASC")?>&page=<?=((isset($viewdata_request["page"])) ? $viewdata_request["page"] : 0)?>&orderby=email">
                        E-mail
                    </a>
                </th>
                <th>
                    Текст задачи
                </th>
            <?  if ((isset($viewdata_username)) AND (!empty($viewdata_username))) : ?>
                    <th></th>
            <?  endif; ?>
            </tr>
        <?  foreach ($viewdata_list as $listItem) : ?>
                <tr data-itemid="<?=$listItem["id"]?>">
                    <td class="taskTableCheckbox"><input type="checkbox" class="<?=(((isset($viewdata_username)) AND (!empty($viewdata_username))) ? "taskCheckboxClickable" : "")?>" <?=(((isset($viewdata_username)) AND (!empty($viewdata_username))) ? "" : "disabled")?> <?=($listItem["status"] ? "checked" : "")?>></td>
                    <td class="taskTableUsername"><?=$listItem["username"]?></td>
                    <td class="taskTableEmail"><?=$listItem["email"]?></td>
                    <td class="taskTableText">
                    <?  if ($listItem["edited"] == 1) : ?>
                            <div class="taskTableTextEdited">* отредактированно администратором</div>
                    <?  endif; ?>
                        <p>
                            <?=$listItem["text"]?>
                        </p>
                    </td>
                <?  if ((isset($viewdata_username)) AND (!empty($viewdata_username))) : ?>
                        <td><a href="/task/edit/?id=<?=$listItem["id"]?>" class="editButton">Редактировать</a></td>
                <?  endif; ?>
                </tr>
        <?  endforeach; ?>
        </table>
        <div class="taskPagination">
        <?  $pageNumber = ceil($viewdata_item_count / $viewdata_item_per_page);
            for ($i = 0; $i < $pageNumber;) : ?>
                <a href="?order=<?=((((isset($viewdata_request["orderby"])) AND (isset($viewdata_request["order"]))) AND (($viewdata_request["orderby"] == "email") AND ($viewdata_request["order"] == "ASC"))) ? "DESC" : "ASC")?>&page=<?=$i?>&orderby=<?=((isset($viewdata_request["orderby"])) ? $viewdata_request["orderby"] : "id")?>" class="<?=(((isset($viewdata_request["page"])) AND ($viewdata_request["page"] == $i)) ? "current" : "")?>"><?= ++$i?></a>
        <?  endfor; ?>
        </div>
<?  endif; ?>
</div>