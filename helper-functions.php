<?php
/**
 * Helper functions
 *
 * @link       https://afterword.com.au
 * @since      1.0.0
 * @package    after-loader
 * @author     Andrew Hateley-Browne <andrew@afterword.com.au>
 */
namespace Afterword;

/**
 * Makes Custom Post Labels.
 *
 * @since	1.0.0
 * @access  public
 * @param   string      $text_domain        The text-domain of the theme or plugin.
 * @param   string      $slug               The slug of the Custom Post Type.
 * @param   string      $label              The single label for the Custom Post Type.
 * @param   string      $label_plural             The plural label for the Custom Post Type, if different to the single label.
 * @param   string      $image              The name of the Featured Image, if different to 'featured image'.
 * @return	$labels		The CPT Labels.
 */
function cpt_labels( string $text_domain, string $slug, string $label, string $label_plural = null, string $image = null ) {

	$image = strtolower( $image ) ?: 'featured image';

	return $labels = [
		'name'                     => __( $label_plural ?: $label . 's' . 's', $text_domain ),
		'singular_name'            => __( $label, $text_domain ),
		'add_new'                  => __( 'Add New', $text_domain ),
		'add_new_item'             => __( 'Add New ' . $label, $text_domain ),
		'edit_item'                => __( 'Edit ' . $label, $text_domain ),
		'new_item'                 => __( 'New ' . $label, $text_domain ),
		'view_item'                => __( 'View ' . $label, $text_domain ),
		'view_items'               => __( 'View ' . $label_plural ?: $label . 's' . 's', $text_domain ),
		'search_items'             => __( 'Search ' . $label_plural ?: $label . 's' . 's', $text_domain ),
		'not_found'                => __( 'No ' . $label_plural ?: $label . 's' . 's' . ' found.', $text_domain ),
		'not_found_in_trash'       => __( 'No ' . $label_plural ?: $label . 's' . 's' . ' found in Trash.', $text_domain ),
		'parent_item_colon'        => __( 'Parent ' . $label_plural ?: $label . 's' . 's' . ':', $text_domain ),
		'all_items'                => __( 'All ' . $label_plural ?: $label . 's' . '', $text_domain ),
		'archives'                 => __( $label . ' Archives', $text_domain ),
		'attributes'               => __( $label . ' Attributes', $text_domain ),
		'insert_into_item'         => __( 'Insert into ' . $label, $text_domain ),
		'uploaded_to_this_item'    => __( 'Uploaded to this ' . $label, $text_domain ),
		'featured_image'           => __( ucwords( $image ), $text_domain ),
		'set_featured_image'       => __( 'Set ' . $image, $text_domain ),
		'remove_featured_image'    => __( 'Remove ' . $image, $text_domain ),
		'use_featured_image'       => __( 'Use as ' . $image, $text_domain ),
		'menu_name'                => __( $label_plural ?: $label . 's', $text_domain ),
		'filter_items_list'        => __( 'Filter ' . $label . ' list', $text_domain ),
		'filter_by_date'           => __( 'Filter by date', $text_domain ),
		'items_list_navigation'    => __( $label_plural ?: $label . 's' . ' list navigation', $text_domain ),
		'items_list'               => __( $label_plural ?: $label . 's' . ' list', $text_domain ),
		'item_published'           => __( $label . ' published.', $text_domain ),
		'item_published_privately' => __( $label . ' published privately.', $text_domain ),
		'item_reverted_to_draft'   => __( $label . ' reverted to draft.', $text_domain ),
		'item_scheduled'           => __( $label . ' scheduled.', $text_domain ),
		'item_updated'             => __( $label . ' updated.', $text_domain ),
		'item_link'                => __( $label . ' Link', $text_domain ),
		'item_link_description'    => __( 'A link to an ' . strtolower( $label ), $text_domain )
	];
}