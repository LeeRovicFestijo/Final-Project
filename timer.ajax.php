<?php
session_start();
$class_quiz_id = $_SESSION['class_quiz_id'];

if (!isset($_SESSION['id']) || ($_SESSION['id'] == '')) {
    header("location: index.php");
    exit();
}

$session_id=$_SESSION['id'];
?>

<?php
include('dbcon.php');
// include('session.php');

$sql = mysqli_query($conn,"SELECT * FROM student_class_quiz WHERE class_quiz_id = '$class_quiz_id' AND student_id = '$session_id'")or die(mysqli_error($conn));
$row = mysqli_fetch_array($sql);
$quiz_time = $row['student_quiz_time'];
$student_class_quiz_id = $row['student_class_quiz_id'];

$sqlp = mysqli_query($conn,"SELECT * FROM class_quiz")or die(mysqli_error($conn));
$rowp = mysqli_fetch_array($sqlp);
if($quiz_time <= $rowp['quiz_time'] OR $quiz_time > 0){
	 mysqli_query($conn,"UPDATE student_class_quiz SET student_quiz_time = ".$row['student_quiz_time']." - 1 WHERE student_class_quiz_id = '$student_class_quiz_id' ORDER BY student_class_quiz_id DESC")or die(mysqli_error($conn)); 
	/* $_SESSION['take_exam'] = 'continue'; */

	$init = $quiz_time;
	$minutes = floor(($init / 60) % 60);
	$seconds = $init % 60;
	if($init > 59){		
		echo "$minutes minutes and $seconds seconds";
	} else {
		echo "$seconds seconds";
	}
} /* else {
	$_SESSION['take_exam'] = 'denied';
} */
?>
