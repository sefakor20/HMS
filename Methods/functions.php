<?php
//fetch item total
function getItemTotal($connection, $table)
{
    $query = "SELECT COUNT(id) AS total FROM {$table}";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    return mysqli_fetch_object($result);
}

//fetch total for a specific item
function getTotalStudent($connection)
{
    $query = "SELECT COUNT(id) AS total FROM user WHERE user_group = 2";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    return mysqli_fetch_object($result);
}

//date and time format
function getDateFormat($raw_date)
{
    $new_date = strftime("%a %b %d, %Y", strtotime($raw_date));
    return $new_date;
}

//delete item
function getDeleteItem($connection, $table, $id)
{
    $query = "DELETE FROM {$table} WHERE id = '$id'";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    return mysqli_fetch_object($result);
}


//check for duplicate username
function checkDuplicateUsername($connection, $username)
{
    $query = "SELECT * FROM user WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    return mysqli_fetch_object($result);
}

//check for duplicate email
function checkDuplicateEmail($connection, $email)
{
    $query = "SELECT * FROM user WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    return mysqli_fetch_object($result);
}

//fetch part of an item
function readMore($content, $num)
{
    $con_len = strlen($content);
    if ($con_len > $num) {
        $new_len = substr($content, 0, $num) . '...';
    } else {
        $new_len = $content;
    }

    return $new_len;
}


//fetch total for a specific item
function getTotalForSpecificItem($connection)
{
    $query = "SELECT COUNT(id) as total FROM reservation WHERE status = 2 ";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    return mysqli_fetch_object($result);
}

//student reservation total
function getStudentReservationTotal($connection, $id)
{
    $query = "SELECT COUNT(id) AS total FROM reservation WHERE student_id =  '$id'";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    return mysqli_fetch_object($result);
}

//student approved reservation total
function getStudentApprovedReservationTotal($connection, $id)
{
    $query = "SELECT COUNT(id) AS total FROM reservation WHERE student_id =  '$id' AND notification = 2";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    return mysqli_fetch_object($result);
}


//student declined reservation total
function getStudentDeclinedReservationTotal($connection, $id)
{
    $query = "SELECT COUNT(id) AS total FROM reservation WHERE student_id =  '$id' AND notification = 3";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    return mysqli_fetch_object($result);
}
