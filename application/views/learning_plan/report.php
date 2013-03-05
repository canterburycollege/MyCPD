<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>MyCPD</title>
        <link href="<?= base_url('/assets/css/default.css') ?>" rel="stylesheet" type="text/css">
    </head>
    <body>
        <table class="layout">
            <tr>
                <td class="layout"><h1>Report Page</h1></td>
                <td class="layout right"><h2><?= $employee->display_name ?></h2></td>
            </tr>
        </table>
        <hr/>
        <?php $this->load->view('templates/nav_bar'); ?>
        <hr/>
        <p>Page for selecting, viewing and printing reports about MyCPD</p>
        <p>A number of attributes may be used to filter, group & sort reports e.g.</p>
        <ul>
            <li>Active / Archived (academic year?)</li>
            <li>Target Date</li> 
            <li>Completed Date:</li>
            <li>Target</li>
            <li>CPD type</li>
            <li>Priority</li>
            <li>Rating</li>
        </ul>
    </body>
</html>
