<?php
if (!isset($user_id))
{
	$user_id = '52120a2b-7898-43ca-861b-b2e74f63bb03';
}
?>
<form accept-charset="utf-8" method="post" id="indexForm" enctype="multipart/form-data" action="/v2/softwares/upload_and_unzip_file">
	<div style="display:none;"><input type="hidden" value="POST" name="_method"></div>
	<fieldset>
		<legend>Add a file</legend>
		<div class="control-group">
			<label class="control-label">Add a file</label>
			<div class="controls">
				<input type="file" id="file" name="data[zip_file]">
			</div>
		</div>
		<!--
		<div>
			<label class="control-label" for="comments">File description</label>
			<div class="input textarea">
				<textarea id="comments" rows="6" cols="30" name="data[comments]"></textarea>
			</div>
		</div>
		-->
		<input type="submit" value="Upload" class="btn">
		<div class="clear">
			<br />
			<br />
			<br />
			<br />
		</div>
	</fieldset>
</form>
