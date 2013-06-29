<?
/**
 * Class code_editor
 */
class code_editor extends dependency {

	/**
	 * @param string $language
	 * @param        $file
	 * @return string
	 */
	public function get_editor_pane($language = 'less', $file) {
		$file = root . str_replace(root, '', $file);
		$editor_contents = '';
		if (is_readable($file)) {
			$editor_contents = file_get_contents($file);
		}
		$html = '<pre id="editor">'."\n";
			$html .= $editor_contents."\n";
		$html .= '</pre>'."\n";

		$this->di->core->footer_js_files[] = '/inc/lib/ace/ace.js';
		$this->di->core->inline_js[] = 'var editor = ace.edit(\'editor\');
editor.setTheme(\'ace/theme/merbivore\');
editor.getSession().setMode(\'ace/mode/' . $language . '\');
editor.commands.addCommand({
    name: \'Find\',
    bindKey: {win: \'Ctrl-F\',  mac: \'Command-F\'},
    exec: function(editor) {
        var search = prompt("What are you searching for?");
        if (search != null) {
        	editor.findAll(search);
		}
    },
    readOnly: true
});
editor.commands.addCommand({
    name: \'Go to line\',
    bindKey: {win: \'Ctrl-G\',  mac: \'Command-G\'},
    exec: function(editor) {
        var line_number = prompt("Please enter the line number you want to jump to");
        if (line_number != null && parseInt(line_number, 10) > 0) {
        	editor.gotoLine(parseInt(line_number, 10));
		}
    },
    readOnly: true
});
editor.commands.addCommand({
    name: \'Duplicate Line\',
    bindKey: {win: \'Ctrl-D\',  mac: \'Command-D\'},
    exec: function(editor) {
		editor.copyLinesDown();
    },
    readOnly: true
});
editor.commands.addCommand({
    name: \'Duplicate Line\',
    bindKey: {win: \'Ctrl-Shift-/\',  mac: \'Command-Shift-/\'},
    exec: function(editor) {
		editor.toggleCommentLines();
    },
    readOnly: true
});

var live_view_timeout = null;
editor.getSession().on(\'change\', function(e) {
	if (live_view_timeout !== null) {
		clearTimeout(live_view_timeout);
	}
	live_view_timeout = setTimeout(function() {
		console.error(\'Updating preview using : \' + editor.getValue());
	}, 3500);
});
$(\'#live_edit_splitter\')
	.splitter()
	.css(\'width\', $(window).width + \'px\');

$(\'#live_edit_splitter, #editor_pane, .ace_editor, .vsplitbar, #website_pane\').css({
	height: $(window).height() + 15 + \'px\',
	\'overflow-y\': \'auto\',
	\'overflow-x\': \'hidden\',
});';

		return $html;
	}
}