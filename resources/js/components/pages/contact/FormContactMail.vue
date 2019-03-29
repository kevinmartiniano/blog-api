<template>
	<div>
		<p>Want to get in touch? Fill out the form below to send me a message and I will get back to you as soon as possible!</p>
		<!-- Contact Form - Enter your email address on line 19 of the mail/contact_me.php file to make this form work. -->
		<!-- WARNING: Some web hosts do not allow emails to be sent through forms to common mail hosts like Gmail or Yahoo. It's recommended that you use a private domain email address! -->
		<!-- To use the contact form, your site must be on a live web host with PHP! The form will not work locally! -->
		<form v-on:submit.prevent="sendMessage">
			<div>
				<div class="control-group">
					<div class="form-group floating-label-form-group controls">
						<label>Name</label>
						<input v-model="contact.name" type="text" class="form-control" placeholder="Name" id="name" name="name" required data-validation-required-message="Please enter your name.">
						<p class="help-block text-danger"></p>
					</div>
				</div>
				<div class="control-group">
					<div class="form-group floating-label-form-group controls">
						<label>Email Address</label>
						<input v-model="contact.email" type="email" class="form-control" placeholder="Email Address" id="email" name="email" required data-validation-required-message="Please enter your email address.">
						<p class="help-block text-danger"></p>
					</div>
				</div>
				<div class="control-group">
					<div class="form-group col-xs-12 floating-label-form-group controls">
						<label>Phone Number</label>
						<input v-model="contact.phone_number" v-mask="['(##) ####-####', '(##) #####-####']" type="tel" class="form-control" placeholder="Phone Number" id="phone_number" name="phone_number" required data-validation-required-message="Please enter your phone number.">
						<p class="help-block text-danger"></p>
					</div>
				</div>
				<div class="control-group">
					<div class="form-group floating-label-form-group controls">
						<label>Message</label>
						<textarea v-model="contact.message" rows="5" class="form-control" placeholder="Message" id="message" name="message" required data-validation-required-message="Please enter a message."></textarea>
						<p class="help-block text-danger"></p>
					</div>
				</div>
				<br>
				<div id="success"></div>
				<div class="form-group">
					<button class="btn btn-primary" id="sendMessageButton" value="Send">Send</button>
				</div>
			</div>
		</form>
	</div>
</template>

<script>
	export default {
		/*
		* The component's data.
		*/
		data() {
			return {
				contact: [],
			};
		},

		methods: {
			sendMessage(){
				var contact = this.contact;

				this.contact = '';

				axios.post('/api/v1/contact/', {
					name: contact.name,
					email: contact.email,
					phone_number: contact.phone_number,
					message: contact.message
				}).then(response => {
					window.location.href = '/contact';
				}).catch(error => {
					console.debug(error);
				});
			},
		},
	}
</script>