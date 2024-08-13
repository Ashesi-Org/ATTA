$(document).ready(function () {
    // LOGIN
    $('#login-form').on('submit', function (event) {
        event.preventDefault(); // Prevent the default form submission

        // Add loading class to button
        $('#login-button').addClass('is-loading is-loading-sm');

        $.ajax({
            url: 'Actions/login_user.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                var res = JSON.parse(response);
                if (res.status === 'success') {
                    window.location.href = 'index.php'; // Redirect to dashboard or any other page on success
                } else {
                    $('#login-error-message').text(res.message);
                    $('#login-error').show();
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', status, error);
                $('#login-error-message').text('An error occurred. Please try again.');
                $('#login-error').show();
            },
            complete: function () {
                // Remove loading class from button
                $('#login-button').removeClass('is-loading is-loading-sm');
            }
        });
    });

    //  ENROLLMENT
    $('#enrollmentForm').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function (response) {
                console.log(response); // Log the response

                // Check the message in the response
                if (response.message === 'Not enrolled') {
                    // Toast the message
                    showToast('info', 'You are not enrolled in this course.<p>Redirecting to the pretest page...</p>');

                    //  Wait for 3 seconds before redirecting
                    setTimeout(function () {
                        // Redirect to the pretest page
                        window.location.href = 'enrollment-pretest.php?course_id=' + response.course_id + '&user_id=' + response.student_id;
                    }, 3000);

                } else {
                    // Redirect to the course page
                    window.location.href = 'single-course.php?course_id=' + response.course_id + '&course_name=' + response.course_name;
                }
            },
            error: function (xhr, status, error) {
                // Handle error response
                showToast('error', 'An error occurred while checking enrolment.');
            }
        });
    });





    // SAVING COURSE
    $('.add-course').on('click', function (e) {
        e.preventDefault();
        var courseId = $(this).data('course-id');
        var studentId = $(this).data('student-id');
        var $button = $(this);

        $.ajax({
            url: 'Actions/add_course.php',
            type: 'POST',
            data: {
                course_id: courseId,
                student_id: studentId
            },
            success: function (response) {
                var res = JSON.parse(response);
                if (res.status === 'success') {
                    // Update the button to remove course button
                    $button.removeClass('btn-primary add-course').addClass('btn-danger remove-course')
                        .html('<i class="material-icons">remove</i>')
                        .off('click')
                        .on('click', removeCourse);
                    showToast('success', 'Course has been saved.');
                } else {
                    showToast('error', res.message);
                }
            },
            error: function (xhr, status, error) {
                showToast('error', 'An error occurred while adding the course.');
            }
        });
    });

    // REMOVING COURSE
    $('.remove-course').on('click', function (e) {
        e.preventDefault();
        var courseId = $(this).data('course-id');
        var studentId = $(this).data('student-id');
        var $button = $(this);

        $.ajax({
            url: 'Actions/remove_course.php',
            type: 'POST',
            data: {
                course_id: courseId,
                student_id: studentId
            },
            success: function (response) {
                var res = JSON.parse(response);
                if (res.status === 'success') {
                    // Update the button to add course button
                    $button.removeClass('btn-danger remove-course').addClass('btn-primary add-course')
                        .html('<i class="material-icons">add</i>')
                        .off('click')
                        .on('click', addCourse);
                    showToast('error', 'Course has been removed.');
                } else {
                    showToast('error', res.message);
                }
            },
            error: function (xhr, status, error) {
                showToast('error', 'An error occurred while removing the course.');
            }
        });
    });

    function addCourse(e) {
        e.preventDefault();
        var courseId = $(this).data('course-id');
        var studentId = $(this).data('student-id');
        var $button = $(this);

        $.ajax({
            url: 'Actions/add_course.php',
            type: 'POST',
            data: {
                course_id: courseId,
                student_id: studentId
            },
            success: function (response) {
                var res = JSON.parse(response);
                if (res.status === 'success') {
                    $button.removeClass('btn-primary add-course').addClass('btn-danger remove-course')
                        .html('<i class="material-icons">remove</i>')
                        .off('click')
                        .on('click', removeCourse);
                    showToast('success', 'Course has been saved.');
                } else {
                    showToast('error', res.message);
                }
            },
            error: function (xhr, status, error) {
                showToast('error', 'An error occurred while adding the course.');
            }
        });
    }

    function removeCourse(e) {
        e.preventDefault();
        var courseId = $(this).data('course-id');
        var studentId = $(this).data('student-id');
        var $button = $(this);

        $.ajax({
            url: 'Actions/remove_course.php',
            type: 'POST',
            data: {
                course_id: courseId,
                student_id: studentId
            },
            success: function (response) {
                var res = JSON.parse(response);
                if (res.status === 'success') {
                    $button.removeClass('btn-danger remove-course').addClass('btn-primary add-course')
                        .html('<i class="material-icons">add</i>')
                        .off('click')
                        .on('click', addCourse);
                    showToast('error', 'Course has been removed.');
                } else {
                    showToast('error', res.message);
                }
            },
            error: function (xhr, status, error) {
                showToast('error', 'An error occurred while removing the course.');
            }
        });
    }

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
});