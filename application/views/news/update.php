        <link href="<?= base_url('/assets/css/default.css') ?>" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
        <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
        <script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
<script type="text/javascript" src="<?= base_url('/assets/js/tiny_mce/jquery.tinymce.js')?>"></script>
 <script type="text/javascript" src="<?= base_url('/assets/js/tiny_mce/tiny_mce.js')?>"></script>
<script type="text/javascript">
tinyMCE.init({
        theme : "advanced",
        mode : "textareas",
        plugins : "fullpage",
        theme_advanced_buttons3_add : "fullpage"
});
</script>

<?php echo validation_errors(); ?>
<?php foreach ($news as $news_item): ?>    

<?php endforeach; ?>
<?php echo form_open('news/update') ?>
 <fieldset class="fieldset-auto-width">          
            <legend>Update news banner</legend>
<label for="description">Banner text</label><br>
<textarea name="description" cols="100" rows="20"><?= $news_item['description'] ?></textarea><br />


<input type="submit" name="submit" value="Update News" /> 
 </fieldset>   
</form>