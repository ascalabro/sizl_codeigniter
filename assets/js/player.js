$('document').ready(function() {

    // if javascript is loaded, hide the "You need to install javascript to view the video notifier."
    $('.enable_js_notifier').hide();

    // load latest playlist from script
    var playlist = [];
    playlist = load_newest_playlist();
    alert(JSON.stringify(playlist));
    // load jwplayer
    player = new jwplayer("vid_player").setup({
        playlist: playlist,
        controls: false,
        autostart: true,
        height: 580,
        width: 800,
        events: {
            onDisplayClick: function(){
                $('#vid_player').css({
                    "width": "100%"
                });
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
        }
    });
    
    $("#toggle_fullscreen").click(function(){
        player.setFullscreen(true);
    });

});
