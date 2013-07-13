<?php
/**
 * Class seo
 *
 * Called by default at the end of the core_module controller - Responsible for the following:
 * Title Tags, Meta Descriptions, Meta Keywords (disabled by default), Robots : follow/nofollow.. & Social tags (Facebook OG & Tweet Cards)
 */
class seo extends dependency {

	/**
	 * @param $path_parts
	 * @param $path_count
	 */
	public function __controller(array $path_parts, $path_count) {
		$this->set_page_title();
		$this->set_meta_description();
		$this->set_meta_keywords();
		$this->set_robots();
		$this->set_social_tags();
	}

	/**
	 *
	 */
	public function set_page_title() {
		if (isset($this->current->title) && !empty($this->current->title)) {
			$page_title = $this->current->title;
		}
		$page_title = (isset($page_title) ? $page_title . ' | ' . $this->di->get->setting('site_name') : $this->di->get->setting('site_name'));
		$this->di->core->page['title_tag'] = $page_title;
	}

	/**
	 *
	 */
	public function set_meta_description() {
		$page_description = '';
		if (isset($this->current->body) && !empty($this->current->body)) {
			// Split into the first 2 sentences at a maximum
			$page_description = $this->current->body;
			$description_sentences = explode('. ', $page_description, 3);
			$page_description = trim((isset($description_sentences[0]) ? $description_sentences[0] . '. ' . (isset($description_sentences[1]) ? $description_sentences[1] : '') : ''));
		}
		$this->di->core->page['meta_description'] = trim(strip_tags($page_description));
	}

	/**
	 *
	 */
	public function set_meta_keywords() {
		if (isset($this->current->meta_keywords) && !empty($this->current->meta_keywords)) {
			$this->di->core->page['meta_keywords'] = trim(strip_tags($this->current->meta_keywords));
		}
	}

	/**
	 *
	 */
	public function set_robots() {
		$this->di->core->page['robots'] = 'index,follow';
	}

	/**
	 *
	 */
	public function set_social_tags() {
		$this->di->core->page['social_meta_tags'] = array();
		$this->set_social_tag_facebook();
		$this->set_social_tag_twitter();
	}

	/**
	 *
	 */
	public function set_social_tag_facebook() {
		$this->di->core->page['social_meta_tags'][] = '<meta property="og:site_name" content="' . $this->di->get->setting('site_name') . '" />';
		$this->di->core->page['social_meta_tags'][] = '<meta property="og:title" content="' . $this->di->core->page['title_tag'] . '" />';
		$this->di->core->page['social_meta_tags'][] = '<meta property="og:type" content="website" />';
		$this->di->core->page['social_meta_tags'][] = '<meta property="og:url" content="http://' . host . uri . '" />';
		$this->di->core->page['social_meta_tags'][] = '<meta property="og:description" content="' . $this->di->core->page['meta_description'] . '" />';
		//$this->di->core->page['social_meta_tags'][] = '<meta property="og:image" content="http://cdn.soraiseyourglasses.com/sryg/uploads/prod_img/2_1764_t_v1.jpg" />';
	}

	/**
	 *
	 */
	public function set_social_tag_twitter() {
		$this->di->core->page['social_meta_tags'][] = '<meta name="twitter:card" content="summary" />';
		$this->di->core->page['social_meta_tags'][] = '<meta name="twitter:url" content="http://' . host . uri . '" />';
		$this->di->core->page['social_meta_tags'][] = '<meta name="twitter:title" content="' . $this->di->core->page['title_tag'] . '" />';
		$this->di->core->page['social_meta_tags'][] = '<meta name="twitter:description" content="' . $this->di->core->page['meta_description'] . '" />';
		//$this->di->core->page['social_meta_tags'][] = '<meta name="twitter:image" content="http://cdn.soraiseyourglasses.com/sryg/uploads/prod_img/2_1764_t_v1.jpg" />';
	}
}