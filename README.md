[![Actions Status](https://github.com/wyattblue/auto-editor/workflows/build/badge.svg)](https://github.com/wyattblue/auto-editor/actions)
<a href="https://discord.com/invite/kMHAWJJ/"><img src="https://img.shields.io/discord/711767814821773372?color=%237289DA&label=chat&logo=discord&logoColor=white"></a>
<img src="https://img.shields.io/badge/version-21w11a-blue.svg">
<p align="center"><img src="https://raw.githubusercontent.com/wyattblue/auto-editor/master/articles/imgs/auto-editor_banner.png" title="Auto-Editor" width="700"></p>

**Auto-Editor** is a command line application for automatically **editing video and audio** by analyzing where sections are silent and cutting them up.

Before doing the real editing, you first cut out the "dead space" which is typically just silence. This is typically known as a "first pass". Cutting all these dead spaces is a boring task, especially if the video is 15 minutes, 30 minutes, or even an hour long.

Luckily, this can be automated with software. [Once you'll installed auto-editor](https://github.com/WyattBlue/auto-editor/blob/master/articles/installing.md), you can run:

```
auto-editor path/to/your/video.mp4
```

from your console and it will generate a **brand new video** with all the silent sections cut off. Generating a new video **takes a while** so instead, you can export the new video to your editor directly. For example, running:

```
auto-editor example.mp4 --export_to_premiere
```

Will create an XML file that can be imported to Adobe Premiere Pro. This is **much much faster** than generating a new video (takes usually seconds). DaVinici Resolve and Final Cut Pro are also supported.

```
auto-editor example.mp4 --export_to_resolve
```

```
auto-editor example.mp4 --export_to_final_cut_pro
```


You can change the **pace** of a video by changing by including frames that are silent but are next to loud parts. A frame margin of 8 will add up to 8 frames before and 8 frames after the loud part.

```
auto-editor example.mp4 --frame_margin 8
```

<h3 align="center">Auto-Editor is available on all platforms</h3>
<p align="center"><img src="https://raw.githubusercontent.com/WyattBlue/auto-editor/master/articles/imgs/cross_platform.png" width="500" title="Windows, MacOs, and Linux"></p>


## Articles
 - [How to Install Auto-Editor](https://github.com/WyattBlue/auto-editor/blob/master/articles/installing.md)
 - [How to Edit Videos With Auto-Editor](https://github.com/WyattBlue/auto-editor/blob/master/articles/editing.md)
 - [How to Use Motion Detection in Auto-Editor](https://github.com/WyattBlue/auto-editor/blob/master/articles/motionDetection.md)
 - [`--cut_out`, `--ignore`, and Range Syntax](https://github.com/WyattBlue/auto-editor/blob/master/articles/rangeSyntax.md)
 - [Zooming](https://github.com/WyattBlue/auto-editor/blob/master/articles/zooming.md)
 - [The Rectangle Effect](https://github.com/WyattBlue/auto-editor/blob/master/articles/rectangleEffect.md)
 - [Subcommands](https://github.com/WyattBlue/auto-editor/blob/master/articles/subcommands.md)

## Copyright
Auto-Editor is under the [Public Domain](https://github.com/WyattBlue/auto-editor/blob/master/LICENSE) but contains non-free elements. See [this page](https://github.com/WyattBlue/auto-editor/blob/master/articles/legalinfo.md) for more info.

## Issues
If you have a bug or a code suggestion, you can [create a new issue](https://github.com/WyattBlue/auto-editor/issues/new) here. If you'll like to discuss this project, suggest new features, or chat with other users, you can use [the discord server](https://discord.com/invite/kMHAWJJ).

## LA Hacks project addition ideas

- [ ] Electron GUI for a modern, intuitive interface
- [ ] More flexible encoder options for video processing
    - [] control quality, crf/bitrate
    - [] option for vp9 or h264
        - h264 pros: Currently the editor outputs in a fairly uncompressed format, which uses unecessarily high amount of disk space, and for a cloud service version would dramatically increase bandwidth costs.
            - example_long.mp4 as mpeg4: output video has bitrate of 973 kb/s
            - example_long.mp4 as h.264: output video has bitrate of 322 kb/s
            - and the time spent processing is about the time, though cpu usage is higher.
            - still, cpu usage is not maximum, which means there is more performance we could gain if we want to render our videos even faster.
            - also, cv render takes about twice as long, but with 1/5th the cpu usage, so as long as the output files are the same that seems like the more efficient codec, and we can slice and multisize it.
            jk it's about the same. 
            Opencv: 1377 %cpuSeconds
            FFmpeg: 1367 %cpuSeconds
            now that I think about it this makes perfect sense since I believe opencv uses ffmpeg for the back end anyway.
            note: %cpu measures where 100% cpu is 6c/12t @4ghz of an intel i7 4930k
            with AV renderer (ffmpeg) and single threaded h264 encoding, we get 1062 %cpuSeconds, a nice improvement, although our wall clock time increases to 81 seconds, the %cpuSeconds shows we are making more efficient use of the hardware. And, the bitrate is even slightly lower at 320 kb/s, though that is likely down to margin of error.
            at 2 threads we get 1194 %cpuSeconds, so it looks like 1 thread is the most efficient.
            

        - h264 cons: Significantly higher processing demands, potentially an issue for home users of the desktop version. Cloud can have stronger processors, but that also means higher costs. Although the data shows it's actually about the same?
- [ ] GPU/multithreading acceleration
- [ ] Option to output video in lower resolution for lighter processing
- [ ] Cloud hosted option 