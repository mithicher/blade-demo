<div class="mb-5">
	@if($label ?? null)
	   <label for="{{ $name }}" class="form-label block mb-1 font-semibold text-gray-700">
		   {{ $label }} 
		   @if($optional ?? null)
			   <span class="text-sm text-gray-500 font-normal">(optional)</span>
		   @endif
	   </label>
   @endif

   @php $id = $name . Str::random(8); @endphp
   
   <input 
	   id="{{ $id }}" 
	   type="hidden" 
	   name="{{ $name }}" 
	   x-ref="{{ $name }}" 
	   value="{{ old($name, $value ?? '') }}" />

   <div x-data="{ 
		   csrf: '{{ csrf_token() }}',
		   error: '', 
		   showUploadButton: Boolean('{{ $upload ?? false }}'),
		   endpoint: '{{ $endpoint ?? '' }}',
		   deleteEndpoint: '{{ $deleteEndpoint ?? '' }}',
		   uploadAttachment(event) {
			   console.log(event.attachment);
			   let attachment = event.attachment;
			   let file = attachment.file
			   if (file) {
				   let form = new FormData; 
				   form.append('Content-Type', file.type);
				   form.append('image', file);

				   xhr = new XMLHttpRequest;
				   xhr.open('POST', this.endpoint, true);
				   xhr.setRequestHeader('X-CSRF-Token', this.csrf);

				   xhr.upload.onprogress = function(event) {
					   var progress = event.loaded / event.total * 100;
					   return attachment.setUploadProgress(progress);
				   };

				   xhr.onload = function() {
					   if (this.status >= 200 && this.status < 300) {
						   var data = JSON.parse(this.responseText);
						   return attachment.setAttributes({
							   url: data.url,
							   href: data.url
						   });
						 }
				   };

				   return xhr.send(form);
			   }
		   },
		   deleteAttachment(event) {
			   // console.log(event.attachment.attachment);
			   let attachment = event.attachment;

			   let url = attachment.attachment.attributes.values.url.split('/');
			   // console.log(`${url[1]}/${url[2]}`);
			   let previewURL = `${url[1]}/${url[2]}`;

			   if (previewURL && this.deleteEndpoint) {
				   let form = new FormData; 
				   form.append('image', previewURL);

				   xhr = new XMLHttpRequest;
				   xhr.open('POST', this.deleteEndpoint, true);
				   xhr.setRequestHeader('X-CSRF-Token', this.csrf);

				   xhr.upload.onprogress = function(event) {
					   var progress = event.loaded / event.total * 101;
					   return attachment.setUploadProgress(progress);
				   };

				   xhr.onload = function() {
					   if (this.status >= 201 && this.status < 300) {
						   var data = JSON.parse(this.responseText);
						   return '';
						 }
				   };

				   return xhr.send(form);
			   }
		   }
	   }" 
	   @js-errors.window="error = $event.detail.errors.{{ $name }} || ''" class="relative">
	   
	   <trix-editor 
		   placeholder="{{ $placeholder ?? '' }}"
		   input="{{ $id }}" 
		   class="trix-editor border-gray-300 trix-content"
		   :class="{' border-red-500 bg-red-100' : error.length || '{{ $errors->has($name) }}'}"
		   x-ref="trix-editor"
		   x-on:trix-change="$dispatch('input', event.target.value)"
		   x-on:keydown="error.length ? error = '' : ''"
		   x-on:trix-initialize="$refs['trix-editor'].classList.add('rounded-lg', 'bg-white', 'shadow-sm', 'p-6')
			   uploadBtn = document.querySelector('.trix-button-group--file-tools');
			   if (showUploadButton == true) {
				   uploadBtn.setAttribute('style', 'display: block');
			   } else  {
				   uploadBtn.setAttribute('style', 'display: none');
			   }
		   "
		   x-on:trix-focus="$refs['trix-editor'].classList.add('focus:shadow-outline', 'focus:border-blue-300')"
		   x-on:trix-attachment-add="showUploadButton == true ? uploadAttachment(event) : ''"
		   x-on:trix-attachment-remove="deleteAttachment(event)"
		   ></trix-editor>

	   @isset($hint)
		   <div class="text-sm text-gray-500 my-2 leading-tight help-text">{{ $hint }}</div>
	   @endisset

	   <div x-show="error.length > 0">
		   <svg class="absolute text-red-600 fill-current w-5 h-5" style="top: 48px; right: 12px"
			   xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
			   <path
				   d="M11.953,2C6.465,2,2,6.486,2,12s4.486,10,10,10s10-4.486,10-10S17.493,2,11.953,2z M13,17h-2v-2h2V17z M13,13h-2V7h2V13z" />
		   </svg>
		   <div class="text-red-600 mt-2 text-sm block leading-tight error-text" x-html="error"></div>
	   </div>

	   @error($name)
		   <svg class="absolute text-red-600 fill-current w-5 h-5" style="top: 48px; right: 12px"
			   xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
			   <path
				   d="M11.953,2C6.465,2,2,6.486,2,12s4.486,10,10,10s10-4.486,10-10S17.493,2,11.953,2z M13,17h-2v-2h2V17z M13,13h-2V7h2V13z" />
		   </svg>
		   <div class="text-red-600 mt-2 text-sm block leading-tight error-text">{{ $message }}</div>
	   @enderror
   
   </div>
</div>