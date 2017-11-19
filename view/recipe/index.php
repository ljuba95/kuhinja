<?php
ob_start();
?>

    <h2>Prikaz modela</h2>

    <table class="table table-bordered table-striped">
        <thead class="thead-inverse">
        <tr>
            <th>Row</th>
            <th>Name</th>
            <th>Date</th>
            <th>Model_ID</th>
            <th>MDA Level</th>
            <th>Status</th>
            <th>Description</th>
            <th>File</th>
        </tr>
        </thead>
        <tbody>

        <?php
        /** @var \Model\Model $model */
        foreach ($models as $model) {
            ?>
            <tr>
                <td><?php echo $model->getModelElementId(); ?></td>
                <td><?php echo $model->getName(); ?></td>
                <td>14.6.2017.</td>
                <td>M2</td>
                <td><?= !empty($model->getIsInstanceOf()) ? $model->getIsInstanceOf()->getName() : ''; ?></td>
                <td>Description of Model Name</td>
                <td>Some sort of file</td>
                <td>Some sort of file</td>
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