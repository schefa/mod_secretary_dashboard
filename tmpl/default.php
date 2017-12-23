<?php
/**
 * @version     3.0.0
 * @package     mod_secretary_dashboard
 * @copyright   Copyright (C) 2014. Alle Rechte vorbehalten.
 * @license     GNU General Public License version 2 oder später; siehe LICENSE.txt
 * @author      Fjodor Schäfer - https://www.schefa.com
 */

// no direct access
defined('_JEXEC') or die;

$user	= JFactory::getUser();

$showDocuments   = (int) $params->get('showDocuments',0);
if($showDocuments === 1) 
    $documents = SecretaryFactory::getData('folders', 'documents','extension','id,title','loadObjectList');

$showSubjects   = (int) $params->get('showSubjects',0);
if($showSubjects === 1)
    $subjects = SecretaryFactory::getData('folders', 'subjects','extension','id,title','loadObjectList');

$showProducts   = (int) $params->get('showProducts',0);
if($showProducts === 1)
    $products = SecretaryFactory::getData('folders', 'products','extension','id,title','loadObjectList');

$showTimes   = (int) $params->get('showTimes',0);
if($showTimes === 1)
    $times = SecretaryFactory::getData('folders', 'times','extension','id,title','loadObjectList');
    
$showMessages   = (int) $params->get('showMessages',0);
if($showMessages === 1)
    $messages = SecretaryFactory::getData('folders', 'messages','extension','id,title','loadObjectList');
 
 

?> 
<div id="secretaryQuickIconsTitle">
	<h1 class="text-center"><?php echo $business['title'];?></h1>
	<?php if(!empty( $business['slogan'] )) { ?><h3 class="text-center"><?php echo $business['slogan'];?></h3><?php } ?>
</div>

<div id="secretaryQuickIcons">

	<div class="grid fullwidth">
    	
        <?php if ($user->authorise('core.show', 'com_secretary.folder')) { ?>
        <div class="grid-item">
            <div class="qicon">
                <a href="<?php echo JRoute::_('index.php?option=com_secretary&view=folders&extension=documents'); ?>">
                    <span class="fa fa-folder-o"></span>
                    <?php echo JText::_('COM_SECRETARY_CATEGORIES'); ?>
                </a>
            </div>
        </div>
        <?php } ?>
        
        <?php if ($user->authorise('core.show', 'com_secretary.document')) { ?>
        <div class="grid-item">
            <div class="qicon">
                <a href="<?php echo JRoute::_('index.php?option=com_secretary&view=documents&catid=0'); ?>">
                    <span class="fa fa-file"></span>
                    <?php echo JText::_('COM_SECRETARY_DOCUMENTS'); ?>
                </a>
                <?php if(!empty($documents)) { ?>
                <div class="qicon-wrapper-list">
                <?php foreach($documents as $document) { ?>
                	<div><a href="index.php?option=com_secretary&view=documents&catid=<?php echo $document->id ?>"><?php echo JText::_( $document->title ) ?></a></div>
                <?php } ?>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php } ?>
        
        <?php if ($user->authorise('core.show', 'com_secretary.subject')) { ?>
        <div class="grid-item">
            <div class="qicon">
                <a href="<?php echo JRoute::_('index.php?option=com_secretary&view=subjects'); ?>">
                    <span class="fa fa-users"></span>
                    <?php echo JText::_('COM_SECRETARY_SUBJECTS'); ?>
                </a>
                <?php if(!empty($subjects)) { ?>
                <div class="qicon-wrapper-list">
                <?php foreach($subjects as $subject) { ?>
                	<div><a href="index.php?option=com_secretary&view=subjects&catid=<?php echo $subject->id ?>"><?php echo JText::_( $subject->title ) ?></a></div>
                <?php } ?>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php } ?>
        
        <?php if ($user->authorise('core.show', 'com_secretary.product')) { ?>
        <div class="grid-item">
            <div class="qicon">
                <a href="<?php echo JRoute::_('index.php?option=com_secretary&view=products'); ?>">
                    <span class="fa fa-shopping-cart"></span>
                <?php echo JText::_('COM_SECRETARY_PRODUCTS'); ?>
                </a>
                <?php if(!empty($products)) { ?>
                <div class="qicon-wrapper-list">
                <?php foreach($products as $product) { ?>
                	<div><a href="index.php?option=com_secretary&view=products&catid=<?php echo $product->id ?>"><?php echo JText::_( $product->title ) ?></a></div>
                <?php } ?>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php } ?>
        
        <?php if ($user->authorise('core.show', 'com_secretary.message')) { ?>
        <div class="grid-item">
            <div class="qicon">
                <a href="<?php echo JRoute::_('index.php?option=com_secretary&view=messages'); ?>">
                    <span class="fa fa-comment"></span>
                <?php echo JText::_('COM_SECRETARY_MESSAGES'); ?>
                </a>
                <?php if(!empty($messages)) { ?>
                <div class="qicon-wrapper-list">
                <?php foreach($messages as $message) { ?>
                	<div><a href="index.php?option=com_secretary&view=messages&catid=<?php echo $message->id ?>"><?php echo JText::_( $message->title ) ?></a></div>
                <?php } ?>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php } ?>
        

            <?php if ($user->authorise('core.show', 'com_secretary.time')) { ?>
            <div class="grid-item">
                <div class="qicon">
                <a href="<?php echo JRoute::_('index.php?option=com_secretary&view=times&layout=list'); ?>">
                    <span class="fa fa-calendar"></span>
                <?php echo JText::_('COM_SECRETARY_TIMES'); ?>
                </a>
                    <?php if(!empty($times)) { ?>
                    <div class="qicon-wrapper-list">
                    <?php foreach($times as $time) { ?>
                    	<div><a href="index.php?option=com_secretary&view=times&catid=<?php echo $time->id ?>"><?php echo JText::_( $time->title ) ?></a></div>
                    <?php } ?>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <?php } ?>
            
            <?php if ($user->authorise('core.show', 'com_secretary.accounting')) { ?>
            <div class="grid-item">
                <div class="qicon">
                    <a href="<?php echo JRoute::_('index.php?option=com_secretary&view=accountings'); ?>">
                        <span class="fa fa-book"></span>
                    <?php echo JText::_('COM_SECRETARY_ACCOUNTING'); ?>
                    </a>
                </div>
            </div>
            <?php } ?>
            
            <?php if ((file_exists(JPATH_ADMINISTRATOR.'/components/com_secretary/views/markets/view.html.php')) && $user->authorise('core.show', 'com_secretary.market')) { ?>
            <div class="grid-item">
                <div class="qicon">
                    <a href="<?php echo JRoute::_('index.php?option=com_secretary&view=markets'); ?>">
                        <span class="fa fa-certificate"></span>
                    <?php echo JText::_('COM_SECRETARY_MARKETS'); ?>
                    </a>
                </div>
            </div>
            <?php } ?>
        
    </div>
    
	<hr />
	
	<div class="fullwidth">
        
        <?php if ($user->authorise('core.show', 'com_secretary.business')) { ?>
        <div class="grid-item">
            <div class="qicon">
                <a href="<?php echo JRoute::_('index.php?option=com_secretary&view=businesses'); ?>">
                    <span class="fa fa-home"></span>
                <?php echo JText::_('COM_SECRETARY_BUSINESS'); ?>
                </a>
            </div>
        </div>
        <?php } ?>
        
        <?php if ($user->authorise('core.show', 'com_secretary.location')) { ?>
        <div class="grid-item">
            <div class="qicon">
                <a href="<?php echo JRoute::_('index.php?option=com_secretary&view=locations'); ?>">
                    <span class="fa fa-cube"></span>
                    <?php echo JText::_('COM_SECRETARY_LOCATIONS'); ?>
                </a>
            </div>
        </div>
        <?php } ?>
        
        <?php if ($user->authorise('core.show', 'com_secretary.reports')) { ?>
        <div class="grid-item">
            <div class="qicon">
                <a href="<?php echo JRoute::_('index.php?option=com_secretary&view=reports'); ?>">
                    <span class="fa fa-bar-chart"></span>
                <?php echo JText::_('COM_SECRETARY_REPORTS'); ?>
                </a>
            </div>
        </div>
        <?php } ?>
        
        <?php if ($user->authorise('core.show', 'com_secretary.template')) { ?>
        <div class="grid-item">
            <div class="qicon">
                <a href="<?php echo JRoute::_('index.php?option=com_secretary&view=templates'); ?>">
                    <span class="fa fa-print"></span>
                <?php echo JText::_('COM_SECRETARY_TEMPLATES'); ?>
                </a>
            </div>
        </div>
        <?php } ?>
        
        <?php if ($user->authorise('core.admin', 'com_secretary')) { ?>
        <div class="grid-item">
            <div class="qicon">
                <a href="<?php echo JRoute::_('index.php?option=com_secretary&view=items&extension=status'); ?>">
                    <span class="fa fa-paperclip"></span>
                <?php echo JText::_('COM_SECRETARY_STATUS'); ?>
                </a>
            </div>
        </div>
        
        <div class="grid-item">
            <div class="qicon">
                <a href="<?php echo JRoute::_('index.php?option=com_secretary&view=items&extension=fields'); ?>">
                    <span class="fa fa-th-large"></span>
                <?php echo JText::_('COM_SECRETARY_FIELDS'); ?>
                </a>
            </div>
        </div>
        
        <div class="grid-item">
            <div class="qicon">
                <a href="<?php echo JRoute::_('index.php?option=com_secretary&view=items&extension=entities'); ?>">
                    <span class="fa fa-text-height"></span>
                <?php echo JText::_('COM_SECRETARY_ENTITIES'); ?>
                </a>
            </div>
        </div>
        <?php } ?>
        
        <?php if ($user->authorise('core.admin', 'com_secretary')) { ?>
        <div class="grid-item">
            <div class="qicon">
                <a href="<?php echo JRoute::_('index.php?option=com_secretary&view=items&extension=uploads'); ?>">
                    <span class="fa fa-upload"></span>
                	<?php echo JText::_('COM_SECRETARY_FILES'); ?>
                </a>
            </div>
        </div>
        
        <div class="grid-item">
            <div class="qicon">
                <a href="<?php echo JRoute::_('index.php?option=com_secretary&view=item&id=1&layout=edit&extension=settings'); ?>">
                    <span class="fa fa-cog"></span>
                    <?php echo JText::_('COM_SECRETARY_SETTINGS'); ?>
                </a>
            </div>
        </div>
        <?php } ?>
      
    	<div class="grid-item">
    		<div class="qicon">
                <a class="modal" rel="{handler:'iframe', size:{x:(document.documentElement.clientWidth)*0.9, y:(document.documentElement.clientHeight)*0.95}}" target="_blank" href="https://www.schefa.com/secretary/docs">
                    <span class="fa fa-life-buoy"></span>
                    <?php echo JText::_('COM_SECRETARY_DOCS_AND_TUTORIALS'); ?>
                </a>
    		</div>
    	</div>
    </div>
    
	<div style="clear: both;"></div>
  
</div>

<script>
jQuery(document).ready(function($) {
	$('.grid').masonry({ itemSelector: '.grid-item', columnWidth:150});
});
</script> 
