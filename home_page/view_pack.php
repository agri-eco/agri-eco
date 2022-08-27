<?php
include 'config.php';
if (isset($_GET['id'])) {
    $qry = $conn->query("SELECT u.*,b.*,p.title,p.description,concat(u.firstname,' ',u.lastname) as name FROM book_list b inner join `packages` p on p.id = b.package_id inner join clients u on u.id = b.user_id where b.id = '{$_GET['id']}' ");
    foreach ($qry->fetch_assoc() as $k => $v) {
        $$k = $v;
    }
}
?>
<style>
    #uni_modal .modal-content>.modal-footer {
        display: none;
    }
</style>
<div class="conitaner-fluid px-3 py-2">
    <h4 class="text-center"><b>Package:</b> <?php echo $title ?></h4>
    <div class="row">
        <div class="col-md-6">
            <p><b>Client Name:</b> <?php echo $name ?></p>
            <p><b>Client Email:</b> <?php echo $email ?></p>
            <p><b>Client Contact:</b> <?php echo $contact ?></p>
            <p>
                <b>Schedule</b>
                <br>Check in: <?php echo date("F d, Y", strtotime($date_start)) ?>
                <br>Check out: <?php echo date("F d, Y", strtotime($date_end)) ?>
            </p>

        </div>
        <div class="col-md-6">

            <p><b>Details:</b> <span class="truncate"><?php echo strip_tags(stripslashes(html_entity_decode($description))) ?></span></p>
            <p><b>Number of Pax:</b> <span class="truncate"><?php echo strip_tags(stripslashes(html_entity_decode($pax))) ?></span></p>
            <p><b>Package Inclusion:</b><span class="truncate"><?php echo strip_tags(stripslashes(html_entity_decode($unli))) ?><br><?php echo strip_tags(stripslashes(html_entity_decode($inclusion))) ?></span></p>
            <p><b>Package Cost:</b> ₱ <?php echo $cost ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-3">Booking Status:</div>
        <div class="col-auto">
            <?php
            switch ($status) {
                case '0':
                    echo '<span class="badge badge-light text-dark">Pending</span>';
                    break;
                case '1':
                    echo '<span class="badge badge-primary">Confirmed</span>';
                    break;
                case '2':
                    echo '<span class="badge badge-danger">Cancelled</span>';
                    break;
                case '3':
                    echo '<span class="badge badge-warning">Picked Up</span>';
                    break;
                case '4':
                    echo '<span class="badge badge-success">Returned</span>';
                    break;
                default:
                    echo '<span class="badge badge-danger">Cancelled</span>';
                    break;
            }
            ?>
        </div>

    </div>
</div>
<!-- <p><b>Package:</b> <?php echo $title ?></p>
<p><b>Details:</b> <span class="truncate"><?php echo strip_tags(stripslashes(html_entity_decode($description))) ?></span></p>
<p><b>Number of Pax:</b> <span class="truncate"><?php echo strip_tags(stripslashes(html_entity_decode($pax))) ?></span></p>
<p><b>Package Inclusion:</b><span class="truncate"><?php echo strip_tags(stripslashes(html_entity_decode($unli))) ?><br><?php echo strip_tags(stripslashes(html_entity_decode($inclusion))) ?></span></p>
<p><b>Package Cost:</b> ₱ <?php echo $cost ?></p>
<p>
    <b>Schedule</b>
    <br>Check in: <?php echo date("F d, Y", strtotime($date_start)) ?>
    <br>Check out: <?php echo date("F d, Y", strtotime($date_end)) ?>
</p> -->


<div class="modal-footer">

    <button type="button" class="btn btn-secondary" data-dismiss="modal">Exit</button>
</div>