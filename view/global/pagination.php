<nav aria-label="...">
    <ul class="pagination">
        <?php
        if (count($pages) > 1) {
            foreach ($pages as $pageName => $pageNumber) {
                ?>
                <li class="page-item<?php echo $pageNumber == $page ? ' active' : '' ?>">

                    <a class="page-link"
                       href="<?= str_replace('{$page}', $pageNumber, $uri) ?>"><?php echo $pageName ?></a>
                </li>
                <?php
            }
        }
        ?>
    </ul>
</nav>
