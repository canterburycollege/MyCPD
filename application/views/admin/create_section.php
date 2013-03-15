<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>MyCPD Admin</title>
        <link href="<?= base_url('/assets/css/default.css') ?>" rel="stylesheet" type="text/css">
    </head>
    <body>
        <h1>Create Section</h1>
        <?= validation_errors(); ?>
        <?= form_open('admin/section/create') ?>
        <fieldset>
            <legend>Add new Section</legend>
            
            <label for="title">Section name: </label>
            <input type="text" name="title" id="title" /><br />
            
            <label for="manager">Section Manager: </label>
            <input type="text" name="manager" id="manager" /><br />
            
            <label for="faculty_id">Faculty</label>
            <?= form_dropdown('faculty_id',$faculties) ?><br />
            
            <input type="submit" name="submit" value="Submit" /> 
            <input type="reset" name="reset" value="Reset" />
        </fieldset>

    </form>	
    </body>
</html>
