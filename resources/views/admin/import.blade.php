
<form action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <label>Import</label>
    <input type="file" name="file"></br>
    <button type="submit">Import</button>
</form></br>