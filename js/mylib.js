/**
 * Created by driln on 25.11.2015.
 */
//Функция блокировки кнопки при загрузке документа
$(document).ready(function(){
    var button = document.getElementById('enterButton');
    button.disabled = true;
    $("enterButton").addClass("disabled");
});

//Функция проверки строки в поле логина на SQL инъекции
$(function(){
    $("#auth").children("table").children("tbody").children("tr:first-child").children("td:last-child")
        .children("input").on("input", function(e){
            var input = this;
            var value = input.value;
            var reg = /[`"'\\\/]/;
            if(reg.test(value)) {
                alert("Вы ввели недопустимый символ!\n\r" +
                    "Полный список недопустимых символов:    `'/\"");
                var length = value.length - 1;
                value = value.substring(0, length);
                this.value = value;
            }
    })
});



//Функции проверки заполненности полей, при заполненности обоих полей кнопка разблокируется
$(function(){
    $("#auth").children("table").children("tbody").children("tr:first-child").children("td:last-child")
        .children("input").on("input", function(e){
            var input = this;
            var value = input.value;
            if(value!="") {
                $pass=$("#auth").children("table").children("tbody").children("tr:last-child").children("td:last-child")
                    .children("input");
                        var passvalue = $pass[0].value;
                        if(passvalue!=="") {
                            var button = document.getElementById('enterButton');
                            button.disabled = false;
                            $("enterButton").removeClass("disabled");
                            $("enterButton").addClass("active");
                        }
                console.log(passvalue);
            }
        })
});

$(function(){
    $("#auth").children("table").children("tbody").children("tr:last-child").children("td:last-child")
        .children("input").on("input", function(e){
            var input = this;
            var value = input.value;
            if(value!="") {
                $login=$("#auth").children("table").children("tbody").children("tr:first-child").children("td:last-child")
                    .children("input");
                var namevalue = $login[0].value;
                if(namevalue!=="") {
                    var button = document.getElementById('enterButton');
                    button.disabled = false;
                    $("enterButton").removeClass("disabled");
                    $("enterButton").addClass("active");
                    console.log(namevalue);
                }
            }
        })
});
