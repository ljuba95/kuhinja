<?php
ob_start();
?>
    <div class="col-lg-8">
        <form class="form-signin" method="post" action="/sessions/create">
            <h2 class="form-signin-heading my-4">Prijava</h2>
            <label for="inputEmail" class="sr-only">Email adresa</label>
            <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email" required
                   autofocus>
            <label for="inputPassword" class="sr-only">Šifra</label>
            <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Šifra" required>
            <hr>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Prijavite se</button>

            <hr>
            <div class="col-md-6 control">
                <div >
                    Nemate nalog?
                    <a href="/users/new">
                        Registrujte se ovde!
                    </a>
                </div>
            </div>

        </form>
    </div>
<?php

$html = ob_get_clean();
$title = empty($title) ? 'Prijavljivanje' : $title;
ob_flush();
echo render('global/main.php', array_merge($params, array('content' => $html, 'title' => $title)));