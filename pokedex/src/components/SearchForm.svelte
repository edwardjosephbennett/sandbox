<script>
	export let formTitle = '';
</script>
<div class="w-full max-w-xs">
	<h1 class="text-2xl mb-4 text-center">{formTitle}</h1>
	<form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
		<div class="mb-4">
			<label class="block text-gray-700 text-sm font-bold mb-2" for="username">
				Enter Pokèmon name:
			</label>
			<input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="E.g Bulbasaur">
		</div>
		<div class="flex items-center justify-between">
			<button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
				Search
			</button>
		</div>
	</form>
	<p class="text-center text-gray-500 text-xs">
		&copy;2020 Acme Corp. All rights reserved.
	</p>
</div>