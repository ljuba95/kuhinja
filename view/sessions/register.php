<?php
ob_start();
?>
    <div class="col-lg-8">
        <form class="form-horizontal" action="/users/create" method="post">
            <fieldset>

                <!-- Form Name -->
                <h2 class="form-signin-heading my-4">Registracija</h2>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-6 control-label" for="name">Ime i prezime</label>
                    <div class="col-md-6">
                        <input id="name" name="name" type="text" placeholder="Unesite ime i prezime"
                               class="form-control input-md" required="">

                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-6 control-label" for="email">Email</label>
                    <div class="col-md-6">
                        <input id="email" name="email" type="text" placeholder="Unesite email"
                               class="form-control input-md" required="">

                    </div>
                </div>

                <!-- Password input-->
                <div class="form-group">
                    <label class="col-md-6 control-label" for="password">Šifra</label>
                    <div class="col-md-6">
                        <input id="password" name="password" type="password" placeholder="Unesite šifru"
                               class="form-control input-md" required="">

                    </div>
                </div>

                <!-- Button -->
                <div class="form-group">
                    <label class="col-md-6 control-label" for="signup"></label>
                    <div class="col-md-6">
                        <button id="signup" name="signup" class="btn btn-lg btn-primary btn-block">Registracija</button>
                    </div>
                </div>

            </fieldset>
        </form>
    </div>
<?php

$html = ob_get_clean();
$title = empty($title) ? 'Registracija' : $title;
ob_flush();
echo render('global/main.php', array_merge($params, array('content' => $html, 'title' => $title)));