(function( $ ) {
	function setupTables() {
		var i = 0;
		$('table.options-table').each(function(index) {
			$(this).attr('id', 'table-' + i);
			addRemoveButton('table-' + i);
			addMediaSelectors('table-' + i);
			i++;
		});
	}

	function addRemoveButton(id) {
		table = $('#' + id)
		var removeButton = '<tr><th class="fields-label"><div><a id="table-' + id + '" data-table-id="' + id + '" href="javascript:void(0)" class="remove-table button button-primary">Remove</a></div></th><th class="top-row"><div></div></th></tr>';
		table.find('tbody').append(removeButton);

		$('.remove-table').click(function() {
			$(this).parents('div.postbox').remove();
		});
	}

	function addMediaSelectors(id) {
		addMediaSelector($('#' + id));
	}

	function addMediaSelector(table) {
		var rows = table.find('.image-file-input');
		rows.each(function(index) {
			var frame,
				addImgLink = $(this).find('.upload-custom-img'),
				imgContainer = $(this).find('.custom-img-container'),
				imgIdInput = $(this).find('.custom-img-id');

			addImgLink.on( 'click', function( event ){
				event.preventDefault();

				if ( frame ) {
					frame.open();
					return;
				}

				frame = wp.media({
					title: 'Choose an image',
					button: {
						text: 'Use this media'
					},
					multiple: false
				});

				frame.on( 'select', function() {
					var attachment = frame.state().get('selection').first().toJSON();
					imgContainer.find('img').remove();
					imgContainer.append( '<img src="' + attachment.url + '" alt="" style="max-width: 150px;"/>' );
					imgIdInput.val( attachment.id );
				});

				frame.open();
			});
		});

	}

	function ajaxGetTable() {
		var tableCount = $('.options-table').length;
		$.ajax({
			url: ajaxurl,
			data: {
				action: 'add_table',
				index: tableCount,
			},
			success: renderAddedTable,
		});
	}

	function renderAddedTable(response) {
        console.log(response);
		$(response.data).insertBefore('#message-metabox-footer');
		tinymce.init(tinyMCEPreInit.mceInit.content);
		var textarea = $('table.options-table').last().find('textarea');
		var id = textarea.attr('id');
		tinymce.execCommand( 'mceAddEditor', true, id);
		quicktags({id: id });
		var tableCount = $('.options-table').length;
		var tableId = tableCount - 1;
		$('table.options-table').last().attr('id', 'table-' + tableId );
		addMediaSelectors('table-' + tableId);
		addRemoveButton('table-' + tableId);
	}

	setupTables();
    $(document).on('click', '#add_table', function(event) {
		event.preventDefault();
		ajaxGetTable();
	});
})( jQuery );
