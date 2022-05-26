$(document).ready(function () {
    const inputs = '<tr>' + $('#inputs').html() + '</tr>';

    $('.plus').on('click', () => {
        $('table').append(inputs);
    });

    $('.minus').on('click', () => {
        let trCount = $('table tr').length;

        if (trCount > 2) {
            $('table tr').last().remove();
        } else {
            alert('You can\'t delete');
        }
    });

    $('form').on('submit', function(e) {
        e.preventDefault();

        let form = $(this);
        let url = form.attr('action');

        $.ajax({
            url: url,
            method: 'POST',
            dataType: 'json',
            data: form.serialize(),
            success: function (response) {
                let status = response.status

                if (status === 200) {
                    $('.response-content').html('<p class="success">' + response.message + '</p>');

                    $('input[name="total[]"]').each(function (index) {
                        $(this).val(response.data[index]);
                    });
                } else {
                    $('.response-content').html('<p class="red">' + response.message + '</p>');
                }
            }
        });
    });
});