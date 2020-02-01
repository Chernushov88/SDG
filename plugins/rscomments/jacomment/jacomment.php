<?php
/**
* @version 1.0.0
* @package RSComments! 1.0.0
* @copyright (C) 2009 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-2.0.html
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.plugin.plugin');

class plgRSCommentsjacomment extends JPlugin {
	/*
	* Plugin constructor
	* Set language and variables
	* _name : The name of the commponent
	*/
	
	public function __construct($subject) {
		parent::__construct($subject);
		$this->_name = 'jacomment';
	}
	
	protected function canRun() {
		if (file_exists(JPATH_SITE.'/components/com_jacomment/jacomment.php')) {
			JFactory::getLanguage()->load('plg_rscomments_jacomment',JPATH_ADMINISTRATOR);
			return true;
		}
		
		return false;
	}

	/*
	* Set the import button
	* return : html
	*/

	public function rscommentsButton() {
		if ($this->canRun()) {
			return '<tr>
					<td width="10%">'.JText::_('RSC_PLG_JACOMMENT').'</td>
					<td>
						<button class="rs_button" type="button" onclick="rsc_import(\''.$this->_name.'\')">'.JText::_('RSC_PLG_IMPORT').'</button>
					</td>
				</tr>';
		}
	}

	/*
	* Import function
	* return : number of imported comments
	*/
	
	public function rscommentsImport() {
		if (!$this->canRun())
			return false;
		
		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);
		$nr_c	= 0;
		$nr_s	= 0;
		
		// Import comments
		$query->clear()
			->select($db->qn('name'))->select($db->qn('email'))->select($db->qn('website'))
			->select($db->qn('comment'))->select($db->qn('userid'))->select($db->qn('ip'))
			->select($db->qn('option'))->select($db->qn('contentid'))->select($db->qn('published'))
			->select($db->qn('subscription_type'))->select($db->qn('date'))
			->from($db->qn('#__jacomment_items'));
		
		$db->setQuery($query);
		if ($jacomments = $db->loadObjectList()) {
			foreach ($jacomments as $comment) {
				$query->clear()
					->insert($db->qn('#__rscomments_comments'))
					->set($db->qn('name').' = '.$db->q($comment->name))
					->set($db->qn('email').' = '.$db->q($comment->email))
					->set($db->qn('website').' = '.$db->q($comment->website))
					->set($db->qn('comment').' = '.$db->q(strip_tags($comment->comment)))
					->set($db->qn('uid').' = '.$db->q($comment->userid))
					->set($db->qn('ip').' = '.$db->q($comment->ip))
					->set($db->qn('date').' = '.$db->q($comment->date))
					->set($db->qn('option').' = '.$db->q($comment->option))
					->set($db->qn('id').' = '.$db->q($comment->contentid))
					->set($db->qn('published').' = '.$db->q($comment->published));
					
				$db->setQuery($query);
				$db->execute();
				$nr_c++;
				
				
				if ($comment->subscription_type != 0) {
					$query->clear()
						->insert($db->qn('#__rscomments_subscriptions'))
						->set($db->qn('id').' = '.$db->q($comment->contentid))
						->set($db->qn('option').' = '.$db->q($comment->option))
						->set($db->qn('name').' = '.$db->q($comment->name))
						->set($db->qn('email').' = '.$db->q($comment->email));
					
					$db->setQuery($query);
					$db->execute();
					$nr_s++;
				}
			}
		}
			
		$count = new stdClass();
		$count->comments 	  = $nr_c;
		$count->subscriptions = $nr_s;
		
		return $count;
	}
}