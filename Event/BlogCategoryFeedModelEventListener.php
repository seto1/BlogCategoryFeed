<?php

class BlogCategoryFeedModelEventListener extends BcModelEventListener {

	public $events = [
		'Blog.BlogPost.beforeFind',
	];

	public function blogBlogPostBeforeFind(CakeEvent $event) {
		$request = Router::getRequest();
		if (empty($request['ext']) || $request['ext'] !== 'rss') {
			return;
		}
		if (empty($request->query['category'])) {
			return;
		}
		$event->data[0]['conditions'][] = [
			'BlogCategory.name' => $request->query['category'],
		];
	}

}
