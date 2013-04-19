        <link href="<?= base_url('/assets/css/default.css') ?>" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
        <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
        <script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
        <script>
            $(function() {
                $( "#target_date" ).datepicker({dateFormat: 'dd/mm/yy'});
            });
        </script>
        <div class="target">
<h2>Create a target</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('target/create') ?>
<fieldset class="fieldset-auto-width">
<label for="title">Area for Development</label> 
<input type="input" name="title" /><br />

<label for="title_ext">Target title</label> 
<input type="input" name="title_ext" /><br />

<label for="description">Description of action</label>
<textarea name="description" row="50" cols="50"></textarea><br />

<label for="target_status_id">Status</label>
<?= form_dropdown('target_status', $target_status) ?><br />

            <label for="target_date">Due Date</label>
            <input type="text" name="target_date" id="target_date" /><br />
            <br>
<input type="submit" name="submit" value="Create target" /> 
    </fieldset>  
</form>

  </div>