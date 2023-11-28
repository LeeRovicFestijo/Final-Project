<?php include('header_dashboard.php'); ?>
<?php include('session.php'); ?>
<?php $get_id = $_GET['id']; ?>

<body>
    <?php include('navbar_student.php'); ?>
    <div class="container-fluid">
        <div class="row-fluid">
            <?php include('progress_link_student.php'); ?>

            <!-- Assignment Progress -->
            <div class="span4" id="content">
                <div class="row-fluid">
                    <!-- Breadcrumb -->
                    <?php
                    $class_query = mysqli_query($conn, "select * from teacher_class
                                        LEFT JOIN class ON class.class_id = teacher_class.class_id
                                        LEFT JOIN subject ON subject.subject_id = teacher_class.subject_id
                                        where teacher_class_id = '$get_id'") or die(mysqli_error($conn));
                    $class_row = mysqli_fetch_array($class_query);
                    $class_id = $class_row['class_id'];
                    $school_year = $class_row['school_year'];
                    ?>
                    <ul class="breadcrumb">
                        <li><a href="#"><?php echo $class_row['class_name']; ?></a> <span class="divider">/</span></li>
                        <li><a href="#"><?php echo $class_row['subject_code']; ?></a> <span class="divider">/</span></li>
                        <li><a href="#">School Year: <?php echo $class_row['school_year']; ?></a> <span
                                class="divider">/</span></li>
                        <li><a href="#"><b>Assignment Progress</b></a></li>
                    </ul>
                    <!-- End Breadcrumb -->

                    <!-- Assignment Table -->
                    <div id="block_bg" class="block">
                        <div class="navbar navbar-inner block-header">
                            <div id="" class="muted pull-left"><h4> Assignment Grade Progress</h4></div>
                        </div>
                        <div class="block-content collapse in">
                            <div class="span12">
                                <table cellpadding="0" cellspacing="0" border="0" class="table" id="">
                                    <thead>
                                        <tr>
                                            <th>Date Upload</th>
                                            <th>Assignment</th>
                                            <th>Grade</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = mysqli_query($conn, "select * FROM student_assignment 
                                        LEFT JOIN student ON student.student_id = student_assignment.student_id
                                        RIGHT JOIN assignment ON student_assignment.assignment_id = assignment.assignment_id
                                        WHERE student_assignment.student_id = '$session_id'
                                        ORDER BY fdatein DESC") or die(mysqli_error($conn));
                                        while ($row = mysqli_fetch_array($query)) {
                                            $id = $row['student_assignment_id'];
                                            $student_id = $row['student_id'];
                                        ?>
                                            <tr>
                                                <td><?php echo $row['fdatein']; ?></td>
                                                <td><?php echo $row['fname']; ?></td>
                                                <?php if ($session_id == $student_id) { ?>
                                                    <td><span class="badge badge-success"><?php echo $row['grade']; ?></span></td>
                                                <?php } else { ?>
                                                    <td></td>
                                                <?php } ?>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- End Assignment Table -->
                </div>
            </div>
            <!-- End Assignment Progress -->

            <!-- Practice Quiz Progress -->
            <div class="span5" id="content">
                <div class="row-fluid">
                    <!-- Breadcrumb -->
                    <ul class="breadcrumb">
                        <li><a href="#"><b>..</b></a></li>
                    </ul>
                    <!-- End Breadcrumb -->

                    <!-- Practice Quiz Table -->
                    <div id="block_bg" class="block">
                        <div class="navbar navbar-inner block-header">
                            <div id="" class="muted pull-left"><h4> Practice Quiz Progress</h4></div>
                        </div>
                        <div class="block-content collapse in">
                            <div class="span12">
                                <table cellpadding="0" cellspacing="0" border="0" class="table" id="">
                                    <thead>
                                        <tr>
                                            <th>Quiz Title</th>
                                            <th>Description</th>
                                            <th>Quiz Time (In Minutes)</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = mysqli_query($conn, "select * FROM class_quiz 
                                        LEFT JOIN quiz ON class_quiz.quiz_id = quiz.quiz_id
                                        WHERE teacher_class_id = '$get_id' ORDER BY class_quiz_id DESC") or die(mysqli_error($conn));
                                        while ($row = mysqli_fetch_array($query)) {
                                            $id = $row['class_quiz_id'];
                                            $quiz_id = $row['quiz_id'];
                                            $quiz_time = $row['quiz_time'];

                                            $query1 = mysqli_query($conn, "select * from student_class_quiz where class_quiz_id = '$id' and student_id = '$session_id'") or die(mysqli_error($conn));
                                            $row1 = mysqli_fetch_array($query1);
                                            $grade = $row1['grade'];
                                        ?>
                                            <?php if ($grade == "") { } else { ?>
                                                <tr>
                                                    <td><?php echo $row['quiz_title']; ?></td>
                                                    <td><?php echo $row['quiz_description']; ?></td>
                                                    <td><?php echo $row['quiz_time'] / 60; ?></td>
                                                    <td width="200">
                                                        <b>Already Taken Score <?php echo $grade; ?></b>
                                                    </td>
                                                    <script type="text/javascript">
                                                        $(document).ready(function () {
                                                            $('#<?php echo $id; ?>Take This Quiz').tooltip('show');
                                                            $('#<?php echo $id; ?>Take This Quiz').tooltip('hide');
                                                        });
                                                    </script>
                                                </tr>
                                            <?php } ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- End Practice Quiz Table -->
                </div>
            </div>
            <!-- End Practice Quiz Progress -->

            <!-- Optional: Add your downloadable_sidebar.php here -->
        </div>
        <?php include('footer.php'); ?>
    </div>
    <?php include('script.php'); ?>
</body>
</html>
