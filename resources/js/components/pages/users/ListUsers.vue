<template>
	<div>
		<table class="table table-hover">
			<thead>
				<tr>
				<th scope="col">#</th>
				<th scope="col">Name</th>
				<th scope="col">Email</th>
				<th scope="col">User Type</th>
				<th scope="col">Actions</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="user in users" :key="user.id">
					<th scope="row">{{ user.id }}</th>
					<td>{{ user.name }}</td>
					<td>{{ user.email }}</td>
					<td>{{ user.user_type_id }}</td>
					<td>
						<a v-bind:href="'/admin/users/' + user.id">
							<span class="fa-stack fa-md">
								<i class="fas fa-square fa-stack-2x"></i>
								<i class="fa fa-edit fa-stack-1x fa-inverse"></i>
							</span>
						</a>

						<a href="#">
							<span class="fa-stack fa-md">
								<i class="fas fa-square fa-stack-2x"></i>
								<i class="fas fa-trash-alt fa-stack-1x fa-inverse"></i>
							</span>
						</a>
					</td>
				</tr>
			</tbody>
		</table>
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
		'users',
	],
}
</script>