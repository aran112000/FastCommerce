<?
final class core {

	public function __construct() {
		if (ajax) {

		}
	}

	public function get_html_header() {
		$html = '<!DOCTYPE html>'."\n";
		$html .= '<html>'."\n";
		$html .= '<head>'."\n";
		$html .= "\t".'<link rel="stylesheet" type="text/css" href="/css/style.css" />'."\n";
		$html .= "\t".'<title>Ecommerce</title>'."\n"; // TODO
		$html .= '</head>'."\n";
		$html .= '<body>'."\n";

		return $html;
	}

	public function get_html_content() {
		return ''; // TODO
	}

	public function get_html_footer() {
		$html = '</body>'."\n";
		$html .= '<script src="/js/jquery.min.js"></script>'."\n";
		$html .= '</html>'."\n";

		return $html;
	}

	public function __destruct() {
		db::close();
	}
}