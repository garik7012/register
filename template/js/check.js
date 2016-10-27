
$(document).ready(function() {
    alert(10);
    $("form").bind("submit", function(event){
        event.preventDefault();
        alert(15);
        //при повторной отправке удаляем все ошибки

//проверка email
        var email = $('#email').val();
        emailReg = /^[\w]{1}[\w-\.]*@[\w-]+\.[a-z]{2,4}$/i;
        if(!emailReg.test(email) || email == '')
        {
            showError('email', "Пожалуйста, введите ваш e-mail");
        }
        //проверка пароля
        var pwd1 = $('#password').val();
        if(pwd1.length < 7) showError('password', 'пароль должен быть длинее 6 символов');
        if(pwd1.length > 30) showError('password', 'пароль не должен быть длинее 30 символов');

        /* подумав, решил оставить сложность пароля на пользователе. если надо, проверку на сложность можно всегда включить
         pwdReg = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/;
         if(!pwdReg.test(pwd1)){
         showError('password', 'пароль должен содержать...');
         }*/

        //проверка повторного ввода пароля
        var pwd2 = $('#password-confirm').val();
        if(pwd1 !== pwd2){
            showError("password-confirm", 'пароли не совпадают')
        }
        //проверка выбора пола
      

        if(!checkDate()){
            errorField.children().text('Пожалуйста, выберите дату рождения');
            $('#brthd .row').append(errorField);
            $('#brthd').addClass('has-error');
        }

    });

//дата рождения. выбор правильной даты
    $('select').bind('change click', function()
    {
        checkDate();
    });



    function checkDate() {
        monthForChek = $("select#select02").val();
        dayForCheck = $("select#select01").val();
        yearForCheck = $("select#select03").val();
        if(~$.inArray(+monthForChek, [1,3,5,7,8,10,12])){
            $("#select01 [value='29']").show();
            $("#select01 [value='30']").show();
            $("#select01 [value='31']").show();
        } else if(~$.inArray(+monthForChek, [4,6,9,11])) {
            if(+dayForCheck == 31) $("#select01 :first-child").prop('selected', true);
            $("#select01 [value='31']").hide();
        } else if(monthForChek == 2){
            $("#select01 [value='30']").hide();
            $("#select01 [value='31']").hide();
            if(+dayForCheck == 31 || +dayForCheck == 30) $("#select01 :first-child").prop('selected', true);
            if(yearForCheck%4 != 0){
                $("#select01 [value='29']").hide();
                if(+dayForCheck == 29) $("#select01 :first-child").prop('selected', true);
            } else $("#select01 [value='29']").show();
        }
        dt = new Date(yearForCheck, monthForChek-1, dayForCheck);
        return ((+yearForCheck == dt.getFullYear()) && ((+monthForChek-1) == dt.getMonth()) && (+dayForCheck == dt.getDate()));
    }



    function showError(fieldName, err) {
        eF = errorField.clone();
        eF.children().text(err);
        $('#' + fieldName).after(eF);
        $('#' + fieldName).parent().addClass('has-error');
    }
});
