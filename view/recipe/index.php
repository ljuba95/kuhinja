<?php
ob_start();
?>

    <h2>Prikaz svih recepata</h2>

    <table class="table table-bordered table-striped">
        <thead class="thead-inverse">
        <tr>
            <th>Broj</th>
            <th>Naziv</th>
            <th>Potrebno vreme</th>
            <th>Autor</th>
            <th>Vise</th>
        </tr>
        </thead>
        <tbody>

        <?php
        $i = 1;
        foreach ($recepti as $recept) {
            ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $recept->getName(); ?></td>
                <td><?php echo $recept->getTimeNeeded() . ' minuta'; ?></td>
                <td>Jelkis</td>
                <td><a href="/recept/show/<?= $recept->getId(); ?>"><i class="fa fa-search" aria-hidden="true"></i></a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

<?php echo render('global/pagination.php', array('page' => $page, 'uri' => $uri, 'pages' => $pages)); ?>


<?php

$html = ob_get_clean();
$title = empty($title) ? 'prikaz modela' : $title;
ob_flush();
echo render('global/main.php', array_merge($params, array('content' => $html, 'title' => $title)));