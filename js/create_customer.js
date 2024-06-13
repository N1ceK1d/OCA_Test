$(document).ready(() => {
    // Сначала скрываем оба блока
    $('.time_access').hide();
    $('.question_access').hide();

    // Обработчик события изменения для select
    $('.access_type').on('change', (event) => {
        // Получаем выбранное значение
        var valueSelected = $(event.target).val();

        // Скрываем оба блока
        $('.time_access').hide();
        $('.question_access').hide();

        // Показываем блоки в зависимости от выбранного значения
        if(valueSelected == 1) {
            $('.time_access').show();
        } else if(valueSelected == 2) {
            $('.question_access').show();
        } else if(valueSelected == 3) {
            $('.time_access').show();
            $('.question_access').show();
        }
    });

    // Триггерим событие change, чтобы установить начальное состояние
    $('.access_type').trigger('change');
});
