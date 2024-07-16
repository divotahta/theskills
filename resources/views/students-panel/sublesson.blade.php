<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight ">
        {{ $lesson->name }}
        </h2>
    </x-slot>


<div class="mt-5 relative overflow-x-auto shadow-md sm:rounded-lg">

<center>
<div id="player"></div>
<br><br>
<button type="button" class="mr-3 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"  id="play">Play</button>
<button type="button" class="mr-3 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"   id="pause">Pause</button>
<button type="button" class="mr-3 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"  id="forward">Maju</button>
<button type="button" class="mr-3 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"  id="backward">Mundur</button>
</center>

@if (!empty($lesson->pdf_location))
<div class="flex justify-center mt-3">
    <a href="{{ asset('storage/' . $lesson->pdf_location) }}" target="_blank" class="btn btn-primary text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Buka materi PDF</a>
</div>
@endif


</div>


<script>
    var tag = document.createElement('script');
    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    var player;
    function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
            height: '315',
            width: '560',
            videoId:  '{{ $lesson->youtube_link }}',
            playerVars: {
                'playsinline': 1
            },
            events: {
                'onReady': onPlayerReady,
                'onStateChange': onPlayerStateChange
            }
        });
    }

    function onPlayerReady(event) {
        document.getElementById('play').addEventListener('click', function() {
            player.playVideo();
        });
        document.getElementById('pause').addEventListener('click', function() {
            player.pauseVideo();
        });
        document.getElementById('forward').addEventListener('click', function() {
            var currentTime = player.getCurrentTime();
            player.seekTo(currentTime + 60, true); // Maju 1 menit (60 detik)
        });
        document.getElementById('backward').addEventListener('click', function() {
            var currentTime = player.getCurrentTime();
            player.seekTo(currentTime - 60, true); // Mundur 1 menit (60 detik)
        });
    }

    var done = false;
    function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.PLAYING && !done) {
            done = true;
        }
    }

    function stopVideo() {
        player.stopVideo();
    }
</script>

<style>
    iframe {
        pointer-events: none;
    }
</style>
</x-app-layout>