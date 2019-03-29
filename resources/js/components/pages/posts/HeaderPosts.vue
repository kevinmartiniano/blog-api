<template>
	<div class="post-heading">
		<h1>
			{{ title }}
		</h1>
		<h2 class="subheading">
			{{ subtitle }}
		</h2>
		<span class="meta">Posted by <a v-bind:href="'/users/' + user_id" name="link_user_id">{{ user_name }}</a> on {{ created_at }}</span>
	</div>
</template>

<script>
export default {
	data() {
		return {
			//
		};
	},

	props: [
		'title',
		'subtitle',
		'user_id',
		'user_name',
		'created_at',
	],

	ready() {
		//
	},

	mounted() {
		//
	},

	methods: {
		//
	},
}
</script>