<html>
    <head>
        <title>MyCPD Hub</title>
        <link href="<?= base_url('/assets/css/default.css') ?>" rel="stylesheet" type="text/css">
    </head>
    <body>
        <h1>My CPD Hub</h1>
   
        <?= validation_errors(); ?>

        <?= form_open('learning_plan/create_header') ?>

        <fieldset>
            <legend>Add new learning plan</legend>
            <label for="academic_year">Academic year</label> 
            <input type="text" name="academic_year" size="4" /><br />
            <input type="submit" name="submit" value="Submit" /> 
            <input type="reset" name="reset" value="Reset" />
        </fieldset>

    </form>	
</body>
</html>