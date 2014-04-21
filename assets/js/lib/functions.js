function load_newest_playlist(playlist_obj) {
    var playlist = [];
    $.ajax({
        async: false,
        type: 'GET',
        url: 'lib/scripts/returnNewestPlaylist.php',
        success: function(data) {
            data = jQuery.parseJSON(data);
            $('body').append(data);
            for (var i = 0; i < data.length; i++) {
                playlist.push(data[i]);
            }
        }
    });
    return playlist;
}

function update_playlist(current_vid_id) {
    var playlist = [];
    $.ajax({
        async: false,
        type: 'GET',
        url: 'lib/data/playlist2.json',
        success: function(new_playlist) {
            for (var i = 0; i < new_playlist.length; i++) {
                playlist.push(new_playlist[i]);
            }
        }
    });
    return playlist;
}

function load_intro_vid() {
    var playlist = [];
    $.ajax({
        async: false,
        type: 'POST',
        url: 'ajax/getIntroVid',
        success: function(data) {
            data = jQuery.parseJSON(data);
            $('body').append(data);
            for (var i = 0; i < data.length; i++) {
                playlist.push(data[i]);
            }
        }
    });
    return playlist;
}


function addSourceToVideo(element, playlist, type) {
    alert(JSON.stringify(playlist));
    var mp4source = document.createElement('source');
    mp4source.src = playlist[0].mp4;
    mp4source.type = 'video/mp4';
    mp4source.setAttribute("data-vid-id", playlist[0].vid_id);
    element.appendChild(mp4source);
    var oggsource = document.createElement('source');
    oggsource.src = playlist[0].ogg;
    oggsource.type = 'video/ogg';
    oggsource.setAttribute("data-vid-id", playlist[0].vid_id);
    element.appendChild(oggsource);
}

function removeElement(node) {
    node.parentNode.removeChild(node);
}

