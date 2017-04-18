<?php

namespace B2\Forms;

class Clockpicker extends \bors_forms_element
{
	function html()
	{
		$form = $this->form();

		\B2\jQuery::load();

		$html = [];


		$time = $this->value();

		if($time && !is_numeric($time))
			$time = strtotime($time);

		$hhmm = $time ? date('H:i', $time) : '';

		$html[] = <<< __EOT__
<div class="input-group clockpicker" style="width: 15ex">
    <input type="text" name="{$this->param('name')}" class="form-control" value="{$hhmm}">
    <span class="input-group-addon">
        <span class="glyphicon glyphicon-time"></span>
    </span>
</div>
__EOT__;

		\jquery::on_ready("\$('.clockpicker').clockpicker({'autoclose': true});");

		$bower_path = \B2\Cfg::get('bower.path', '/bower-asset');

		if($this->form()->templater()->layout_type() == 'bootstrap')
		{
			bors_use($bower_path.'/clockpicker/dist/bootstrap-clockpicker.min.js');
			bors_use($bower_path.'/clockpicker/dist/bootstrap-clockpicker.min.css');
		}
		else
		{
			bors_use($bower_path.'/clockpicker/dist/jquery-clockpicker.min.js');
			bors_use($bower_path.'/clockpicker/dist/jquery-clockpicker.min.css');
		}

		$html = join("\n", $html);

		if(defval($params, 'raw') || !$this->label())
			return $html;

		return $this->row_html($html);
	}
}
