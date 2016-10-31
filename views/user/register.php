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
                                <div class="panel-title form-title col-sm-7 col-sm-offset-1"><?= Lang::_('titles', 'panel-title')?></div>
                                <div class=" col-sm-4">
                                    <a href="rus" lang = 'rus' class="btn lang <?php if($_SESSION['lang'] == 'rus') echo 'active'?>" role="button">Рус</a>
                                    <a href="eng" lang = 'eng' class="btn lang <?php if($_SESSION['lang'] == 'eng') echo 'active'?>" role="button">Eng</a>
                                    <a href="/user/login/" class="btn btn-primary" role="button"><?= Lang::_('buttons', 'login')?></a>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="POST" action="/user/register">
                                <div class="form-group">
                                    <label for="name" class="col-md-4 control-label"><?= Lang::_('fields', 'name'); ?></label>
                                    <div class="col-md-6  <?php if(isset($errors['name'])) echo 'has-error';?>">
                                        <input id="name" type="text" class="form-control" maxlength="30" name="name" value="<?php if(isset($name)) echo $name;?>"
                                               placeholder="<?= Lang::_('placeholders', 'name'); ?>" autofocus>
                                        <?php checkError('name', $errors) ?>
                                    </div>
                                </div>
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
                                        <input id="password" type="password" maxlength="30" class="form-control" name="password" placeholder="<?= Lang::_('placeholders', 'pwd'); ?>">
                                        <?php checkError('password', $errors) ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password-confirm" class="col-md-4 control-label"><?= Lang::_('fields', 'pwd-conf'); ?></label>
                                    <div class="col-md-6 <?php if(isset($errors['password-confirm'])) echo 'has-error';?>">
                                        <input id="password-confirm" type="password" maxlength="30" class="form-control" name="conf_password" placeholder="<?= Lang::_('placeholders', 'pwd-conf'); ?>">
                                        <?php checkError('password-confirm', $errors) ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="gender"><?= Lang::_('fields', 'gender'); ?></label>
                                    <div class="col-md-4 <?php if(isset($errors['gender'])) echo 'has-error';?>" id="gender">
                                        <label class="radio-inline" for="gender-0">
                                            <input type="radio" name="gender" value="Male" requiredd <?php if(isset($_POST['gender']) and $_POST['gender']=='Male') echo 'checked';?>>
                                            <?= Lang::_('inputs', 'gender_m'); ?>
                                        </label>
                                        <label class="radio-inline" for="gender-1">
                                            <input type="radio" name="gender" value="Female"  requiredd <?php if(isset($_POST['gender']) and $_POST['gender']=='Female') echo 'checked';?>>
                                            <?= Lang::_('inputs', 'gender_f'); ?>
                                        </label>
                                        <?php checkError('gender', $errors) ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="brthd"><?= Lang::_('fields', 'brthd'); ?></label>
                                    <div id='brthd' class="col-md-6 <?php if(isset($errors['brthd'])) echo 'has-error';?>">
                                        <div class="form-group row">
                                            <label for="select01" class=""></label>
                                            <div class="col-md-1 select_day">
                                                <select id="select01" class="form-control" name="b_day">
                                                    <option value="0"><?= Lang::_('inputs', 'b_day'); ?></option>
                                                    <?php for($i = 1; $i < 32; $i++){ ?>
                                                        <option value="<?php echo $i;?>" <?php if(isset($_POST['b_day']) and $_POST['b_day']==$i) echo 'selected';?>><?php echo $i;?></option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                            <label for="select02" class="col-md-1 control-label">&nbsp;</label>
                                            <div class="col-md-2 select_month">
                                                <select id="select02" class="form-control" name="b_month">
                                                    <option value="0"><?= Lang::_('inputs', 'b_month'); ?></option>
                                                    <?php
                                                    $months = Lang::_('inputs', 'months');
                                                    for($j = 1; $j < 13; $j++){ ?>
                                                        <option value = "<?php echo $j;?>" <?php if(isset($_POST['b_month']) and $_POST['b_month']==$j) echo 'selected';?>><?php echo $months[$j-1];?></option>;
                                                    <?php }?>
                                                </select>
                                            </div>
                                            <label for="inputValue1" class="col-md-1 control-label">&nbsp;</label>
                                            <div class="col-md-1 select_year">
                                                <select id="select03" class="form-control" name="b_year">
                                                    <option value="0"><?= Lang::_('inputs', 'b_year'); ?></option>
                                                    <?php for($i = 2016; $i > 1920; $i--){ ?>
                                                        <option value="<?php echo $i;?>" <?php if(isset($_POST['b_year']) and $_POST['b_year']==$i) echo 'selected';?>><?php echo $i;?></option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                        <?php checkError('brthd', $errors) ?>
                                    </div>
                                </div>
                                <div class="form-group text-right">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary" name="register">
                                            <?= Lang::_('buttons', 'submit1'); ?>
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