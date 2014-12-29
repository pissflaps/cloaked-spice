/**
 * @license MIT
 * @fileOverview Favico animations
 * @author Miroslav Magda, http://blog.ejci.net
 * @version 0.3.4
 */

/**
 * Create new favico instance
 * @param {Object} Options
 * @return {Object} Favico object
 * @example
 * var favico = new Favico({
 *    bgColor : '#d00',
 *    textColor : '#fff',
 *    fontFamily : 'sans-serif',
 *    fontStyle : 'bold',
 *    position : 'down',
 *    type : 'circle',
 *    animation : 'slide',
 * });
 */
(function() {

    var Favico = (function(opt) {'use strict';
        opt = (opt) ? opt : {};
        var _def = {
            bgColor : '#d00',
            textColor : '#fff',
            fontFamily : 'sans-serif', //Arial,Verdana,Times New Roman,serif,sans-serif,...
            fontStyle : 'bold', //normal,italic,oblique,bold,bolder,lighter,100,200,300,400,500,600,700,800,900
            type : 'circle',
            position : 'down', // down, up, left, leftup (upleft)
            animation : 'slide',
            elementId : false
        };
        var _opt, _orig, _h, _w, _canvas, _context, _img, _ready, _lastBadge, _running, _readyCb, _stop, _browser;

        _browser = {};
        _browser.ff = (/firefox/i.test(navigator.userAgent.toLowerCase()));
        _browser.chrome = (/chrome/i.test(navigator.userAgent.toLowerCase()));
        _browser.opera = (/opera/i.test(navigator.userAgent.toLowerCase()));
        _browser.ie = (/msie/i.test(navigator.userAgent.toLowerCase())) || (/trident/i.test(navigator.userAgent.toLowerCase()));
        _browser.supported = (_browser.chrome || _browser.ff || _browser.opera);

        var _queue = [];
        _readyCb = function() {
        };
        _ready = _stop = false;
        /**
         * Initialize favico
         */
        var init = function() {
            //merge initial options
            _opt = merge(_def, opt);
            _opt.bgColor = hexToRgb(_opt.bgColor);
            _opt.textColor = hexToRgb(_opt.textColor);
            _opt.position = _opt.position.toLowerCase();
            _opt.animation = (animation.types['' + _opt.animation]) ? _opt.animation : _def.animation;

            var isUp = _opt.position.indexOf('up') > -1;
            var isLeft = _opt.position.indexOf('left') > -1;

            //transform animation
            if (isUp || isLeft) {
                for (var i = 0; i < animation.types['' + _opt.animation].length; i++) {
                    var step = animation.types['' + _opt.animation][i];

                    if (isUp) {
                        if (step.y < 0.6) {
                            step.y = step.y - 0.4;
                        } else {
                            step.y = step.y - 2 * step.y + (1 - step.w);
                        }
                    }

                    if (isLeft) {
                        if (step.x < 0.6) {
                            step.x = step.x - 0.4;
                        } else {
                            step.x = step.x - 2 * step.x + (1 - step.h);
                        }
                    }

                    animation.types['' + _opt.animation][i] = step;
                }
            }
            _opt.type = (type['' + _opt.type]) ? _opt.type : _def.type;
            try {
                _orig = link.getIcon();
                //create temp canvas
                _canvas = document.createElement('canvas');
                //create temp image
                _img = document.createElement('img');
                if (_orig.hasAttribute('href')) {
                    _img.setAttribute('src', _orig.getAttribute('href'));
                    //get width/height
                    _img.onload = function() {
                        _h = (_img.height > 0) ? _img.height : 32;
                        _w = (_img.width > 0) ? _img.width : 32;
                        _canvas.height = _h;
                        _canvas.width = _w;
                        _context = _canvas.getContext('2d');
                        icon.ready();
                    };
                } else {
                    _img.setAttribute('src', '');
                    _h = 32;
                    _w = 32;
                    _img.height = _h;
                    _img.width = _w;
                    _canvas.height = _h;
                    _canvas.width = _w;
                    _context = _canvas.getContext('2d');
                    icon.ready();
                }
            } catch(e) {
                throw 'Error initializing favico. Message: ' + e.message;
            }

        };
        /**
         * Icon namespace
         */
        var icon = {};
        /**
         * Icon is ready (reset icon) and start animation (if ther is any)
         */
        icon.ready = function() {
            _ready = true;
            icon.reset();
            _readyCb();
        };
        /**
         * Reset icon to default state
         */
        icon.reset = function() {
            //reset
            _queue = [];
            _lastBadge = false;
            _context.clearRect(0, 0, _w, _h);
            _context.drawImage(_img, 0, 0, _w, _h);
            //_stop=true;
            link.setIcon(_canvas);
            //webcam('stop');
            //video('stop');
        };
        /**
         * Start animation
         */
        icon.start = function() {
            if (!_ready || _running) {
                return;
            }
            var finished = function() {
                _lastBadge = _queue[0];
                _running = false;
                if (_queue.length > 0) {
                    _queue.shift();
                    icon.start();
                } else {

                }
            };
            if (_queue.length > 0) {
                _running = true;
                var run = function() {
                    // apply options for this animation
                    ['type', 'animation', 'bgColor', 'textColor',
                     'fontFamily', 'fontStyle'].forEach(function(a) {
                        if (a in _queue[0].options) {
                            _opt[a] = _queue[0].options[a];
                        }
                    });
                    animation.run(_queue[0].options, function() {
                        finished();
                    }, false);
                };
                if (_lastBadge) {
                    animation.run(_lastBadge.options, function() {
                        run();
                    }, true);
                } else {
                    run();
                }
            }
        };

        /**
         * Badge types
         */
        var type = {};
        var options = function(opt) {
            opt.n = ((typeof opt.n)==='number') ? Math.abs(opt.n|0) : opt.n;
            opt.x = _w * opt.x;
            opt.y = _h * opt.y;
            opt.w = _w * opt.w;
            opt.h = _h * opt.h;
            opt.len = ("" + opt.n).length;
            return opt;
        };
        /**
         * Generate circle
         * @param {Object} opt Badge options
         */
        type.circle = function(opt) {
            opt = options(opt);
            var more = false;
            if (opt.len === 2) {
                opt.x = opt.x - opt.w * 0.4;
                opt.w = opt.w * 1.4;
                more = true;
            } else if (opt.len >= 3) {
                opt.x = opt.x - opt.w * 0.65;
                opt.w = opt.w * 1.65;
                more = true;
            }
            _context.clearRect(0, 0, _w, _h);
            _context.drawImage(_img, 0, 0, _w, _h);
            _context.beginPath();
            _context.font = _opt.fontStyle + " " + Math.floor(opt.h * (opt.n > 99 ? 0.85 : 1)) + "px " + _opt.fontFamily;
            _context.textAlign = 'center';
            if (more) {
                _context.moveTo(opt.x + opt.w / 2, opt.y);
                _context.lineTo(opt.x + opt.w - opt.h / 2, opt.y);
                _context.quadraticCurveTo(opt.x + opt.w, opt.y, opt.x + opt.w, opt.y + opt.h / 2);
                _context.lineTo(opt.x + opt.w, opt.y + opt.h - opt.h / 2);
                _context.quadraticCurveTo(opt.x + opt.w, opt.y + opt.h, opt.x + opt.w - opt.h / 2, opt.y + opt.h);
                _context.lineTo(opt.x + opt.h / 2, opt.y + opt.h);
                _context.quadraticCurveTo(opt.x, opt.y + opt.h, opt.x, opt.y + opt.h - opt.h / 2);
                _context.lineTo(opt.x, opt.y + opt.h / 2);
                _context.quadraticCurveTo(opt.x, opt.y, opt.x + opt.h / 2, opt.y);
            } else {
                _context.arc(opt.x + opt.w / 2, opt.y + opt.h / 2, opt.h / 2, 0, 2 * Math.PI);
            }
            _context.fillStyle = 'rgba(' + _opt.bgColor.r + ',' + _opt.bgColor.g + ',' + _opt.bgColor.b + ',' + opt.o + ')';
            _context.fill();
            _context.closePath();
            _context.beginPath();
            _context.stroke();
            _context.fillStyle = 'rgba(' + _opt.textColor.r + ',' + _opt.textColor.g + ',' + _opt.textColor.b + ',' + opt.o + ')';
            //_context.fillText((more) ? '9+' : opt.n, Math.floor(opt.x + opt.w / 2), Math.floor(opt.y + opt.h - opt.h * 0.15));
            if ((typeof opt.n)==='number' && opt.n > 999) {
                _context.fillText(((opt.n > 9999) ? 9 : Math.floor(opt.n / 1000) ) + 'k+', Math.floor(opt.x + opt.w / 2), Math.floor(opt.y + opt.h - opt.h * 0.2));
            } else {
                _context.fillText(opt.n, Math.floor(opt.x + opt.w / 2), Math.floor(opt.y + opt.h - opt.h * 0.15));
            }
            _context.closePath();
        };
        /**
         * Generate rectangle
         * @param {Object} opt Badge options
         */
        type.rectangle = function(opt) {
            opt = options(opt);
            var more = false;
            if (opt.len === 2) {
                opt.x = opt.x - opt.w * 0.4;
                opt.w = opt.w * 1.4;
                more = true;
            } else if (opt.len >= 3) {
                opt.x = opt.x - opt.w * 0.65;
                opt.w = opt.w * 1.65;
                more = true;
            }
            _context.clearRect(0, 0, _w, _h);
            _context.drawImage(_img, 0, 0, _w, _h);
            _context.beginPath();
            _context.font = "bold " + Math.floor(opt.h * (opt.n > 99 ? 0.9 : 1)) + "px sans-serif";
            _context.textAlign = 'center';
            _context.fillStyle = 'rgba(' + _opt.bgColor.r + ',' + _opt.bgColor.g + ',' + _opt.bgColor.b + ',' + opt.o + ')';
            _context.fillRect(opt.x, opt.y, opt.w, opt.h);
            _context.fillStyle = 'rgba(' + _opt.textColor.r + ',' + _opt.textColor.g + ',' + _opt.textColor.b + ',' + opt.o + ')';
            //_context.fillText((more) ? '9+' : opt.n, Math.floor(opt.x + opt.w / 2), Math.floor(opt.y + opt.h - opt.h * 0.15));
            if ((typeof opt.n)==='number' && opt.len > 3) {
                _context.fillText(((opt.n > 9999) ? 9 : Math.floor(opt.n / 1000) ) + 'k+', Math.floor(opt.x + opt.w / 2), Math.floor(opt.y + opt.h - opt.h * 0.2));
            } else {
                _context.fillText(opt.n, Math.floor(opt.x + opt.w / 2), Math.floor(opt.y + opt.h - opt.h * 0.15));
            }
            _context.closePath();
        };

        /**
         * Set badge
         */
        var badge = function(number, opts) {
            opts = ((typeof opts)==='string' ? {animation:opts} : opts) || {};
            _readyCb = function() {
                try {
                    if (typeof(number)==='number' ? (number > 0) : (number !== '')) {
                        var q = {
                            type : 'badge',
                            options : {
                                n : number
                            }
                        };
                        if ('animation' in opts &&
                            animation.types['' + opts.animation]) {
                            q.options.animation = '' + opts.animation;
                        }
                        if ('type' in opts && type['' + opts.type]) {
                            q.options.type = '' + opts.type;
                        }
                        ['bgColor', 'textColor'].forEach(function(o) {
                            if (o in opts) {
                                q.options[o] = hexToRgb(opts[o]);
                            }
                        });
                        ['fontStyle', 'fontFamily'].forEach(function(o) {
                            if (o in opts) {
                                q.options[o] = opts[o];
                            }
                        });
                        _queue.push(q);
                        if (_queue.length > 100) {
                            throw 'Too many badges requests in queue.';
                        }
                        icon.start();
                    } else {
                        icon.reset();
                    }
                } catch(e) {
                    throw 'Error setting badge. Message: ' + e.message;
                }
            };
            if (_ready) {
                _readyCb();
            }
        };

        /**
         * Set image as icon
         */
        var image = function(imageElement) {
            _readyCb = function() {
                try {
                    var w = imageElement.width;
                    var h = imageElement.height;
                    var newImg = document.createElement('img');
                    var ratio = (w / _w < h / _h) ? (w / _w) : (h / _h);
                    newImg.setAttribute('src', imageElement.getAttribute('src'));
                    newImg.height = (h / ratio);
                    newImg.width = (w / ratio);
                    _context.clearRect(0, 0, _w, _h);
                    _context.drawImage(newImg, 0, 0, _w, _h);
                    link.setIcon(_canvas);
                } catch(e) {
                    throw 'Error setting image. Message: ' + e.message;
                }
            };
            if (_ready) {
                _readyCb();
            }
        };
        /**
         * Set video as icon
         */
        var video = function(videoElement) {
            _readyCb = function() {
                try {
                    if (videoElement === 'stop') {
                        _stop = true;
                        icon.reset();
                        _stop = false;
                        return;
                    }
                    //var w = videoElement.width;
                    //var h = videoElement.height;
                    //var ratio = (w / _w < h / _h) ? (w / _w) : (h / _h);
                    videoElement.addEventListener('play', function() {
                        drawVideo(this);
                    }, false);

                } catch(e) {
                    throw 'Error setting video. Message: ' + e.message;
                }
            };
            if (_ready) {
                _readyCb();
            }
        };
        /**
         * Set video as icon
         */
        var webcam = function(action) {
            //UR
            if (!window.URL || !window.URL.createObjectURL) {
                window.URL = window.URL || {};
                window.URL.createObjectURL = function(obj) {
                    return obj;
                };
            }
            if (_browser.supported) {
                var newVideo = false;
                navigator.getUserMedia = navigator.getUserMedia || navigator.oGetUserMedia || navigator.msGetUserMedia || navigator.mozGetUserMedia || navigator.webkitGetUserMedia;
                _readyCb = function() {
                    try {
                        if (action === 'stop') {
                            _stop = true;
                            icon.reset();
                            _stop = false;
                            return;
                        }
                        newVideo = document.createElement('video');
                        newVideo.width = _w;
                        newVideo.height = _h;
                        navigator.getUserMedia({
                            video : true,
                            audio : false
                        }, function(stream) {
                            newVideo.src = URL.createObjectURL(stream);
                            newVideo.play();
                            drawVideo(newVideo);
                        }, function() {
                        });
                    } catch(e) {
                        throw 'Error setting webcam. Message: ' + e.message;
                    }
                };
                if (_ready) {
                    _readyCb();
                }
            }

        };

        /**
         * Draw video to context and repeat :)
         */
        function drawVideo(video) {
            if (video.paused || video.ended || _stop) {
                return false;
            }
            //nasty hack for FF webcam (Thanks to Julian Cwirko, kontakt@redsunmedia.pl)
            try {
                _context.clearRect(0, 0, _w, _h);
                _context.drawImage(video, 0, 0, _w, _h);
            } catch(e) {

            }
            setTimeout(drawVideo, animation.duration, video);
            link.setIcon(_canvas);
        }

        var link = {};
        /**
         * Get icon from HEAD tag or create a new <link> element
         */
        link.getIcon = function() {
            var elm = false;
            var url = '';
            //get link element
            var getLink = function() {
                var link = document.getElementsByTagName('head')[0].getElementsByTagName('link');
                for (var l = link.length, i = (l - 1); i >= 0; i--) {
                    if ((/(^|\s)icon(\s|$)/i).test(link[i].getAttribute('rel'))) {
                        return link[i];
                    }
                }
                return false;
            };
            if (_opt.elementId) {
                //if img element identified by elementId
                elm = document.getElementById(_opt.elementId);
                elm.setAttribute('href', elm.getAttribute('src'));
            } else {
                //if link element
                elm = getLink();
                if (elm === false) {
                    elm = document.createElement('link');
                    elm.setAttribute('rel', 'icon');
                    document.getElementsByTagName('head')[0].appendChild(elm);
                }
            }
            //check if image and link url is on same domain. if not raise error
            url = (_opt.elementId) ? elm.src : elm.href;
/*            if (url.indexOf(document.location.hostname) === -1) {
                throw new Error('Error setting favicon. Favicon image is on different domain (Icon: ' + url + ', Domain: ' + document.location.hostname + ')');
            }*/
            elm.setAttribute('type', 'image/x-icon');
            return elm;
        };
        link.setIcon = function(canvas) {
            var url = canvas.toDataURL('image/png');
            if (_opt.elementId) {
                //if is attached to element (image)
                document.getElementById(_opt.elementId).setAttribute('src', url);
            } else {
                //if is attached to fav icon
                if (_browser.ff || _browser.opera) {
                    //for FF we need to "recreate" element, atach to dom and remove old <link>
                    //var originalType = _orig.getAttribute('rel');
                    var old = _orig;
                    _orig = document.createElement('link');
                    //_orig.setAttribute('rel', originalType);
                    if (_browser.opera) {
                        _orig.setAttribute('rel', 'icon');
                    }
                    _orig.setAttribute('rel', 'icon');
                    _orig.setAttribute('type', 'image/x-icon');
                    document.getElementsByTagName('head')[0].appendChild(_orig);
                    _orig.setAttribute('href', url);
                    if (old.parentNode) {
                        old.parentNode.removeChild(old);
                    }
                } else {
                    _orig.setAttribute('href', url);
                }
            }
        };

        //http://stackoverflow.com/questions/5623838/rgb-to-hex-and-hex-to-rgb#answer-5624139
        //HEX to RGB convertor
        function hexToRgb(hex) {
            var shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
            hex = hex.replace(shorthandRegex, function(m, r, g, b) {
                return r + r + g + g + b + b;
            });
            var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
            return result ? {
                r : parseInt(result[1], 16),
                g : parseInt(result[2], 16),
                b : parseInt(result[3], 16)
            } : false;
        }

        /**
         * Merge options
         */
        function merge(def, opt) {
            var mergedOpt = {};
            var attrname;
            for (attrname in def) {
                mergedOpt[attrname] = def[attrname];
            }
            for (attrname in opt) {
                mergedOpt[attrname] = opt[attrname];
            }
            return mergedOpt;
        }

        /**
         * Cross-browser page visibility shim
         * http://stackoverflow.com/questions/12536562/detect-whether-a-window-is-visible
         */
        function isPageHidden() {
            return document.hidden || document.msHidden || document.webkitHidden || document.mozHidden;
        }

        /**
         * @namespace animation
         */
        var animation = {};
        /**
         * Animation "frame" duration
         */
        animation.duration = 40;
        /**
         * Animation types (none,fade,pop,slide)
         */
        animation.types = {};
        animation.types.fade = [{
            x : 0.4,
            y : 0.4,
            w : 0.6,
            h : 0.6,
            o : 0.0
        }, {
            x : 0.4,
            y : 0.4,
            w : 0.6,
            h : 0.6,
            o : 0.1
        }, {
            x : 0.4,
            y : 0.4,
            w : 0.6,
            h : 0.6,
            o : 0.2
        }, {
            x : 0.4,
            y : 0.4,
            w : 0.6,
            h : 0.6,
            o : 0.3
        }, {
            x : 0.4,
            y : 0.4,
            w : 0.6,
            h : 0.6,
            o : 0.4
        }, {
            x : 0.4,
            y : 0.4,
            w : 0.6,
            h : 0.6,
            o : 0.5
        }, {
            x : 0.4,
            y : 0.4,
            w : 0.6,
            h : 0.6,
            o : 0.6
        }, {
            x : 0.4,
            y : 0.4,
            w : 0.6,
            h : 0.6,
            o : 0.7
        }, {
            x : 0.4,
            y : 0.4,
            w : 0.6,
            h : 0.6,
            o : 0.8
        }, {
            x : 0.4,
            y : 0.4,
            w : 0.6,
            h : 0.6,
            o : 0.9
        }, {
            x : 0.4,
            y : 0.4,
            w : 0.6,
            h : 0.6,
            o : 1.0
        }];
        animation.types.none = [{
            x : 0.4,
            y : 0.4,
            w : 0.6,
            h : 0.6,
            o : 1
        }];
        animation.types.pop = [{
            x : 1,
            y : 1,
            w : 0,
            h : 0,
            o : 1
        }, {
            x : 0.9,
            y : 0.9,
            w : 0.1,
            h : 0.1,
            o : 1
        }, {
            x : 0.8,
            y : 0.8,
            w : 0.2,
            h : 0.2,
            o : 1
        }, {
            x : 0.7,
            y : 0.7,
            w : 0.3,
            h : 0.3,
            o : 1
        }, {
            x : 0.6,
            y : 0.6,
            w : 0.4,
            h : 0.4,
            o : 1
        }, {
            x : 0.5,
            y : 0.5,
            w : 0.5,
            h : 0.5,
            o : 1
        }, {
            x : 0.4,
            y : 0.4,
            w : 0.6,
            h : 0.6,
            o : 1
        }];
        animation.types.popFade = [{
            x : 0.75,
            y : 0.75,
            w : 0,
            h : 0,
            o : 0
        }, {
            x : 0.65,
            y : 0.65,
            w : 0.1,
            h : 0.1,
            o : 0.2
        }, {
            x : 0.6,
            y : 0.6,
            w : 0.2,
            h : 0.2,
            o : 0.4
        }, {
            x : 0.55,
            y : 0.55,
            w : 0.3,
            h : 0.3,
            o : 0.6
        }, {
            x : 0.50,
            y : 0.50,
            w : 0.4,
            h : 0.4,
            o : 0.8
        }, {
            x : 0.45,
            y : 0.45,
            w : 0.5,
            h : 0.5,
            o : 0.9
        }, {
            x : 0.4,
            y : 0.4,
            w : 0.6,
            h : 0.6,
            o : 1
        }];
        animation.types.slide = [{
            x : 0.4,
            y : 1,
            w : 0.6,
            h : 0.6,
            o : 1
        }, {
            x : 0.4,
            y : 0.9,
            w : 0.6,
            h : 0.6,
            o : 1
        }, {
            x : 0.4,
            y : 0.9,
            w : 0.6,
            h : 0.6,
            o : 1
        }, {
            x : 0.4,
            y : 0.8,
            w : 0.6,
            h : 0.6,
            o : 1
        }, {
            x : 0.4,
            y : 0.7,
            w : 0.6,
            h : 0.6,
            o : 1
        }, {
            x : 0.4,
            y : 0.6,
            w : 0.6,
            h : 0.6,
            o : 1
        }, {
            x : 0.4,
            y : 0.5,
            w : 0.6,
            h : 0.6,
            o : 1
        }, {
            x : 0.4,
            y : 0.4,
            w : 0.6,
            h : 0.6,
            o : 1
        }];
        /**
         * Run animation
         * @param {Object} opt Animation options
         * @param {Object} cb Callabak after all steps are done
         * @param {Object} revert Reverse order? true|false
         * @param {Object} step Optional step number (frame bumber)
         */
        animation.run = function(opt, cb, revert, step) {
            var animationType = animation.types[isPageHidden() ? 'none' : _opt.animation];
            if (revert === true) {
                step = ( typeof step !== 'undefined') ? step : animationType.length - 1;
            } else {
                step = ( typeof step !== 'undefined') ? step : 0;
            }
            cb = (cb) ? cb : function() {
            };
            if ((step < animationType.length) && (step >= 0)) {
                type[_opt.type](merge(opt, animationType[step]));
                setTimeout(function() {
                    if (revert) {
                        step = step - 1;
                    } else {
                        step = step + 1;
                    }
                    animation.run(opt, cb, revert, step);
                }, animation.duration);

                link.setIcon(_canvas);
            } else {
                cb();
                return;
            }
        };
        //auto init
        init();
        return {
            badge : badge,
            video : video,
            image : image,
            webcam : webcam,
            reset : icon.reset
        };
    });

    // AMD / RequireJS
    if ( typeof define !== 'undefined' && define.amd) {
        define([], function() {
            return Favico;
        });
    }
    // CommonJS
    else if ( typeof module !== 'undefined' && module.exports) {
        module.exports = Favico;
    }
    // included directly via <script> tag
    else {
        this.Favico = Favico;
    }

})();
/**
 * Cookie plugin
 *
 * Copyright (c) 2006 Klaus Hartl (stilbuero.de)
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 */

/**
 * Create a cookie with the given name and value and other optional parameters.
 *
 * @example $.cookie('the_cookie', 'the_value');
 * @desc Set the value of a cookie.
 * @example $.cookie('the_cookie', 'the_value', { expires: 7, path: '/', domain: 'jquery.com', secure: true });
 * @desc Create a cookie with all available options.
 * @example $.cookie('the_cookie', 'the_value');
 * @desc Create a session cookie.
 * @example $.cookie('the_cookie', null);
 * @desc Delete a cookie by passing null as value. Keep in mind that you have to use the same path and domain
 *       used when the cookie was set.
 *
 * @param String name The name of the cookie.
 * @param String value The value of the cookie.
 * @param Object options An object literal containing key/value pairs to provide optional cookie attributes.
 * @option Number|Date expires Either an integer specifying the expiration date from now on in days or a Date object.
 *                             If a negative value is specified (e.g. a date in the past), the cookie will be deleted.
 *                             If set to null or omitted, the cookie will be a session cookie and will not be retained
 *                             when the the browser exits.
 * @option String path The value of the path atribute of the cookie (default: path of page that created the cookie).
 * @option String domain The value of the domain attribute of the cookie (default: domain of page that created the cookie).
 * @option Boolean secure If true, the secure attribute of the cookie will be set and the cookie transmission will
 *                        require a secure protocol (like HTTPS).
 * @type undefined
 *
 * @name $.cookie
 * @cat Plugins/Cookie
 * @author Klaus Hartl/klaus.hartl@stilbuero.de
 */

/**
 * Get the value of a cookie with the given name.
 *
 * @example $.cookie('the_cookie');
 * @desc Get the value of a cookie.
 *
 * @param String name The name of the cookie.
 * @return The value of the cookie.
 * @type String
 *
 * @name $.cookie
 * @cat Plugins/Cookie
 * @author Klaus Hartl/klaus.hartl@stilbuero.de
 */
jQuery.cookie = function(name, value, options) {
    if (typeof value != 'undefined') { // name and value given, set cookie
        options = options || {};
        if (value === null) {
            value = '';
            options.expires = -1;
        }
        var expires = '';
        if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
            var date;
            if (typeof options.expires == 'number') {
                date = new Date();
                date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
            } else {
                date = options.expires;
            }
            expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
        }
        // CAUTION: Needed to parenthesize options.path and options.domain
        // in the following expressions, otherwise they evaluate to undefined
        // in the packed version for some reason...
        var path = options.path ? '; path=' + (options.path) : '';
        var domain = options.domain ? '; domain=' + (options.domain) : '';
        var secure = options.secure ? '; secure' : '';
        document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
    } else { // only name given, get cookie
        var cookieValue = null;
        if (document.cookie && document.cookie != '') {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = jQuery.trim(cookies[i]);
                // Does this cookie string begin with the name we want?
                if (cookie.substring(0, name.length + 1) == (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        return cookieValue;
    }
};
/*! http://mths.be/placeholder v2.0.7 by @mathias */
!function(a,b,c){function d(a){var b={},d=/^jQuery\d+$/;return c.each(a.attributes,function(a,c){c.specified&&!d.test(c.name)&&(b[c.name]=c.value)}),b}function e(a,d){var e=this,f=c(e);if(e.value==f.attr("placeholder")&&f.hasClass("placeholder"))if(f.data("placeholder-password")){if(f=f.hide().next().show().attr("id",f.removeAttr("id").data("placeholder-id")),a===!0)return f[0].value=d;f.focus()}else e.value="",f.removeClass("placeholder"),e==b.activeElement&&e.select()}function f(){var a,b=this,f=c(b),g=this.id;if(""==b.value){if("password"==b.type){if(!f.data("placeholder-textinput")){try{a=f.clone().attr({type:"text"})}catch(h){a=c("<input>").attr(c.extend(d(this),{type:"text"}))}a.removeAttr("name").data({"placeholder-password":!0,"placeholder-id":g}).bind("focus.placeholder",e),f.data({"placeholder-textinput":a,"placeholder-id":g}).before(a)}f=f.removeAttr("id").hide().prev().attr("id",g).show()}f.addClass("placeholder"),f[0].value=f.attr("placeholder")}else f.removeClass("placeholder")}var g,h,i="placeholder"in b.createElement("input"),j="placeholder"in b.createElement("textarea"),k=c.fn,l=c.valHooks;i&&j?(h=k.placeholder=function(){return this},h.input=h.textarea=!0):(h=k.placeholder=function(){var a=this;return a.filter((i?"textarea":":input")+"[placeholder]").not(".placeholder").bind({"focus.placeholder":e,"blur.placeholder":f}).data("placeholder-enabled",!0).trigger("blur.placeholder"),a},h.input=i,h.textarea=j,g={get:function(a){var b=c(a);return b.data("placeholder-enabled")&&b.hasClass("placeholder")?"":a.value},set:function(a,d){var g=c(a);return g.data("placeholder-enabled")?(""==d?(a.value=d,a!=b.activeElement&&f.call(a)):g.hasClass("placeholder")?e.call(a,!0,d)||(a.value=d):a.value=d,g):a.value=d}},i||(l.input=g),j||(l.textarea=g),c(function(){c(b).delegate("form","submit.placeholder",function(){var a=c(".placeholder",this).each(e);setTimeout(function(){a.each(f)},10)})}),c(a).bind("beforeunload.placeholder",function(){c(".placeholder").each(function(){this.value=""})}))}(this,document,jQuery);

/*
//fgnass.github.com/spin.js#v1.2.6
// -- Removed 7/9/2014 //
!function(e,t,n){function o(e,n){var r=t.createElement(e||"div"),i;for(i in n)r[i]=n[i];return r}function u(e){for(var t=1,n=arguments.length;t<n;t++)e.appendChild(arguments[t]);return e}function f(e,t,n,r){var o=["opacity",t,~~(e*100),n,r].join("-"),u=.01+n/r*100,f=Math.max(1-(1-e)/t*(100-u),e),l=s.substring(0,s.indexOf("Animation")).toLowerCase(),c=l&&"-"+l+"-"||"";return i[o]||(a.insertRule("@"+c+"keyframes "+o+"{"+"0%{opacity:"+f+"}"+u+"%{opacity:"+e+"}"+(u+.01)+"%{opacity:1}"+(u+t)%100+"%{opacity:"+e+"}"+"100%{opacity:"+f+"}"+"}",a.cssRules.length),i[o]=1),o}function l(e,t){var i=e.style,s,o;if(i[t]!==n)return t;t=t.charAt(0).toUpperCase()+t.slice(1);for(o=0;o<r.length;o++){s=r[o]+t;if(i[s]!==n)return s}}function c(e,t){for(var n in t)e.style[l(e,n)||n]=t[n];return e}function h(e){for(var t=1;t<arguments.length;t++){var r=arguments[t];for(var i in r)e[i]===n&&(e[i]=r[i])}return e}function p(e){var t={x:e.offsetLeft,y:e.offsetTop};while(e=e.offsetParent)t.x+=e.offsetLeft,t.y+=e.offsetTop;return t}var r=["webkit","Moz","ms","O"],i={},s,a=function(){var e=o("style",{type:"text/css"});return u(t.getElementsByTagName("head")[0],e),e.sheet||e.styleSheet}(),d={lines:12,length:7,width:5,radius:10,rotate:0,corners:1,color:"#000",speed:1,trail:100,opacity:.25,fps:20,zIndex:2e9,className:"spinner",top:"auto",left:"auto"},v=function m(e){if(!this.spin)return new m(e);this.opts=h(e||{},m.defaults,d)};v.defaults={},h(v.prototype,{spin:function(e){this.stop();var t=this,n=t.opts,r=t.el=c(o(0,{className:n.className}),{position:"relative",width:0,zIndex:n.zIndex}),i=n.radius+n.length+n.width,u,a;e&&(e.insertBefore(r,e.firstChild||null),a=p(e),u=p(r),c(r,{left:(n.left=="auto"?a.x-u.x+(e.offsetWidth>>1):parseInt(n.left,10)+i)+"px",top:(n.top=="auto"?a.y-u.y+(e.offsetHeight>>1):parseInt(n.top,10)+i)+"px"})),r.setAttribute("aria-role","progressbar"),t.lines(r,t.opts);if(!s){var f=0,l=n.fps,h=l/n.speed,d=(1-n.opacity)/(h*n.trail/100),v=h/n.lines;(function m(){f++;for(var e=n.lines;e;e--){var i=Math.max(1-(f+e*v)%h*d,n.opacity);t.opacity(r,n.lines-e,i,n)}t.timeout=t.el&&setTimeout(m,~~(1e3/l))})()}return t},stop:function(){var e=this.el;return e&&(clearTimeout(this.timeout),e.parentNode&&e.parentNode.removeChild(e),this.el=n),this},lines:function(e,t){function i(e,r){return c(o(),{position:"absolute",width:t.length+t.width+"px",height:t.width+"px",background:e,boxShadow:r,transformOrigin:"left",transform:"rotate("+~~(360/t.lines*n+t.rotate)+"deg) translate("+t.radius+"px"+",0)",borderRadius:(t.corners*t.width>>1)+"px"})}var n=0,r;for(;n<t.lines;n++)r=c(o(),{position:"absolute",top:1+~(t.width/2)+"px",transform:t.hwaccel?"translate3d(0,0,0)":"",opacity:t.opacity,animation:s&&f(t.opacity,t.trail,n,t.lines)+" "+1/t.speed+"s linear infinite"}),t.shadow&&u(r,c(i("#000","0 0 4px #000"),{top:"2px"})),u(e,u(r,i(t.color,"0 0 1px rgba(0,0,0,.1)")));return e},opacity:function(e,t,n){t<e.childNodes.length&&(e.childNodes[t].style.opacity=n)}}),function(){function e(e,t){return o("<"+e+' xmlns="urn:schemas-microsoft.com:vml" class="spin-vml">',t)}var t=c(o("group"),{behavior:"url(#default#VML)"});!l(t,"transform")&&t.adj?(a.addRule(".spin-vml","behavior:url(#default#VML)"),v.prototype.lines=function(t,n){function s(){return c(e("group",{coordsize:i+" "+i,coordorigin:-r+" "+ -r}),{width:i,height:i})}function l(t,i,o){u(a,u(c(s(),{rotation:360/n.lines*t+"deg",left:~~i}),u(c(e("roundrect",{arcsize:n.corners}),{width:r,height:n.width,left:n.radius,top:-n.width>>1,filter:o}),e("fill",{color:n.color,opacity:n.opacity}),e("stroke",{opacity:0}))))}var r=n.length+n.width,i=2*r,o=-(n.width+n.length)*2+"px",a=c(s(),{position:"absolute",top:o,left:o}),f;if(n.shadow)for(f=1;f<=n.lines;f++)l(f,-2,"progid:DXImageTransform.Microsoft.Blur(pixelradius=2,makeshadow=1,shadowopacity=.3)");for(f=1;f<=n.lines;f++)l(f);return u(t,a)},v.prototype.opacity=function(e,t,n,r){var i=e.firstChild;r=r.shadow&&r.lines||0,i&&t+r<i.childNodes.length&&(i=i.childNodes[t+r],i=i&&i.firstChild,i=i&&i.firstChild,i&&(i.opacity=n))}):s=l(t,"animation")}(),typeof define=="function"&&define.amd?define(function(){return v}):e.Spinner=v}(window,document);  */