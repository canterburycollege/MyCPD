<html>
    <head>
        <title>MyCPD Hub</title>
        <link href="<?= base_url('/assets/css/default.css') ?>" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
        <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
        <script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
        <script>
            $(function() {
                $( "#target_date" ).datepicker({dateFormat: 'yy-mm-dd'});
            });
        </script>
    </head>
    <body>
        <h1>My CPD Hub</h1>
   
        <?= validation_errors(); ?>

        <?= form_open('learning_plan/create_detail/' . $learning_plan_id) ?>

        <input type="hidden" name="learning_plan_id" value="<?= $learning_plan_id ?>" />

        <fieldset>
            <legend>Add new activity/event</legend>
            <label for="title">Title of activity/event</label> 
            <textarea name="title"></textarea><br />

            <label for="learning_outcomes">Intended learning outcomes</label>
            <textarea name="learning_outcomes"></textarea><br />

            <label for="learning_plan_target_id">Target</label>
            <?= form_dropdown('learning_plan_target_id',$targets) ?><br />

            <label for="priority_type_id">Priority</label>
            <?= form_dropdown('priority_type_id',$priorities) ?><br />

            <label for="target_date">Target Date</label>
            <input type="text" name="target_date" id="target_date" /><br />

            <input type="submit" name="submit" value="Submit" /> 
            <input type="reset" name="reset" value="Reset" />
        </fieldset>

    </form>	
</body>
</html>