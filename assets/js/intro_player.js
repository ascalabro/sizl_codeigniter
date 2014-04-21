$('document').ready(function() {

    // if javascript is loaded, hide the "You need to install javascript to view the video notifier."
    $('.enable_js_notifier').hide();
    // get playlist 
    var playlist = [];
    playlist = load_intro_vid();
    // END get playlist

    player = new jwplayer("intro_vid").setup({
        playlist: [{
                image: /*  preview image */ "http://upload.wikimedia.org/wikipedia/commons/3/30/Windows-8-Consumer-Preview.png",
                sources: playlist
            }],
        controls: true,
        autostart: false,
        height: 580,
        width: 999,
        events: {
//            
        }
//            onComplete: function(data) {
//                var current_vid_id = this.getPlaylistItem();
//                alert(current_vid_id.vid_id);
//                /*
//                 *  currently_finishing_vid.vid_id is the id of the video just finishing playing,
//                 *  now we need to remove it from the playlist and create a new playlist, then 
//                 *  load the new playlist into the player.
//                 * 
//                 *  this function will remove the currently finshing vid from the queue
//                 *   
//                 */
//                var new_playlist = [];
//                new_playlist = update_playlist();
////                            var new_playlist = [];
////                            new_playlist = get_newest_playlist();
//                this.load(new_playlist);
//                this.play(true);
//            }

    });




    /* 
     * Below is html5 video player
     * 
     */
//    var video = document.getElementById('intro_video');
//    setAttributes(video, {"id": "player", "width": "755"});
//    //video.setAttribute("id", "player");
//
//    //document.body.appendChild(video);
//    addSourceToVideo(video, playlist, 'video/mp4');
//    $('.loading_player').hide();
//    $('#player').bind('contextmenu', function() {
//        return false;
//    });

    /****   after the video ends, update the playlist and retrieve a new playlist.json       ****/
//	$("#player").on("ended", function() {
//		$(this).empty();
//		
//		var playlist = update_playlist();
//		addSourceToVideo(video, playlist, 'video/mp4');
//		video.load();
//		video.play();
//	});
    /* 
     * END html5 video player
     * 
     */

});

