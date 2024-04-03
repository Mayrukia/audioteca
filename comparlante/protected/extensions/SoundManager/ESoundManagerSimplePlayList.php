<?php
/**
 * 
 * This widget is used to create a playlist using the SoundManager2 http://www.schillmania.com/projects/soundmanager2/demo/play-mp3-links/
 * 
 * Example:
 * <code>
 * 	<a href="/mp3/rain.mp3" id="singlePlayer_1" class="list1">Rain</a>
 *  <a href="/mp3/walking.mp3" id="singlePlayer_2" class="list1">Rain 2</a>
 *	<a href="/mp3/mak.mp3" id="singlePlayer_3" class="list1">Rain 3</a>
 *	<a href="/mp3/fancy-beer-bottle-pop.mp3" id="singlePlayer_4" class="list1">Rain 4</a>
 *  <?php
 *  $this->widget("ext.SoundManager.ESoundManagerSimplePlayList", array("playListId"=>"playList1", "playListClass"=>"list1", "autoPlay"=>true, "autoNext"=>true));
 *  ?>
 * </code>
 * After creating the widget, a js var named "playList1" (the same as playListId) is created. This var is a js object of the class SmPlayList
 * from which you can get the id of the current player or you can call resetPlayList() function to re-initialize the playlist (e.g., after ajax in a CGridView) 
 * @author Vu Khuu <vu.khuu@glandoresystems.com>
 *
 */
class ESoundManagerSimplePlayList extends CWidget {
	public $playListId;
	public $playListClass;
	public $autoPlay = false;
	public $autoNext = false;
	public $playCallback = "function(){}";
	public $pauseCallback = "function(){}";
	public $stopCallback = "function(){}";
	public $resumeCallback = "function(){}";
	public $finishCallback = "function(){}";
	
	public function run() {
		
		$assetManager = Yii::app()->assetManager;
		$assetUrl = $assetManager->publish(dirname(__FILE__).'/assets');
		$cs = Yii::app()->clientScript;
		// Register jQuery
		$cs->registerCoreScript("jquery");
		// Register SoundManager js & css
		$cs->registerCssFile($assetUrl.'/css/player.css');
		$cs->registerCssFile($assetUrl.'/css/flashblock.css');
		$cs->registerScriptFile($assetUrl.'/js/soundmanager2-nodebug.js');
		$cs->registerScriptFile($assetUrl.'/js/SmPlayList.js');
		
		// Initial script
		$initScript = <<<EOD
			soundManager.url = '{$assetUrl}/swf/soundmanager2_flash9_debug.swf';
			soundManager.flashVersion = 9;
			soundManager.useFlashBlock = true;
EOD;
		$cs->registerScript("SoundManagerInitialScript", $initScript);
		
		$autoPlayText = $this->autoPlay ? "true" : "false";
		$autoNextText = $this->autoNext ? "true" : "false";
		
		$smScript = <<<EOD
			// Global reference to SoundManager sound object
			var {$this->playListId} = null;
			soundManager.onready(function(){
				{$this->playListId} = new SmPlayList("{$this->playListId}", "{$this->playListClass}", {$autoPlayText}, {$autoNextText});
				{$this->playListId}.callbacks.play = {$this->playCallback};
				{$this->playListId}.callbacks.pause = {$this->pauseCallback};
				{$this->playListId}.callbacks.resume = {$this->resumeCallback};
				{$this->playListId}.callbacks.stop = {$this->stopCallback};
				{$this->playListId}.callbacks.finish = {$this->finishCallback};
				{$this->playListId}.run();
			});
EOD;
		$cs->registerScript("SoundManagerPlayList_" . $this->playListId, $smScript);
	}
}
?>