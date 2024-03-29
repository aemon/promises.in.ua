<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Front-End Nav helper class.
 *
 * @package    Nav
 * @author     Ushahidi Team
 * @copyright  (c) 2008 Ushahidi Team
 * @license    http://www.ushahidi.com/license.html
 */
class nav_Core {
	
	/**
	 * Generate Main Tabs
     * @param string $this_page
     * @param array $dontshow
	 * @return string $menu
     */
	public static function main_tabs($this_page = FALSE, $dontshow = FALSE)
	{
		$menu = "";
		
		if( ! is_array($dontshow))
		{
			// Set $dontshow as an array to prevent errors
			$dontshow = array();
		}
		
		// Home
		if( ! in_array('home',$dontshow))
		{
			$menu .= "<li><a href=\"".url::site()."main\" ";
			$menu .= ($this_page == 'home') ? " class=\"active\"" : "";
		 	$menu .= ">".Kohana::lang('ui_main.home')."</a></li>";
		 }

		// Reports List
		if( ! in_array('reports',$dontshow))
		{
			$menu .= "<li><a href=\"".url::site()."reports\" ";
			$menu .= ($this_page == 'reports') ? " class=\"active\"" : "";
		 	$menu .= ">".Kohana::lang('ui_main.reports')."</a></li>";
		 }
		
		// Reports Submit
		if( ! in_array('reports_submit',$dontshow))
		{
			if (Kohana::config('settings.allow_reports'))
			{
				$menu .= "<li><a href=\"".url::site()."reports/submit\" ";
				$menu .= ($this_page == 'reports_submit') ? " class=\"active\"":"";
			 	$menu .= ">".Kohana::lang('ui_main.submit')."</a></li>";
			}
		}
		
		// Alerts
		if(! in_array('alerts',$dontshow))
		{
			if(Kohana::config('settings.allow_alerts'))
			{
				$menu .= "<li><a href=\"".url::site()."alerts\" ";
				$menu .= ($this_page == 'alerts') ? " class=\"active\"" : "";
				$menu .= ">".Kohana::lang('ui_main.alerts')."</a></li>";
			}
		}
		
		// Contacts
		if( ! in_array('contact',$dontshow))
		{
			if (Kohana::config('settings.site_contact_page') AND Kohana::config('settings.site_email') != "")
			{
				$menu .= "<li><a href=\"".url::site()."contact\" ";
				$menu .= ($this_page == 'contact') ? " class=\"active\"" : "";
			 	$menu .= ">".Kohana::lang('ui_main.contact')."</a></li>";	
			}
		}
		
		// Custom Pages
		
		if( ! in_array('pages',$dontshow))
		{
			$pages = ORM::factory('page')->where('page_active', '1')->find_all();
			foreach ($pages as $page)
			{
				if( ! in_array('page/'.$page->id,$dontshow))
				{
					$menu .= "<li><a href=\"".url::site()."page/index/".$page->id."\" ";
					$menu .= ($this_page == 'page_'.$page->id) ? " class=\"active\"" : "";
					$menu .= ">".$page->page_tab."</a></li>";
				}
			}
		}

		echo $menu;
		
		// Action::nav_admin_reports - Add items to the admin reports navigation tabs
		Event::run('ushahidi_action.nav_main_top', $this_page);
	}
	

        public static function add_tabs($this_page = FALSE, $dontshow = FALSE)
        {
                $menu = "";

                if( ! is_array($dontshow))
                {
                        // Set $dontshow as an array to prevent errors
                        $dontshow = array();
                }

                // Reports Overdue
                if( ! in_array('reports',$dontshow))
                {
                        $menu .= "<li><a href=\"".url::site()."reports\?c=6\" ";
                        $menu .= ($_SERVER['REQUEST_URI'] == '/reports\\/?с=6') ? " class=\"active\"" : "";
                        $menu .= ">".Kohana::lang('ui_main.reports_overdue')."</a></li>";
                 }

              // Reports Pending
                if( ! in_array('reports',$dontshow))
                {
                        $menu .= "<li><a href=\"".url::site()."reports/?c=7\" ";
                        $menu .= ($_SERVER['REQUEST_URI'] == '/reports/?c=7') ? " class=\"active\"" : "";
                        $menu .= ">".Kohana::lang('ui_main.reports_pending')."</a></li>";
                 }

              // Reports Done
                if( ! in_array('reports',$dontshow))
                {
                        $menu .= "<li><a href=\"".url::site()."reports\\?c=8\" ";
                        $menu .= ($_SERVER['REQUEST_URI'] == '/reports/?c=8') ? " class=\"active\"" : "";
                        $menu .= ">".Kohana::lang('ui_main.reports_done')."</a></li>";
                 }

                echo $menu;

                // Action::nav_admin_reports - Add items to the admin reports navigation tabs
                Event::run('ushahidi_action.nav_main_top', $this_page);
	}



	
}
