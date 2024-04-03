/*
 * This file has been adapted from the demo site of SoundManager http://www.schillmania.com/projects/soundmanager2/demo/play-mp3-links/
 * This version uses jQuery instead of pure javascript.
 * 
 * This class is used to create a playlist containing many SoundManager's sound objects, each of which is styled as a media player.
 * A playlist can be configured to start playing automatically or not.
 * It can also be configured to enable playing next file automatically or not.
 * @param string playListId The id of this playlist
 * @param string playListClass The class of corresponding <a> tags which are the place holders for media players
 * @param bool autoPlay Enable auto play or not
 * @param bool autoNext Enable auto next or not
 * @author vu.khuu@glandoresystems.com
 */
var SmPlayList = function(playListId, playListClass, autoPlay, autoNext) {
	this.playListId = playListId;
	this.playListClass = playListClass;
	this.autoPlay = autoPlay;
	this.autoNext = autoNext;
	this.callbacks = {
		play: null,
		stop: null,
		pause: null,
		resume: null,
		finish: null
	};
	
	
	// Set up some vars
	this.totalPlayers = 0; // Total number of players
	this.playerIndex = 0; // Current index of this.players
	this.players = []; // Stores created SoundManager sound objects by id
	this.playerIndexes = []; // Stores all players' ids & indexes
	this.reversedPlayerIndexes = []; // Reversed version of this.playerIndexes to find next file to play
	this.currentPlayerId = null; // Current player id
	
	var self = this;
	
	this.css = {
		// CSS class names appended to link during various states
		sDefault: 'sm2_link', // default state
		sLoading: 'sm2_loading',
		sPlaying: 'sm2_playing',
		sPaused: 'sm2_paused'
	};
	
	this.events = {
		play: function(playerId) {
			var obj = $("#" + playerId);
			obj.removeClass(self.css.sDefault);
			obj.removeClass(self.css.sPaused);
			obj.addClass(self.css.sPlaying);
			if (self.callbacks.play != null) {
				self.callbacks.play();
			}
		},

		stop: function(playerId) {
			var obj = $("#" + playerId);
			obj.removeClass(self.css.sPlaying);
			obj.addClass(self.css.sDefault);
			if (self.callbacks.stop != null) {
				self.callbacks.stop();
			}
		},

		pause: function(playerId) {
			var obj = $("#" + playerId);
			obj.removeClass(self.css.sPlaying);
			obj.addClass(self.css.sPaused);
			if (self.callbacks.pause != null) {
				self.callbacks.pause();
			}
		},

		resume: function(playerId) {
			var obj = $("#" + playerId);
			obj.removeClass(self.css.sPaused);
			obj.addClass(self.css.sPlaying);
			if (self.callbacks.resume != null) {
				self.callbacks.resume();
			}
		},

		finish: function(playerId) {
			var obj = $("#" + playerId);
			obj.removeClass(self.css.sPlaying);
			obj.addClass(self.css.sDefault);
			if (self.autoNext) {
				var currentIndex = self.playerIndexes[playerId];
				if (currentIndex + 1 < self.reversedPlayerIndexes.length) {
					nextPlayerId = self.reversedPlayerIndexes[currentIndex + 1];
					$("#" + nextPlayerId).trigger("click");
				}
			}
			if (self.callbacks.finish != null) {
				self.callbacks.finish();
			}
		}			
	};
	
	this.run = function(){
		this.buildIndexesOfPlayers();
		this.totalPlayers = $("." + this.playListClass).length;

		// Bind event
		$("." + this.playListClass).live("click", function(){
			var id = this.id;
			
			// If any player is playing, stop it
			if (self.currentPlayerId != null && self.currentPlayerId != id) {
				self.players[self.currentPlayerId].stop();
				self.players[self.currentPlayerId].unload();
			}
			
			self.currentPlayerId = id;
			
			var player = (self.players[id] !== 'undefined') ? self.players[id] : null;
			if (player == null) {
				
				player = soundManager.createSound({
			       id: id,
			       url:$(this).attr("href"),
			       onplay: function(){
					   self.events.play(id);
			       },
			       onstop:function(){
			       	   self.events.stop(id);
				   },
			       onpause:function(){
					   self.events.pause(id);
			       },
			       onresume:function(){
					   self.events.resume(id);
			       },
			       onfinish:function(){
					   self.events.finish(id);
			       }
			    });
			    player.play();
			    self.players[id] = player;
			    
			    self.playerIndex++;
			} else {
				player.togglePause();
			}
			
			
			return false;
		});
		
		if (this.autoPlay) {
			$("." + this.playListClass + ":first-child").trigger("click");
		}
	};
	
	this.buildIndexesOfPlayers = function(){
		$("." + self.playListClass).each(function(i, e){
			$(e).addClass("sm2");
			if (! $(e).hasClass(self.css.sDefault)) {
				$(e).addClass(self.css.sDefault);
			}
			self.playerIndexes[e.id] = i;
			self.reversedPlayerIndexes[i] = e.id;
		});
	};
	
	this.resetPlayList = function() {
		// Stop current player
		if (self.currentPlayerId != null) {
			self.players[self.currentPlayerId].stop();
		}
		this.players = [];
		this.totalPlayers = $("." + this.playListClass).length;
		this.buildIndexesOfPlayers();
	};
};