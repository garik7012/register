<?php include ROOT . '/views/layouts/header.php'; ?>

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
     * показывает значение либо только что отправленное
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
                            <div class="panel-title form-title col-sm-7 col-sm-offset-1">Приветствуем Вас, <?php showValue('name'); ?>, дополните информацию о себе</div>
                            <div class="col-sm-4">
                                <a href="#" class="btn active" role="button">Рус</a>
                                <a href="#" class="btn" role="button">Eng</a>
                                <a href="#" class="btn btn-primary" role="button">Выход</a>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">

                        <form class="form-horizontal" method="post" enctype=multipart/form-data action="/user/cabinet">
                            <div class="form-group">
                                <label class="control-label col-xs-3" for="name">Имя:</label>
                                <div class="col-xs-9 col-sm-8 <?php if(array_key_exists('name', $errors)) echo 'has-error';?>">
                                    <input type="text" class="form-control" id="name" name="name"
                                           placeholder="Введите имя" value="<?php showValue('name') ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" for="lastName">Фамилия:</label>
                                <div class="col-xs-9 col-sm-8 <?php if(array_key_exists('lastName', $errors)) echo 'has-error';?>">
                                    <input type="text" class="form-control" id="lastName" name="lastName"
                                           placeholder="Введите фамилию" value="<?php showValue('lastName')?>">
                                    <?php checkError('lastName', $errors)?>
                                </div>
                            </div>
                            <div id='brthd' class=" <?php if (isset($errors['brthd'])) echo 'has-error'; ?>">
                                <div class="form-group">
                                    <label class="control-label col-xs-3">Дата рождения:</label>
                                    <div class="col-xs-3 col-sm-2">
                                        <select id="select01" class="form-control" name="b_day">
                                            <option value="0">День</option>
                                            <?php for ($i = 1; $i < 32; $i++): ?>
                                                <option value="<?php echo $i; ?>" <?php isSelected($i, 'j');?> >
                                                    <?php echo $i;?>
                                                </option>
                                            <?php endfor;?>
                                        </select>
                                    </div>
                                    <div class="col-xs-3">
                                        <select id="select02" class="form-control" name="b_month">
                                            <option value="0">Месяц</option>
                                            <?php
                                            $months = ['Января', 'Февраля', 'Марта', 'Апреля', 'Мая', 'Июня', 'Июля', 'Августа', 'Сентября', 'Октября', 'Ноября', 'Декабря'];
                                            for ($j = 1; $j < 13; $j++): ?>
                                                <option value="<?php echo $j; ?>" <?php isSelected($j, 'n') ?> >
                                                    <?php echo $months[$j - 1]; ?>
                                                </option>;
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                    <div class="col-xs-3">
                                        <select id="select03" class="form-control" name="b_year">
                                            <option value="0">Год</option>
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
                                <label class="control-label col-xs-3" for="city">Откуда вы:</label>
                                <div class="col-xs-9 col-sm-8 <?php if(array_key_exists('city', $errors)) echo 'has-error';?>">
                                    <input type="text" class="form-control" id="city" name="city"
                                           placeholder="Город в котором вы проживаете"
                                            value="<?php showValue('city')?>">
                                    <?php checkError('city', $errors); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" for="phoneNumber">Телефон:</label>
                                <div class="col-xs-9 col-sm-8 <?php if(array_key_exists('phoneNumber', $errors)) echo 'has-error';?>">
                                    <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber"
                                           placeholder="Введите номер телефона"
                                           value="<?php showValue('phoneNumber')?>" >
                                    <?php checkError('phoneNumber', $errors); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" for="description">Обо мне</label>
                                <div class="col-xs-9 col-sm-8 <?php if(array_key_exists('description', $errors)) echo 'has-error';?>">
                                    <textarea rows="4" class="form-control" id="description" name="description" placeholder="расскажите коротко о себе"
                                              value=""><?php showValue('description')?></textarea>
                                    <?php checkError('description', $errors); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label
                                    class="control-label col-xs-3 <?php if (isset($errors['gender'])) echo 'has-error'; ?>">Пол:</label>
                                <div class="col-xs-2">
                                    <label class="radio-inline">
                                        <input type="radio" name="gender"
                                               value="Male" <?php if ($user['gender'] == 1) echo 'checked' ?>> Мужской
                                    </label>
                                </div>
                                <div class="col-xs-2  col-xs-offset-2 col-sm-offset-0">
                                    <label class="radio-inline">
                                        <input type="radio" name="gender"
                                               value="Female" <?php if ($user['gender'] == 0) echo 'checked' ?>> Женский
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" for="user_avatar">Фото:</label>
                                <?php if($user['avatar']==''):?>
                                    <div class="hidden-xs col-sm-4 field_avatar <?php if(array_key_exists('avatar', $errors)) echo 'has-error'?>">
                                    <span>Добавьте ваше фото.<i class="glyphicon glyphicon-arrow-right"></i></span>
                                        <p class="help-block">Только изображения, не более <?php echo round($params['max_size']/1024/1024, 1) . ' MB';?></p>
                                    </div><?php else: ?>
                                    <div class="col-sm-3">
                                    <img src="<?php echo $user['avatar'];?>" alt="User photo" class="img-responsive img-rounded" height="150" width="200">
                                        </div>
                                <?php endif ;?>
                                <div class="col-xs-9 col-sm-3 field_avatar">
                                    <input type="file" id="user_avatar" name="avatar">
                                    <?php if($user['avatar'] !=''):?>
                                    <input type="checkbox" id="deleteAvatar" name="deleteAvatar">
                                    <label class="control-label" for="deleteAvatar">удалить фото</label>
                                    <?php endif?>

                                </div>

                            </div>

                            <br/>
                            <div class="form-group">
                                <div class="col-xs-offset-3 col-xs-9">
                                    <input type="submit" class="btn btn-primary" value="Сохранить изменения"
                                           name="updateInfo">
                                    <input type="reset" class="btn btn-default" value="Не сохранять">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</section>
<?php include ROOT . '/views/layouts/footer.php'; ?>