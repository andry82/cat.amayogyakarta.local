$(document).ready(function () {
	var funcNum = getUrlParam('CKEditorFuncNum'); 

	$('#elfinder').elfinder(
		// 1st Arg - options
		{
			cssAutoLoad : false,               // Disable CSS auto loading
			baseUrl : plugin_url,                    // Base URL to css/*, js/*
			url: site_url + 'admin/files/connector',  // connector URL (REQUIRED)
			getFileCallback : function(file) {
				window.opener.CKEDITOR.tools.callFunction(funcNum, file.url);
				window.close();
			},
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
			// , lang: 'ru'                    // language (OPTIONAL)
		},
		// 2nd Arg - before boot up function
		function(fm, extraObj) {
			// `init` event callback function
			fm.bind('init', function() {
				// Optional for Japanese decoder "encoding-japanese.js"
				if (fm.lang === 'ja') {
					fm.loadScript(
						[ '//cdn.rawgit.com/polygonplanet/encoding.js/1.0.26/encoding.min.js' ],
						function() {
							if (window.Encoding && Encoding.convert) {
								fm.registRawStringDecoder(function(s) {
									return Encoding.convert(s, {to:'UNICODE',type:'string'});
								});
							}
						},
						{ loadType: 'tag' }
					);
				}
			});
			// Optional for set document.title dynamically.
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
	);
});

function getUrlParam(paramName) {
	var reParam = new RegExp('(?:[\?&]|&amp;)' + paramName + '=([^&]+)', 'i') ;
	var match = window.location.search.match(reParam) ;
	return (match && match.length > 1) ? match[1] : '' ;
}