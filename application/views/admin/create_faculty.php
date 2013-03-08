<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>MyCPD Admin</title>
        <link href="<?= base_url('/assets/css/default.css') ?>" rel="stylesheet" type="text/css">
    </head>
    <body>
        <h1>Create Faculty</h1>
        <?= validation_errors(); ?>
        <?= form_open('admin/faculty/create') ?>
        <fieldset>
            <legend>Add new Faculty</legend>
            
            <label for="title">Faculty name: </label>
            <input type="text" name="title" id="title" /><br />
            
            <label for="manager">Faculty Head: </label>
            <input type="text" name="manager" id="manager" /><br />
            
            <input type="submit" name="submit" value="Submit" /> 
            <input type="reset" name="reset" value="Reset" />
        </fieldset>

    </form>	
    </body>
</html>
