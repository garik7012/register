<?php include ROOT . '/views/layouts/header.php';?>

<section>
    <?php
    /**
     * выводит selected если итерация совпадает с днем, месяцем или годом
     * @param $i - итерация цикла
     * @param $comp - день(j) или месяц(n) или год(Y)
     */
    function isSelected($i, $comp){
        global $user;
        if (isset($user['b_date']) and date_format(date_create($user['b_date']), $comp) == $i) echo 'selected';
    }
    /**
     * показывает только что отправленное значение
     * либо то, которое у нас было
     * @param $fieldName - имя поля для которого будет проводиться проверка
     */
    function showValue($fieldName){
        global $user;
         if(isset($_POST[$fieldName])){
            echo $_POST[$fieldName];
        }else echo $user[$fieldName];
    }
    /**
     * проверяем на существование ошибок $errors для поля $field
     * если ошибка есть - выводим ее
     * @param $field
     * @param $errors
     */
    function checkError($field, $errors){
        if(isset($errors[$field])){
            echo '<span class="errorSpan help-block"><strong>'. $errors[$field] .'</strong></span>';
        }
    }
    ?>
    
    <div class="content">
        <div class="col-md-8 col-md-offset-2 col-xs-12">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <div class="row">
                            <div class="panel-title form-title col-sm-7 col-sm-offset-1"><?= Lang::_('text','title_start')?><?php showValue('name'); ?><?= Lang::_('text', 'title_end')?></div>
                            <div class="col-sm-4">
                                <a href="rus" lang = 'rus' class="btn lang <?php if($_SESSION['lang'] == 'rus') echo 'active'?>" role="button">Рус</a>
                                <a href="eng" lang = 'eng' class="btn lang <?php if($_SESSION['lang'] == 'eng') echo 'active'?>" role="button">Eng</a>
                                <a href="/user/logout" class="btn btn-primary" role="button"><?= Lang::_('buttons', 'logout') ?></a>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">

                        <form class="form-horizontal" method="post" enctype=multipart/form-data action="/user/cabinet">
                            <div class="form-group">
                                <label class="control-label col-xs-3" for="name"><?= Lang::_('fields', 'name') ?></label>
                                <div class="col-xs-9 col-sm-8 <?php if(array_key_exists('name', $errors)) echo 'has-error';?>">
                                    <input type="text" class="form-control" id="name" name="name"
                                           placeholder="<?= Lang::_('placeholders', 'name'); ?>" value="<?php showValue('name'); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" for="lastName"><?= Lang::_('fields', 'lastName') ?></label>
                                <div class="col-xs-9 col-sm-8 <?php if(array_key_exists('lastName', $errors)) echo 'has-error';?>">
                                    <input type="text" class="form-control" id="lastName" name="lastName"
                                           placeholder="<?= Lang::_('placeholders', 'lastName'); ?>" value="<?php showValue('lastName')?>">
                                    <?php checkError('lastName', $errors)?>
                                </div>
                            </div>
                            <div id='brthd' class=" <?php if (isset($errors['brthd'])) echo 'has-error'; ?>">
                                <div class="form-group">
                                    <label class="control-label col-xs-3"><?= Lang::_('fields', 'brthd') ?></label>
                                    <div class="col-xs-3 col-sm-2">
                                        <select id="select01" class="form-control" name="b_day">
                                            <option value="0"><?= Lang::_('inputs', 'b_day')?></option>
                                            <?php for ($i = 1; $i < 32; $i++): ?>
                                                <option value="<?php echo $i; ?>" <?php isSelected($i, 'j');?> >
                                                    <?php echo $i;?>
                                                </option>
                                            <?php endfor;?>
                                        </select>
                                    </div>
                                    <div class="col-xs-3">
                                        <select id="select02" class="form-control" name="b_month">
                                            <option value="0"><?= Lang::_('inputs', 'b_month')?></option>
                                            <?php
                                            $months = Lang::_('inputs', 'months');
                                            for ($j = 1; $j < 13; $j++): ?>
                                                <option value="<?php echo $j; ?>" <?php isSelected($j, 'n') ?> >
                                                    <?php echo $months[$j - 1]; ?>
                                                </option>;
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                    <div class="col-xs-3">
                                        <select id="select03" class="form-control" name="b_year">
                                            <option value="0"><?= Lang::_('inputs', 'b_year')?></option>
                                            <?php for ($i = 2016; $i > 1920; $i--): ?>
                                                <option value="<?php echo $i; ?>" <?php isSelected($i, 'Y'); ?> >
                                                    <?php echo $i; ?>
                                                </option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" for="city"><?= Lang::_('fields', 'city') ?></label>
                                <div class="col-xs-9 col-sm-8 <?php if(array_key_exists('city', $errors)) echo 'has-error';?>">
                                    <input type="text" class="form-control" id="city" name="city"
                                           placeholder="<?= Lang::_('placeholders', 'city'); ?>"
                                            value="<?php showValue('city')?>">
                                    <?php checkError('city', $errors); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" for="phoneNumber"><?= Lang::_('fields', 'phoneNumber') ?></label>
                                <div class="col-xs-9 col-sm-8 <?php if(array_key_exists('phoneNumber', $errors)) echo 'has-error';?>">
                                    <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber"
                                           placeholder="<?= Lang::_('placeholders', 'phoneNumber'); ?>"
                                           value="<?php showValue('phoneNumber')?>" >
                                    <?php checkError('phoneNumber', $errors); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" for="description"><?= Lang::_('fields', 'description') ?></label>
                                <div class="col-xs-9 col-sm-8 <?php if(array_key_exists('description', $errors)) echo 'has-error';?>">
                                    <textarea rows="4" class="form-control" id="description" name="description" placeholder="<?= Lang::_('placeholders', 'description'); ?>"
                                              value=""><?php showValue('description')?></textarea>
                                    <?php checkError('description', $errors); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label
                                    class="control-label col-xs-3 <?php if (isset($errors['gender'])) echo 'has-error'; ?>"><?= Lang::_('fields', 'gender') ?></label>
                                <div class="col-xs-2">
                                    <label class="radio-inline">
                                        <input type="radio" name="gender"
                                               value="Male" <?php if ($user['gender'] == 1) echo 'checked' ?>> <?= Lang::_('inputs', 'gender_m') ?>
                                    </label>
                                </div>
                                <div class="col-xs-2  col-xs-offset-2 col-sm-offset-0">
                                    <label class="radio-inline">
                                        <input type="radio" name="gender"
                                               value="Female" <?php if ($user['gender'] == 0) echo 'checked' ?>> <?= Lang::_('inputs', 'gender_f') ?>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" for="user_avatar"><?= Lang::_('fields', 'avatar') ?></label>
                                <?php if($user['avatar']==''):?>
                                    <div class="hidden-xs col-sm-4 field_avatar <?php if(array_key_exists('avatar', $errors)) echo 'has-error'?>">
                                    <span><?= Lang::_('placeholders', 'avatar'); ?><i class="glyphicon glyphicon-arrow-right"></i></span>
                                        <p class="help-block"><?= Lang::_('placeholders', 'avatar_help'); ?><?php echo round($config['max_size']/1024/1024, 1) . ' MB';?></p>
                                    </div><?php else: ?>
                                    <div class="col-sm-3">
                                    <img src="<?php echo $user['avatar'];?>" alt="User photo" class="img-responsive img-rounded" height="150" width="200">
                                    </div>
                                <?php endif ;?>
                                <div class="col-xs-9 col-sm-3 field_avatar  <?php if(array_key_exists('avatar', $errors)) echo 'has-error'?>">
                                    <input type="file" id="user_avatar" name="avatar">
                                    <?php checkError('avatar', $errors); ?>
                                    <?php if($user['avatar'] !=''):?>
                                        <input type="checkbox" id="deleteAvatar" name="deleteAvatar">
                                        <label class="control-label" for="deleteAvatar"><?= Lang::_('inputs', 'deleteAvatar')?></label>
                                    <?php endif?>

                                </div>

                            </div>

                            <br/>
                            <div class="form-group">
                                <div class="col-xs-offset-3 col-xs-9">
                                    <input type="submit" class="btn btn-primary" value="<?= Lang::_('buttons', 'submit2')?>"
                                           name="updateInfo">
                                    <input type="reset" class="btn btn-default" value="<?= Lang::_('buttons', 'cancel')?>">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</section>
<?php include ROOT . '/views/layouts/footer.php'; ?>