<?php
// Report all errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include core file
include_once(__DIR__ . "/Settings/core.php");

// Include the general functions
include_once(__DIR__ . "/Functions/general_function.php");

if (!logged_in()) {
    header("Location: login.php");
    exit();
}

// Check if the user is an admin
if (!is_admin()) {
    header("Location: login.php");
    exit();
}

// Get course details
$course_id = $_GET['course_id'];
$course_details = get_course_details($course_id);

// Get course topics along with subtopics
$course_topics = get_course_topics($course_id);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Course Details</title>
    <meta name="robots" content="noindex">
    <link type="text/css" href="assets/vendor/perfect-scrollbar.css" rel="stylesheet">
    <link type="text/css" href="assets/css/app.css" rel="stylesheet">
    <link type="text/css" href="assets/css/app.rtl.css" rel="stylesheet">
    <link type="text/css" href="assets/css/vendor-material-icons.css" rel="stylesheet">
    <link type="text/css" href="assets/css/vendor-fontawesome-free.css" rel="stylesheet">
    <link type="text/css" href="assets/css/vendor-ion-rangeslider.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body class="layout-default">
    <div class="loader loader-lg"></div>

    <div id="modal-standard" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-standard-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-standard-title">Select Content Style</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Please select the style of content you want to generate:</p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="contentStyle" id="textbook" value="textbook">
                        <label class="form-check-label" for="textbook">Textbook</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="contentStyle" id="lecture" value="lecture">
                        <label class="form-check-label" for="lecture">Lecture Slides</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <button type="button" id="modal-save-button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div id="content">
        <div class="mdk-header-layout js-mdk-header-layout">
            <?php include 'Components/header.php'; ?>

            <div class="mdk-header-layout__content">
                <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
                    <div class="mdk-drawer-layout__content page">
                        <div>
                            <div class="container-fluid page__heading-container">
                                <div class="page__heading d-flex align-items-center justify-content-between">
                                    <h1 class="m-0"><?php echo $course_details['course_name']; ?></h1>
                                </div>
                            </div>
                            <section class="ftco-section">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-wrap">
                                                <table class="table myaccordion table-hover" id="accordion">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Topic</th>
                                                            <th>Number of Sub Topics</th>
                                                            <th>&nbsp;</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($course_topics as $key => $topic) : ?>
                                                            <?php $sub_count = subcount_topic($topic['topic_id']); ?>
                                                            <tr data-toggle="collapse" data-target="#collapseOne<?php echo $topic['topic_id']; ?>" aria-expanded="false" aria-controls="collapseOne<?php echo $topic['topic_id']; ?>">
                                                                <th scope="row"><?php echo $key + 1; ?></th>
                                                                <td><?php echo $topic['topic_name']; ?></td>
                                                                <td><?php echo $sub_count; ?></td>
                                                                <td><i class="fa" aria-hidden="true"></i></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="6" id="collapseOne<?php echo $topic['topic_id']; ?>" class="collapse acc" data-parent="#accordion">
                                                                    <table class="table table-hover">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>#</th>
                                                                                <th>Sub Topic</th>
                                                                                <th>Content</th>
                                                                                <th>Confirm content</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php $subtopics = get_subtopics($topic['topic_id']); ?>
                                                                            <?php foreach ($subtopics as $sub_key => $subtopic) : ?>
                                                                                <tr>
                                                                                    <th scope="row"><?php echo $sub_key + 1; ?></th>
                                                                                    <td><?php echo $subtopic['subtopic_name']; ?> <a href="#" onclick="getcontent('<?php echo $subtopic['subtopic_name']; ?>', <?php echo $subtopic['topic_id']; ?>, <?php echo $subtopic['subtopic_id']; ?>)">(review content)</a></td>
                                                                                    <td>
                                                                                        <div id="editor-container-<?php echo $subtopic['subtopic_id']; ?>" class="editor-container"></div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <button id="confirm-<?php echo $subtopic['subtopic_id']; ?>" class="btn btn-primary" onclick="saveContent(<?php echo $subtopic['subtopic_id']; ?>, <?php echo $topic['topic_id']; ?>)">Confirm</button>
                                                                                    </td>
                                                                                </tr>
                                                                            <?php endforeach; ?>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>

                    <?php include 'Components/sidebar.php'; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/vendor/jquery.min.js"></script>
    <script src="assets/vendor/popper.min.js"></script>
    <script src="assets/vendor/bootstrap.min.js"></script>
    <script src="assets/vendor/perfect-scrollbar.min.js"></script>
    <script src="assets/vendor/dom-factory.js"></script>
    <script src="assets/vendor/material-design-kit.js"></script>
    <script src="assets/vendor/ion.rangeSlider.min.js"></script>
    <script src="assets/js/ion-rangeslider.js"></script>
    <script src="assets/js/toggle-check-all.js"></script>
    <script src="assets/js/check-selected-row.js"></script>
    <script src="assets/js/dropdown.js"></script>
    <script src="assets/js/sidebar-mini.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/app-settings.js"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        let selectedContentType = '';

        $(document).ready(function() {
            // Initialize Quill editors
            <?php foreach ($course_topics as $topic) : ?>
                <?php $subtopics = get_subtopics($topic['topic_id']); ?>
                <?php foreach ($subtopics as $subtopic) : ?>
                    var quill<?php echo $subtopic['subtopic_id']; ?> = new Quill('#editor-container-<?php echo $subtopic['subtopic_id']; ?>', {
                        theme: 'snow'
                    });
                    $('#editor-container-<?php echo $subtopic['subtopic_id']; ?>').data('quillEditor', quill<?php echo $subtopic['subtopic_id']; ?>);
                <?php endforeach; ?>
            <?php endforeach; ?>

            $('.loader').hide();
            $('#content').show();
        });

        function getcontent(subtopic, topic_id, subtopic_id) {
            $('#modal-standard').modal('show');

            $('#modal-save-button').off('click').on('click', function() {
                selectedContentType = $('input[name="contentStyle"]:checked').val();

                if (!selectedContentType) {
                    showToast('error', 'Please select a content style.');
                    return;
                }

                var data = {
                    "week": topic_id,
                    "style": selectedContentType,
                    "topic": subtopic
                };
                showToast('info', 'Please wait while the content is being loaded...');

                $.ajax({
                    url: 'https://dela-xw5ne3ehqq-uc.a.run.app/generate-content',
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify(data),
                    success: function(response) {
                        response = formatTextToHTML(response);

                        var editorContainerId = '#editor-container-' + subtopic_id;
                        var quillEditor = $(editorContainerId).data('quillEditor');

                        if (quillEditor) {
                            showToast('success', 'Content generated successfully');
                            quillEditor.setContents(quillEditor.clipboard.convert(response));
                        } else {
                            showToast('error', 'Error generating content');
                        }
                    },
                    error: function(error) {
                        showToast('error', 'Error generating content');
                    }
                });

                $('#modal-standard').modal('hide');
            });
        }

        function formatTextToHTML(text) {
            // Replace headers (### and ####) with corresponding HTML tags
            text = text.replace(/^### (.+)$/gm, '<h3>$1</h3>');
            text = text.replace(/^#### (.+)$/gm, '<h4>$1</h4>');

            // Replace bold text (**text**) with <strong> tags
            text = text.replace(/\*\*(.+?)\*\*/g, '<strong>$1</strong>');

            // Replace inline code with <code> tags
            text = text.replace(/`([^`]+)`/g, '<code>$1</code>');

            // Replace code blocks (``` ... ```) with <pre><code> tags
            text = text.replace(/```([\s\S]*?)```/g, '<pre><code>$1</code></pre>');

            // Wrap paragraphs with <p> tags
            text = text.replace(/^\s*([^\n]+)\s*$/gm, '<p>$1</p>');

            return text;
        }

        function saveContent(subtopic_id, topic_id) {
            if (!selectedContentType) {
                showToast('error', 'Please select a content style.');
                return;
            }

            var editorContainerId = '#editor-container-' + subtopic_id;
            var quillEditor = $(editorContainerId).data('quillEditor');
            var content = quillEditor.root.innerHTML;

            $.ajax({
                url: 'Actions/save_content.php',
                type: 'POST',
                data: {
                    subtopic_id: subtopic_id,
                    topic_id: topic_id,
                    content: content,
                    style: selectedContentType
                },
                success: function(response) {
                    showToast('success', 'Content saved successfully');
                },
                error: function(error) {
                    showToast('error', 'Error saving content');
                }
            });
        }

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
    </script>
</body>

</html>
