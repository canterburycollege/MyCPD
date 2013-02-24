<html>
    <head>
        <title>Learning Plan</title>
        <link href="<?= base_url('/assets/css/default.css') ?>" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.js"></script>
        <script type="text/javascript" src="<?= base_url('assets/js/DataTables/media/js/jquery.dataTables.js') ?>"></script>
        <script>
            $(document).ready(function(){
                $('#table_detail').dataTable({
                    "bJQueryUI": true,
                    "sPaginationType": "full_numbers"});
            });
        </script>

    </head>
    <body>
        <h1>My Learning Plan</h1>
        <h2>Employee: <?= $employee->display_name ?></h2>
        <div id="div_activities">
            <h3>Activities/Events</h3>
            <table id="table_detail">
                <thead>
                    <tr>
                        <th>Title of CPD activity/event</th>
                        <th>Intended Learning Outcomes</th>
                        <th>target this CPD addresses</th>
                        <th>Priority level</th>
                        <th>Target Date</th>
                        <th>Completed?</th>
                        <th>Evaluation</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($activities as $row): ?>
                        <tr>
                            <td><?= $row->title ?></td>
                            <td><?= $row->learning_outcomes ?></td>
                            <td><?= $row->target_title ?></td>
                            <td><?= $row->priority_type ?></td>
                            <td><?= $row->target_date ?></td>
                            <td><?= $row->is_completed ?></td>
                            <td><?= anchor_popup($row->evaluation_url, 'Evaluate now') ?></td>
                            <td><?=
                    anchor('learning_plan/update_detail/'
                            . $row->activity_id, 'Edit')
                        ?>
                                |<?=
                            anchor('learning_plan/delete_detail/'
                                    . $row->activity_id, 'Delete')
                        ?>                    
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <p><?=
                    anchor('learning_plan/create_activity/'
                            . $employee->id, 'Add new Activity/Event')
                    ?>
            </p>
        </div>
    </body>
</html>




