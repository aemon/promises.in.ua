<?php blocks::open("reports");?>
<?php blocks::title(Kohana::lang('ui_main.reports_listed'));?>
<ul class="ul_big_feed">
		<?php
		if ($incidents->count() == 0)
		{
			?>
			<?php echo Kohana::lang('ui_main.no_reports'); ?>
			<?php
		}
		foreach ($incidents as $incident)
		{
			$incident_id = $incident->id;
			$incident_title = text::limit_chars(html::strip_tags($incident->incident_title), 40, '...', True);
			$incident_date = $incident->incident_date;
			$incident_date = date('M j Y', strtotime($incident->incident_date));
			$incident_location = $incident->location->location_name;
		?>
			<li>
			<span class="gray small"><?php echo $incident_date; ?></span>
			&nbsp;<a href="<?php echo url::site() . 'reports/view/' . $incident_id; ?>"> <?php echo $incident_title ?></a>
			</li>
		<?php
		}
		?>
</ul>
<a class="more" href="<?php echo url::site() . 'reports/' ?>"><?php echo Kohana::lang('ui_main.view_more'); ?></a>
<div style="clear:both;"></div>
<?php blocks::close();?>
