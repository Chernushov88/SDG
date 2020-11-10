'use strict';
//document.addEventListener('DOMContentLoaded', function() {
    if (document.querySelector('form.contact_form')) {
        var formElement = document.querySelector('form.contact_form');
        var btn = formElement.querySelector('.btn');
        btn.addEventListener('click', function() { feedback_send() });

        function feedback_send() {
            var formElement = document.querySelector('form.contact_form');
            var btn = formElement.querySelector('.btn');
            var formData = new FormData(formElement);
            btn.disabled = true;
            var request = new XMLHttpRequest();
            request.onreadystatechange = function() { if (this.readyState === 4 && this.status === 200) { setTimeout(function() { btn.innerText = '✔ Отправлено';
                        formElement.querySelector('textarea').value = ""; }, 350); } };
            request.onload = function() {
                if (this.status !== 200) {
                    console.log(this.statusText + ': ' + this.status);
                    btn.disabled = false;
                }

            }
            request.open('POST', '/templates/rt_chapelco/send.php', true);
            request.send(formData);
        }
    }
//})