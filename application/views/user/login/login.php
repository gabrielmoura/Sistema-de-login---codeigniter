<? defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script type="text/JavaScript" src="<?= base_url('assets/js/sha512.min.js') ?>"></script>
<script type="text/JavaScript" src="<?= base_url('assets/js/form.js') ?>"></script>
<div class="container">
    <div class="row">

        <? if (isset($msg)) : ?>
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    <?= $msg ?>
                </div>
            </div>
        <? endif; ?>
        <div class="col-md-12">
            <div class="page-header">
                <h1>Login</h1>
            </div>
            <?= "Olá " . $this->input->ip_address(); ?>

            <?= form_open($html['action']); ?>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Seu Email">
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Sua senha">
            </div>
            <div class="form-group">
                <input type="button" class="btn btn-default" value="Login"
                       onclick="formhash(this.form, this.form.password);">
            </div>
            <?= form_close(); ?>
        </div>
    </div><!-- .row -->
</div><!-- .container -->