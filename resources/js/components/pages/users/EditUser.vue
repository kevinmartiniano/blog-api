<template>
	<div>
		<p>
			<h1>
				Edit user
			</h1>
		</p>
		<p>
			Form to edit user.
		</p>
		<form v-on:submit.prevent="editUser">
			<div class="control-group">
				<div class="form-group floating-label-form-group controls">
					<label>Name</label>
					<input type="text" placeholder="Name" id="txt_name" name="txt_name" required="required" data-validation-required-message="Please enter a name." class="form-control">
					<p class="help-block text-danger"></p>
				</div>
			</div>
			<div class="control-group">
				<div class="form-group floating-label-form-group controls">
					<label>Email</label>
					<input type="text" placeholder="Email" v-model="user.email" id="txt_email" name="txt_email" required="required" data-validation-required-message="Please enter a email." class="form-control">
					<p class="help-block text-danger"></p>
				</div>
			</div>
			<div class="success"></div>
			<div class="form-group">
				<button class="btn btn-primary" id="editUser">Send</button>
			</div>
		</form>
	</div>
</template>

<script>
export default {
	data() {
		return {
			user: [],
		};
	},

	props: [
		'user_edit',
		'user_id',
	],

	ready() {
		//
	},

	mounted() {
		this.setName();
		this.setEmail();
	},

	methods: {
		setName: function() {
			document.getElementById('txt_name').value = this.user_edit.name;
		},

		setEmail: function() {
			document.getElementById('txt_email').value = this.user_edit.email;
		},

		editUser() {
			axios.put('/api/v1/users/' + this.user_edit.id, {
				name: this.user.name,
				email: this.user.email,
				created_id: this.user_id
			}).then(response => {
				window.location.href = window.location.origin + '/users/' + this.user_edit.id;
			}).catch(error => {
				console.debug(error);
			});
		},
	},
}
</script>