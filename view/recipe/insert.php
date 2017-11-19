<?php
ob_start();
?>

    <div class="container">
        <h2>Create model</h2>
        <form class="form-horizontal" action="/model/insert" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <div class="form-group">
                    <label for="example-text-input" class="col-2 col-form-label"> Date of
                        Creation </label> <?php echo date('d M Y', time()); ?>
                </div>
                <label class="control-label col-sm-2">Name:</label>
                <div class="col-sm-4">
                    <input type="ime" class="form-control" name="ime" placeholder="Unesite ime" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">Instance of model_ID:</label>
                <div class="col-sm-4">
                    <input type="instance" class="form-control" name="instance" autocomplete="on" required>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2">MDA Level:</label>
                <div class="col-sm-4">

                    <input type="radio" name="opcija" value="M0"> M0
                    <input type="radio" name="opcija" value="M1"> M1
                    <input type="radio" name="opcija" value="M2"> M2
                    <input type="radio" name="opcija" value="M3"> M3
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" align="right">Description:</label>
                <div class="col-sm-4">
                    <textarea class="form-control" name="opis" cols="50"></textarea>
                </div>
            </div>

            <div class="col-sm-12">

            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" align="right">Status:</label>
                <div class="col-sm-2">
                    <select>
                        <option value="finished">
                            Finished
                        </option>

                        <option value="in progres">
                            In progres
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-sm-12">

            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" align="right">File path:</label>
                <div class="col-sm-4">
                    <input type="file" name="filepath" id="filepath">
                </div>
            </div>


            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary" name="btn-save">Save</button>
                    <a class="btn btn-success" href="/../../studenti.php">Cancel</a>
                    <br>
                </div>
            </div>
        </form>
    </div>

<?php

$html = ob_get_clean();
$title = empty($title) ? 'Insert recipe' : $title;
ob_flush();
echo render('global/main.php', array_merge($params, array('content' => $html, 'title' => $title)));