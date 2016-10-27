<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <?php
    if (isset($errors)) {
        foreach ($errors as $error) {
            echo $error . '<br/>';
        }
    }
    ?>
    <div class="content">
        <div class="col-md-8 col-md-offset-2 col-xs-12">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                            <h4>Приветствуем Вас, <?php echo $user['name']; ?>, дополните информацию о себе</h4>

                    </div>
                    <div class="panel-body">

                        <form class="form-horizontal" method="post" enctype=multipart/form-data action="/user/cabinet">
                            <div class="form-group">
                                <label class="control-label col-xs-3" for="name">Имя:</label>
                                <div class="col-xs-9 col-sm-8">
                                    <input type="text" class="form-control" id="name" name="name"
                                           placeholder="Введите имя" value="<?php echo $user['name'] ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" for="lastName">Фамилия:</label>
                                <div class="col-xs-9 col-sm-8">
                                    <input type="text" class="form-control" id="lastName" name="lastName"
                                           placeholder="Введите фамилию">
                                </div>
                            </div>
                            <div id='brthd' class=" <?php if (isset($errors['brthd'])) echo 'has-error'; ?>">
                                <div class="form-group">
                                    <label class="control-label col-xs-3">Дата рождения:</label>
                                    <div class="col-xs-3 col-sm-2">
                                        <select id="select01" class="form-control" name="b_day">
                                            <option value="0">День</option>
                                            <?php for ($i = 1; $i < 32; $i++) { ?>
                                                <option
                                                    value="<?php echo $i; ?>" <?php if (isset($user['bday']) and date_format(date_create($user['bday']), 'j') == $i) echo 'selected'; ?>><?php echo $i; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-xs-3">
                                        <select id="select02" class="form-control" name="b_month">
                                            <option value="0">Месяц</option>
                                            <?php
                                            $months = ['Января', 'Февраля', 'Марта', 'Апреля', 'Мая', 'Июня', 'Июля', 'Августа', 'Сентября', 'Октября', 'Ноября', 'Декабря'];
                                            for ($j = 1; $j < 13; $j++) { ?>
                                                <option
                                                    value="<?php echo $j; ?>" <?php if (isset($user['bday']) and date_format(date_create($user['bday']), 'n') == $j) echo 'selected'; ?>><?php echo $months[$j - 1]; ?></option>;
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-xs-3">
                                        <select id="select03" class="form-control" name="b_year">
                                            <option value="0">Год</option>
                                            <?php for ($i = 2016; $i > 1920; $i--) { ?>
                                                <option
                                                    value="<?php echo $i; ?>" <?php if (isset($user['bday']) and date_format(date_create($user['bday']), 'Y') == $i) echo 'selected'; ?>><?php echo $i; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" for="city">Откуда вы:</label>
                                <div class="col-xs-9 col-sm-8">
                                    <input type="text" class="form-control" id="city" name="city"
                                           placeholder="Город в котором вы проживаете">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" for="phoneNumber">Телефон:</label>
                                <div class="col-xs-9  col-sm-8">
                                    <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber"
                                           placeholder="Введите номер телефона">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" for="description">Обо мне</label>
                                <div class="col-xs-9  col-sm-8">
                                    <textarea rows="4" class="form-control" id="description" name="description"
                                              placeholder="расскажите коротко о себе"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label
                                    class="control-label col-xs-3 <?php if (isset($errors['gender'])) echo 'has-error'; ?>">Пол:</label>
                                <div class="col-xs-2">
                                    <label class="radio-inline">
                                        <input type="radio" name="gender"
                                               value="Male" <?php if ($user['sex'] == 1) echo 'checked' ?>> Мужской
                                    </label>
                                </div>
                                <div class="col-xs-2  col-xs-offset-2 col-sm-offset-0">
                                    <label class="radio-inline">
                                        <input type="radio" name="gender"
                                               value="Female" <?php if ($user['sex'] == 0) echo 'checked' ?>> Женский
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" for="user_avatar">Фото:</label>
                                <div class="col-xs-9">
                                    <input type="file" id="user_avatar" name="avatar" value="загрузить фото">
                                </div>
                            </div>
                            <br/>
                            <div class="form-group">
                                <div class="col-xs-offset-3 col-xs-9">
                                    <input type="submit" class="btn btn-primary" value="Сохранить изменения"
                                           name="updateInfo">
                                    <input type="reset" class="btn btn-default" value="Очистить форму">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</section>
<?php include ROOT . '/views/layouts/footer.php'; ?>
