<html>
    <head>
        <title>MyCPD Hub</title>
        <link href="<?= base_url('/assets/css/default.css') ?>" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
        <script>
            $(function() {
                $( "#planned_date" ).datepicker({dateFormat: 'yy-mm-dd'});
            });
        </script>
    </head>
    <body>
        <h1>MyCPD</h1>
   
        <?= validation_errors(); ?>

        <?= form_open('learning_plan/create_activity/' . $employee_id) ?>

        <fieldset>
            <legend>Add new activity/event</legend>
            
            <label for="planned_date">Planned date</label>
            <input type="text" name="planned_date" id="planned_date" 
                   value="<?= $activity->planned_date ?>" /><br />
            
            <label for="title">Title of activity/event</label> 
            <textarea name="title"></textarea><br />

            <label for="learning_outcomes">Intended learning outcomes</label>
            <textarea name="learning_outcomes"></textarea><br />
            
            <label for="cpd_type_id">CPD type</label>
            <?= form_dropdown('cpd_type_id', $cpd_types) ?><br />

            <label for="learning_plan_target_id">Target</label>
            <?= form_dropdown('target_id',$targets) ?><br />

            <label for="priority_type_id">Priority</label>
            <?= form_dropdown('priority_type_id',$priorities) ?><br />

            <input type="submit" name="submit" value="Submit" /> 
            <input type="reset" name="reset" value="Reset" />
        </fieldset>

    </form>	
</body>
</html>