<form method="POST" class="taskForm">
    <?  if (isset($viewdata_errors) AND (!empty($viewdata_errors))) : ?>
        <div class="taskFormErrors">
            <?  foreach($viewdata_errors as $error) : ?>
                <p><?=$error?></p>
            <?  endforeach; ?>
        </div>
    <?  endif; ?>
    <div class="taskFormRow">
        Имя пользователя: <br />
        <input type="text" name="username" value="<?=(isset($viewdata_form_fields["username"]) ? $viewdata_form_fields["username"] : "")?>" />
    </div>
    <div class="taskFormRow">
        E-mail: <br />
        <input type="email" name="email" value="<?=(isset($viewdata_form_fields["email"]) ? $viewdata_form_fields["email"] : "")?>" />
    </div>
    <div class="taskFormRow">
        Текст: <br />
        <textarea name="text"><?=(isset($viewdata_form_fields["text"]) ? $viewdata_form_fields["text"] : "")?></textarea>
    </div>
    <div class="taskFormRow">
        <button>Отправить</button>
    </div>
</form>