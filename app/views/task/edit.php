<form method="POST" class="taskForm">
    <?  if (isset($viewdata_errors) AND (!empty($viewdata_errors))) : ?>
        <div class="taskFormErrors">
            <?  foreach($viewdata_errors as $error) : ?>
                <p><?=$error?></p>
            <?  endforeach; ?>
        </div>
    <?  endif; ?>
    <input type="hidden" name="id" value="<?=(isset($viewdata_form_fields["id"]) ? $viewdata_form_fields["id"] : "")?>" />
    <div class="taskFormRow">
        Текст: <br />
        <textarea name="text"><?=(isset($viewdata_form_fields["text"]) ? $viewdata_form_fields["text"] : "")?></textarea>
    </div>
    <div class="taskFormRow">
        <button>Сохранить</button>
    </div>
</form>