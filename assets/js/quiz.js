document.addEventListener('DOMContentLoaded', function () {
    let currentQuestionIndex = 0;
    const totalQuestions = document.querySelectorAll('.question-card').length;

    function showQuestion(index) {
        document.querySelectorAll('.question-card').forEach((card, i) => {
            card.style.display = (i === index) ? 'block' : 'none';
        });
        document.getElementById('prev-btn').style.display = (index > 0) ? 'inline-block' : 'none';
        document.getElementById('next-btn').style.display = (index < totalQuestions - 1) ? 'inline-block' : 'none';
        document.getElementById('submit-btn').style.display = (index === totalQuestions - 1) ? 'inline-block' : 'none';
    }

    function isCurrentQuestionAnswered() {
        const currentQuestion = document.getElementById('question-' + currentQuestionIndex);
        const radioButtons = currentQuestion.querySelectorAll('input[type="radio"]');
        return Array.from(radioButtons).some(radio => radio.checked);
    }

    function nextQuestion() {
        if (isCurrentQuestionAnswered()) {
            if (currentQuestionIndex < totalQuestions - 1) {
                currentQuestionIndex++;
                showQuestion(currentQuestionIndex);
            }
        } else {
            // Show a toast message
            showToast('warning', 'Please select an answer to proceed.');
        }
    }

    function previousQuestion() {
        if (currentQuestionIndex > 0) {
            currentQuestionIndex--;
            showQuestion(currentQuestionIndex);
        }
    }

    document.querySelectorAll('.next-btn').forEach(button => {
        button.addEventListener('click', nextQuestion);
    });

    document.querySelectorAll('.prev-btn').forEach(button => {
        button.addEventListener('click', previousQuestion);
    });

    showQuestion(currentQuestionIndex); // Initialize the first question view

    // AJAX form submission
    document.getElementById('pretestForm').addEventListener('submit', function (event) {
        event.preventDefault();

        const form = event.target;
        const formData = new FormData(form);
        const xhr = new XMLHttpRequest();

        xhr.open('POST', 'Actions/enroll.php', true);
        xhr.setRequestHeader('Accept', 'application/json');
        xhr.onload = function () {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                const responseMessage = document.getElementById('responseMessage');
                responseMessage.innerHTML = response.message;
                if (response.topics.length > 0) {
                    responseMessage.innerHTML += '<br>Topics you should study: ' + response.topics.join(', ');

                    // Show a toast message
                    showToast('success', 'Great, we have curated your list of topics to study');
                    // redirect after 3 seconds
                    setTimeout(() => {
                        window.location.href = 'single-course.php?course_id=' + response.course_id + '&course_name=' + response.course_name;
                    }, 3000);
                }
            } else {
                document.getElementById('responseMessage').innerHTML = 'An error occurred during submission. Please try again.';
            }
        };
        xhr.send(formData);
    });
});

// SHOW TOAST
function showToast(icon, title) {
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: icon,
        title: title,
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer);
        }
    });
}
