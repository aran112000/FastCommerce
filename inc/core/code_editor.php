<?php
/**
 * Class code_editor
 */
class code_editor extends dependency {

	/**
	 * @var array
	 */
	protected $editable_file_extensions = array(
		'php',
		'css',
		'less',
		'html',
		'js',
	);

	public function do_save() {
		if (ajax) {
			$file = fopen($_REQUEST['file'], 'w') or trigger_error('Unable to open live edit file for writing');
			fwrite($file, $_REQUEST['content']);
			fclose($file);
			$this->di->ajaxify->do_inject_script('console.log(\'Your changes have been saved\')');
		} else {
			trigger_error('This should only ever be called via the live editor');
		}
	}

	/**
	 * @param string $current_dir
	 * @return string
	 */
	public function get_file_browser($current_dir = '') {
		if (ajax && isset($_REQUEST['path'])) {
			$current_dir = $_REQUEST['path'];
		}
		$html = '';
		$path = rtrim(root . str_replace(root, '', $current_dir), '/') . '/';
		if (is_readable($path)) {
			$html .= '<ul class="open file_browser">'."\n";
			foreach (glob($path . '*', GLOB_ONLYDIR) as $dir) {
				$dir_name = str_replace($path, '', $dir);
				$post_data = array('path' => $dir);
				$id = str_replace(array('/', '\\', '.', ':'), '_', $dir);
				$html .= '<li class="dir" id="dir_' . $id . '" data-ajaxify-handler="code_editor:get_file_browser" data-ajaxify-data=\'' . json_encode($post_data) . '\'>' . $dir_name . '</li>'."\n";
			}
			foreach (glob($path . '*.{' . implode(',', $this->editable_file_extensions) . '}', GLOB_BRACE) as $file) {
				$file_info = pathinfo($path . $file);
				$post_data = array('path' => $file, 'extension' => $file_info['extension']);
				$id = str_replace(array('/', '\\', '.', ':'), '_', $file);
				$html .= '<li class="' . $file_info['extension'] . '" id="file_' . $id . '" allow-multiple data-ajaxify-handler="code_editor:get_editor_pane" data-ajaxify-data=\'' . json_encode($post_data) . '\'>' . $file_info['filename'] . '.' . $file_info['extension'] . '</li>'."\n";
			}
			$html .= '</ul>'."\n";
		}

		if (ajax) {
			return $this->di->ajaxify->do_append('ul.open li' . $_REQUEST['origin'] . '.dir', $html);
		} else {
			return $html;
		}
	}

	/**
	 * @param string $language
	 * @param        $file
	 * @return string
	 */
	public function get_editor_pane($language = 'less', $file = '') {
		if (ajax) {
			$language = $_REQUEST['extension'];
			$file = $_REQUEST['path'];
		}
		if ($language == 'js') {
			$language = 'javascript';
		}
		$file = root . str_replace(root, '', $file);
		$editor_contents = '';
		if (is_readable($file)) {
			$editor_contents = htmlentities(file_get_contents($file));
		}

		$html = '<pre id="editor">'."\n";
			$html .= $editor_contents."\n";
		$html .= '</pre>'."\n";
		$html .= '<input type="hidden" id="live_edit_file" name="live_edit_file" value="' . $file . '" />'."\n";

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
editor.commands.addCommand({
    name: \'Save\',
    bindKey: {win: \'Ctrl-S\',  mac: \'Command-S\'},
    exec: function(editor) {
		live_edit_save();
    },
    readOnly: false
});

var live_view_timeout = null;
editor.getSession().on(\'change\', function(e) {
	if (live_view_timeout !== null) {
		clearTimeout(live_view_timeout);
	}
	live_view_timeout = setTimeout(function() {
		live_edit_save();
	}, 5500);
});

function live_edit_save() {
	if (live_view_timeout !== null) {
		clearTimeout(live_view_timeout);
	}

	var data={};
	data.payload = {content:editor.getValue().replace(\'"\', \'\\"\'), file:$(\'input#live_edit_file\').val()};
	data.payload.act = \'code_editor\';
    data.payload.handler = \'do_save\';
	__af.send(data, function() {
		document.getElementById(\'live_edit_preview_iframe\').contentWindow.location.reload();
	});
}';

		if (ajax) {
			return $this->di->ajaxify->do_update('div#editor_pane', $html);
		} else {
			return $html;
		}
	}
}