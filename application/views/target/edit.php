<?php 
/**
 * @package target edit form
 * @todo Check this is your target to edit or your an admin.
 * 
 */

//for testing
echo "Edit record ".$_GET['id']."<br>";?>



        <link href="<?= base_url('/assets/css/default.css') ?>" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
        <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
        <script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
        <script>
            $(function() {
                $( "#target_date" ).datepicker({dateFormat: 'dd/mm/yy'});
            });
        </script>
<script type="text/javascript" src="<?= base_url('/assets/js/tiny_mce/jquery.tinymce.js')?>"></script>
 <script type="text/javascript" src="<?= base_url('/assets/js/tiny_mce/tiny_mce.js')?>"></script>
<script type="text/javascript">
tinyMCE.init({
        theme : "advanced",
        mode : "textareas",
        plugins : "fullpage",
        theme_advanced_toolbar_location : "top",
        theme_advanced_buttons3_add : "fullpage"
});
</script>
<h2>Edit a target</h2>
                <?php foreach ($targets as $target_item): ?>
              
                     
               
<?php endforeach; ?>

                    
                    <?php echo validation_errors(); ?>

<?php echo form_open('target/edit?id='.$_GET['id']) ?>

<label for="title">Area for Development</label> 
<input type="input" name="title" value="<?= $target_item['title'] ?>"/><br />

<label for="title_ext">Target title</label> 
<input type="input" name="title_ext" value="<?= $target_item['title_ext'] ?>"/><br />

<label for="description">Description of action</label>
<textarea name="description" cols="100" rows="20"><?= $target_item['description'] ?></textarea><br />

<label for="target_status_id">Status</label>
<?= form_dropdown('target_status', $target_status)?><br />

            <label for="target_date">Due Date</label>
            <input type="text" name="target_date" id="target_date" value="<?= $target_item['target_date'] ?>"/><br />

<input type="submit" name="submit" value="Update target" /> 

</form>