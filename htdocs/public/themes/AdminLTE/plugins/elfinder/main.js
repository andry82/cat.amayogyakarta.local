/**
 * elFinder client options and main script for RequireJS
 *
 * e.g. `<script data-main="./main.js" src="./require.js"></script>`
 **/
define('elFinderConfig', {
	// elFinder options (REQUIRED)
	// Documentation for client options:
	// https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
	defaultOpts : {
		url : site_url + 'admin/files/connector', // connector URL (REQUIRED)
		commandsOptions : {
			edit : {
				extraOptions : {
					// set API key to enable Creative Cloud image editor
					// see https://console.adobe.io/
					creativeCloudApiKey : '',
					// browsing manager URL for CKEditor, TinyMCE
					// uses self location with the empty value
					managerUrl : ''
				}
			},
			quicklook : {
				// to enable preview with Google Docs Viewer
				googleDocsMimes : ['application/pdf', 'image/tiff', 'application/vnd.ms-office', 'application/msword', 'application/vnd.ms-word', 'application/vnd.ms-excel', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']
			}
		},
		uiOptions : {
			// toolbar configuration
			toolbar : [
				// ['back', 'forward'],
				// ['reload'],
				// ['home', 'up'],
				// ['mkdir', 'mkfile']
				['upload'],
				['quicklook', 'open', 'download', 'info'], 
				// ['getfile'],
				['copy', 'cut', 'paste'],
				['rm'],
				['duplicate', 'rename', 'edit', 'resize'],
				// ['extract', 'archive'],
				['search'],
				['view'],
				['fullscreen']
				// ['help']
			],

			// directories tree options
			tree : {
				// expand current root on init
				openRootOnLoad : true,
				// auto load current dir parents
				syncTree : true
			},

			// navbar options
			navbar : {
				minWidth : 150,
				maxWidth : 500
			},

			// current working directory options
			cwd : {
				// display parent directory in listing as ".."
				oldSchool : false
			}
		},
		contextmenu: {
			// navbarfolder menu
			navbar: ['open', 'download', '|', 'upload', '|', 'info', 'chmod'],
			// current directory menu
			cwd: ['undo', 'redo', '|', 'back', 'up', 'reload', '|', 'upload', 'paste', '|', '|', 'view', 'sort', 'selectall', 'colwidth', '|', 'info', '|', 'fullscreen', '|'], //'mkdir', 'mkfile',
			// current directory file menu
			files: ['getfile', '|', 'open', 'download', 'opendir', 'quicklook', '|', 'upload', '|', 'copy', 'cut', 'paste', 'duplicate', '|', 'empty', '|', 'rename', 'edit', 'resize', '|', 'selectall', 'selectinvert', '|', 'info', 'chmod', 'netunmount']
		},
		height : '500',
		// bootCalback calls at before elFinder boot up 
		bootCallback : function(fm, extraObj) {
			/* any bind functions etc. */
			fm.bind('init', function() {
				// any your code
			});
			// for example set document.title dynamically.
			var title = document.title;
			fm.bind('open', function() {
				var path = '',
					cwd  = fm.cwd();
				if (cwd) {
					path = fm.path(cwd.hash) || null;
				}
				document.title = path? path + ':' + title : title;
			}).bind('destroy', function() {
				document.title = title;
			});
		}
	},
	managers : {
		// 'DOM Element ID': { /* elFinder options of this DOM Element */ }
		'elfinder': {}
	}
 });

define('returnVoid', void 0);

(function(){
	"use strict";
	var // jQuery and jQueryUI version
		jqver = '3.4.1',
		uiver = '1.12.1',
		
		// Detect language (optional)
		lang = (function() {
			var locq = window.location.search,
				map = {
					'ja' : 'jp',
					'pt' : 'pt_BR',
					'ug' : 'ug_CN',
					'zh' : 'zh_CN'
				},
				full = {
					'zh_tw' : 'zh_TW',
					'zh_cn' : 'zh_CN',
					'fr_ca' : 'fr_CA'
				},
				fullLang, locm, lang;
			if (locq && (locm = locq.match(/lang=([a-zA-Z_-]+)/))) {
				// detection by url query (?lang=xx)
				fullLang = locm[1];
			} else {
				// detection by browser language
				fullLang = (navigator.browserLanguage || navigator.language || navigator.userLanguage || '');
			}
			fullLang = fullLang.replace('-', '_').substr(0,5).toLowerCase();
			if (full[fullLang]) {
				lang = full[fullLang];
			} else {
				lang = (fullLang || 'en').substr(0,2);
				if (map[lang]) {
					lang = map[lang];
				}
			}
			return lang;
		})(),

		// Start elFinder (REQUIRED)
		start = function (elFinder, editors, config) {
			
			// load jQueryUI CSS
			elFinder.prototype.loadCss('//cdnjs.cloudflare.com/ajax/libs/jqueryui/'+uiver+'/themes/smoothness/jquery-ui.css');
			
			$(function() {
				var optEditors = {
						commandsOptions: {
							edit: {
								editors: Array.isArray(editors)? editors : []
							}
						}
					},
					opts = {};

				// Interpretation of "elFinderConfig"
				if (config && config.managers) {
					$.each(config.managers, function(id, mOpts) {
						opts = Object.assign(opts, config.defaultOpts || {});
						// editors marges to opts.commandOptions.edit
						try {
							mOpts.commandsOptions.edit.editors = mOpts.commandsOptions.edit.editors.concat(editors || []);
						} catch(e) {
							Object.assign(mOpts, optEditors);
						}
						// Make elFinder
						$('#' + id).elfinder(
							// 1st Arg - options
							$.extend(true, { lang: lang }, opts, mOpts || {}),
							// 2nd Arg - before boot up function
							function(fm, extraObj) {
								// `init` event callback function
								fm.bind('init', function() {
									// Optional for Japanese decoder "extras/encoding-japanese.min"
									delete fm.options.rawStringDecoder;
									if (fm.lang === 'ja' || fm.lang === 'jp') {
										require(
											[ 'encoding-japanese' ],
											function(Encoding) {
												if (Encoding && Encoding.convert) {
													fm.registRawStringDecoder(function(s) {
														return Encoding.convert(s, {to:'UNICODE',type:'string'});
													});
												}
											}
										);
									}
								});
							}
						);
					});
				} else {
					alert('"elFinderConfig" object is wrong.');
				}
			});
		},
		
		// JavaScript loader (REQUIRED)
		load = function() {
			require(
				[
					'elfinder',
					'extras/editors.default',	   // load text, image editors
					'elFinderConfig'
				//  , 'extras/quicklook.googledocs'  // optional preview for GoogleApps contents on the GoogleDrive volume
				],
				start,
				function(error) {
					alert(error.message);
				}
			);
		},
		
		// is IE8 or :? for determine the jQuery version to use (optional)
		old = (typeof window.addEventListener === 'undefined' && typeof document.getElementsByClassName === 'undefined')
		       ||
		      (!window.chrome && !document.unqueID && !window.opera && !window.sidebar && 'WebkitAppearance' in document.documentElement.style && document.body.style && typeof document.body.style.webkitFilter === 'undefined');
		
	// config of RequireJS (REQUIRED)
	require.config({
		baseUrl : plugin_url + 'elfinder/js', // '//cdnjs.cloudflare.com/ajax/libs/elfinder/'+elver+'/js',
		paths : {
			'jquery'   : '//cdnjs.cloudflare.com/ajax/libs/jquery/'+(old? '1.12.4' : jqver)+'/jquery.min',
			'jquery-ui': '//cdnjs.cloudflare.com/ajax/libs/jqueryui/'+uiver+'/jquery-ui.min',
			'elfinder' : 'elfinder.min',
			'encoding-japanese': '//cdn.rawgit.com/polygonplanet/encoding.js/1.0.26/encoding.min'
		},
		waitSeconds : 10 // optional
	});

	// load JavaScripts (REQUIRED)
	load();

})();
