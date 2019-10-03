<div class="topMenu">
    <ul>
    <?  if (isset($_SESSION['login'])) : ?>
            <li>
                <a href="/authorization/logout/">Выйти</a>
            </li>
    <?  else : ?>
            <li>
                <a href="/authorization/">Войти</a>
            </li>
    <?  endif; ?>
        <li>
            <a href="/task/create/">
                Добавить задачу
            </a>
        </li>
    </ul>
</div>
