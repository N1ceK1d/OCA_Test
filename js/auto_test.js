$(document).ready(() => {
    $('.answers').each((index, element) => {
        let answer_item = $(element).children()[0];
        let answerText = $(answer_item).children('label').text();
        if (answerText === "Да") {
            $(answer_item).children('input').prop('checked', true);
        }
    });
});