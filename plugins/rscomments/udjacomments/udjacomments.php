<?php
/**
* @version 1.0.0
* @package RSComments! 1.0.0
* @copyright (C) 2012 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-2.0.html
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.plugin.plugin');

class plgRSCommentsudjacomments extends JPlugin
{
	/*
	* Plugin constructor
	* Set language and variables
	* _name : The name of the commponent
	*/
	
	public function __construct($subject) {
		parent::__construct($subject);
		$this->_name = 'udjacomments';
	}
	
	protected function canRun() {
		if (file_exists(JPATH_SITE.'/administrator/components/com_udjacomments/udjacomments.php')) {
			JFactory::getLanguage()->load('plg_rscomments_udjacomments',JPATH_ADMINISTRATOR);
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
					<td width="10%">'.JText::_('RSC_PLG_UDJACOMMENTS').'</td>
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
			->select($db->qn('full_name'))->select($db->qn('receive_notifications'))->select($db->qn('email'))
			->select($db->qn('url'))->select($db->qn('content'))->select($db->qn('ip'))
			->select($db->qn('time_added'))->select($db->qn('comment_url'))->select($db->qn('is_published'))
			->from($db->qn('#__udjacomments'));
		
		$db->setQuery($query);
		if ($udjacomments = $db->loadObjectList()) {
			foreach ($udjacomments as $comment) {
				$component  = 'com_content';
				$comment_url = explode(':',$comment->comment_url);
				$article_id  = $comment_url[1];
				$component   = $comment_url[0];

				$query->clear()
					->insert($db->qn('#__rscomments_comments'))
					->set($db->qn('name').' = '.$db->q($comment->full_name))
					->set($db->qn('email').' = '.$db->q($comment->email))
					->set($db->qn('website').' = '.$db->q($comment->url))
					->set($db->qn('comment').' = '.$db->q(strip_tags($comment->comment)))
					->set($db->qn('ip').' = '.$db->q($comment->ip))
					->set($db->qn('date').' = '.$db->q($comment->time_added))
					->set($db->qn('option').' = '.$db->q($component))
					->set($db->qn('id').' = '.$db->q($article_id))
					->set($db->qn('published').' = '.$db->q($comment->is_published));
				
				$db->setQuery($query);
				$db->execute();
				$nr_c++;
				
				if($comment->receive_notifications != 0) {
					$query->clear()
						->insert($db->qn('#__rscomments_subscriptions'))
						->set($db->qn('id').' = '.$db->q($article_id))
						->set($db->qn('option').' = '.$db->q($component))
						->set($db->qn('name').' = '.$db->q($comment->full_name))
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