<!--
	This component demonstrates how components can make asynchronous
	Core REST API requests to update their internal data. The template
	will change automatically once new data is present.
-->
<template>
	<div id="coreapi-request-module">
		<h2>
			{{ $i18n( 'vuecorerestsandbox-coreapirequest-title' ) }}
		</h2>

		<p>
			{{ $i18n( 'vuecorerestsandbox-coreapirequest-intro') }}
		</p>

		<!--
			This is an example of how conditional logic works in Vue
			templates. More information about this can be found here:
			https://vuejs.org/v2/guide/conditional.html
		-->
		<div>
			<pre v-if="jsonResult">{{ jsonResult }}</pre>
			<pre v-else>{{ $i18n( 'vuecorerestsandbox-coreapirequest-pending' ) }}</pre>
		</div>

		<span>Available Paths&nbsp;</span>
		<select v-model="selectedPath">
			<option v-for="path in corePaths" v-bind:value="path">
				{{ path }}
			</option>
		</select><br>

		<span>Selected Path:&nbsp;{{ selectedPath }}</span><br>

		<span>Param values to substitute (separate with a ; character)&nbsp;</span>
		<input v-model="params" type="text"><br>

		<button v-on:click="makeCoreRestApiCall( scriptPath )">
			{{ $i18n( 'vuecorerestsandbox-coreapirequest-button' ) }}
		</button>
	</div>
</template>

<script>
module.exports = {
	name: 'CoreApiRequestModule',

	// Every component can have a `data` property. This is the place for any
	// state that we want to keep track of in a reactive way. Here the initial
	// state of the `jsonResult` property is null; that will change once we make a
	// successful API request. The component will automatically re-render when
	// that happens.
	data: function () {
		return {
			scriptPath: scriptPath,
			corePaths: corePaths,
			selectedPath: corePaths[0],
			params: 'Main_Page',
			jsonResult: null
		};
	},

	methods: {
		/**
		 *
		 */
		makeCoreRestApiCall: function ( scriptPath ) {
			var path = this.selectedPath;
			var paramArray = this.params.split( ';' );
			paramArray.forEach( function ( item ) {
				path = path.replace( /\{.+?\}/, item );
			});

//			fetch( '/mediawiki/rest.php' + path )
			fetch( scriptPath + '/rest.php' + path )
			.then( response => {
				return response.json();
			}).then( json => {
				this.jsonResult = json;
			});
		}
	}
};
</script>
