<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Faculty</title>
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
        <h1>Admin/Faculty Page</h1>
        <hr/>
        <?php $this->load->view('templates/admin/nav_bar'); ?>
        <hr/>
        <div id="div_faculties">
            <table id="table_detail">
                <thead>
                    <tr>
                        <th>Faculty</th>
                        <th>Faculty Head</th>
                        <th>Actions</th>
                </thead>
                <tbody>
                    <?php foreach ($faculties as $row): ?>
                        <tr>
                            <td><?= $row->title ?></td>
                            <td><?= $row->manager ?></td>
                            <td><?= anchor('admin/faculty/update/' . $row->id, 'Edit') ?>
                                |<?= anchor('admin/faculty/delete/' . $row->id, 'Delete') ?>                    
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <p><?= anchor('admin/faculty/create/', 'Add new Faculty') ?></p>
        
    </body>
</html>
