<?php
/**
 * Edit question page
 *
 * @package ElggQuestions
 */

elgg_gatekeeper();

$question_guid = (int) elgg_extract('guid', $vars);

elgg_entity_gatekeeper($question_guid, 'object', 'question');
$question = get_entity($question_guid);

if (!$question->canEdit()) {
	register_error(elgg_echo('actionunauthorized'));
	forward(REFERRER);
}

elgg_push_breadcrumb($question->getDisplayName(), $question->getURL());
elgg_push_breadcrumb(elgg_echo('edit'));

$form_vars = [];
if (questions_limited_to_groups()) {
	$form_vars['class'] = 'questions-validate-container';
}

$body_vars = questions_prepare_question_form_vars($question);

$content = elgg_view_form('object/question/save', $form_vars, $body_vars);

$body = elgg_view_layout('content', [
	'title' => elgg_echo('edit'),
	'content' => $content,
	'filter' => '',
]);

echo elgg_view_page(elgg_echo('edit'), $body);
