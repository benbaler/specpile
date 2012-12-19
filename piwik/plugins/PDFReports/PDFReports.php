<?php
/**
 * Piwik - Open source web analytics
 * 
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @version $Id: PDFReports.php 6956 2012-09-10 01:53:28Z matt $
 * 
 * @category Piwik_Plugins
 * @package Piwik_PDFReports
 */

/**
 *
 * @package Piwik_PDFReports
 */
class Piwik_PDFReports extends Piwik_Plugin
{
	const DISPLAY_FORMAT_GRAPHS_ONLY_FOR_KEY_METRICS = 1; // Display Tables Only (Graphs only for key metrics)
	const DISPLAY_FORMAT_GRAPHS_ONLY = 2; // Display Graphs Only for all reports
	const DISPLAY_FORMAT_TABLES_AND_GRAPHS = 3; // Display Tables and Graphs for all reports
	const DISPLAY_FORMAT_TABLES_ONLY = 4; // Display only tables for all reports
	const DEFAULT_DISPLAY_FORMAT = self::DISPLAY_FORMAT_GRAPHS_ONLY_FOR_KEY_METRICS;

	const DEFAULT_REPORT_FORMAT = Piwik_ReportRenderer::HTML_FORMAT;
	const DEFAULT_PERIOD = 'week';

	const EMAIL_ME_PARAMETER = 'emailMe';
	const EVOLUTION_GRAPH_PARAMETER = 'evolutionGraph';
	const ADDITIONAL_EMAILS_PARAMETER = 'additionalEmails';
	const DISPLAY_FORMAT_PARAMETER = 'displayFormat';
	const EMAIL_ME_PARAMETER_DEFAULT_VALUE = true;
	const EVOLUTION_GRAPH_PARAMETER_DEFAULT_VALUE = false;

	const EMAIL_TYPE = 'email';

	static private $availableParameters = array(
		self::EMAIL_ME_PARAMETER => false,
		self::EVOLUTION_GRAPH_PARAMETER => false,
		self::ADDITIONAL_EMAILS_PARAMETER => false,
		self::DISPLAY_FORMAT_PARAMETER => true,
	);

	static private $managedReportTypes = array(
		self::EMAIL_TYPE => 'themes/default/images/email.png'
	);

	static private $managedReportFormats = array(
		Piwik_ReportRenderer::HTML_FORMAT => 'themes/default/images/html_icon.png',
		Piwik_ReportRenderer::PDF_FORMAT => 'plugins/UserSettings/images/plugins/pdf.gif'
	);

	public function getInformation()
	{
		return array(
			'name' => 'Email Reports Plugin',
			'description' => Piwik_Translate('PDFReports_PluginDescriptionReports'),
			'author' => 'Piwik',
			'author_homepage' => 'http://piwik.org/',
			'version' => Piwik_Version::VERSION,
		);
	}
	public function getListHooksRegistered()
	{
		return array( 
				'TopMenu.add' => 'addTopMenu',
				'TaskScheduler.getScheduledTasks' => 'getScheduledTasks',
				'AssetManager.getJsFiles' => 'getJsFiles',
				'PDFReports.getReportParameters' => 'getReportParameters',
				'PDFReports.validateReportParameters' => 'validateReportParameters',
				'PDFReports.getReportMetadata' => 'getReportMetadata',
				'PDFReports.getReportTypes' => 'getReportTypes',
				'PDFReports.getReportFormats' => 'getReportFormats',
				'PDFReports.getRendererInstance' => 'getRendererInstance',
				'PDFReports.getReportRecipients' => 'getReportRecipients',
				'PDFReports.processReports' => 'processReports',
				'PDFReports.allowMultipleReports' => 'allowMultipleReports',
				'PDFReports.sendReport' => 'sendReport',
				'template_reportParametersPDFReports' => 'template_reportParametersPDFReports',
				'UsersManager.deleteUser' => 'deleteUserReport',
				'SitesManager.deleteSite' => 'deleteSiteReport',
		);
	}

	/**
	 * Delete reports for the website
	 *
	 * @param Piwik_Event_Notification $notification notification object
	 */
	function deleteSiteReport( $notification )
	{
		$idSite = &$notification->getNotificationObject();

		$idReports = Piwik_PDFReports_API::getInstance()->getReports($idSite);
		
		foreach($idReports as $report)
		{
			$idReport = $report['idreport'];
			Piwik_PDFReports_API::getInstance()->deleteReport($idReport);
		}
	}

	/**
	 * @param Piwik_Event_Notification $notification notification object
	 */
	function getJsFiles( $notification )
	{
		$jsFiles = &$notification->getNotificationObject();
		$jsFiles[] = "plugins/PDFReports/templates/pdf.js";
	}

	/**
	 * @param Piwik_Event_Notification $notification notification object
	 */
	function validateReportParameters( $notification )
	{
		if(self::manageEvent($notification))
		{
			$parameters = &$notification->getNotificationObject();

			$reportFormat = $parameters[self::DISPLAY_FORMAT_PARAMETER];
			$availableDisplayFormats = array_keys(self::getDisplayFormats());
			if(!in_array($reportFormat, $availableDisplayFormats))
			{
				throw new Exception(
					Piwik_TranslateException(
						// General_ExceptionInvalidAggregateReportsFormat should be named General_ExceptionInvalidDisplayFormat
						'General_ExceptionInvalidAggregateReportsFormat',
						array($reportFormat, implode(', ', $availableDisplayFormats))
					)
				);
			}

			// emailMe is an optional parameter
			if(!isset($parameters[self::EMAIL_ME_PARAMETER]))
			{
				$parameters[self::EMAIL_ME_PARAMETER] = self::EMAIL_ME_PARAMETER_DEFAULT_VALUE;
			}
			else
			{
				$parameters[self::EMAIL_ME_PARAMETER] = self::valueIsTrue($parameters[self::EMAIL_ME_PARAMETER]);
			}

			// evolutionGraph is an optional parameter
			if(!isset($parameters[self::EVOLUTION_GRAPH_PARAMETER]))
			{
				$parameters[self::EVOLUTION_GRAPH_PARAMETER] = self::EVOLUTION_GRAPH_PARAMETER_DEFAULT_VALUE;
			}
			else
			{
				$parameters[self::EVOLUTION_GRAPH_PARAMETER] = self::valueIsTrue($parameters[self::EVOLUTION_GRAPH_PARAMETER]);
			}

			// additionalEmails is an optional parameter
			if(isset($parameters[self::ADDITIONAL_EMAILS_PARAMETER]))
			{
				$parameters[self::ADDITIONAL_EMAILS_PARAMETER] = self::checkAdditionalEmails($parameters[self::ADDITIONAL_EMAILS_PARAMETER]);
			}
		}
	}

	// based on http://www.php.net/manual/en/filter.filters.validate.php -> FILTER_VALIDATE_BOOLEAN
	static private function valueIsTrue($value)
	{
		return $value == 'true' || $value == 1 || $value == '1' || $value === true;
	}

	/**
	 * @param Piwik_Event_Notification $notification notification object
	 */
	function getReportMetadata( $notification )
	{
		if(self::manageEvent($notification))
		{
			$reportMetadata = &$notification->getNotificationObject();

			$notificationInfo = $notification->getNotificationInfo();
			$idSite = $notificationInfo[Piwik_PDFReports_API::ID_SITE_INFO_KEY];

			$availableReportMetadata = Piwik_API_API::getInstance()->getReportMetadata($idSite);

			$filteredReportMetadata = array();
			foreach($availableReportMetadata as $reportMetadata)
			{
				// removing reports from the API category and MultiSites.getOne
				if(
					$reportMetadata['category'] == 'API' ||
					$reportMetadata['category'] == Piwik_Translate('General_MultiSitesSummary') && $reportMetadata['name'] == Piwik_Translate('General_SingleWebsitesDashboard')
				) continue;

				$filteredReportMetadata[] = $reportMetadata;
			}

			$reportMetadata = $filteredReportMetadata;
		}
	}

	/**
	 * @param Piwik_Event_Notification $notification notification object
	 */
	function getReportTypes( $notification )
	{
		$reportTypes = &$notification->getNotificationObject();
		$reportTypes = array_merge($reportTypes, self::$managedReportTypes);
	}

	/**
	 * @param Piwik_Event_Notification $notification notification object
	 */
	function getReportFormats( $notification )
	{
		if(self::manageEvent($notification))
		{
			$reportFormats = &$notification->getNotificationObject();
			$reportFormats = self::$managedReportFormats;
		}
	}

	/**
	 * @param Piwik_Event_Notification $notification notification object
	 */
	function getReportParameters( $notification )
	{
		if(self::manageEvent($notification))
		{
			$availableParameters = &$notification->getNotificationObject();
			$availableParameters = self::$availableParameters;
		}
	}

	/**
	 * @param Piwik_Event_Notification $notification notification object
	 */
	function processReports( $notification )
	{
		if(self::manageEvent($notification))
		{
			$processedReports = &$notification->getNotificationObject();

			$notificationInfo = $notification->getNotificationInfo();
			$report = $notificationInfo[Piwik_PDFReports_API::REPORT_KEY];

			$displayFormat = $report['parameters'][self::DISPLAY_FORMAT_PARAMETER];
			$evolutionGraph = $report['parameters'][self::EVOLUTION_GRAPH_PARAMETER];

			foreach ($processedReports as &$processedReport)
			{
				$metadata = $processedReport['metadata'];

				$isAggregateReport = !empty($metadata['dimension']);

				$processedReport['displayTable'] = $displayFormat != self::DISPLAY_FORMAT_GRAPHS_ONLY;

				$processedReport['displayGraph'] =
					($isAggregateReport ?
						$displayFormat == self::DISPLAY_FORMAT_GRAPHS_ONLY || $displayFormat == self::DISPLAY_FORMAT_TABLES_AND_GRAPHS
							:
						$displayFormat != self::DISPLAY_FORMAT_TABLES_ONLY)
					&& Piwik::isGdExtensionEnabled()
					&& Piwik_PluginsManager::getInstance()->isPluginActivated('ImageGraph')
					&& !empty($metadata['imageGraphUrl']);

				$processedReport['evolutionGraph'] = $evolutionGraph;

				// remove evolution metrics from MultiSites.getAll
				if($metadata['module'] == 'MultiSites')
				{
					$columns = $processedReport['columns'];

					foreach(Piwik_MultiSites_API::getApiMetrics($enhanced = true) as $metricSettings)
					{
						unset($columns[$metricSettings[Piwik_MultiSites_API::METRIC_EVOLUTION_COL_NAME_KEY]]);
					}

					$processedReport['metadata'] = $metadata;
					$processedReport['columns'] = $columns;
				}
			}
		}
	}

	/**
	 * @param Piwik_Event_Notification $notification notification object
	 */
	function getRendererInstance( $notification )
	{
		if(self::manageEvent($notification))
		{
			$reportRenderer = &$notification->getNotificationObject();
			$notificationInfo = $notification->getNotificationInfo();

			$reportFormat = $notificationInfo[Piwik_PDFReports_API::REPORT_KEY]['format'];
			$outputType = $notificationInfo[Piwik_PDFReports_API::OUTPUT_TYPE_INFO_KEY];

			$reportRenderer = Piwik_ReportRenderer::factory($reportFormat);

			if($reportFormat == Piwik_ReportRenderer::HTML_FORMAT)
			{
				$reportRenderer->setRenderImageInline($outputType != Piwik_PDFReports_API::OUTPUT_SAVE_ON_DISK);
			}
		}
	}

	/**
	 * @param Piwik_Event_Notification $notification notification object
	 */
	function allowMultipleReports( $notification )
	{
		if(self::manageEvent($notification))
		{
			$allowMultipleReports = &$notification->getNotificationObject();
			$allowMultipleReports = true;
		}
	}

	/**
	 * @param Piwik_Event_Notification $notification notification object
	 */
	function sendReport( $notification )
	{
		if(self::manageEvent($notification))
		{
			$notificationInfo = $notification->getNotificationInfo();
			$report = $notificationInfo[Piwik_PDFReports_API::REPORT_KEY];
			$websiteName = $notificationInfo[Piwik_PDFReports_API::WEBSITE_NAME_KEY];
			$prettyDate = $notificationInfo[Piwik_PDFReports_API::PRETTY_DATE_KEY];
			$contents = $notificationInfo[Piwik_PDFReports_API::REPORT_CONTENT_KEY];
			$filename = $notificationInfo[Piwik_PDFReports_API::FILENAME_KEY];
			$additionalFiles = $notificationInfo[Piwik_PDFReports_API::ADDITIONAL_FILES_KEY];

			$periods = self::getPeriodToFrequency();
			$message  = Piwik_Translate('PDFReports_EmailHello');
			$subject = Piwik_Translate('General_Report') . ' '. $websiteName . " - ".$prettyDate;

			$mail = new Piwik_Mail();
			$mail->setSubject($subject);
			$fromEmailName = Piwik_Config::getInstance()->branding['use_custom_logo']
				? Piwik_Translate('CoreHome_WebAnalyticsReports')
				: Piwik_Translate('PDFReports_PiwikReports');
			$fromEmailAddress = Piwik_Config::getInstance()->General['noreply_email_address'];
			$attachmentName = $subject;
			$mail->setFrom($fromEmailAddress, $fromEmailName);

			switch ($report['format'])
			{
				case 'html':

					// Needed when using images as attachment with cid
					$mail->setType(Zend_Mime::MULTIPART_RELATED);
					$message .= "<br/>" . Piwik_Translate('PDFReports_PleaseFindBelow', array($periods[$report['period']], $websiteName));
					$mail->setBodyHtml($message . "<br/><br/>". $contents);
					break;

				default:
				case 'pdf':
					$message .= "\n" . Piwik_Translate('PDFReports_PleaseFindAttachedFile', array($periods[$report['period']], $websiteName));
					$mail->setBodyText($message);
					$mail->createAttachment(
						$contents,
						'application/pdf',
						Zend_Mime::DISPOSITION_INLINE,
						Zend_Mime::ENCODING_BASE64,
						$attachmentName.'.pdf'
					);
					break;
			}

			foreach($additionalFiles as $additionalFile)
			{
				$fileContent = $additionalFile['content'];
				$at = $mail->createAttachment(
					$fileContent,
					$additionalFile['mimeType'],
					Zend_Mime::DISPOSITION_INLINE,
					$additionalFile['encoding'],
					$additionalFile['filename']
				);
				$at->id = $additionalFile['cid'];

				unset($fileContent);
			}

			// Get user emails and languages
			$reportParameters = $report['parameters'];
			$emails = array();

			if(isset($reportParameters[self::ADDITIONAL_EMAILS_PARAMETER]))
			{
				$emails = $reportParameters[self::ADDITIONAL_EMAILS_PARAMETER];
			}

			if($reportParameters[self::EMAIL_ME_PARAMETER] == 1)
			{
				if(Piwik::getCurrentUserLogin() == $report['login'])
				{
					$emails[] = Piwik::getCurrentUserEmail();
				}
				elseif($report['login'] == Piwik_Config::getInstance()->superuser['login'])
				{
					$emails[] = Piwik::getSuperUserEmail();
				}
				else
				{
					try {
						$user = Piwik_UsersManager_API::getInstance()->getUser($report['login']);
					} catch(Exception $e) {
						return;
					}
					$emails[] = $user['email'];
				}
			}

			foreach ($emails as $email)
			{
				if(empty($email)) {
					continue;
				}
				$mail->addTo($email);

				try {
					$mail->send();
				} catch(Exception $e) {

					// If running from piwik.php with debug, we ignore the 'email not sent' error
					if(!isset($GLOBALS['PIWIK_TRACKER_DEBUG']) || !$GLOBALS['PIWIK_TRACKER_DEBUG'])
					{
						throw new Exception("An error occured while sending '$filename' ".
							" to ". implode(', ',$mail->getRecipients()).
							". Error was '". $e->getMessage()."'");
					}
				}
				$mail->clearRecipients();
			}
		}
	}

	/**
	 * @param Piwik_Event_Notification $notification notification object
	 */
	function getReportRecipients( $notification )
	{
		if(self::manageEvent($notification))
		{
			$recipients = &$notification->getNotificationObject();
			$notificationInfo = $notification->getNotificationInfo();

			$report = $notificationInfo[Piwik_PDFReports_API::REPORT_KEY];
			$parameters = $report['parameters'];
			$eMailMe = $parameters[self::EMAIL_ME_PARAMETER];

			if($eMailMe)
			{
				$recipients[] = Piwik::getCurrentUserEmail();
			}

			if(isset($parameters[self::ADDITIONAL_EMAILS_PARAMETER]))
			{
				$additionalEMails = $parameters[self::ADDITIONAL_EMAILS_PARAMETER];
				$recipients = array_merge($recipients, $additionalEMails);
			}
			$recipients = array_filter($recipients);
		}
	}

	/**
	 * @param Piwik_Event_Notification $notification notification object
	 */
	static public function template_reportParametersPDFReports($notification)
	{
		$out =& $notification->getNotificationObject();

		$view = Piwik_View::factory('report_parameters');
		$view->currentUserEmail = Piwik::getCurrentUserEmail();
		$view->displayFormats = self::getDisplayFormats();
		$view->reportType = self::EMAIL_TYPE;
		$view->defaultDisplayFormat = self::DEFAULT_DISPLAY_FORMAT;
		$view->defaultEmailMe = self::EMAIL_ME_PARAMETER_DEFAULT_VALUE ? 'true' : 'false';
		$view->defaultEvolutionGraph = self::EVOLUTION_GRAPH_PARAMETER_DEFAULT_VALUE ? 'true' : 'false';
		$out .= $view->render();
	}

	private static function manageEvent($notification)
	{
		$notificationInfo = $notification->getNotificationInfo();
		return in_array(
			$notificationInfo[Piwik_PDFReports_API::REPORT_TYPE_INFO_KEY],
			array_keys(self::$managedReportTypes)
		);
	}

	/**
	 * @param Piwik_Event_Notification $notification notification object
	 */
	function getScheduledTasks ( $notification )
	{
		// Reports have to be sent when the period ends for all websites
		$maxHourOffset = 0;
		$uniqueTimezones = Piwik_SitesManager_API::getInstance()->getUniqueSiteTimezones();
		$baseDate = Piwik_Date::factory("2011-01-01");
		foreach($uniqueTimezones as &$timezone)
		{
			$offsetDate = Piwik_Date::factory($baseDate->toString(), $timezone);

			// Earlier means a negative timezone
			if ( $offsetDate->isEarlier($baseDate) )
			{
				// Gets the timezone offset
				$hourOffset = (24 - date ('H', $offsetDate->getTimestamp()));

				if ( $hourOffset > $maxHourOffset )
				{
					$maxHourOffset = $hourOffset;
				}
			}
		}

		$tasks = &$notification->getNotificationObject();

		$dailySchedule = new Piwik_ScheduledTime_Daily();
		$dailySchedule->setHour($maxHourOffset);
		$tasks[] = new Piwik_ScheduledTask ( $this, 'dailySchedule', $dailySchedule );

		$weeklySchedule = new Piwik_ScheduledTime_Weekly();
		$weeklySchedule->setHour($maxHourOffset);
		$tasks[] = new Piwik_ScheduledTask ( $this, 'weeklySchedule', $weeklySchedule );

		$monthlySchedule = new Piwik_ScheduledTime_Monthly();
		$monthlySchedule->setHour($maxHourOffset);
		$tasks[] = new Piwik_ScheduledTask ( $this, 'monthlySchedule', $monthlySchedule );
	}
	
	function dailySchedule()
	{
		$this->generateAndSendScheduledReports('day');
	}
	
	function weeklySchedule()
	{
		$this->generateAndSendScheduledReports('week');
	}
	
	function monthlySchedule()
	{
		$this->generateAndSendScheduledReports('month');
	}
	
	function generateAndSendScheduledReports($period)
	{
		// Select all reports to generate
		$reportsToGenerate = Piwik_PDFReports_API::getInstance()->getReports($idSite = false, $period);
		
		// For each, generate the file and send the message with the attached report
		foreach($reportsToGenerate as $report)
		{
			Piwik_PDFReports_API::getInstance()->sendReport($report['idreport']);
		}
	}
		
    function addTopMenu()
    {
    	$isMobileMessagingActivated = Piwik_PluginsManager::getInstance()->isPluginActivated('MobileMessaging');
    	$tooltip = $isMobileMessagingActivated ? 'MobileMessaging_TopLinkTooltip' : 'PDFReports_TopLinkTooltip';
    	Piwik_AddTopMenu(
			$isMobileMessagingActivated ? 'MobileMessaging_TopMenu' : 'PDFReports_EmailReports',
			array('module' => 'PDFReports', 'action' => 'index'),
			true,
			13,
			$isHTML = false,
			$tooltip = Piwik_Translate($tooltip)
		);
    }

	/**
	 * @param Piwik_Event_Notification $notification notification object
	 */
    function deleteUserReport($notification)
	{
		$userLogin = $notification->getNotificationObject();
		Piwik_Query('DELETE FROM ' . Piwik_Common::prefixTable('report') . ' WHERE login = ?', $userLogin);
    }
    
    function install()
	{
		$queries[] = '
                CREATE TABLE `'.Piwik_Common::prefixTable('report').'` (
					`idreport` INT(11) NOT NULL AUTO_INCREMENT,
					`idsite` INTEGER(11) NOT NULL,
					`login` VARCHAR(100) NOT NULL,
					`description` VARCHAR(255) NOT NULL,
					`period` VARCHAR(10) NOT NULL,
					`type` VARCHAR(10) NOT NULL,
					`format` VARCHAR(10) NOT NULL,
					`reports` TEXT NOT NULL,
					`parameters` TEXT NULL,
					`ts_created` TIMESTAMP NULL,
					`ts_last_sent` TIMESTAMP NULL,
					`deleted` tinyint(4) NOT NULL default 0,
					PRIMARY KEY (`idreport`)
				) DEFAULT CHARSET=utf8';
        try {
        	foreach($queries as $query)
        	{
        		Piwik_Exec($query);
        	}
		}
		catch(Exception $e) {
    		if(!Zend_Registry::get('db')->isErrNo($e, '1050'))
			{
				throw $e;
			}
		}
	}

	private static function checkAdditionalEmails($additionalEmails)
	{
		foreach($additionalEmails as &$email)
		{
			$email = trim($email);
			if(empty($email))
			{
				$email = false;
			}
			elseif(!Piwik::isValidEmailString($email))
			{
				throw new Exception(Piwik_TranslateException('UsersManager_ExceptionInvalidEmail') . ' ('.$email.')');
			}
		}
		$additionalEmails = array_filter($additionalEmails);
		return $additionalEmails;
	}

	private static function getDisplayFormats()
	{
		$displayFormats = array(
			// PDFReports_AggregateReportsFormat_TablesOnly should be named PDFReports_DisplayFormat_GraphsOnlyForKeyMetrics
			self::DISPLAY_FORMAT_GRAPHS_ONLY_FOR_KEY_METRICS => Piwik_Translate('PDFReports_AggregateReportsFormat_TablesOnly'),
			// PDFReports_AggregateReportsFormat_GraphsOnly should be named PDFReports_DisplayFormat_GraphsOnly
			self::DISPLAY_FORMAT_GRAPHS_ONLY => Piwik_Translate('PDFReports_AggregateReportsFormat_GraphsOnly'),
			// PDFReports_AggregateReportsFormat_TablesAndGraphs should be named PDFReports_DisplayFormat_TablesAndGraphs
			self::DISPLAY_FORMAT_TABLES_AND_GRAPHS => Piwik_Translate('PDFReports_AggregateReportsFormat_TablesAndGraphs'),
			self::DISPLAY_FORMAT_TABLES_ONLY => Piwik_Translate('PDFReports_DisplayFormat_TablesOnly'),
		);
		return $displayFormats;
	}

	/**
	 * @ignore
	 */
	static public function getPeriodToFrequency()
	{
		$periods = array(
			'day' => Piwik_Translate('General_Daily'),
			'week' => Piwik_Translate('General_Weekly'),
			'month' => Piwik_Translate('General_Monthly'),
			'range' => Piwik_Translate('General_DateRangeInPeriodList'),
		);
		return $periods;
	}
}
