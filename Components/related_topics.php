<?php
// include the core file
include_once(__DIR__ . "/../Settings/core.php");

// get related topics
$related_topics = get_related_topics($course['course_id'], $topic_id);

?>
<div class="card">
    <div class="card-header card-header-large bg-light d-flex align-items-center">
        <div class="flex">
            <h4 class="card-header__title">Related Topics</h4>
        </div>
    </div>
    <div class="card-body">
        <?php foreach ($related_topics as $topic) : ?>
        <div class="card card__course clear-shadow border">
            <div class="p-3">
                <div class="d-flex align-items-center">
                    <div>
                        <a class="text-body mb-1" href="#"><strong><?php echo $topic['topic_name']; ?></strong></a><br>
                    </div>
                    <a href="topic.php?topic=<?php echo $topic['topic_name']; ?> & topic_id=<?php echo $topic['topic_id']; ?>" class="btn btn-primary ml-auto">
                        <i class="sidebar-menu-icon sidebar-menu-icon fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>