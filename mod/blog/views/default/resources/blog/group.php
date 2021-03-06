<?php

$group_guid = elgg_extract('guid', $vars, elgg_extract('group_guid', $vars)); // group_guid for BC
$lower = elgg_extract('lower', $vars);
$upper = elgg_extract('upper', $vars);

elgg_entity_gatekeeper($group_guid, 'group');
$group = get_entity($group_guid);

elgg_register_title_button('blog', 'add', 'object', 'blog');

elgg_push_collection_breadcrumbs('object', 'blog', $group);

$title = elgg_echo('collection:object:blog:group');
if ($lower) {
	$title .= ': ' . elgg_echo('date:month:' . date('m', $lower), [date('Y', $lower)]);
}

$content = elgg_view('blog/listing/group', [
	'entity' => $group,
	'lower' => $lower,
	'upper' => $upper,
]);

$layout = elgg_view_layout('default', [
	'title' => $title,
	'content' => $content,
	'sidebar' => elgg_view('blog/sidebar', [
		'page' => 'group',
		'entity' => $group,
	]),
	'filter_id' => 'blog/group',
	'filter_value' => 'all',
]);

echo elgg_view_page($title, $layout);
