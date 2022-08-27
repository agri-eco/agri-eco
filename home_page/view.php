<?php
include 'config.php';
if (isset($_GET['id'])) {
    $qry = $conn->query("SELECT b.*,p.title,p.description,concat(u.firstname,' ',u.lastname) as name FROM book_list b inner join `packages` p on p.id = b.package_id inner join clients u on u.id = b.user_id where b.id = '{$_GET['id']}' ");
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
<p><b>Package:</b> <?php echo $title ?></p>
<p><b>Details:</b> <span class="truncate"><?php echo strip_tags(stripslashes(html_entity_decode($description))) ?></span></p>
<p><b>Number of Pax:</b> <span class="truncate"><?php echo strip_tags(stripslashes(html_entity_decode($pax))) ?></span></p>
<p><b>Package Inclusion:</b><span class="truncate"><?php echo strip_tags(stripslashes(html_entity_decode($unli))) ?><br><?php echo strip_tags(stripslashes(html_entity_decode($inclusion))) ?></span></p>
<p>
    <b>Schedule</b>
    <br>Check in: <?php echo date("F d, Y", strtotime($date_start)) ?>
    <br>Check out: <?php echo date("F d, Y", strtotime($date_end)) ?>
</p>

<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Exit</button>
</div>