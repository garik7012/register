<?php include ROOT . '/views/layouts/header.php'; ?>
<?php function checkError($field, $errors){
    if(isset($errors[$field])){
        echo '<span class="errorSpan help-block"><strong>'. $errors[$field] .'</strong></span>';
    }
}?>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="panel-title form-title col-sm-7 col-sm-offset-1"><?= Lang::_('titles', 'panel-title-login')?></div>
                                <div class=" col-sm-4">
                                    <a href="rus" lang = 'rus' class="btn lang <?php if($_SESSION['lang'] == 'rus') echo 'active'?>" role="button">Рус</a>
                                    <a href="eng" lang = 'eng' class="btn lang <?php if($_SESSION['lang'] == 'eng') echo 'active'?>" role="button">Eng</a>
                                    <a href="/user/register" class="btn btn-primary" role="button"><?= Lang::_('buttons', 'register')?></a>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="POST" action="/user/login/">
                                <div class="form-group">
                                    <label for="email" class="col-md-4 control-label"><?= Lang::_('fields', 'email'); ?></label>
                                    <div class="col-md-6 <?php if(isset($errors['email'])) echo 'has-error';?>">
                                        <input id="email" type="email" class="form-control" name="email" value="<?php if(isset($email)) echo $email;?>" placeholder="<?= Lang::_('placeholders', 'email'); ?>">
                                        <?php checkError('email', $errors) ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-md-4 control-label"><?= Lang::_('fields', 'pwd'); ?></label>
                                    <div class="col-md-6 <?php if(isset($errors['password'])) echo 'has-error';?>">
                                        <input id="password" type="password" maxlength="30" class="form-control" name="password" placeholder="<?= Lang::_('placeholders', 'password'); ?>">
                                        <?php checkError('password', $errors) ?>
                                    </div>
                                </div>
                                <div class="form-group text-right">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary" name="login">
                                            <?= Lang::_('buttons', 'submit3'); ?>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


<?php include ROOT . '/views/layouts/footer.php'; ?>