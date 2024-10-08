<?php
// include the core file
include_once(__DIR__ . "/../Settings/core.php");

// include the general function
include_once(__DIR__ . "/../Functions/general_function.php");

?>

<div class="mdk-drawer  js-mdk-drawer" id="default-drawer" data-align="start">
    <div class="mdk-drawer__content">
        <div class="sidebar sidebar-light sidebar-left bg-white" data-perfect-scrollbar>

            <div class="sidebar-block p-0 m-0">
                <div class="d-flex align-items-center sidebar-p-a border-bottom bg-light">
                    <a class="flex d-flex align-items-center text-body text-underline-0">
                        <span class="avatar avatar-sm mr-2">
                            <span class="avatar-title rounded-circle bg-soft-secondary text-muted">
                                <?php if (logged_in() == 1) :
                                    $fname = get_user_details($_SESSION['user_id'])['first_name'];
                                    $lname = get_user_details($_SESSION['user_id'])['last_name'];

                                    $initials = $fname[0] . ' ' . $lname[0];

                                    echo $initials;
                                endif;
                                ?>
                            </span>
                        </span>
                        <span class="flex d-flex flex-column">
                            <strong>
                                <?php if (logged_in() == 1) :
                                    echo get_user_details($_SESSION['user_id'])['first_name'] . ' ' . get_user_details($_SESSION['user_id'])['last_name'];
                                endif;

                                if (logged_in() != 1) :
                                    echo "<a href='login.php'>Login</a>";
                                endif;
                                ?>
                            </strong>
                            <small class="text-muted text-uppercase"><?php if (get_user_role($_SESSION['user_id']) == '2') :
                                                                            echo "ADMIN";
                                                                        elseif (get_user_role($_SESSION['user_id']) == '1') :
                                                                            echo "STUDENT";
                                                                        endif; ?></small>
                        </span>
                    </a>
                </div>
            </div>
            <div class="sidebar-block p-0">

                <div class="sidebar-heading">Student</div>

                <ul class="sidebar-menu mt-0">


                    <li class="sidebar-menu-item <?php if ($_SERVER['PHP_SELF'] == '/Capstone/index.php') : echo 'active';
                                                    endif; ?>">
                        <a class="sidebar-menu-button ajax-link" href="index.php">
                            <span class="sidebar-menu-icon sidebar-menu-icon--left">
                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 40 40" width="22" height="22">
                                    <g transform="matrix(1.6666666666666667,0,0,1.6666666666666667,0,0)">
                                        <path d="M7.652,14.05v-0.6C7.65,12.373,6.777,11.501,5.7,11.5H4.5c-0.414,0-0.75,0.336-0.75,0.75v6C3.75,18.664,4.086,19,4.5,19 h1.2c1.077-0.001,1.949-0.873,1.951-1.95v-0.6C7.65,16.117,7.564,15.79,7.4,15.5c-0.089-0.155-0.089-0.345,0-0.5 C7.564,14.71,7.651,14.383,7.652,14.05z M6.152,17.05c-0.017,0.249-0.231,0.437-0.48,0.42c-0.225-0.015-0.405-0.195-0.42-0.42v-0.6 c0.017-0.249,0.231-0.437,0.48-0.42c0.225,0.015,0.405,0.195,0.42,0.42V17.05z M6.152,14.05c-0.017,0.249-0.231,0.437-0.48,0.42 c-0.225-0.015-0.405-0.195-0.42-0.42v-0.6c0.017-0.249,0.231-0.437,0.48-0.42c0.225,0.015,0.405,0.195,0.42,0.42V14.05z M7.652,4.95C7.618,3.873,6.716,3.028,5.64,3.062C4.611,3.095,3.785,3.921,3.752,4.95v4.8c0,0.414,0.336,0.75,0.75,0.75 s0.75-0.336,0.75-0.75v-1.2c-0.017-0.249,0.171-0.463,0.42-0.48c0.249-0.017,0.463,0.171,0.48,0.42c0.001,0.02,0.001,0.04,0,0.06 v1.2c0,0.414,0.336,0.75,0.75,0.75s0.75-0.336,0.75-0.75V4.95z M6.152,6.15c-0.017,0.249-0.231,0.437-0.48,0.42 c-0.225-0.015-0.405-0.195-0.42-0.42v-1.2c0.017-0.249,0.231-0.437,0.48-0.42c0.225,0.015,0.405,0.195,0.42,0.42V6.15z M11.2,4H9.7 C9.286,4,8.95,4.336,8.95,4.75S9.286,5.5,9.7,5.5h1.5c0.414,0,0.75-0.336,0.75-0.75S11.614,4,11.2,4z M11.951,12.75 c0-0.414-0.336-0.75-0.75-0.75c0,0-0.001,0-0.001,0H9.7c-0.414,0-0.75,0.336-0.75,0.75S9.286,13.5,9.7,13.5h1.5 c0.414,0.001,0.75-0.335,0.751-0.749C11.951,12.751,11.951,12.75,11.951,12.75z M8.5,20h-6C2.224,20,2,19.776,2,19.5v-17 C2,2.224,2.224,2,2.5,2h8.672c0.265,0,0.52,0.105,0.707,0.293l2.828,2.828C14.895,5.308,15,5.563,15,5.828V12c0,0.552,0.448,1,1,1 c0.552,0,1-0.448,1-1V5.414c0.001-0.531-0.21-1.04-0.586-1.414L13,0.586C12.624,0.212,12.116,0.001,11.586,0H2C0.895,0,0,0.895,0,2 v18c0,1.105,0.895,2,2,2h6.5c0.552,0,1-0.448,1-1S9.052,20,8.5,20z M23.685,16.61l-6-2.382c-0.119-0.047-0.251-0.047-0.37,0 l-6,2.382c-0.194,0.077-0.319,0.266-0.315,0.475v3.13c0,0.276,0.224,0.5,0.5,0.5s0.5-0.224,0.5-0.5v-2.08 c0-0.138,0.111-0.249,0.248-0.25c0.029,0,0.057,0.005,0.085,0.015l5,1.765c0.108,0.037,0.224,0.037,0.332,0l6-2.118 c0.261-0.091,0.398-0.376,0.307-0.637C23.924,16.773,23.819,16.663,23.685,16.61L23.685,16.61z M20.763,19.829l-2.93,1.034 c-0.215,0.076-0.451,0.076-0.666,0l-2.93-1.034c-0.26-0.092-0.546,0.045-0.638,0.306c-0.019,0.053-0.028,0.11-0.028,0.166v2.145 c0,0.212,0.134,0.401,0.334,0.471l2.574,0.909c0.661,0.232,1.382,0.232,2.043,0l2.573-0.909c0.2-0.07,0.334-0.259,0.334-0.471V20.3 c0-0.276-0.223-0.5-0.5-0.5c-0.057,0-0.113,0.01-0.166,0.028L20.763,19.829z" stroke="none" fill="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </g>
                                </svg>
                            </span>
                            <span class="sidebar-menu-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-menu-item <?php if ($_SERVER['PHP_SELF'] == '/Capstone/courses.php' || $_SERVER['PHP_SELF'] == '/Capstone/single-course.php') : echo 'active';
                                                    endif; ?>">
                        <a class="sidebar-menu-button ajax-link" href="courses.php">
                            <span class="sidebar-menu-icon sidebar-menu-icon--left">
                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 40 40" width="22" height="22">
                                    <g transform="matrix(1.6666666666666667,0,0,1.6666666666666667,0,0)">
                                        <path d="M2.5,16C2.224,16,2,15.776,2,15.5v-11C2,4.224,2.224,4,2.5,4h14.625c0.276,0,0.5,0.224,0.5,0.5V8c0,0.552,0.448,1,1,1 s1-0.448,1-1V4c0-1.105-0.895-2-2-2H2C0.895,2,0,2.895,0,4v12c0,1.105,0.895,2,2,2h5.375c0.138,0,0.25,0.112,0.25,0.25v1.5 c0,0.138-0.112,0.25-0.25,0.25H5c-0.552,0-1,0.448-1,1s0.448,1,1,1h7.625c0.552,0,1-0.448,1-1s-0.448-1-1-1h-2.75 c-0.138,0-0.25-0.112-0.25-0.25v-1.524c0-0.119,0.084-0.221,0.2-0.245c0.541-0.11,0.891-0.638,0.781-1.179 c-0.095-0.466-0.505-0.801-0.981-0.801L2.5,16z M3.47,9.971c-0.303,0.282-0.32,0.757-0.037,1.06c0.282,0.303,0.757,0.32,1.06,0.037 c0.013-0.012,0.025-0.025,0.037-0.037l2-2c0.293-0.292,0.293-0.767,0.001-1.059c0,0-0.001-0.001-0.001-0.001l-2-2 c-0.282-0.303-0.757-0.32-1.06-0.037s-0.32,0.757-0.037,1.06C3.445,7.006,3.457,7.019,3.47,7.031l1.293,1.293 c0.097,0.098,0.097,0.256,0,0.354L3.47,9.971z M7,11.751h2.125c0.414,0,0.75-0.336,0.75-0.75s-0.336-0.75-0.75-0.75H7 c-0.414,0-0.75,0.336-0.75,0.75S6.586,11.751,7,11.751z M18.25,16.5c0,0.276-0.224,0.5-0.5,0.5s-0.5-0.224-0.5-0.5v-5.226 c0-0.174-0.091-0.335-0.239-0.426c-1.282-0.702-2.716-1.08-4.177-1.1c-0.662-0.029-1.223,0.484-1.252,1.146 c-0.001,0.018-0.001,0.036-0.001,0.054v7.279c0,0.646,0.511,1.176,1.156,1.2c1.647-0.011,3.246,0.552,4.523,1.593 c0.14,0.14,0.33,0.219,0.528,0.218c0.198,0.001,0.388-0.076,0.529-0.215c1.277-1.044,2.878-1.61,4.527-1.6 c0.641-0.023,1.15-0.547,1.156-1.188v-7.279c-0.001-0.327-0.134-0.64-0.369-0.867c-0.236-0.231-0.557-0.353-0.886-0.337 c-1.496,0.016-2.963,0.411-4.265,1.148c-0.143,0.092-0.23,0.251-0.23,0.421V16.5z" stroke="none" fill="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </g>
                                </svg>
                            </span>
                            <span class="sidebar-menu-text">Courses</span>
                        </a>
                    </li>
                    <?php if (get_user_role($_SESSION['user_id']) == 2) : ?>
                        <li class="sidebar-menu-item <?php if ($_SERVER['PHP_SELF'] == '/Capstone/admin.php') : echo 'active';
                                                        endif; ?>">
                            <a class="sidebar-menu-button ajax-link" href="admin.php">
                                <span class="sidebar-menu-icon sidebar-menu-icon--left">
                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 40 40" width="22" height="22">
                                        <g transform="matrix(1.6666666666666667,0,0,1.6666666666666667,0,0)">
                                            <path d="M23,14.5H1c-0.552,0-1,0.448-1,1V16c0,0.684,0.462,1.282,1.125,1.453C1.346,17.51,1.5,17.709,1.5,17.937V23 c0,0.552,0.448,1,1,1s1-0.448,1-1v-1c0-0.276,0.224-0.5,0.5-0.5h16c0.276,0,0.5,0.224,0.5,0.5v1c0,0.552,0.448,1,1,1s1-0.448,1-1 v-5.063c0-0.228,0.154-0.427,0.375-0.484C23.538,17.282,24,16.684,24,16v-0.5C24,14.948,23.552,14.5,23,14.5z M20.5,19 c0,0.276-0.224,0.5-0.5,0.5H4c-0.276,0-0.5-0.224-0.5-0.5v-1c0-0.276,0.224-0.5,0.5-0.5h16c0.276,0,0.5,0.224,0.5,0.5V19z M7.522,5.717l0.75,0.385c0.143,0.073,0.313,0.073,0.456,0l0.75-0.385C9.645,5.631,9.75,5.46,9.75,5.272V4.334 c0-0.189-0.107-0.362-0.276-0.447l-0.75-0.375c-0.141-0.071-0.307-0.071-0.448,0l-0.75,0.375C7.357,3.972,7.25,4.145,7.25,4.334 v0.938C7.25,5.46,7.355,5.631,7.522,5.717z M14.522,9.217l0.75,0.385c0.143,0.073,0.313,0.073,0.456,0l0.75-0.385 c0.167-0.086,0.272-0.257,0.272-0.445V7.834c0-0.189-0.107-0.362-0.276-0.447l-0.75-0.375c-0.141-0.071-0.307-0.071-0.448,0 l-0.75,0.375c-0.169,0.085-0.276,0.258-0.276,0.447v0.938C14.25,8.96,14.355,9.131,14.522,9.217z M2.5,13h19 c0.276,0,0.5-0.224,0.5-0.5v-11C22,0.672,21.328,0,20.5,0h-17C2.672,0,2,0.672,2,1.5v11C2,12.776,2.224,13,2.5,13z M5.75,3.871 C5.749,3.397,6.017,2.964,6.441,2.753L7.941,2c0.352-0.175,0.766-0.175,1.118,0l1.5,0.75c0.424,0.211,0.692,0.644,0.691,1.118v1.4 c0,0.188,0.106,0.36,0.273,0.445l1.275,0.649c0.162,0.082,0.355,0.07,0.505-0.031c0.107-0.071,0.118-0.068,1.171-0.6 c0.169-0.085,0.276-0.258,0.276-0.447V3.5c0-0.414,0.336-0.75,0.75-0.75c0.414,0,0.75,0.336,0.75,0.75v1.79 c0,0.189,0.107,0.362,0.276,0.447l1.033,0.516c0.424,0.211,0.692,0.644,0.691,1.118V9.23c0.001,0.469-0.262,0.899-0.68,1.112 l-1.5,0.77c-0.358,0.184-0.784,0.184-1.142,0l-1.5-0.77c-0.417-0.213-0.68-0.643-0.678-1.112v-0.9c0-0.188-0.106-0.36-0.273-0.445 l-1.748-0.889c-0.143-0.073-0.312-0.073-0.455,0L9.522,7.383C9.355,7.468,9.25,7.64,9.25,7.827v2.237c0,0.414-0.336,0.75-0.75,0.75 s-0.75-0.336-0.75-0.75V7.825c0-0.187-0.105-0.359-0.272-0.444L6.429,6.842C6.011,6.629,5.749,6.199,5.75,5.73V3.871z" stroke="none" fill="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </g>
                                    </svg>
                                </span>
                                <span class="sidebar-menu-text">Admin Panel</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>

            </div>

        </div>
    </div>
</div>