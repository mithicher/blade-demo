<div
	{{ $attributes->merge([
		'class' => 'md:max-w-5xl md:mx-auto' 
	]) }}
>
	{{ $slot }}
</div>