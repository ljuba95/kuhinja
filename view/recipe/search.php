<?php
/**
 * Created by PhpStorm.
 * User: Milos
 * Date: 12/13/2017
 * Time: 5:34 PM
 */


$i = 1;
foreach ($recepti as $recept) {
    ?>
    <tr>
        <td><?php echo $i++; ?></td>
        <td><?php echo $recept->getName(); ?></td>
        <td><?php echo $recept->getTimeNeeded() . ' minuta'; ?></td>
        <td><?= $recept->userName ?></td>
        <td><a href="/recept/show/<?= $recept->getId(); ?>"><i class="fa fa-search" aria-hidden="true"></i></a></td>
    </tr>
<?php } ?>