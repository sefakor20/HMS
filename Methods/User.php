<?php
//user login
function Login($connection, $username, $password)
{
    $query = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $user = mysqli_fetch_object($result);

    //username exist
    if (!empty($user)) {
        //check if password matches provided one
        if ($user->password === $password) {
            //check if account is active
            if ($user->status == 1) {
                //account active
                if ($user->user_group == 1) {
                    //redirect to admin portal
                    $_SESSION['admin'] = $user->id;
                    header('location: ../Admin/pages/index.php');
                    exit();
                }
                if ($user->user_group == 2) {
                    //redirect to student portal
                    $_SESSION['student'] = $user->id;
                    header('location: ../Student/pages/index.php');
                    exit();
                }
            } else {
                //inactive account
                $_SESSION['error'] = 'Account not active';
                header('location: ../Admin/pages/login.php');
                exit();
            }
        } else {
            //incorrect password
            $_SESSION['error'] = 'invalid password';
            header('location: ../Admin/pages/login.php');
            exit();
        }
    } else {
        //username does not exist
        $_SESSION['error'] = 'Username does not exist';
        header('location: ../Admin/pages/login.php');
        exit();
    }
}

//fetch user info
function getUserInfo($connection, $id)
{
    $query = "SELECT * FROM user WHERE user.id = '$id' LIMIT 1";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    return mysqli_fetch_object($result);
}

//fetch all users
function getAllAdminUsers($connection, $limit, $offset)
{
    $query = "SELECT user.id, CONCAT(user.first_name, ' ', user.middle_name, ' ', user.last_name) AS user, user.email, user.user_group, user.dob, gender.name AS sex, user.status as  status_id, account_status.name AS status, user_group.name AS group_m, user.phone, user.username FROM user JOIN account_status ON account_status.id = user.status JOIN gender ON gender.id = user.sex JOIN user_group ON user_group.id =  user.user_group ORDER BY user.id ASC LIMIT $limit OFFSET $offset";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $contents = array();

    while ($content = mysqli_fetch_object($result)) {
        if (!array_key_exists($content->id, $contents)) {
            $contents[$content->id] = array(
                'id' => $content->id,
                'user' => $content->user,
                'email' => $content->email,
                'user_group' => $content->user_group,
                'status_id' => $content->status_id,
                'phone' => $content->phone,
                'username' => $content->username,
                'status' => $content->status,
                'group_m' => $content->group_m,
                'dob' => $content->dob,
                'sex' => $content->sex,
            );
        }
    }
    return array_values($contents);
}


//activate student account
function getActivateStudentAccount($connection, $id)
{
    $query = "UPDATE user SET status = 1 WHERE id = '$id'";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    return mysqli_fetch_object($result);
}

//deactivate student account
function getDeactivateStudentAccount($connection, $id)
{
    $query = "UPDATE user SET status = 2 WHERE id = '$id'";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    return mysqli_fetch_object($result);
}


//fetch gender
function getGender($connection)
{
    $query = "SELECT * FROM gender";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $contents = array();

    while ($content = mysqli_fetch_object($result)) {
        if (!array_key_exists($content->id, $contents)) {
            $contents[$content->id] = array(
                'id' => $content->id,
                'name' => $content->name
            );
        }
    }
    return array_values($contents);
}
