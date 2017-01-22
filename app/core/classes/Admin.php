<?php
/**
 * Theme Admin Class.
 *
 * Manages Admin functions
 *
 * @package Classy
 */

namespace Classy;

/**
 * Class Admin
 */
class Admin {

	/**
	 * Admin constructor.
	 */
	public function __construct() {
        add_action( 'add_meta_boxes',   [$this, 'registerMetaBoxes']);
        add_action( 'wp_ajax_add_table',   [$this, 'addMessageMetaboxAjax']);
        add_action( 'save_post',        [$this, 'saveMeta']);
    }

    /**
     * Register meta box(es).
     */
    public function registerMetaBoxes($post)
    {
		global $post;
		$pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);

        add_meta_box(
            'archive-layout',
            __( 'Archive Layout', 'classy' ),
            [$this, 'renderArchiveLayoutMetaBox'],
            'post',
            'side'
        );
        add_meta_box(
            'title-position',
            __( 'Title Position', 'classy' ),
            [$this, 'renderTitlePostionMetaBox'],
            'post',
            'side'
        );
        add_meta_box(
            'title-overlay',
            __( 'Title Overlay', 'classy' ),
            [$this, 'renderTitleOverlayMetaBox'],
            'post',
            'side'
        );
        add_meta_box(
            'title-position',
            __( 'Title Position', 'classy' ),
            [$this, 'renderTitlePostionMetaBox'],
            'page',
            'side'
        );
        add_meta_box(
            'title-overlay',
            __( 'Title Overlay', 'classy' ),
            [$this, 'renderTitleOverlayMetaBox'],
            'page',
            'side'
        );
		if($pageTemplate == 'classy-about')
		{
	        add_meta_box(
	            'contact-primary',
	            __( 'Contact Primary', 'classy' ),
	            [$this, 'renderContactDetails'],
	            'page',
	            'normal',
				'low',
				['order' => 'primary']
	        );
	        add_meta_box(
	            'contact-secondary',
	            __( 'Contact Secondary', 'classy' ),
	            [$this, 'renderContactDetails'],
	            'page',
	            'normal',
				'low',
				['order' => 'secondary']
	        );
		}
    }

	public function addMessageMetabox($index)
	{
	    add_meta_box(
	        'message-' . $index,
	        __( 'Messages', 'classy' ),
	        [$this, 'renderMessagesMetabox'],
	        'page',
	        'normal',
			'low',
			$index
	    );
	}

	public function addMessageMetaboxAjax()
	{
        $table = '<div id="options-table-metabox-' . $_GET['index'] . '" class="postbox">';
        $table .= '<button type="button" class="handlediv button-link" aria-expanded="false"><span class="screen-reader-text">Toggle panel: Message: Another Message</span><span class="toggle-indicator" aria-hidden="true"></span></button>';
        $table .= '<h2 class="hndle ui-sortable-handle"><span>New Message</span></h2>';
        $table .= '<div class="inside">';
        $table .= $this->renderMessagesMetabox(null, null, true);
        $table .= '</div>';
        $table .= '</div>';
        wp_send_json_success($table);
        exit();
	}

    /**
     * Render meta box fields
     */
    public function renderTitlePostionMetaBox()
    {
        global $post;
        $value = get_post_meta($post->ID, '_title_position', true);
        if($value)
            $currentValue = $value;
        ?>
        <fieldset>
			<legend class="screen-reader-text">Post Formats</legend>
			<input <?= $value == 'left' ? 'checked' : ''; ?> type="radio" name="_title_position" class="post-format" id="title-position-left" value="left">
            <label for="title-position-left" class="post-format-standard">Left</label>
			<br>
			<input <?= $value == 'center' ? 'checked' : ''; ?> type="radio" name="_title_position" class="post-format" id="title-position-center" value="center">
            <label for="title-position-center" class="post-format-standard">Center</label>
			<br>
			<input <?= $value == 'right' ? 'checked' : ''; ?> type="radio" name="_title_position" class="post-format" id="title-position-right" value="right">
            <label for="title-position-right" class="post-format-standard">Right</label>
		</fieldset>
        <?php
    }

    /**
     * Render meta box fields
     */
    public function renderArchiveLayoutMetaBox()
    {
        global $post;
        $value = get_post_meta($post->ID, '_archive_layout', true);
        if($value)
            $currentValue = $value;
        ?>
        <fieldset>
			<legend class="screen-reader-text">Post Formats</legend>
			<input <?= $value == 'wide' ? 'checked' : ''; ?> type="radio" name="_archive_layout" class="post-format" id="archive-layout-wide" value="wide">
            <label for="archive-layout-wide" class="post-format-standard">Wide</label>
			<br>
			<input <?= $value == 'standard' ? 'checked' : ''; ?> type="radio" name="_archive_layout" class="post-format" id="archive-layout-standard" value="standard">
            <label for="archive-layout-standard" class="post-format-standard">Standard</label>
		</fieldset>
        <?php
    }

    /**
     * Render meta box fields
     */
    public function renderTitleOverlayMetaBox()
    {
        global $post;
        $value = get_post_meta($post->ID, '_title_overlay', true);
        if($value)
            $currentValue = $value;

        ?>
        <fieldset>
			<legend class="screen-reader-text">Title Overlay</legend>
			<input <?= $value == 1 ? 'checked' : ''; ?> type="radio" name="_title_overlay" class="post-format" id="title-overlay-true" value="1">
            <label for="title-overlay-true" class="post-format-standard">True</label>
			<br>
			<input <?= $value == 0 ? 'checked' : ''; ?> type="radio" name="_title_overlay" class="post-format" id="title-overlay-false" value="0">
            <label for="title-overlay-false" class="post-format-standard">False</label>
		</fieldset>
        <?php
    }

	public function renderContactDetails($post, $meta)
	{
		$order = $meta['args']['order'];
		$existing = get_post_meta($post->ID, '_contact', true);
		if(isset($existing))
			$existing = $existing[$order];
		?>
		<label>Message</label>
		<br>
		<input type="text" name="_contact[<?= $order ?>][message]" value="<?= $existing['message']; ?>">
		<br>

		<label>Email</label>
		<br>
		<input type="text" name="_contact[<?= $order ?>][email]" value="<?= $existing['email']; ?>">
		<br>

		<label>Facebook</label>
		<br>
		<input type="text" name="_contact[<?= $order ?>][facebook]" value="<?= $existing['facebook']; ?>">
		<br>

		<label>Instagram</label>
		<br>
		<input type="text" name="_contact[<?= $order ?>][instagram]" value="<?= $existing['instagram']; ?>">
		<br>

		<label>Twitter</label>
		<br>
		<input type="text" name="_contact[<?= $order ?>][twitter]" value="<?= $existing['twitter']; ?>">
		<br>

		<label>Pinterest</label>
		<br>
		<input type="text" name="_contact[<?= $order ?>][pinterest]" value="<?= $existing['pinterest']; ?>">

		<?php
	}

	public function renderMessagesMetabox($args, $additional, $ajax = false)
	{
		global $post;
		$index = $additional['args'];
		if(! $index)
			$index = $_GET['index'];

		$optionsTable = new OptionsTable;
		$tableSchema = $optionsTable->heroTable($index);

		$html = '';
		$html .= $optionsTable->getTable($tableSchema);
		if($ajax)
			return $html;
		echo $html;
	}

    public function messageMetaBoxFooter()
    {
        ?>
        <div class="remove-action">
            <h2>Add Filtered Search</h2>
        </div>

        <div class="add-action">
            <a href="" id="add_table" class="button button-large">Add</a>
        </div>
        <div class="clear"></div>
        <?php
    }


    /**
     * Save meta box content.
     *
     * @param int $post_id Post ID
     */
    function saveMeta( $post_id ) {
		$metaboxes = [
			'_title_position',
			'_archive_layout',
			'_title_overlay',
			'_contact',
			'_messages'
		];

		$postVars = $_POST;
		array_map(function($metabox) use ($post_id, $postVars) {
	        if(isset($postVars[$metabox]))
	            update_post_meta($post_id, $metabox, $postVars[$metabox]);
		}, $metaboxes);
    }
}
