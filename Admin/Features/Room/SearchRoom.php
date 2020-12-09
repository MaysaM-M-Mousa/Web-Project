<?php
//session_start();
//if (!isset($_SESSION['person_id']) || !isset($_SESSION['person_role']) || $_SESSION['person_role'] != 2
//    || !isset($_SESSION['activated']) || $_SESSION['activated'] != 1) {
//    header("Location: ../../Home/HTML/index.php");
//    return;
//}
require_once 'pdo.php';
sleep(1);
if (isset($_GET['searchBar'], $_GET['filter'], $_GET['order_by'], $_GET['taken'])) {

    $searchbar = htmlentities($_GET['searchBar']);
    $filter = htmlentities($_GET['filter']);
    $order_by = htmlentities($_GET['order_by']);
    $taken = htmlentities($_GET['taken']);

    switch ($filter) {
        case 'roomNumber':
            $colDBFilter = 'room_number';
            break;
        case 'roomType':
            $colDBFilter = 'room_type';
            break;
        case 'badCapacity':
            $colDBFilter = 'bad_capacity';
            break;
        case 'telNumber':
            $colDBFilter = 'message';
            break;
        case 'price':
            $colDBFilter = 'rent_per_night';
            break;
        case 'description':
            $colDBFilter = 'room_description';
            break;
        default :
            $colDBFilter = 'none';
            break;
    }

    switch ($order_by) {
        case 'roomNumber':
            $colDBOrderBY = 'room_number';
            break;
        case 'badCapacity':
            $colDBOrderBY = 'bad_capacity';
            break;
        case 'price':
            $colDBOrderBY = 'rent_per_night';
            break;
        default :
            $colDBOrderBY = 'none';
            break;
    }

    if ($taken === 'false')
        $status = 0;
    elseif ($taken === 'true')
        $status = 1;

    if (empty($searchbar)) {
        if ($colDBOrderBY === 'none') {
            $sql = 'select * from room where status=' . $status;
        } elseif ($colDBOrderBY !== 'none') {
            $sql = 'select * from room where status=' . $status . ' order by ' . $colDBOrderBY . " DESC";
        }
    } else {
        if ($colDBFilter === 'none' && $colDBOrderBY === 'none') {
            $sql = 'select * from room where status=' . $status . ' and room_description like "%' . $searchbar . '%"';
        } elseif ($colDBFilter !== 'none' && $colDBOrderBY === 'none') {
            $sql = 'select * from room where status=' . $status . ' and ' . $colDBFilter . ' like ' . '"%' . $searchbar . '%"';
        } elseif ($colDBFilter === 'none' && $colDBOrderBY !== 'none') {
            $sql = 'select * from room where status=' . $status . ' order by ' . $colDBOrderBY . " DESC";
        } else {
            $sql = 'select * from room where status=' . $status . ' and ' . $colDBFilter . ' like ' . '"%' . $searchbar . '%"' . 'order by ' . $colDBOrderBY . " DESC";
        }
    }

    $result = $pdo->query($sql);

    if ($result->rowCount() < 1) {
        echo '<h1 style="position: absolute;top: 50%;left: 50%;transform: translate(-50%,-50%)">No Results Found!</h1>';
        return;
    }


}
?>


<table class="table table-hover">

    <thead>
    <tr>
        <th>Room Number</th>
        <th>Room Type</th>
        <th>Bad Capacity</th>
        <th>Tel. Number</th>
        <th>Rent Per Night</th>
        <th>Room Description</th>
        <th>Status</th>
    </tr>
    </thead>

    <tbody>
    <?php
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <tr>
            <td><?php echo $row['room_number'] ?></td>
            <td><?php echo $row['room_type'] ?></td>
            <td><?php echo $row['bad_capacity'] ?></td>
            <td><?php echo $row['tel_number'] ?></td>
            <td><?php echo $row['rent_per_night'] ?></td>
            <td><?php echo $row['room_description'] ?></td>
            <td><?php echo $row['status'] == 0 ? 'Available' : 'Taken' ?></td>
            <td>
                <button onclick="EditRoom(this.value)" value="<?php echo $row['room_id'] ?>">Edit</button>
            </td>
        </tr>

        <?php
    }
    ?>
    </tbody>
</table>


