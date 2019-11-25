<section class="content__side">
    <h2 class="content__side-heading">Проекты</h2>

    <nav class="main-navigation">
        <ul class="main-navigation__list">
            <?php foreach ($projects as $item): ?>
                <li class="main-navigation__list-item
                    <?php if (isset($item["id"]) && isset($_GET["id"]) && $item["id"] === intval($_GET["id"])): ?>
                        main-navigation__list-item--active
                    <?php endif; ?>
                ">
                    <a class="main-navigation__list-item-link" href="/?id=<?= $item["id"]; ?>">
                        <?php if (isset($item["name"])): ?>
                            <?= htmlspecialchars($item["name"]); ?>
                        <?php endif; ?>
                    </a>
                    <span class="main-navigation__list-item-count">
                        <?= getCountTasksProject($all_tasks, $item); ?>
                    </span>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>

    <a class="button button--transparent button--plus content__side-button" href="/add-project.php">Добавить проект</a>
</section>

<main class="content__main">
    <h2 class="content__main-heading">Список задач</h2>

    <!-- Поиск по задачам -->
    <form class="search-form" action="/index.php" method="get" autocomplete="off">
        <label>
        <input class="search-form__input" type="text" name="q" value="<?= getGetVal("q"); ?>" placeholder="Поиск по задачам">
        </label>
        <input class="search-form__submit" type="submit" name="" value="Искать">
    </form>
    <div class="search-result">
        <ul class="search-result__list">
            <?php foreach ($task_search as $item): ?>
                <li class="search-result__item">
                <?php if (isset($item["project_id"])): ?>
                    <a class="search-result__link" href="/?id=<?= $item["project_id"]; ?>">
                <?php endif; ?>
                    <?php if (isset($item["title"])): ?>
                        <?= htmlspecialchars($item["title"]); ?>
                    <?php endif; ?>
                    </a>
                    <span class="search-result__text">
                        <?php if (isset($item["project"])): ?>
                            <?= htmlspecialchars($item["project"]); ?>
                        <?php endif; ?>
                    </span>
                </li>
            <?php endforeach; ?>
        </ul>
        <p class="error-message"><?= $search_message ?></p>
    </div>

    <div class="tasks-controls">
        <nav class="tasks-switch">
            <a href="/" class="tasks-switch__item tasks-switch__item--active">Все задачи</a>
            <a href="/" class="tasks-switch__item">Повестка дня</a>
            <a href="/" class="tasks-switch__item">Завтра</a>
            <a href="/" class="tasks-switch__item">Просроченные</a>
        </nav>

        <label class="checkbox">
            <input class="checkbox__input visually-hidden show_completed" type="checkbox"
                <?php if ($show_complete_tasks == 1): ?>
                    checked
                <?php endif; ?>
            >
            <span class="checkbox__text">Показывать выполненные</span>
        </label>
    </div>

    <table class="tasks">
        <?php foreach ($tasks as $item): ?>
            <?php if ($show_complete_tasks == 0 && isset($item["status"]) && $item["status"]): ?>
                <?php continue; ?>
            <?php endif; ?>
            <tr class="tasks__item task
                <?php if (isset($item["status"]) && $item["status"]): ?>
                    task--completed
                <?php endif; ?>
                <?php if (isset($item["hours_until_end"]) && $item["hours_until_end"] <= 24): ?>
                    task--important
                <?php endif; ?>
            ">
                <td class="task__select">
                    <label class="checkbox task__checkbox">
                        <?php if (isset($item["id"])): ?>
                        <a href="/?task_id=<?= $item["id"]; ?>">
                            <?php endif; ?>
                            <input class="checkbox__input visually-hidden" type="checkbox"
                                <?php if (isset($item["status"]) && $item["status"]): ?>
                                    checked
                                <?php endif; ?>
                            >
                            <span class="checkbox__text">
                                <?php if (isset($item["title"])): ?>
                                    <?= htmlspecialchars($item["title"]); ?>
                                <?php endif; ?>
                            </span>
                        </a>
                    </label>
                </td>

                <td class="task__file">
                    <?php if (isset($item["file"])): ?>
                        <a class="download-link" href="<?= $item["file"]; ?>">Файл</a>
                    <?php endif; ?>
                </td>

                <td class="task__date">
                    <?php if (isset($item["deadline"])): ?>
                        <?= htmlspecialchars(date("d.m.Y", strtotime($item["deadline"]))); ?>
                    <?php endif; ?>
                </td>
                <td class="task__controls"></td>
            </tr>
        <?php endforeach; ?>
    </table>
</main>
