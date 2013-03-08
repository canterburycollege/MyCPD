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
        <?= form_open('admin/faculty/update/' . $id) ?>

        <fieldset>          
            <legend>Update Faculty</legend>
            
            <label for="title">Faculty: </label>
            <input type="text" size="50" name="title" id="title" 
                   value="<?= $faculty->title ?>" /><br />
            <label for="manager">Faculty Head: </label>
            <input type="text" size="50" name="manager" id="manager" 
                   value="<?= $faculty->manager ?>" /><br />
            
            <input type="submit" name="submit" value="Submit" /> 
            <input type="reset" name="reset" value="Reset" />
        </fieldset>

    </form>	
    </body>
</html>
