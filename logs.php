<?php
session_start();
require_once('./models/log.php');
$log = new Log();
$logs = $log->fetchLogs();

?>


<?php include './partials/header.php'; ?>
<div>
    <section>
        <div class="h-16 w-full bg-white shadow rounded flex justify-between items-center">
            <h4 class="mx-5 font-semibold">Account Logs</h4>
        </div>
    </section>

    <section class="mt-5">
        <div class="w-full h-screen bg-white p-4 rounded shadow overflow-x-scroll">
            <table id="table_id" class="display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Account ID</th>
                        <th>Full Name</th>
                        <th>Description</th>
                        <th>Date/Time</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                        <?php foreach($logs as $row): ?>
                            <tr>
                                <td><?= $row['user_id'] ?></td>
                                <td><?= $row['fullname'] ?></td>
                                <td><?= $row['description'] ?></td>
                                <td><?= $row['tstamp'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>


</div>
<?php include './partials/footer.php'; ?>