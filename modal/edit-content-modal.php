<div id="edit_content" class="reveal-modal" data-reveal >
	<div class="content-wrap">
		<form id="content-edit-form" method="POST" action="content.php" enctype="multipart/form-data">
			<fieldset>
				<legend class="content-background">Edit</legend>
				<label data-tooltip class="has-tip form-label" title="Your video title should not have been previously used. If the border is red, please change your content's title" id="title" for="title"> Title <small>required</small> : 
					<input type="text" name="title-edit" id="title-edit-input" class="required">
				</label>		
				<label data-tooltip class="has-tip form-label" title="Enter the description off your video." id="description" for="description"> Description <small>required</small> :
					<textarea name="description-edit" id="description-edit-input" rows="5" class="required"> </textarea>
				</label>
				<label data-tooltip class="has-tip form-label" 	title="Choose the tag linked to your content."> Content's tag <small>required</small> :
					<select name="tagid">
					<?php 
						foreach ($tag as $key => $value) 
						{
							?>
							<option value="<?php echo $value['tagid']; ?>"><?php echo$value['tagname']; ?></option>';
							<?php
						}
					?>
					</select>
				</label>
				<label class="form-label" id="thumbnail" for="thumbnail">Thumbnail (.gif/.jpg/.png | max. 5 Mo) :<br>
					<img id="thumbnail-preview-edit" src="videos/default.jpg" style="width:160px;height:100px;margin:0.5% 0 0.5% 0" alt="your thumbnail" />
					<input type="file" name="thumbnail-edit" data-max-size="5242880" accept="image/jpeg,image/png,image/gif" id="content-thumbnail-edit"/>
				</label>
				<label data-tooltip class="has-tip form-label" title="Please choose a licence for your content." id="licence" for="licence"> Content's licence <small>required</small> :
					<p>for more information about the Creative Commons' licences used on this website, please check <a href="http://creativecommons.org/licenses/">CreativeCommons.org</a>.</p>
					<table>
						<tr>
							<td><input type="radio" name="licence-edit" value="1" ><a href="http://creativecommons.org/licenses/by/4.0/"> Attribution 	CC BY</a></td>
							<td><input type="radio" name="licence-edit" value="2"><a href="http://creativecommons.org/licenses/by-sa/4.0/"> Attribution-ShareAlike 	CC BY-SA</a></td>
						</tr>
						<tr>
							<td><input type="radio" name="licence-edit" value="3"><a href="http://creativecommons.org/licenses/by-nd/4.0/"> Attribution-NoDerivs 	CC BY-ND</a></td>
							<td><input type="radio" name="licence-edit" value="4"><a href="http://creativecommons.org/licenses/by-nc/4.0/"> Attribution-NonCommercial 	CC BY-NC</a></td>
						</tr>
						<tr>
							<td><input type="radio" name="licence-edit" value="5"><a href="http://creativecommons.org/licenses/by-nc-sa/4.0/"> Attribution-NonCommercial-ShareAlike 	CC BY-NC-SA</a></td>
							<td><input type="radio" name="licence-edit" value="6"><a href="http://creativecommons.org/licenses/by-nc-nd/4.0/"> Attribution-NonCommercial-NoDerivs 	CC BY-NC-ND</a></td>
						</tr>	
						<tr>
							<td><input type="radio" name="licence-edit" value="8"><a href="http://creativecommons.org/about/cc0"> Public Domain 	CC0</a></td>
							<td><input type="radio" name="licence-edit" value="7"> Copyright </td>
						</tr>
					</table>
				</label>

				<!-- content id -->
				<input id="id-edit" name="id-edit" type="hidden" value="">

				<!-- Error field message div -->
				<div id="message-edit">

				</div>		

				<div class="form-button">
					<a id="submit-edit-content"class="button radius">Edit<a/>
					<span class="cancel-button button secondary radius">Cancel</span>
				</div>
				<a class="close-reveal-modal">&#215;</a>
			</fieldset>
		</form>
	</div>
</div>