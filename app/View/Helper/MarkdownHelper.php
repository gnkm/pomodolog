<?php

App::uses('Markdown', 'Vendor/php-markdown/Michelf');

class MarkdownHelper extends AppHelper {
	public function parse($text){
		return Markdown::defaultTransform($text);
	}
}