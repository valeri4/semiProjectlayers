<?php 

require_once 'DAL.php';

function add_student($first_name, $last_name){
    $sql = "insert into students(first_name, last_name) values('$first_name', '$last_name')";
    
    insert($sql);
}

function get_all_students(){
    $sql = "select * from students";
    $students = get_array($sql);
    return json_encode($students);    
}

function update_student($first_name, $last_name, $student_id){
    $sql = "update students set first_name='$first_name', last_name='$last_name' where student_id='$student_id'";
    update($sql);
}

function delete_student($student_id){
    $sql = "DELETE FROM students WHERE student_id = '$student_id'";
    delete($sql);
}
