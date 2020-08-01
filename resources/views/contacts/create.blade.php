@extends('layouts.base')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css" />
<style>
trix-toolbar {
	position: sticky;
	top: 8px;
	z-index: 10;
	background-color: #fff;
	border-radius: 0.5em;
	padding: 0.5em;
	box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.05);
	margin-left: 1em;
	margin-right: 1em;
	margin-top: 1.2em;
}
.trix-editor {
	margin-top: -3.5em;
	padding-top: 5em;
}
trix-toolbar .trix-button-group {
	/* border-color: #ddd;
	border-bottom-color: #ccc; */
	overflow: hidden;
	border-radius: 4px;
	margin-bottom: 0;
	border: 0;
}
trix-toolbar .trix-button:not(:first-child) {
    border-left: 0; 
}
trix-toolbar .trix-button {
	border: 0;
	background-color: #fff;
}
trix-toolbar .trix-button--icon-bold::before {
	background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-bold' width='44' height='44' viewBox='0 0 24 24' stroke-width='1.5' stroke='%232c3e50' fill='none' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath stroke='none' d='M0 0h24v24H0z'/%3E%3Cpath d='M7 5h6a3.5 3.5 0 0 1 0 7h-6z' /%3E%3Cpath d='M13 12h1a3.5 3.5 0 0 1 0 7h-7v-7' /%3E%3C/svg%3E");
}

trix-toolbar .trix-button--icon-italic::before {
	background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-italic' width='44' height='44' viewBox='0 0 24 24' stroke-width='1.5' stroke='%232c3e50' fill='none' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath stroke='none' d='M0 0h24v24H0z'/%3E%3Cline x1='11' y1='5' x2='17' y2='5' /%3E%3Cline x1='7' y1='19' x2='13' y2='19' /%3E%3Cline x1='14' y1='5' x2='10' y2='19' /%3E%3C/svg%3E");
}
trix-toolbar .trix-button--icon-strike::before {
	background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-strikethrough' width='44' height='44' viewBox='0 0 24 24' stroke-width='1.5' stroke='%232c3e50' fill='none' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath stroke='none' d='M0 0h24v24H0z'/%3E%3Cline x1='5' y1='12' x2='19' y2='12' /%3E%3Cpath d='M16 6.5a4 2 0 0 0 -4 -1.5h-1a3.5 3.5 0 0 0 0 7' /%3E%3Cpath d='M16.5 16a3.5 3.5 0 0 1 -3.5 3h-1.5a4 2 0 0 1 -4 -1.5' /%3E%3C/svg%3E");
}

trix-toolbar .trix-button--icon-code::before {
	background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-code' width='44' height='44' viewBox='0 0 24 24' stroke-width='1.5' stroke='%232c3e50' fill='none' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath stroke='none' d='M0 0h24v24H0z'/%3E%3Cpolyline points='7 8 3 12 7 16' /%3E%3Cpolyline points='17 8 21 12 17 16' /%3E%3Cline x1='14' y1='4' x2='10' y2='20' /%3E%3C/svg%3E");
}

trix-toolbar .trix-button--icon-link::before {
	background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-link' width='44' height='44' viewBox='0 0 24 24' stroke-width='1.5' stroke='%232c3e50' fill='none' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath stroke='none' d='M0 0h24v24H0z'/%3E%3Cpath d='M10 14a3.5 3.5 0 0 0 5 0l4 -4a3.5 3.5 0 0 0 -5 -5l-.5 .5' /%3E%3Cpath d='M14 10a3.5 3.5 0 0 0 -5 0l-4 4a3.5 3.5 0 0 0 5 5l.5 -.5' /%3E%3C/svg%3E");
}

trix-toolbar .trix-button--icon-bullet-list::before {
	background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-list' width='44' height='44' viewBox='0 0 24 24' stroke-width='1.5' stroke='%232c3e50' fill='none' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath stroke='none' d='M0 0h24v24H0z'/%3E%3Cline x1='9' y1='6' x2='20' y2='6' /%3E%3Cline x1='9' y1='12' x2='20' y2='12' /%3E%3Cline x1='9' y1='18' x2='20' y2='18' /%3E%3Cline x1='5' y1='6' x2='5' y2='6.01' /%3E%3Cline x1='5' y1='12' x2='5' y2='12.01' /%3E%3Cline x1='5' y1='18' x2='5' y2='18.01' /%3E%3C/svg%3E");
}

trix-toolbar .trix-button--icon-decrease-nesting-level::before {
	background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-indent-decrease' width='44' height='44' viewBox='0 0 24 24' stroke-width='1.5' stroke='%232c3e50' fill='none' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath stroke='none' d='M0 0h24v24H0z'/%3E%3Cline x1='20' y1='6' x2='13' y2='6' /%3E%3Cline x1='20' y1='12' x2='11' y2='12' /%3E%3Cline x1='20' y1='18' x2='13' y2='18' /%3E%3Cpath d='M8 8l-4 4l4 4' /%3E%3C/svg%3E");
}

trix-toolbar .trix-button--icon-increase-nesting-level::before {
	background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-indent-increase' width='44' height='44' viewBox='0 0 24 24' stroke-width='1.5' stroke='%232c3e50' fill='none' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath stroke='none' d='M0 0h24v24H0z'/%3E%3Cline x1='20' y1='6' x2='9' y2='6' /%3E%3Cline x1='20' y1='12' x2='13' y2='12' /%3E%3Cline x1='20' y1='18' x2='9' y2='18' /%3E%3Cpath d='M4 8l4 4l-4 4' /%3E%3C/svg%3E");
}

trix-toolbar .trix-button--icon-attach::before {
	background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-paperclip' width='44' height='44' viewBox='0 0 24 24' stroke-width='1.5' stroke='%232c3e50' fill='none' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath stroke='none' d='M0 0h24v24H0z'/%3E%3Cpath d='M15 7l-6.5 6.5a1.5 1.5 0 0 0 3 3l6.5 -6.5a3 3 0 0 0 -6 -6l-6.5 6.5a4.5 4.5 0 0 0 9 9 l6.5 -6.5' /%3E%3C/svg%3E");
}

trix-toolbar .trix-button--icon-quote::before {
	background-image: url("data:image/svg+xml,%3Csvg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-blockquote-left' fill='%232c3e50' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath fill-rule='evenodd' d='M2 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm5 3a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z'/%3E%3Cpath d='M3.734 6.352a6.586 6.586 0 0 0-.445.275 1.94 1.94 0 0 0-.346.299 1.38 1.38 0 0 0-.252.369c-.058.129-.1.295-.123.498h.282c.242 0 .431.06.568.182.14.117.21.29.21.521a.697.697 0 0 1-.187.463c-.12.14-.289.21-.503.21-.336 0-.577-.108-.721-.327C2.072 8.619 2 8.328 2 7.969c0-.254.055-.485.164-.692.11-.21.242-.398.398-.562.16-.168.33-.31.51-.428.18-.117.33-.213.451-.287l.211.352zm2.168 0a6.588 6.588 0 0 0-.445.275 1.94 1.94 0 0 0-.346.299c-.113.12-.199.246-.257.375a1.75 1.75 0 0 0-.118.492h.282c.242 0 .431.06.568.182.14.117.21.29.21.521a.697.697 0 0 1-.187.463c-.12.14-.289.21-.504.21-.335 0-.576-.108-.72-.327-.145-.223-.217-.514-.217-.873 0-.254.055-.485.164-.692.11-.21.242-.398.398-.562.16-.168.33-.31.51-.428.18-.117.33-.213.451-.287l.211.352z'/%3E%3C/svg%3E");
}
trix-toolbar .trix-button--icon-number-list::before {
	background-image: url("data:image/svg+xml,%3Csvg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-list-ol' fill='%232c3e50' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath fill-rule='evenodd' d='M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5z'/%3E%3Cpath d='M1.713 11.865v-.474H2c.217 0 .363-.137.363-.317 0-.185-.158-.31-.361-.31-.223 0-.367.152-.373.31h-.59c.016-.467.373-.787.986-.787.588-.002.954.291.957.703a.595.595 0 0 1-.492.594v.033a.615.615 0 0 1 .569.631c.003.533-.502.8-1.051.8-.656 0-1-.37-1.008-.794h.582c.008.178.186.306.422.309.254 0 .424-.145.422-.35-.002-.195-.155-.348-.414-.348h-.3zm-.004-4.699h-.604v-.035c0-.408.295-.844.958-.844.583 0 .96.326.96.756 0 .389-.257.617-.476.848l-.537.572v.03h1.054V9H1.143v-.395l.957-.99c.138-.142.293-.304.293-.508 0-.18-.147-.32-.342-.32a.33.33 0 0 0-.342.338v.041zM2.564 5h-.635V2.924h-.031l-.598.42v-.567l.629-.443h.635V5z'/%3E%3C/svg%3E");
}

trix-toolbar .trix-button--icon-undo::before {
	background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-arrow-back-up' width='44' height='44' viewBox='0 0 24 24' stroke-width='1.5' stroke='%232c3e50' fill='none' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath stroke='none' d='M0 0h24v24H0z'/%3E%3Cpath d='M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1' /%3E%3C/svg%3E");
}

trix-toolbar .trix-button--icon-redo::before {
	background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-arrow-forward-up' width='44' height='44' viewBox='0 0 24 24' stroke-width='1.5' stroke='%232c3e50' fill='none' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath stroke='none' d='M0 0h24v24H0z'/%3E%3Cpath d='M15 13l4 -4l-4 -4m4 4h-11a4 4 0 0 0 0 8h1' /%3E%3C/svg%3E");
}

trix-toolbar .trix-button--icon-heading-1::before {
	background-image: url("data:image/svg+xml,%3Csvg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-type-h1' fill='%232c3e50' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M8.637 13V3.669H7.379V7.62H2.758V3.67H1.5V13h1.258V8.728h4.62V13h1.259zm5.329 0V3.669h-1.244L10.5 5.316v1.265l2.16-1.565h.062V13h1.244z'/%3E%3C/svg%3E");
}

trix-editor:empty:not(:focus)::before {
    color: #a0aec0;
}

.trix-content h1 {
	font-size: 2rem;
	font-weight: 700;
	margin-bottom: 0.75rem;
}

.trix-content a {
	text-decoration: underline;
	cursor: pointer;
	color: #667eea;
}

.trix-content blockquote {
	border-left-color: #667eea;
}

.trix-content pre {
	border-radius: 0.5em;
}

.trix-content ol,
.trix-content ul {
	margin-bottom: 1rem;
}

.trix-content li {
	position: relative;
	padding-left: 1.5em;
	margin-bottom: 1rem;
}
.trix-content ul li:before {
	position: absolute;
	top: 10px;
	left: 0;
	content: "";
	width: 0.4em;
	height: 0.4em;
	background-color: #667eea;
	border-radius: 50%;
	display: inline-block;
}

.trix-content ol {
	counter-reset: custom-counter;
}
.trix-content ol li:before {
	counter-increment: custom-counter;
	position: absolute;
	top: 2px;
	left: 0;
	content: counter(custom-counter) ".";
	display: inline-block;
	font-size: 0.85em;
	font-weight: 500;
	color: #667eea;
	text-align: right;
}

.choices,
.choices__inner,
.choices__input,
.choices__list--dropdown {
	background-color: #fff;
	border-radius: 0.5rem;
}
.choices__input {
	font-size: 1rem;
	background-color: transparent;
}
.choices__inner {
	border-color: #e2e8f0;
	box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
	display: inline-block;
    vertical-align: top;
    width: 100%;
    padding: 4.5px 7.5px 0.2px;
}
.choices.is-focused .choices__inner {
	border-radius: 0.5rem;
	box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.5);
}
.choices.is-loading .choices__inner,
.choices.is-loading .choices__input {
	background-color: transparent;
}
.choices__list--dropdown {
	margin-top: 5px;
	padding: 5px 10px;
}
.choices[data-type*=select-one] .choices__input {
	margin-bottom: 4px;
	background-color: #edf2f7;
	border: 0;
}
.choices__list--dropdown .choices__item {
	border-radius: 0.5rem;
	color: inherit;
}
.is-open .choices__list--dropdown {
	z-index: 15;
	border-color:#e2e8f0;
	box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
}

.choices__list--multiple .choices__item,
.choices__list--multiple .choices__item.is-highlighted { 
	font-family: inherit;
    background-color: #718096;
    border: 1px solid #4a5568;
}
.choices[data-type*=select-multiple] .choices__button, 
.choices[data-type*=text] .choices__button {
	border-left: 1px solid #4a5568;
}
.select-has-error .choices__inner {
	border-color: #f56565;
	background-color: #fff5f5;
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/scripts/choices.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js" defer></script>
<script src="//cdn.jsdelivr.net/npm/vanilla-masker@1.1.1/build/vanilla-masker.min.js" defer></script>
<script>
	document.addEventListener('DOMContentLoaded', () => {
		Trix.config.attachments.preview.caption = {
	    	name: false,
	    	size: false
	  	};
	});
</script>
<script src="//cdn.jsdelivr.net/npm/vanilla-masker@1.1.1/build/vanilla-masker.min.js" defer></script>
@endpush

@section('content')
	<x-section-centered class="py-10">
		<x-card>

			<div x-data="{

				save($event, $dispatch) {
					// console.log($event.target.{name}.value);

					fetch('/contacts/create', {
						credentials: 'same-origin',
						method: 'POST',
						body: JSON.stringify({
							fisrt_name: $event.target.first_name.value,
							last_name: $event.target.last_name.value
						}),
						headers: {
							'X-Requested-With': 'XMLHttpRequest',
							'X-CSRF-TOKEN': '{{ csrf_token() }}',
							'Content-Type': 'application/json',
							'Accept': 'application/json',
						}
					})
		                .then(async response => {
							const data = await response.json()
							if (response.ok) {
								return data
							} else {
								return Promise.reject(data)
							}
						})
		                .then(
			                data => {
								// console.log(data);
								// Do not reset form
								// Reset form triggers trix-editor's trix-attachment-remove 
								{{-- this.$refs.form.reset(); --}}
								$dispatch('notice', { type: 'success', text: 'Post created' });
								location.href = '/posts';
			                },
			                error => {
								// console.log('oh no, login failed', error)
								if (error.message.length) {
			                       	$dispatch('js-errors', { errors: error.errors });
			                    }
			            	}
		            	);
					}
				}">
				<x-form 
					action="{{ route('contacts.store') }}" 
					method="POST"
					@submit.prevent="save($event, $dispatch)">
{{-- 
					<x-trix-editor 
						label="Body" 
						name="email" 
						placeholder="Write something good..." 
						upload="true"
						endpoint="/uploads" 
						delete-endpoint="/uploads/remove" /> --}}


					{{-- <x-select-input label="Gender" name="gender">
						<option value="male">Male</option>
						<option value="female">Female</option>
					</x-select-input> --}}

{{-- 				 
					<x-radio-input 
						label="Gender"
						name="gender"
						:options="[
							[
								'label' => 'Male',
								'value' => 'male',
								'description' => 'lorem hgsfahgdad'
							],
							[
								'label' => 'Female',
								'value' => 'female',
								'description' => 'lorem hgsfahgdad'
							]
						]"
						selected="female"
						theme="indigo"
					/>
					 --}}
					<x-text-input
						label="First name"
						name="first_name" />

					<x-text-input label="Last name" placeholder="last name" name="last_name" />
					
					<x-text-input label="Email" type="email" name="email" />

					<x-numeric-input 
						label="Phone" 
						name="phone" 
						mask-type="phone"
						mask-pattern="(99) 9999-9999" />

					<x-numeric-input 
						label="Zip" 
						name="zip"
						mask-type="number"
						maxlength="6" />

					<x-button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white">Save</x-button>

				</x-form>
			</div>
		
		</x-card>
	</x-section-centered>
@endsection