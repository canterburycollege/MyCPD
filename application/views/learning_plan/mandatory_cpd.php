<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>MyCPD</title>
        <link href="<?= base_url('/assets/css/default.css') ?>" rel="stylesheet" type="text/css">
    </head>
    <body>
        <table class="layout">
            <tr>
                <td class="layout"><h1>Mandatory & Contractual Training Page</h1></td>
                <td class="layout right"><h2><?= $employee->display_name ?></h2></td>
            </tr>
        </table>
        <hr/>
        <?php $this->load->view('templates/nav_bar'); ?>
        <hr/>
        <h2>Mandatory Online Training & Assessments Traffic lights:</h2>
        <p>Note: These are automatically updated from Moodle SCORM courses.</p>
        <ul>
            <li>Equality & Diversity</li>
            <li>Safeguarding</li>
            <li>Health & Safety</li>
        </ul>
        <h2>Contractual Qualifications:</h2>
        <p>Note: These are manually added (by HR?) and have a status of not 
            enrolled, enrolled or completed</p>
        <ul>
            <li>Literacy Level 2</li>
            <li>Numeracy Level 2</li>
            <li>Assessor Award</li>
            <li>DTLLS</li>
            <li>Level 5 Diploma in Management & Leadership</li>
        </ul>
    </body>
</html>
