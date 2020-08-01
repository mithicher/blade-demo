@if ($contacts->isNotEmpty())
	<x-base-datatable
		:headings="['#', 'First name', 'Type', 'Last name',  'Email', 'Phone', 'Zip', 'Created at', 'Actions']"
		:data="$contacts"
		model="contacts"
		table-striped
		:values="[
			[
				'key' => 'id', 
				'type' => 'data'
			],
			[
				'key' => 'first_name', 
				'type' => 'data'
			],
			[
				'key' => 'type', 
				'type' => 'data',
				'theme' => [
					'type' => 'badge',
					'colors' => [
						'client' => 'bg-green-200 text-green-700',
						'broker' => 'bg-orange-200 text-orange-700',
						'agent' => 'bg-indigo-200 texindigoge-700',
					]
				]
			],
			[
				'key' => 'last_name', 
				'type' => 'data'
			],
			[
				'key' => 'email', 
				'type' => 'data'
			],
			[
				'key' => 'phone', 
				'type' => 'data'
			],
			[
				'key' => 'zip', 
				'type' => 'data'
			],
			[
				'key' => 'created_at', 
				'type' => 'date',
				'format' => 'y/m/d'
			],
			[
				'key' => 'action', 
				'type' => ['delete', 'edit'],
			]
		]"
	>
	</x-base-datatable>	
@else
	No contacts found. 
@endif
