<template>
	<div>
		<div>
			<p>
				<h1>
					Create a new Post!
				</h1>
			</p>
			<p>
				Form to create a new post.
			</p>
		</div>
		<form>
			<div class="control-group">
				<div class="form-group floating-label-form-group controls">
					<label>Title</label>
					<input type="text" placeholder="Title" id="title" name="title" required="required" data-validation-required-message="Please enter a title." class="form-control">
					<p class="help-block text-danger"></p>
				</div>
			</div>
			<div class="control-group">
					<div class="form-group floating-label-form-group controls">
						<label>Subtitle</label>
						<input type="text" placeholder="Subtitle" id="subtitle" name="subtitle" required="required" data-validation-required-message="Please enter a subtitle." class="form-control">
						<p class="help-block text-danger"></p>
					</div>
				</div>
			<div class="control-group">
				<div class="form-group floating-label-form-group controls">
					<label>Message</label>
					<textarea rows="5" placeholder="Message" id="message" name="message" required="required" data-validation-required-message="Please enter a message." class="form-control"></textarea>
					<p class="help-block text-danger"></p>
				</div>
			</div>
			<div class="success"></div>
			<div class="form-group">
				<button class="btn btn-primary" id="createPost">Send</button>
			</div>
		</form>
	</div>
</template>

<script>
export default {
	
}
</script>