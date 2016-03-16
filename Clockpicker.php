<?php

namespace B2\Forms;

class Clockpicker extends \bors_forms_element
{
	function html()
	{
		$html = [];

		if($label = $this->label())
		{
			$label = preg_replace('!^(.+?) // (.+)$!', "$1<br/><small>$2</small>", $label);

			$html[] = "<tr><th class=\"{$this->form()->templater()->form_table_left_th_css()}\">{$label}</th><td{$td_colspan}>";
		}

		$time = $this->value();

		if($time && !is_numeric($time))
			$time = strtotime($time);

		$hhmm = $time ? date('H:i', $time) : '';

		$html[] = <<< __EOT__
<div class="input-group clockpicker">
    <input type="text" name="{$this->param('name')}" class="form-control" value="{$hhmm}">
    <span class="input-group-addon">
        <span class="glyphicon glyphicon-time"></span>
    </span>
</div>
__EOT__;

		\jquery::on_ready("\$('.clockpicker').clockpicker({'autoclose': true});");

		if($this->form()->templater()->layout_type() == 'bootstrap')
		{
			bors_use(config('bower.path').'/clockpicker/dist/bootstrap-clockpicker.min.js');
			bors_use(config('bower.path').'/clockpicker/dist/bootstrap-clockpicker.min.css');
		}
		else
		{
			bors_use(config('bower.path').'/clockpicker/dist/jquery-clockpicker.min.js');
			bors_use(config('bower.path').'/clockpicker/dist/jquery-clockpicker.min.css');
		}

		return join("\n", $html);
	}
}
