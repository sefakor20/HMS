<?php
//fetch hostel category
function getHostelCategory($connection)
{
    $query = "SELECT * FROM hostel_category";
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

//fetch hostel status
function getHostelStatus($connection)
{
    $query = "SELECT * FROM hostel_status";
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

// fetch all hostel
function getAllHostel($connection, $limit, $offset)
{
    $query = "SELECT hostel.id, hostel.name as hostel, hostel.category, hostel.location, hostel.photo, hostel.available_room as room, hostel.price as price_per_room, hostel.description, hostel_category.name as cat, hostel_status.name as status, hostel.created_at FROM hostel JOIN hostel_category ON hostel_category.id = hostel.category JOIN hostel_status ON hostel_status.id = hostel.status ORDER BY hostel.id DESC LIMIT $limit OFFSET $offset";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $contents = array();

    while ($content = mysqli_fetch_object($result)) {
        if (!array_key_exists($content->id, $contents)) {
            $contents[$content->id] = array(
                'id' => $content->id,
                'hostel' => $content->hostel,
                'location' => $content->location,
                'photo' => $content->photo,
                'room' => $content->room,
                'price_per_room' => $content->price_per_room,
                'description' => $content->description,
                'cat' => $content->cat,
                'status' => $content->status,
                'created_at' => $content->created_at,
                'category' => $content->category
            );
        }
    }
    return array_values($contents);
}

//fetch seleted hostel
function getSelectedHostel($connection, $id)
{
    $query = "SELECT hostel.id, hostel.name as hostel, hostel.location, hostel.photo, hostel.available_room as room, hostel.price as price_per_room, hostel.description, hostel_category.name as cat, hostel_status.name as status, hostel.created_at FROM hostel JOIN hostel_category ON hostel_category.id = hostel.category JOIN hostel_status ON hostel_status.id = hostel.status WHERE hostel.id = '$id'";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    return mysqli_fetch_object($result);
}

//fetch student reservation
function getStudentReservation($connection, $id, $limit, $offset)
{
    $query = "SELECT reservation.id, reservation.short_note, hostel.name as hostel, reservation.quantity, reservation.status AS stat, reservation.created_at, reservation.notification, reservation_notice_status.name AS note, reservation.admin_short_note, hostel.location, reservation_status.name as status FROM reservation JOIN hostel ON hostel.id = reservation.hostel_id JOIN reservation_notice_status ON reservation_notice_status.id = reservation.notification JOIN reservation_status ON reservation_status.id = reservation.status WHERE reservation.student_id = '$id' ORDER BY reservation.id DESC LIMIT $limit OFFSET $offset";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $contents = array();

    while ($content = mysqli_fetch_object($result)) {
        if (!array_key_exists($content->id, $contents)) {
            $contents[$content->id] = array(
                'id' => $content->id,
                'hostel' => $content->hostel,
                'quantity' => $content->quantity,
                'stat' => $content->stat,
                'created_at' => $content->created_at,
                'location' => $content->location,
                'status' => $content->status,
                'admin_short_note' => $content->admin_short_note,
                'short_note' => $content->short_note,
                'note' => $content->note,
                'notification' => $content->notification
            );
        }
    }
    return array_values($contents);
}


//fetch student reservation
function getAdminReservation($connection, $limit, $offset)
{
    $query = "SELECT reservation.id, hostel.name as hostel, reservation.notification, reservation_notice_status.name AS note, CONCAT(user.first_name, ' ', user.middle_name, ' ', user.last_name) AS student, reservation.short_note, reservation.quantity, reservation.status AS stat, reservation.created_at, reservation_status.name as status FROM reservation JOIN hostel ON hostel.id = reservation.hostel_id JOIN reservation_notice_status ON reservation_notice_status.id = reservation.notification JOIN reservation_status ON reservation_status.id = reservation.status JOIN user ON user.id = reservation.student_id ORDER BY reservation.id DESC LIMIT $limit OFFSET $offset";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $contents = array();

    while ($content = mysqli_fetch_object($result)) {
        if (!array_key_exists($content->id, $contents)) {
            $contents[$content->id] = array(
                'id' => $content->id,
                'hostel' => $content->hostel,
                'quantity' => $content->quantity,
                'stat' => $content->stat,
                'created_at' => $content->created_at,
                'student' => $content->student,
                'short_note' => $content->short_note,
                'status' => $content->status,
                'notification' => $content->notification,
                'note' => $content->note
            );
        }
    }
    return array_values($contents);
}

//fetch admin selected reservation
function getAdminSelectedReservation($connection, $id)
{
    $query = "SELECT reservation.id, hostel.name as hostel, reservation.notification, reservation.hostel_id, reservation.student_id, hostel.available_room AS room, CONCAT(user.first_name, ' ', user.middle_name, ' ', user.last_name) AS student, reservation.short_note, reservation.quantity, reservation.status AS stat, reservation.created_at, reservation_status.name as status FROM reservation JOIN hostel ON hostel.id = reservation.hostel_id JOIN reservation_status ON reservation_status.id = reservation.status JOIN user ON user.id = reservation.student_id WHERE reservation.id = '$id'";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    return mysqli_fetch_object($result);
}

//fetch reservation notice
function getReservationNotice($connection)
{
    $query = "SELECT * FROM reservation_notice_status";
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

//change reservation status to read
function getChangeReservationStatus($connection, $id)
{
    $query = "UPDATE reservation SET status = 1 WHERE id = '$id'";
    mysqli_query($connection, $query) or die(mysqli_error($connection));
}


//fetch total approved reservations
function getTotalApprovedReservation($connection)
{
    $query = "SELECT COUNT(id) AS total FROM reservation WHERE notification = 2";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    return mysqli_fetch_object($result);
}

//fetch total declined reservations
function getTotalDeclineReservation($connection)
{
    $query = "SELECT COUNT(id) AS total FROM reservation WHERE notification = 3";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    return mysqli_fetch_object($result);
}



//fetch approved reservation
function getAdminApprovedReservation($connection, $limit, $offset)
{
    $query = "SELECT reservation.id, hostel.name as hostel, reservation.notification, reservation_notice_status.name AS note, reservation.admin_short_note, CONCAT(user.first_name, ' ', user.middle_name, ' ', user.last_name) AS student, reservation.short_note, reservation.quantity, reservation.status AS stat, reservation.created_at, reservation_status.name as status FROM reservation JOIN hostel ON hostel.id = reservation.hostel_id JOIN reservation_notice_status ON reservation_notice_status.id = reservation.notification JOIN reservation_status ON reservation_status.id = reservation.status JOIN user ON user.id = reservation.student_id WHERE reservation.notification = 2 ORDER BY reservation.id DESC LIMIT $limit OFFSET $offset";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $contents = array();

    while ($content = mysqli_fetch_object($result)) {
        if (!array_key_exists($content->id, $contents)) {
            $contents[$content->id] = array(
                'id' => $content->id,
                'hostel' => $content->hostel,
                'quantity' => $content->quantity,
                'stat' => $content->stat,
                'created_at' => $content->created_at,
                'student' => $content->student,
                'short_note' => $content->short_note,
                'status' => $content->status,
                'notification' => $content->notification,
                'note' => $content->note,
                'admin_short_note' => $content->admin_short_note
            );
        }
    }
    return array_values($contents);
}


//fetch declined reservation
function getAdmindDeclineReservation($connection, $limit, $offset)
{
    $query = "SELECT reservation.id, hostel.name as hostel, reservation.notification, reservation_notice_status.name AS note, reservation.admin_short_note, CONCAT(user.first_name, ' ', user.middle_name, ' ', user.last_name) AS student, reservation.short_note, reservation.quantity, reservation.status AS stat, reservation.created_at, reservation_status.name as status FROM reservation JOIN hostel ON hostel.id = reservation.hostel_id JOIN reservation_notice_status ON reservation_notice_status.id = reservation.notification JOIN reservation_status ON reservation_status.id = reservation.status JOIN user ON user.id = reservation.student_id WHERE reservation.notification = 3 ORDER BY reservation.id DESC LIMIT $limit OFFSET $offset";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $contents = array();

    while ($content = mysqli_fetch_object($result)) {
        if (!array_key_exists($content->id, $contents)) {
            $contents[$content->id] = array(
                'id' => $content->id,
                'hostel' => $content->hostel,
                'quantity' => $content->quantity,
                'stat' => $content->stat,
                'created_at' => $content->created_at,
                'student' => $content->student,
                'short_note' => $content->short_note,
                'status' => $content->status,
                'notification' => $content->notification,
                'note' => $content->note,
                'admin_short_note' => $content->admin_short_note
            );
        }
    }
    return array_values($contents);
}

//fetch cancelled reservation
function getAdmindCancelledReservation($connection, $limit, $offset)
{
    $query = "SELECT reservation.id, hostel.name as hostel, reservation.notification, reservation_notice_status.name AS note, reservation.admin_short_note, CONCAT(user.first_name, ' ', user.middle_name, ' ', user.last_name) AS student, reservation.short_note, reservation.quantity, reservation.status AS stat, reservation.created_at, reservation_status.name as status FROM reservation JOIN hostel ON hostel.id = reservation.hostel_id JOIN reservation_notice_status ON reservation_notice_status.id = reservation.notification JOIN reservation_status ON reservation_status.id = reservation.status JOIN user ON user.id = reservation.student_id WHERE reservation.notification = 4 ORDER BY reservation.id DESC LIMIT $limit OFFSET $offset";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $contents = array();

    while ($content = mysqli_fetch_object($result)) {
        if (!array_key_exists($content->id, $contents)) {
            $contents[$content->id] = array(
                'id' => $content->id,
                'hostel' => $content->hostel,
                'quantity' => $content->quantity,
                'stat' => $content->stat,
                'created_at' => $content->created_at,
                'student' => $content->student,
                'short_note' => $content->short_note,
                'status' => $content->status,
                'notification' => $content->notification,
                'note' => $content->note,
                'admin_short_note' => $content->admin_short_note
            );
        }
    }
    return array_values($contents);
}

//search hostel
function searchHostel($connection, $item)
{
    $query = "SELECT * FROM hostel WHERE hostel.name LIKE '$item' OR hostel.price LIKE '$item' ORDER BY hostel.id DESC";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $contents = array();

    while ($content = mysqli_fetch_object($result)) {
        if (!array_key_exists($content->id, $content)) {
            $contents[$content->id] = array(
                'id' => $content->id,
                'name' => $content->name,
                'photo' => $content->photo,
                'available_room' => $content->available_room,
                'price' => $content->price
            );
        }
    }
    return array_values($contents);
}

//cancel reservation
function getCancelReservation($connection, $id)
{
    $query = "UPDATE reservation SET notification = 4 WHERE id = '$id'";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    return mysqli_fetch_object($result);
}

//fetch total cancelled reservations
function getTotalCancelledReservation($connection)
{
    $query = "SELECT COUNT(id) AS total FROM reservation WHERE notification = 4";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    return mysqli_fetch_object($result);
}

//fetch student approved reservation
function getStudentAllApprovedReservation($connection, $id, $limit, $offset)
{
    $query = "SELECT reservation.id, reservation.short_note, hostel.name as hostel, reservation.quantity, reservation.status AS stat, reservation.created_at, reservation.notification, reservation_notice_status.name AS note, reservation.admin_short_note, hostel.location, reservation_status.name as status FROM reservation JOIN hostel ON hostel.id = reservation.hostel_id JOIN reservation_notice_status ON reservation_notice_status.id = reservation.notification JOIN reservation_status ON reservation_status.id = reservation.status WHERE reservation.student_id = '$id' AND reservation.notification = 2 ORDER BY reservation.id DESC LIMIT $limit OFFSET $offset";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $contents = array();

    while ($content = mysqli_fetch_object($result)) {
        if (!array_key_exists($content->id, $contents)) {
            $contents[$content->id] = array(
                'id' => $content->id,
                'hostel' => $content->hostel,
                'quantity' => $content->quantity,
                'stat' => $content->stat,
                'created_at' => $content->created_at,
                'location' => $content->location,
                'status' => $content->status,
                'admin_short_note' => $content->admin_short_note,
                'short_note' => $content->short_note,
                'note' => $content->note,
                'notification' => $content->notification
            );
        }
    }
    return array_values($contents);
}
//fetch student declined reservation
function getStudentAllDeclinedReservation($connection, $id, $limit, $offset)
{
    $query = "SELECT reservation.id, reservation.short_note, hostel.name as hostel, reservation.quantity, reservation.status AS stat, reservation.created_at, reservation.notification, reservation_notice_status.name AS note, reservation.admin_short_note, hostel.location, reservation_status.name as status FROM reservation JOIN hostel ON hostel.id = reservation.hostel_id JOIN reservation_notice_status ON reservation_notice_status.id = reservation.notification JOIN reservation_status ON reservation_status.id = reservation.status WHERE reservation.student_id = '$id' AND reservation.notification = 3 ORDER BY reservation.id DESC LIMIT $limit OFFSET $offset";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $contents = array();

    while ($content = mysqli_fetch_object($result)) {
        if (!array_key_exists($content->id, $contents)) {
            $contents[$content->id] = array(
                'id' => $content->id,
                'hostel' => $content->hostel,
                'quantity' => $content->quantity,
                'stat' => $content->stat,
                'created_at' => $content->created_at,
                'location' => $content->location,
                'status' => $content->status,
                'admin_short_note' => $content->admin_short_note,
                'short_note' => $content->short_note,
                'note' => $content->note,
                'notification' => $content->notification
            );
        }
    }
    return array_values($contents);
}
