<html>
    <head>
        <title>Learning Plan</title>
        <link href="http://webdev-04.cant-col.ac.uk/MyCPD//assets/css/default.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.js"></script>
        <script type="text/javascript" src="http://webdev-04.cant-col.ac.uk/MyCPD/assets/js/DataTables/media/js/jquery.dataTables.js"></script>
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
        <h1><img src="http://webdev-04.cant-col.ac.uk/MyCPD/assets/pix/target.gif" alt="Target icon"> My Targets</h1>
        <table id="targets_table">
            <thead>
                <tr>
                    <th style="width: 210px">Title</th>
                    <th style="width: 310px">Description</th>
                    <th style="width: 110px">Status</th>
                    <th style="width: 124px">Completion Date</th>
   
                </tr>
            </thead>
            <tbody>
                <?php foreach ($targets as $target_item): ?>
                    <tr>
                        <td><?= $target_item['title'] ?></td>
                        <td><?= $target_item['description'] ?></td>
                        <td><?= $target_item['status'] ?></td>
                        <td><?= $target_item['target_date'] ?></td>
                    </tr>
<?php endforeach; ?>
            </tbody>
        </table>
    </body>
</html>


        
        
        
        
        
        
        
        
        
        
        
        
        
