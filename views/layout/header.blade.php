<header>
	<nav class="nav has-shadow">
		<div class="container">
			@if(get_field('fff_nav_layout', 'option') == 'left')
				<div class="nav-left">
					<div class="desktop-logo">
						{{ get_custom_logo() }}
					</div>
					<div class="mobile-logo">
						<a href="/">
							<img src="{{ wp_get_attachment_image_src(get_field('fff_mobile_logo', 'option'), 'large')[0] }}">
						</a>
					</div>
				</div>
				<div class="nav-right">
					@if ($items = $menu->get_items())
						@foreach ($items as $item)
							<span class="nav-item is-tab"><a href="{{ $item->get_link() }}">{{ $item->get_title() }}</a>
							@if (!empty($item->get_children()))
								<aside class="menu">
									<ul class="menu-list">
										@foreach ($item->get_children() as $child_item)
											<li><a href="{{ $child_item->get_link() }}">{{ $child_item->get_title() }}</a></li>
										@endforeach
									</ul>
								</aside>
							@endif
							</span>
						@endforeach
					@endif
				</div>
			@else
				<div class="nav-center">
					@if ($items = $menu->get_split_items(true))
						@foreach ($items as $index => $item)
							<span class="nav-item is-tab"><a href="{{ $item->get_link() }}">{{ $item->get_title() }}</a>
							@if (!empty($item->get_children()))
								<aside class="menu">
									<ul class="menu-list">
										@foreach ($item->get_children() as $child_item)
											<li><a href="{{ $child_item->get_link() }}">{{ $child_item->get_title() }}</a></li>
										@endforeach
									</ul>
								</aside>
							@endif
							</span>
						@endforeach
					@endif
					<div class="desktop-logo">
						{{ get_custom_logo() }}
					</div>
					<div class="mobile-logo">
						<a href="/">
							<img src="{{ wp_get_attachment_image_src(get_field('fff_mobile_logo', 'option'), 'large')[0] }}">
						</a>
					</div>
					@if ($items = $menu->get_split_items())
						@foreach ($items as $item)
							<span class="nav-item is-tab"><a href="{{ $item->get_link() }}">{{ $item->get_title() }}</a>
							@if (!empty($item->get_children()))
								<aside class="menu">
									<ul class="menu-list">
										@foreach ($item->get_children() as $child_item)
											<li><a href="{{ $child_item->get_link() }}">{{ $child_item->get_title() }}</a></li>
										@endforeach
									</ul>
								</aside>
							@endif
							</span>
						@endforeach
					@endif
				</div>
			@endif
		</div>
	</nav>
</header>
