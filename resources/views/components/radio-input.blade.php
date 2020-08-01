<div class="mb-5">	
    @if($label ?? null)
		<label for="{{ $name }}" class="form-label block mb-1 font-semibold text-gray-700">
			{{ $label }} 
			@if($optional ?? null)
				<span class="text-sm text-gray-500 font-normal">(optional)</span>
			@endif
		</label>
    @endif

	<div
		x-data="{
			radioSelected: ''
		}"
		x-init="radioSelected = '{{ $selected ?? '' }}'"
		>
		@if(isset($options))
			<div class="flex -mx-4 flex-wrap">
				@foreach($options as $option)
					@php $id = Str::random(8); @endphp
					<label 
						for="{{ $id }}"
						class="w-full md:w-1/3 flex justify-start items-center truncate px-4 py-1">
						<div 
							:class="{ 'border-{{ $theme }}-500': radioSelected === '{{ $option['value'] }}'}"
							class="bg-white flex flex-1 p-4 rounded-lg shadow-sm border relative">
							<div class="mr-3 flex-shrink-0 text-{{ $theme }}-600">
								<input
									id="{{ $id }}"
									type="radio" 
									class="form-radio focus:outline-none focus:shadow-outline" 
									name="{{ $name }}"
									value="{{ old($name, $option['value'] ?? '') }}"
									x-model="radioSelected"
									x-on:change="$dispatch('input', radioSelected)" />
							</div>
							<div class="select-none text-gray-700">
								<div class="text-gray-800 font-medium pt-px">{{ $option['label'] }}</div>
								<div class="whitespace-normal text-gray-600 text-sm">{{ $option['description'] ?? ''}}</div>
							</div>

							{{-- <template x-if="radioSelected === '{{ $option['value'] }}'">
								<div class="absolute top-0 right-0 mt-4 mr-4">
								<svg class="w-6 h-6 fill-current text-{{ $theme }}-500" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
								</div> 
							</template>--}}

						</div>
					</label>
				@endforeach
			</div>
		@else 
			<p class="text-sm text-gray-600">Please provide an <code>:options="$options"</code> array with keys label and value.</p>
		@endif
	</div>
</div>