<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['reject_students'])){
    mysqli_query($connect, "DELETE FROM primary_school_students WHERE primary_id ='".$_POST['reject_students']."'") or die(db_conn_error);
    $delete_errors = $_POST['reject_students'];
}