$(document).ready(function () {

    /*
            Добавляем позицию
     */
    $('#add-position').click(function (e) {
        e.preventDefault();

        let position = $('.container').find('#position').clone(),
            number = position.find('.number').val();

        position.attr('id', ('position' + number));
        position.find('#add-position').attr('class', ('btn btn-danger delete')).removeAttr("id").text('Удалить');
        position.find('.number').remove();
        position.find('input').val('');

        $('.number').val(parseInt(number) + 1);

        $('#position').after(position);
    });

    /*
            Удаляем позицию
     */
    $('.container').on('click', '.delete',function (e) {
        e.preventDefault();

        let input = $('.container').find('.number'),
            number = input.val();

        $('#position' + (parseInt(number) - 1)).remove();

        input.val((parseInt(number) - 1));
    });

    /*
            проверяем стоимость
     */
    $('#declared_price').keyup(function () {

        if (parseInt($(this).val()) >= 1000) {

            $('#insurance').prop('checked', true);
            $('#insurance_agent_code').attr('disabled', false);
        } else {

            $('#insurance').prop('checked', false);
            $('#insurance_agent_code').attr('disabled', true);
        }

        if (parseInt($(this).val()) >= 50000) {

            $('#have_doc').prop('checked', true);
        } else {

            $('#have_doc').prop('checked', false);
        }
    });

    /*
            нажатие страховка
     */
    $('#insurance').click(function () {
        
        if ($(this).prop('checked')) {

            $('#insurance_agent_code').attr('disabled', false);
        } else {

            $('#insurance_agent_code').attr('disabled', true);
        }

        if (parseInt($('#declared_price').val()) >= 1000) {

            $('#insurance').prop('checked', true);
            $('#insurance_agent_code').attr('disabled', false);
        }
    });

    /*
        нажатие документы
    */
    $('#have_doc').click(function () {

        if (parseInt($('#declared_price').val()) >= 50000) {

            $('#have_doc').prop('checked', true);
        }
    })
});