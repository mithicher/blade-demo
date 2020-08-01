@extends('layouts.base')

@section('content')
	 <x-section-centered class="py-10">

		<x-alert variant="success" :close="false">
			Hello user create
		</x-alert>
		
			
		<div
			x-data="{
				// checks any search query string in browser URL
				query: new URLSearchParams(location.search).get('s') || '',

				// fetches data using fetch api
				fetchData(page = null) {
					// Check if any page query string is available in browser URL
					// then grab that value
					let currentPageFromUrl = location.search.match(/page=(\d+)/) 
									? location.search.match(/page=(\d+)/)[1] 
									: 1
				
					if (this.query) {
						currentPageFromUrl = 1;
						history.pushState(null, null, '?page=1&s='+ this.query);
					}
					
					// TODO: Change the endpoint
					const endpointURL =  page !== null 
								? `${page}&s=${this.query}` 
								: `/contacts?page=${currentPageFromUrl}&s=${this.query}`;
					
					if (page) {
						// 1. if page is valid http://domain.test/users/partial?page=2&s=

						// 2. create a URL object from the page
						const urlObj = new URL(page);
						
						// 3. initialize URLSearchParams
						const params = new URLSearchParams(urlObj.search);
							
						// 4. Push to Current Browser URL
						history.pushState(null, null, '?page=' + params.get('page') );
					}
						
					fetch(endpointURL, {
							headers: {
								'X-Requested-With': 'XMLHttpRequest'
							}
						})
						.then(response => response.text())
						.then(html => {
							document.querySelector('#js-contacts-body').innerHTML = html
						})
				}
			}"
			x-init="
				$watch('query', (value) => {
					const url = new URL(window.location.href);
					url.searchParams.set('s', value);
					history.pushState(null, document.title, url.toString());
				})
			"
			@goto-page="fetchData($event.detail.page)"
			@reload.window="fetchData()"
			x-cloak>

			<div class="my-4">
				<x-search-input
					placeholder="Search contacts..." 
					name="s" 
					x-model="query" 
					x-on:input.debounce.750="fetchData()" />
			</div>

			<div id="js-contacts-body">
				@include('contacts._partial')
			</div>
		</div>
	 </x-section-centered>
@endsection