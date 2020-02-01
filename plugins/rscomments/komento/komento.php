<?php
/**
* @version 1.0.0
* @package RSComments! 1.0.0
* @copyright (C) 2009 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-2.0.html
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.plugin.plugin');

class plgRSCommentskomento extends JPlugin {
	/*
	* Plugin constructor
	* Set language and variables
	* _name : The name of the commponent
	*/
	
	public function __construct($subject) {
		parent::__construct($subject);
		$this->_name = 'komento';
	}
	
	protected function canRun() {
		if (file_exists(JPATH_SITE.'/components/com_komento/komento.php')) {
			JFactory::getLanguage()->load('plg_rscomments_komento',JPATH_ADMINISTRATOR);
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
					<td width="10%">'.JText::_('RSC_PLG_KOMENTO').'</td>
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
			->select($db->qn('name'))->select($db->qn('email'))->select($db->qn('title'))
			->select($db->qn('comment'))->select($db->qn('created_by'))->select($db->qn('ip'))
			->select($db->qn('component'))->select($db->qn('cid'))->select($db->qn('published'))
			->select($db->qn('url'))->select($db->qn('created'))
			->from($db->qn('#__komento_comments'));
		
		$db->setQuery($query);
		if ($jacomments = $db->loadObjectList()) {
			foreach ($jacomments as $comment) {
				$query->clear()
					->insert($db->qn('#__rscomments_comments'))
					->set($db->qn('name').' = '.$db->q($comment->name))
					->set($db->qn('email').' = '.$db->q($comment->email))
					->set($db->qn('subject').' = '.$db->q($comment->title))
					->set($db->qn('website').' = '.$db->q($comment->url))
					->set($db->qn('comment').' = '.$db->q(strip_tags($comment->comment)))
					->set($db->qn('uid').' = '.$db->q($comment->created_by))
					->set($db->qn('ip').' = '.$db->q($comment->ip))
					->set($db->qn('date').' = '.$db->q($comment->created))
					->set($db->qn('option').' = '.$db->q($comment->component))
					->set($db->qn('id').' = '.$db->q($comment->cid))
					->set($db->qn('published').' = '.$db->q($comment->published));
					
				$db->setQuery($query);
				$db->execute();
				$nr_c++;
			}
		}
		
		// Import subscriptions
		$query->clear()
			->select($db->qn('component'))->select($db->qn('cid'))
			->select($db->qn('fullname'))->select($db->qn('email'))
			->where($db->qn('published').' = 1')
			->from($db->qn('#__komento_subscription'));
		
		$db->setQuery($query);
		if ($subscriptions = $db->loadObjectList()) {
			foreach ($subscriptions as $subscription) {
				$query->clear()
					->insert($db->qn('#__rscomments_subscriptions'))
					->set($db->qn('id').' = '.$db->q($subscription->cid))
					->set($db->qn('option').' = '.$db->q($subscription->component))
					->set($db->qn('name').' = '.$db->q($subscription->fullname))
					->set($db->qn('email').' = '.$db->q($subscription->email));
				
				$db->setQuery($query);
				$db->execute();
				$nr_s++;
			}
		}
		
		$count = new stdClass();
		$count->comments 	  = $nr_c;
		$count->subscriptions = $nr_s;
		
		return $count;
	}
}