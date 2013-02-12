<html>
    <head>
        <title>Learning Plan</title>
        <link href="<?= base_url('/assets/css/default.css') ?>" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.js"></script>

        <script type="text/javascript" src="<?= base_url('/assets/js/DataTables/media/js/jquery.dataTables.js') ?>"></script>
        <script>
            $(document).ready(function(){
                $('#targets_table').dataTable({
                "bJQueryUI": true,
               "sPaginationType": "full_numbers"});
              $("table#targets_table tr:even").css("background-color", "#fff");
              $("table#targets_table tr:odd").css("background-color", "#EFF1F1");
            });
        </script>

    </head>
    <body>
        <h1><img src="<?= base_url('/assets/pix/target.gif') ?>" alt="Target icon"> My Targets</h1>
        <table id="targets_table">
            <thead>
                <tr>
                    <th style="width: 210px">Title</th>
                    <th style="width: 310px">Description</th>
                    <th style="width: 110px">Status</th>
                    <th style="width: 124px">Completion Date</th>
                    <th style="width: 80px">Actions</th>
   
                </tr>
            </thead>
            <tbody>
                <?php foreach ($targets as $target_item): ?>
                    <tr>
                        <td><?= $target_item['title'] ?></td>
                        <td><?= $target_item['description'] ?></td>
                        <td><?= $target_item['status'] ?></td>
                        <td><?= $target_item['target_date'] ?></td>
                        <td><a href="/target/update?id=<?= $target_item['id'] ?>">Edit</a> | <a href="/target/delete?id=<?= $target_item['id'] ?>">Delete</a></td>
                    </tr>
<?php endforeach; ?>
            </tbody>
        </table>
        <a href="<?= base_url('/target/create') ?>">Add a target</a> | 
        <a href="<?= base_url('/hub/view') ?>">Back to hub</a>
    </body>
</html>


        
        
        
        
        
        
        
        
        
        
        
        
        
