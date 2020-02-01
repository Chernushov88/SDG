var forms = new function() {

    this.msg = {
        required: 'Обязательное поле',
        email: 'Укажите корректный e-mail', 
        phone: 'Укажите корректный телефон',
        captcha: 'Неверный код проверки',
        form: 'Во время отправки формы возникли ошибки. Пожалуйста, перезагрузите страницу.',
        success: 'Ваше сообщение отправлено. Мы свяжемся с Вами в рабочее время в течение 15 минут.'
    };
    
    this.validate = function(selector) {

        var $form = $(selector);

        if ($.isFunction($.fn.validate) && $form.length != 0 && $form.data('checkform')) {

            $form.validate({
                //onKeyup: true,
                onChange: true,
                eachValidField: function() {
                    $(this).closest('.b-form_box').removeClass('g-error');
                    $(this).closest('.b-form_box').find('.b-form_box_error').remove();
                },
                eachInvalidField: function(status, options) {
                    $(this).closest('.b-form_box').addClass('g-error');
                    $(this).closest('.b-form_box').find('.b-form_box_error').remove();

                    if(options.required) {
                        if(!options.pattern) {
                            if($form.data('report') != 'placeholder') {
                                $(this).closest('.b-form_box').append('<span class="b-form_box_error">' + forms.msg.email + '</span>');
                            } else {
                                $(this).val('').attr('placeholder', forms.msg.email);
                            }
                        }
                    } else {
                        if($form.data('report') != 'placeholder') {
                            $(this).closest('.b-form_box').append('<span class="b-form_box_error">' + forms.msg.required + '</span>');
                        } else {
                            $(this).val('').attr('placeholder', forms.msg.required);
                        }
                    }

                },
                invalid: function() {

                    var documentScrollState = document.documentElement.scrollTop || document.body.scrollTop,
                        targetPosition = $(this).find('.g-error:first').offset().top - 30;
                    
                    if(documentScrollState > targetPosition) {
                        $('html, body').animate({ scrollTop: $(this).find('.g-error:first').offset().top - 20 }, 200);
                    }

                },
                valid: function(e) {

                    e.preventDefault();

                    var $targetFrom = $(this),
                        data = $(this).serialize();

                    $targetFrom.find('.g-btn').addClass('sending');

                    $.ajax({
                        url: $targetFrom.attr('action'),
                        method: $targetFrom.attr('method'),
                        data: data,
                        success: function(data) {

                            $targetFrom.find('.g-btn').removeClass('sending');
                            $targetFrom.parent().find('.b-form_answer').remove();

                            if($targetFrom.attr('action') == 'php/callback.php') {

                                var json = $.parseJSON(data);

                                if(json.status) {
                                    $targetFrom.after('<div class="b-form_answer blue"><p>Спасибо за заявку. Мы перезвоним Вам в ближайшее время.</p></div>');
                                } else {
                                    $targetFrom.after('<div class="b-form_answer red"><p>Ошибка! Попробуйте еще раз.</div></p>');
                                }

                            } else {

                                var answerContent = $(data).find('#content p:lt(2)'),
                                    isError = $(data).find('.errorMsg').length > 0;

                                if(isError) {
                                    $targetFrom.after('<div class="b-form_answer red"><p>Ошибка! Проверьте правильность e-mail.</div></p>');
                                } else {
                                    //$targetFrom.after('<div class="b-form_answer blue"><p>Еще чуть-чуть! Проверьте, пришло ли от нас подтверждение, и подтвердите свой электронный адрес, пройдя по ссылке.</p></div>');
                                    $targetFrom.after('<div class="b-form_answer blue"></div>');
                                    $targetFrom.parent().find('.b-form_answer').append(answerContent);
                                    $targetFrom.find('.g-btn').attr('disabled', true);
                                }

                            }

                            $targetFrom.parent().find('.b-form_answer').fadeIn(300);

                        }

                    });

                }
            });

        }

    };

};