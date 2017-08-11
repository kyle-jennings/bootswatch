//////////
// MAIN //
//////////

// standard global variables
var container;
var scene;
var camera;
var renderer;
var speed1 = 10;
var speed2 = 12;
var clock = new THREE.Clock();

// custom global variables
var cube;
var context = new AudioContext();
var audioBuffer;
var sourceNode;
var splitter;
var analyser, analyser2;
var javascriptNode;

//audio palyer
// check if the default naming is enabled, if not use the chrome one.
if (! window.AudioContext) {
  if (! window.webkitAudioContext) {
    console.log('no audiocontext found');
    return false;
  }
  window.AudioContext = window.webkitAudioContext;
}


$(function(){
  // initialization
  init();

  // animation loop / game loop
  animate();
});
///////////////
// FUNCTIONS //
///////////////

function init()  {

  scene = new THREE.Scene();

  ////////////
  // CAMERA //
  ////////////

  // set the view size in pixels (custom or according to window size)
  // var SCREEN_WIDTH = 400, SCREEN_HEIGHT = 300;
  var SCREEN_WIDTH = window.innerWidth, SCREEN_HEIGHT = window.innerHeight;
  // camera attributes
  var VIEW_ANGLE = 50, ASPECT = SCREEN_WIDTH / SCREEN_HEIGHT, NEAR = 0.1, FAR = 20000;
  // set up camera
  camera = new THREE.PerspectiveCamera( VIEW_ANGLE, ASPECT, NEAR, FAR);
  // add the camera to the scene
  scene.add(camera);
  // the camera defaults to position (0,0,0)
  // 	so pull it back (z = 400) and up (y = 100) and set the angle towards the scene origin
  camera.position.set(0,250,400);
  camera.lookAt(scene.position);

  //////////////
  // RENDERER //
  //////////////

  // create and start the renderer; choose antialias setting.
  renderer = new THREE.WebGLRenderer( {antialias:true} );
  renderer.setSize(SCREEN_WIDTH, SCREEN_HEIGHT);
  // attach div element to variable to contain the renderer
  container = document.getElementById('audio-visuals');

  if(!container || container == 'undefined')
    return false;
  // attach renderer to the container div
  container.appendChild( renderer.domElement );


  ///////////
  // LIGHT //
  ///////////

  // create a light
  var light = new THREE.PointLight(0xffffff);
  light.position.set(0,250,100);
  scene.add(light);
  var ambientLight = new THREE.AmbientLight(0x111111);
  // scene.add(ambientLight);

  var particleTexture = THREE.ImageUtils.loadTexture( 'data:image/png;base64,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');

  particleGroup = new THREE.Object3D();
  particleAttributes = { startSize: [], startPosition: [], randomness: [] };
  var totalParticles = 500;
  var radiusRange = 50;
  for( var i = 0; i < totalParticles; i++ )
  {
      var spriteMaterial = new THREE.SpriteMaterial( { map: particleTexture, useScreenCoordinates: false, color: 0xffffff } );

  	var sprite = new THREE.Sprite( spriteMaterial );
  	sprite.scale.set( 20, 20, 0.1 ); // imageWidth, imageHeight
  	sprite.position.set( Math.random() - 0.5, Math.random() - 0.5, Math.random() - 0.5 );
  	// for a cube:
  	// sprite.position.multiplyScalar( radiusRange );
  	// for a solid sphere:
  	// sprite.position.setLength( radiusRange * Math.random() );
  	// for a spherical shell:
  	sprite.position.setLength( radiusRange * (Math.random() * 0.1 + 0.9) );

  	// sprite.color.setRGB( Math.random(),  Math.random(),  Math.random() );
  	sprite.material.color.setHSL( Math.random(), 0.9, 0.7 );

  	// sprite.opacity = 0.80; // translucent particles
  	sprite.material.blending = THREE.AdditiveBlending; // "glowing" particles

  	particleGroup.add( sprite );
  	// add variable qualities to arrays, if they need to be accessed later
  	particleAttributes.startPosition.push( sprite.position.clone() );
  	particleAttributes.randomness.push( Math.random() );
  }
  particleGroup.position.y = 50;
  scene.add( particleGroup );
}

function animate() {
  requestAnimationFrame( animate );
  render();
  update();
}

function update() {
  var time = 4 * clock.getElapsedTime();

  for ( var c = 0; c < particleGroup.children.length; c ++ ) {
  	var sprite = particleGroup.children[ c ];

  	// particle wiggle
  	var wiggleScale = speed2;
  	sprite.position.x += wiggleScale * (Math.random() - 0.5);
  	sprite.position.y += wiggleScale * (Math.random() - 0.5);
  	sprite.position.z += wiggleScale * (Math.random() - 0.5);

  	// pulse away/towards center
  	// individual rates of movement
  	var a = particleAttributes.randomness[c] + 1;
  	var pulseFactor = Math.sin(a * time) * 0.1 + speed1;
  	sprite.position.x = particleAttributes.startPosition[c].x * pulseFactor;
  	sprite.position.y = particleAttributes.startPosition[c].y * pulseFactor;
  	sprite.position.z = particleAttributes.startPosition[c].z * pulseFactor;
  }

  // rotate the entire group
  particleGroup.rotation.x = time * 0.1;
  particleGroup.rotation.y = time * 0.1;
  particleGroup.rotation.z = time * 0.2;

}

function render() {
  renderer.render( scene, camera );
}



// load the sound
setupAudioNodes();

function setupAudioNodes() {
  var el = document.getElementById('audio');
  var sourceNode = context.createMediaElementSource(el);

  // setup a javascript node
  javascriptNode = context.createScriptProcessor(2048, 1, 1);
  // connect to destination, else it isn't called
  javascriptNode.connect(context.destination);
  // setup a analyzer
  analyser = context.createAnalyser();
  analyser.smoothingTimeConstant = 0.3;
  analyser.fftSize = 1024;
  analyser2 = context.createAnalyser();
  analyser2.smoothingTimeConstant = 0.0;
  analyser2.fftSize = 1024;

  // create a buffer source node
  //sourceNode = context.createBufferSource();
  splitter = context.createChannelSplitter();

  // connect the source to the analyser and the splitter
  sourceNode.connect(splitter);

  // connect one of the outputs from the splitter to
  // the analyser
  splitter.connect(analyser,0,0);
  splitter.connect(analyser2,1,0);

  // we use the javascript node to draw at a
  // specific interval.
  analyser.connect(javascriptNode);

  // and connect to destination
  sourceNode.connect(context.destination);
  el.play();
}

javascriptNode.onaudioprocess = function() {
  // get the average for the first channel
  var array =  new Uint8Array(analyser.frequencyBinCount);
  analyser.getByteFrequencyData(array);
  var average = getAverageVolume(array);
  speed1=average/20;
  // get the average for the second channel
  var array2 =  new Uint8Array(analyser2.frequencyBinCount);
  analyser2.getByteFrequencyData(array2);
  var average2 = getAverageVolume(array2);
  speed2=average2/30;

}

function getAverageVolume(array) {
    var values = 0;
    var average;

    var length = array.length;

    // get all the frequency amplitudes
    for (var i = 0; i < length; i++) {
        values += array[i];
    }

    average = values / length;
    return average;
}
