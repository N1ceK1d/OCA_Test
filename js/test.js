$(document).ready(() => {
    $('.answers').on('change', (event) => {
        if($(event.target).hasClass('check_input')) {
            $(event.target).parent().parent().parent().removeClass('border-danger');
        }
    })

    $('.end_test_btn').on('click', () => {
        if($('.check_input:checked').length == 200) {
            $('.end_test_btn').prop('type', 'submit');
        } else {
            $('.end_test_btn').prop('type', 'button');
            const alertPlaceholder = document.getElementById('liveAlertPlaceholder')
            const alert = (message, type) => {
              const wrapper = document.createElement('div')
              wrapper.innerHTML = [
                `<div class="alert alert-${type} alert-dismissible position-fixed w-50" role="alert">`,
                `   <div>${message}</div>`,
                '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
                notChecked(),
                '</div>'
              ].join('')
              alertPlaceholder.append(wrapper)
            }
            alert(`Вы не ответили на ${200 - $('.check_input:checked').length} вопросов`, 'danger')
        }
    })
});

function notChecked() {
    let questionNumber = 1;
    if ($('.check_input:checked').length === 0) {
        $('.question-text').each(function(index, element) {
            if ($(element).siblings('.answers').find('.check_input:checked').length === 0) {
                $(element).parent('.question').addClass('border-danger'); // highlight the question's container
                $(element).parent('.question').get(0).scrollIntoView({behavior: "smooth"}); // scroll to the question
            }
            questionNumber++;
        });
        scrollToFirstUnansweredQuestion();
        return "<hr><p>Вы не ответили на ни один вопрос</p>";
    } else {
        questionNumber = 1; // reset the questionNumber variable
        let notAnsweredQuestionFound = false;
        $('.question-text').each(function(index, element) {
            if ($(element).siblings('.answers').find('.check_input:checked').length === 0) {
                notAnsweredQuestionFound = true;
                $(element).parent('.question').addClass('border-danger');
                scrollToFirstUnansweredQuestion();
            } else {
                $(element).parent('.question').removeClass('border-danger');
            }
            questionNumber++;
        });
        if (notAnsweredQuestionFound) {
            return `<hr><p>Вы ответили не на все вопросы</p>`;
        } 
    }
}

function scrollToFirstUnansweredQuestion() {
    const questions = $('.question');
    let firstUnansweredQuestion = null;
    questions.each(function() {
      const inputs = $(this).find('input');
      const hasUnansweredInput = inputs.filter(':checked').length === 0;
      if (hasUnansweredInput && !firstUnansweredQuestion) {
        firstUnansweredQuestion = $(this);
      }
    });
    if (firstUnansweredQuestion) {
      firstUnansweredQuestion.get(0).scrollIntoView({behavior: "smooth"});
    }
  }

function getFirstNotChecked() {
    $('.answers').map((index, element) => {
        console.log($(element));
        if(!$(element).find('.check_input').is(':checked')) {
            return `<p>Вы не ответили на ${ $(element).parent().find('.question-text').text() } вопрос</p>`;
        }
        
    });
}

function getFirstNotAnsweredQuestion() {
    let questionNumber = 1;
    let notAnsweredQuestionFound = false;
    $('.question-text').each(function(index, element) {
        if ($(element).siblings('.answers').find('.check_input:checked').length === 0) {
            console.log(`Question ${questionNumber}: ${$(element).text()}`);
            notAnsweredQuestionFound = true;
            return false; // stop the loop
        }
        questionNumber++;
    });
    if (!notAnsweredQuestionFound) {
        console.log("All questions answered");
    }
}

