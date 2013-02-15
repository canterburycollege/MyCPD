<html>
    <head>
        <title>MyCPD Hub</title>
        <link href="<?= base_url('/assets/css/default.css') ?>" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.js"></script>
        <script type="text/javascript" src="<?= base_url('assets/js/DataTables/media/js/jquery.dataTables.js') ?>"></script>
        <script>
            $(document).ready(function(){
                $('#table_1').dataTable({
                "bJQueryUI": true,
                "sPaginationType": "full_numbers"});
            });
        </script>
    </head>
    <body>
        <h1>MyCPD Hub</h1>
    <li><a href="http://webdev-04.cant-col.ac.uk/MyCPD/learning_plan/view">Learning Plan</a></li>
    <li><a href="http://webdev-04.cant-col.ac.uk/MyCPD/target/view">Targets</a></li>
    </body>
</html>


        
        
        
        
        
        
        
        
        
        
        
        
        
