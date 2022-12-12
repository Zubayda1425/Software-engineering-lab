"use strict";
/*------------------------------------------ GENERAL MEDIA CLASS BEGIN -----------------------------------------------*/
function Media (mediaType, defaultCodecFormat, mediaElementTag) {
  // mediaType can be 'video' or 'audio' strings
  // defaultCodecFormat can be 'webm' or 'mp3' strings
  var self = this;
  this.mediaEvents = {
    loadstart: 0,
    progress: 0,
    suspend: 0,
    abort: 0,
    error: 0,
    emptied: 0,
    stalled: 0,
    loadedmetadata: 0,
    loadeddata: 0,
    canplay: 0,
    canplaythrough: 0,
    playing: 0,
    waiting: 0,
    seeking: 0,
    seeked: 0,
    ended: 0,
    durationchange: 0,
    timeupdate: 0,
    play: 0,
    pause: 0,
    ratechange: 0,
    resize: 0,
    volumechange: 0
  };
  this.mediaProperties = [
    "error", "src", "srcObject", "currentSrc", "crossOrigin", "networkState", "preload", "buffered", "readyState",
    "seeking", "currentTime", "duration", "paused", "defaultPlaybackRate", "playbackRate", "played", "seekable",
    "ended", "autoplay", "loop", "mediaGroup", "controller", "controls", "volume", "muted", "defaultMuted",
    "audioTracks", "videoTracks", "textTracks", "width", "height", "videoWidth", "videoHeight", "poster"
  ];
  // find media element
  this.mediaElement = document.getElementById(mediaElementTag);
  // find source element
  this.mediaSource = document.getElementById(defaultCodecFormat);
  // create an array sized by properties amount
  this.mediaPropertiesElts = new Array(this.mediaProperties.length);
  // initiate media events
  this.initEvents("eventsTableID", this.mediaEvents, false);
  // initiate media properties
  this.initProperties("propertiesTableID", this.mediaProperties, this.mediaPropertiesElts, false);
  // properties are updated even if no event was triggered
  setInterval(function () {
    self.updateProperties(self);
  }, 250);
}
// initiate media events function to fill the table
Media.prototype.initEvents = function (id, arrayEventDef) {
  var self = this;
  // for every media event add eventListener by event name(key)
  for (var key in arrayEventDef) {
    // increase value in arrayEventDef every time you trigger 'key' event
    this.mediaElement.addEventListener(key, function (event) {
        self.incrementEventCounter(event, self);
      }, false
    );
  }
  // update progress bar each time current value changed
  this.mediaElement.addEventListener('timeupdate', function (event) {
      self.updateProgressBar(self);
    }, false
  );
  // get table body element with exact id
  var tbody = document.getElementById(id),
    i = 1, // iterator for table row formation
    tr = null,
    th,
    td;
  for (key in arrayEventDef) {
    // if this is beginning of the row, create it
    if (tr === null)
      tr = document.createElement("tr");
    th = document.createElement("th"); //initiate element
    th.textContent = key; // fill the context
    // create column element
    td = document.createElement("td");
    td.setAttribute("id", "e_" + key);
    td.textContent = "0";
    td.className = "false";
    // assign header and column to row
    tr.appendChild(th);
    tr.appendChild(td);
    // when you rich 5th column - append row, and drop tr
    if ((i++ % 5) === 0) {
      tbody.appendChild(tr);
      tr = null;
    }
  }
  // if somehow tr not dropped append the least of available data
  if (tr !== null) tbody.appendChild(tr);
};
// increase 'event' counter, when event happen
Media.prototype.incrementEventCounter = function (event, self) {
  self.mediaEvents[event.type]++;
};
// initiate media properties function to fill the table
Media.prototype.initProperties = function (id, arrayPropDef, arrayProp) {
  var tableBody = document.getElementById(id),
    tableFragment = document.createDocumentFragment(),
    i = 0,
    tr = null,
    th,
    td,
    temp; // temporary boolean variable to check if video supports any listed properties
  // while array's limit is not achieved, create rows with properties' values
  do {
    // if this is the first row
    if (tr === null){
      tr = document.createElement("tr");
    }
    th = document.createElement("th");
    th.textContent = arrayPropDef[i];
    // create column element
    td = document.createElement("td");
    td.setAttribute("id", "p_" + arrayPropDef[i]);
    // check video's value of this property
    //temp = eval ("document.getElementById('video')." + arrayPropDef[i]);
    //to access media element properties use indexer notation
    temp = this.mediaElement[arrayPropDef[i]];
    if (typeof temp == "string") {
      temp = temp.substr(0,10);
    }
    td.textContent = temp;
    if (typeof temp != "undefined") {
      td.className = "true"; // this class highlight supported properties
    } else {
      td.className = "false";
    }
    tr.appendChild(th);
    tr.appendChild(td);
    arrayProp[i] = td;
    // when you rich 3rd column - append row, and drop tr
    if ((++i % 4) === 0) {
      tableFragment.appendChild(tr);
      tr = null;
    }
  } while (i < arrayPropDef.length);
  tableBody.appendChild(tableFragment);
  // if somehow tr not dropped append the least of available data
  if (tr !== null) tableBody.appendChild(tr);
};
// update progress bar value each time 'timeupdate' event happens (after you click play it happens all the time)
Media.prototype.updateProgressBar = function (self) {
  // find progress bar element
  var progressBar = document.getElementById('progress-bar'),
    percentage = 0;
  // if media is playing, calculate progress in percents
  if(self.mediaElement.duration >= 0){
    percentage = Math.floor((100 / self.mediaElement.duration) * self.mediaElement.currentTime);
  }
  // assign result to value and alt text
  progressBar.value = percentage;
  progressBar.innerHTML = percentage + '% played';
};
// update video's properties
Media.prototype.updateProperties = function (self){
  var i = 0;
  var e;   // for the property value element
  var val; // for video property via 'eval'
  // check if document contain tag with specific media event identifier
  for (var keyME in self.mediaEvents) {
    e = document.getElementById("e_" + keyME);
    if (e) {
      e.textContent = self.mediaEvents[keyME];
      // if event happened at least once, apply class
      if (self.mediaEvents[keyME] > 0) e.className = "true";
    }
  }
  for (var keyMP in self.mediaProperties) {
    // eval video property value
    val = this.mediaElement[self.mediaProperties[keyMP]];
    if (typeof val == 'string'){
      val = val.substr(0, 10);
    }
    // show it in the properties table
    self.mediaPropertiesElts[i++].textContent = val;
  }
};
/*------------------------------------------ GENERAL MEDIA CLASS END -------------------------------------------------*/
/*------------------------------------------ SPECIFIC MEDIA FUNCTIONS BEGIN ------------------------------------------*/
Media.prototype.toggleMute = function () {
  this.mediaElement.muted = !this.mediaElement.muted;
};
Media.prototype.playPause = function () {
  if (this.mediaElement.paused) {
    this.mediaElement.play ();
  } else {
    this.mediaElement.pause ();
  }
};
Media.prototype.loopUnloop = function () {
  if (this.mediaElement.loop) {
    this.mediaElement.removeAttribute('loop');
  } else {
    this.mediaElement.loop = true;
  }
};
/*------------------------------------------- SPECIFIC MEDIA FUNCTIONS END -------------------------------------------*/
/*------------------------------------------- VIDEO CLASS BEGIN ------------------------------------------------------*/
var videoList = {
  big_buck: {
    poster: 'https://img00.deviantart.net/176d/i/2008/306/a/1/big_buccaneer_by_ratow.jpg',
    name: 'Big Buck',
    webm: 'https://upload.wikimedia.org/wikipedia/commons/transcoded/7/79/Big_Buck_Bunny_small.ogv/Big_Buck_Bunny_small.ogv.120p.vp9.webm'
  },
  sintel: {
    poster: 'https://i1.wp.com/thetalkinggeek.com/wp-content/uploads/2015/09/sintel1.png?zoom=2&resize=800%2C445&ssl=1',
    name: 'Sintel Trailer',
    webm: 'https://upload.wikimedia.org/wikipedia/commons/transcoded/7/75/Sintel_movie_720x306.ogv/Sintel_movie_720x306.ogv.360p.webm',
  },
  w3c: {
    poster: 'https://images-na.ssl-images-amazon.com/images/S/sgp-catalog-images/region_US/wb-883316455302-Full-Image_GalleryBackground-en-US-1483994511251._RI_SX940_.jpg',
    name: 'Happy feet 2 trailer',
    ogg: 'http://html5videocreator.github.io/data/images/happyfit2.ogv'
  }

};
function Video (defaultCodecFormat, elementTag) {
  Media.call (this, 'video', defaultCodecFormat, elementTag);
  var self = this;
  // when customer click inside the tag aria make it play/pause the video
  this.mediaElement.onclick = function () { self.playPause (); };
  this.generatePlaylist();
}
Video.prototype = Object.create(Media.prototype);
Video.prototype.toggleFullScreen = function () {
  if (this.mediaElement.requestFullscreen) {
    this.mediaElement.requestFullscreen();
  } else if (this.mediaElement.webkitRequestFullScreen) {
    this.mediaElement.webkitRequestFullScreen();
  } else if (this.mediaElement.mozRequestFullScreen) {
    this.mediaElement.mozRequestFullScreen();
  } else if (this.mediaElement.msRequestFullscreen) {
    this.mediaElement.msRequestFullscreen();
  }
};
Video.prototype.switchVideo = function (videoName) {
  var sourceFragment = document.createDocumentFragment();
  for (var index in videoList[videoName]){
    if(index === 'poster'){
      this.mediaElement.setAttribute('poster', videoList[videoName][index]);
    } else if(index != 'name') {
      var sourcePiece = document.createElement('source');
      sourcePiece.src = videoList[videoName][index];
      sourcePiece.type = 'video/' + index;
      sourceFragment.appendChild(sourcePiece);
    }
  }
  this.mediaElement.innerHTML = '';
  this.mediaElement.appendChild(sourceFragment);
  // if video is not loaded - load it
  this.mediaElement.setAttribute('width', '723px');
  this.mediaElement.setAttribute('height', '361px');
  this.mediaElement.load();
};
Video.prototype.generatePlaylist = function () {
  var self = this;
  var playlistElement = document.getElementById('videoPlaylist');
  var playlistFragment = document.createDocumentFragment();
  for (var index in videoList){
    var mediaBlock = document.createElement('div');
    var mediaLeftBlock = document.createElement('div');
    var mediaBodyBlock = document.createElement('div');
    var imageBlock = document.createElement('img');
    var headerBlock = document.createElement('h3');
    var textBlock = document.createElement('p');
    mediaBlock.className = 'media';
    mediaBlock.id = index;
    mediaLeftBlock.className = 'media-left';
    imageBlock.className = 'media-object';
    imageBlock.src = videoList[index].poster;
    imageBlock.alt = videoList[index].name;
    mediaBodyBlock.className = 'media-body';
    headerBlock.className='mt-0';
    headerBlock.innerHTML = videoList[index].name;
    textBlock.innerHTML = 'Official trailer';
    mediaLeftBlock.appendChild(imageBlock);
    mediaBodyBlock.appendChild(headerBlock);
    mediaBodyBlock.appendChild(textBlock);
    mediaBlock.appendChild(mediaLeftBlock);
    mediaBlock.appendChild(mediaBodyBlock);
    playlistFragment.appendChild(mediaBlock);
  }
  playlistElement.innerHTML = '';
  playlistElement.appendChild(playlistFragment);
  var media = document.getElementsByClassName('media');
  // iterate each element of HTMLCollection with Array method 'forEach'
  [].forEach.call(media, function (el) {
    // assign event listener for every media element
    el.addEventListener('click', function () {
      self.switchVideo(el.id);
    });
    (function(_el){
      _el.addEventListener('click', function () {
        self.switchVideo(_el.id);
      });
    })(el);
  });
};
Video.prototype.resizeVideo = function () {
  if (this.mediaEvents.loadeddata > 0) { // check if video loaded
    if (this.mediaElement.width != (this.mediaElement.videoWidth + 200)) { // and video width not equal to this one
      this.mediaElement.width = this.mediaElement.videoWidth + 200;
      this.mediaElement.height = this.mediaElement.videoHeight + 200;
    } else { // return video to initial size
      this.mediaElement.width = this.mediaElement.videoWidth;
      this.mediaElement.height = this.mediaElement.videoHeight;
    }
  }
};
var mediaObject;
mediaObject = new Video ('webm', 'video');
document.getElementById('controlsPlayPause').addEventListener("click", function() {
  mediaObject.playPause();
}, false);
document.getElementById('controlsStop').addEventListener("click", function() {
  mediaObject.playPause(); mediaObject.mediaElement.currentTime = 0;
}, false);
document.getElementById('controlsDecreaseVolume').addEventListener("click", function() {
  mediaObject.mediaElement.volume-=0.1;
}, false);
document.getElementById('controlsMute').addEventListener("click", function() {
  mediaObject.toggleMute();
}, false);
document.getElementById('controlsIncreaseVolume').addEventListener("click", function() {
  mediaObject.mediaElement.volume+=0.1;
}, false);
document.getElementById('controlsDecreaseSpeed').addEventListener("click", function() {
  mediaObject.mediaElement.playbackRate--;
}, false);
document.getElementById('controlsIncreaseSpeed').addEventListener("click", function() {
  mediaObject.mediaElement.playbackRate++;
}, false);
document.getElementById('controlsLoop').addEventListener("click", function() {
  mediaObject.loopUnloop();
}, false);
document.getElementById('controlsReload').addEventListener("click", function() {
  mediaObject.mediaElement.load();
}, false);
document.getElementById('controlsStepBack').addEventListener("click", function() {
  mediaObject.mediaElement.currentTime-=10;
}, false);
document.getElementById('controlsStepForward').addEventListener("click", function() {
  mediaObject.mediaElement.currentTime+=10;
}, false);
/*------------------------------------------- VIDEO CLASS END --------------------------------------------------------*/