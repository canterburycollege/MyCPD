<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>MyCPD Admin</title>
        <link href="<?= base_url('/assets/css/default.css') ?>" rel="stylesheet" type="text/css">
    </head>
    <body>
        <h1>MyCPD Admin</h1>
        <?= validation_errors(); ?>
        <?= form_open('admin/section/update/' . $id) ?>

        <fieldset>          
            <legend>Update Section</legend>
            
            <label for="title">Section: </label>
            <input type="text" size="50" name="title" id="title" 
                   value="<?= $section->title ?>" /><br />
            <label for="manager">Section Manager: </label>
            <input type="text" size="50" name="manager" id="manager" 
                   value="<?= $section->manager ?>" /><br />
            <label for="faculty_id">Faculty</label>
            <?= form_dropdown('faculty_id',$faculties, $section->faculty_id) ?><br />
            
            <input type="submit" name="submit" value="Submit" /> 
            <input type="reset" name="reset" value="Reset" />
        </fieldset>

    </form>	
    </body>
</html>
