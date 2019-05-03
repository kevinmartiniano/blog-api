<template>
	<div>
		<form v-on:submit.prevent="editUser">
			<div class="control-group">
				<div class="form-group floating-label-form-group controls">
					<label>Name</label>
					<input type="text" placeholder="Name" v-model="user.title" id="name" name="name" required="required" data-validation-required-message="Please enter a name." class="form-control">
					<p class="help-block text-danger"></p>
				</div>
			</div>
			<div class="control-group">
				<div class="form-group floating-label-form-group controls">
					<label>Email</label>
					<input type="text" placeholder="Email" v-model="user.email" id="email" name="email" required="required" data-validation-required-message="Please enter a email." class="form-control">
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
	data() {
		return {
			user: [],
		};
	},

	ready() {
		//
	},

	mounted() {
		//
	},

	methods: {
		editUser() {
			
		},
	},
}
</script>